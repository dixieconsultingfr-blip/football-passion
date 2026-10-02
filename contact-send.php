<?php
/**
 * Traitement du formulaire de contact Football Passion
 * L'adresse email de destination est définie ICI uniquement — jamais exposée en HTML
 */

// ── Configuration ──────────────────────────────────────────────────────────
const DEST_EMAIL       = 'info@coupe-du-monde-2026.info';
const FROM_DOMAIN      = 'football-passion.fr';

require __DIR__ . '/config/secrets.php';

// ── Sécurité : POST uniquement ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /contact.php');
    exit;
}

// ── Honeypot : si rempli = robot ───────────────────────────────────────────
if (!empty($_POST['website'])) {
    header('Location: /contact.php?status=ok'); // fausse réussite pour le bot
    exit;
}

// ── Vérification Turnstile ─────────────────────────────────────────────────
$turnstileToken = trim($_POST['cf-turnstile-response'] ?? '');
if (empty($turnstileToken)) {
    header('Location: /contact.php?status=captcha');
    exit;
}

$verify = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false,
    stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query([
            'secret'   => TURNSTILE_SECRET_KEY,
            'response' => $turnstileToken,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]),
    ]])
);

$result = $verify ? json_decode($verify, true) : [];
if (empty($result['success'])) {
    header('Location: /contact.php?status=captcha');
    exit;
}

// ── Validation des champs ─────────────────────────────────────────────────
$nom     = trim(strip_tags($_POST['nom']     ?? ''));
$email   = trim($_POST['email']   ?? '');
$sujet   = trim(strip_tags($_POST['sujet']   ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

$sujetsAutorises = ['Question', 'Correction', 'Partenariat', 'Donnees personnelles', 'Autre'];
$sujetNormalise  = str_replace(['é', 'è', 'ê', 'ë', 'É'], 'e', $sujet);

$erreurs = [];
if (mb_strlen($nom)     < 2)                                      $erreurs[] = 'nom';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))                   $erreurs[] = 'email';
if (!in_array($sujetNormalise, $sujetsAutorises, true))           $erreurs[] = 'sujet';
if (mb_strlen($message) < 10)                                     $erreurs[] = 'message';

if ($erreurs) {
    header('Location: /contact.php?status=error');
    exit;
}

// ── Protection anti-flood simple (session) ────────────────────────────────
session_start();
$lastSend = $_SESSION['last_contact_send'] ?? 0;
if (time() - $lastSend < 60) {
    header('Location: /contact.php?status=flood');
    exit;
}
$_SESSION['last_contact_send'] = time();

// ── Construction de l'email ────────────────────────────────────────────────
$sujetSafe  = mb_encode_mimeheader('[Football Passion] ' . $sujet . ' - ' . $nom, 'UTF-8', 'Q');
$fromHeader = 'noreply@' . FROM_DOMAIN;

$corps  = "Nouveau message depuis le formulaire de contact\n";
$corps .= str_repeat('-', 50) . "\n\n";
$corps .= "Nom    : {$nom}\n";
$corps .= "Email  : {$email}\n";
$corps .= "Sujet  : {$sujet}\n\n";
$corps .= "Message :\n{$message}\n\n";
$corps .= str_repeat('-', 50) . "\n";
$corps .= "Envoye le " . date('d/m/Y a H:i') . " depuis football-passion.fr\n";
$corps .= "IP : " . ($_SERVER['REMOTE_ADDR'] ?? 'inconnue') . "\n";

$headers  = "From: Formulaire Football Passion <{$fromHeader}>\r\n";
$headers .= "Reply-To: {$nom} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";

$sent = mail(DEST_EMAIL, $sujetSafe, $corps, $headers);

header('Location: /contact.php?status=' . ($sent ? 'ok' : 'fail'));
exit;
