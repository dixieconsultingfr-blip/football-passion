<?php
/**
 * Endpoint de generation d'images "titre + phrase choc" pour n8n (branche Pillow/GD).
 * Recoit un template dans images/charte-graphique/, dessine le texte par-dessus via GD,
 * et enregistre le resultat dans images/. Appele en HTTP POST JSON par n8n.
 */

require __DIR__ . '/config/secrets.php';

header('Content-Type: application/json; charset=UTF-8');

// ── Securite : POST + cle secrete ──────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Methode non autorisee']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'JSON invalide']);
    exit;
}

if (($body['secret'] ?? '') !== GENERATE_IMAGE_SECRET) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Cle secrete invalide']);
    exit;
}

// ── Parametres ──────────────────────────────────────────────────────────────
$template = basename(trim($body['template'] ?? ''));
$titre1   = trim($body['titre1'] ?? '');
$titre2   = trim($body['titre2'] ?? '');
$phrase   = trim($body['phrase'] ?? '');
$output   = basename(trim($body['output'] ?? ''));

if ($template === '' || $titre1 === '' || $output === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Parametres manquants (template, titre1, output requis)']);
    exit;
}

$templatePath = __DIR__ . '/images/charte-graphique/' . $template;
$outputPath   = __DIR__ . '/images/' . $output;

if (!is_file($templatePath)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Template introuvable : ' . $template]);
    exit;
}

// ── Chargement de l'image source (PNG ou WebP) ──────────────────────────────
$ext = strtolower(pathinfo($templatePath, PATHINFO_EXTENSION));
switch ($ext) {
    case 'png':
        $src = imagecreatefrompng($templatePath);
        break;
    case 'webp':
        $src = imagecreatefromwebp($templatePath);
        break;
    case 'jpg':
    case 'jpeg':
        $src = imagecreatefromjpeg($templatePath);
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Format de template non supporte : ' . $ext]);
        exit;
}

if (!$src) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Echec du chargement de l\'image template']);
    exit;
}

imagesavealpha($src, true);
$width  = imagesx($src);
$height = imagesy($src);
$isPortrait = $height > $width;

// ── Polices ───────────────────────────────────────────────────────────────
$fontBold     = __DIR__ . '/fonts/Montserrat-Bold.ttf';
$fontSemiBold = __DIR__ . '/fonts/Montserrat-SemiBold.ttf';

// ── Couleurs ──────────────────────────────────────────────────────────────
$white = imagecolorallocate($src, 255, 255, 255);
$green = imagecolorallocate($src, 74, 222, 128); // #4ade80 — vert charte FP

/**
 * Dessine du texte avec retour a la ligne automatique dans une largeur donnee.
 * Retourne la position Y suivante (apres le texte dessine).
 */
function drawWrappedText($im, $fontPath, $size, $color, $x, $y, $maxWidth, $lineHeight, $text) {
    $words = explode(' ', $text);
    $line = '';
    foreach ($words as $word) {
        $test = $line === '' ? $word : $line . ' ' . $word;
        $box = imagettfbbox($size, 0, $fontPath, $test);
        $lineWidth = $box[2] - $box[0];
        if ($lineWidth > $maxWidth && $line !== '') {
            imagettftext($im, $size, 0, $x, $y, $color, $fontPath, $line);
            $y += $lineHeight;
            $line = $word;
        } else {
            $line = $test;
        }
    }
    if ($line !== '') {
        imagettftext($im, $size, 0, $x, $y, $color, $fontPath, $line);
        $y += $lineHeight;
    }
    return $y;
}

if ($isPortrait) {
    // Template FB (ex. 941x1672) — zone de texte dans la moitie superieure basse
    $x = 50;
    $y = 645; // ligne de base de la 1ere ligne de titre
    $maxWidth = 850;

    $y = drawWrappedText($src, $fontBold, 34, $white, $x, $y, $maxWidth, 55, $titre1);
    if ($titre2 !== '') {
        $y = drawWrappedText($src, $fontBold, 34, $white, $x, $y, $maxWidth, 55, $titre2);
    }
    if ($phrase !== '') {
        $y += 25;
        drawWrappedText($src, $fontSemiBold, 24, $green, $x, $y, $maxWidth, 34, $phrase);
    }
} else {
    // Template vignette site (ex. 1731x909) — zone de texte a droite du logo/numero
    $x = 400;
    $y = 195;
    $maxWidth = 1250;

    $y = drawWrappedText($src, $fontBold, 44, $white, $x, $y, $maxWidth, 65, $titre1);
    if ($titre2 !== '') {
        $y = drawWrappedText($src, $fontBold, 44, $white, $x, $y, $maxWidth, 65, $titre2);
    }
    if ($phrase !== '') {
        $y += 30;
        drawWrappedText($src, $fontSemiBold, 26, $green, $x, $y, $maxWidth, 36, $phrase);
    }
}

// ── Export JPEG (qualite 85) ────────────────────────────────────────────────
$flat = imagecreatetruecolor($width, $height);
$bg = imagecolorallocate($flat, 3, 7, 18); // fond de secours si l'image source a de la transparence
imagefill($flat, 0, 0, $bg);
imagecopy($flat, $src, 0, 0, 0, 0, $width, $height);

$ok = imagejpeg($flat, $outputPath, 85);

imagedestroy($src);
imagedestroy($flat);

if (!$ok) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Echec de l\'enregistrement de l\'image']);
    exit;
}

echo json_encode([
    'success' => true,
    'path'    => '/images/' . $output,
    'width'   => $width,
    'height'  => $height,
]);
