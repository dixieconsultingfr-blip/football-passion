<?php
/**
 * Endpoint inscription newsletter Football Passion
 * Reçoit un email en POST (fetch JS depuis le footer) et synchronise avec Brevo.
 * Pas de stockage local (JSON) : Brevo est la seule source de vérité des abonnés.
 */

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

require __DIR__ . '/config/secrets.php';

// Honeypot anti-bot : champ caché, jamais rempli par un humain
if (!empty($_POST['website'])) {
    echo json_encode(['ok' => true, 'message' => 'subscribed']); // fausse réussite pour le bot
    exit;
}

$email = trim($_POST['email'] ?? '');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Adresse email invalide']);
    exit;
}

$email = strtolower($email);

if (!defined('BREVO_API_KEY') || empty(BREVO_API_KEY)) {
    http_response_code(503);
    echo json_encode(['ok' => false, 'error' => 'Configuration serveur manquante']);
    exit;
}

$payload = ['email' => $email, 'updateEnabled' => true];
if (defined('BREVO_LIST_ID') && BREVO_LIST_ID > 0) {
    $payload['listIds'] = [BREVO_LIST_ID];
}

$ch = curl_init('https://api.brevo.com/v3/contacts');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($payload),
    CURLOPT_HTTPHEADER     => [
        'api-key: ' . BREVO_API_KEY,
        'Content-Type: application/json',
        'Accept: application/json',
    ],
    CURLOPT_TIMEOUT        => 5,
]);
$response   = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Brevo renvoie 201 (créé) ou 204 (déjà existant, mis à jour) selon les cas
if ($statusCode >= 200 && $statusCode < 300) {
    echo json_encode(['ok' => true, 'message' => 'subscribed']);
} else {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => 'Erreur lors de l\'inscription, réessayez plus tard']);
}
exit;
