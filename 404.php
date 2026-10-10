<?php
http_response_code(404);
$page_title = 'Page introuvable — Football Passion';
$meta_desc  = 'Cette page n\'existe pas ou plus. Retrouvez les derniers articles et le calendrier football sur Football Passion.';
include __DIR__ . '/templates/header.php';
?>

<div class="max-w-2xl mx-auto text-center py-16">

    <div class="text-8xl mb-2 select-none">⚽</div>
    <div class="text-7xl font-extrabold text-green-500 mb-4 tracking-tight">404</div>

    <h1 class="text-2xl font-bold text-white mb-3">Hors-jeu !</h1>
    <p class="text-gray-400 mb-10 leading-relaxed">
        Cette page a été sifflée par l'arbitre — elle n'existe pas ou a été déplacée.
        Retournez sur le terrain principal pour continuer votre lecture.
    </p>

    <div class="flex flex-col sm:flex-row gap-3 justify-center mb-12">
        <a href="/" class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition-colors text-sm">
            ← Retour à l'accueil
        </a>
        <a href="/blog" class="border border-gray-600 text-gray-300 hover:border-green-500 hover:text-green-400 font-bold px-6 py-3 rounded-lg transition-colors text-sm">
            Voir tous les articles
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-left">
        <h2 class="text-sm font-bold text-green-400 uppercase tracking-wider mb-4">Pages populaires</h2>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <a href="/calendrier.php" class="text-gray-400 hover:text-green-400 transition-colors">📅 Calendrier des matchs</a>
            <a href="/blog?cat=France" class="text-gray-400 hover:text-green-400 transition-colors">🇫🇷 Équipe de France</a>
            <a href="/coupe-du-monde.php" class="text-gray-400 hover:text-green-400 transition-colors">🏆 Coupe du Monde</a>
            <a href="/blog?cat=CL" class="text-gray-400 hover:text-green-400 transition-colors">⭐ Champions League</a>
            <a href="/a-propos.php" class="text-gray-400 hover:text-green-400 transition-colors">👤 À propos</a>
            <a href="/contact.php" class="text-gray-400 hover:text-green-400 transition-colors">✉️ Contact</a>
        </div>
    </div>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
