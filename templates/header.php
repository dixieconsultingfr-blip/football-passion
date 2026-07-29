<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc ?? 'Hub evergreen football — L1, L2, CL, Europa, Euro, CDM, CAN'); ?>" />
    <title><?php echo htmlspecialchars($page_title ?? 'Football Passion'); ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
</head>
<body class="bg-gray-950 text-gray-100">
    <header class="bg-gray-900 border-b border-green-500">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-green-400">
                ⚽ Football Passion
            </a>
            <ul class="flex gap-6">
                <li><a href="/" class="hover:text-green-400">Accueil</a></li>
                <li><a href="/calendrier.php" class="hover:text-green-400">Calendrier</a></li>
                <li><a href="/blog" class="hover:text-green-400">Blog</a></li>
            </ul>
        </nav>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-8">
