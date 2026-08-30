<?php
header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
    'gd_loaded'       => extension_loaded('gd'),
    'gd_info'         => function_exists('gd_info') ? gd_info() : null,
    'has_webp_read'   => function_exists('imagecreatefromwebp'),
    'has_webp_write'  => function_exists('imagewebp'),
    'has_png_read'    => function_exists('imagecreatefrompng'),
    'has_jpeg_write'  => function_exists('imagejpeg'),
    'has_ttftext'     => function_exists('imagettftext'),
    'php_version'     => PHP_VERSION,
], JSON_PRETTY_PRINT);
