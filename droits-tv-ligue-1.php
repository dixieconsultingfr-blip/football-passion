<?php
$page_title    = 'Droits TV Ligue 1 2026-2027 : tout savoir sur Ligue 1+';
$meta_desc     = "Ligue 1+ diffuse 100 % des matchs en 2026-2027. Formules, prix, partage à 2 utilisateurs, plateformes d'accès : le guide complet pour ne rien rater de la Ligue 1 McDonald's.";
$date_maj_page = '2026-09-22';
require_once __DIR__ . '/blog/helpers.php';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "datePublished": "2026-09-22T08:00:00+02:00",
  "dateModified": "<?= $date_maj_page ?>T08:00:00+02:00",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Sur quelle chaîne voir la Ligue 1 en 2026-2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La Ligue 1 McDonald's 2026-2027 est diffusée en exclusivité sur Ligue 1+, la plateforme officielle éditée par la LFP. Aucun match n'est disponible en clair ou sur une chaîne gratuite."
      }
    },
    {
      "@type": "Question",
      "name": "Quel est le prix de l'abonnement Ligue 1+ ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Quatre formules : Pass Mobile à 19,99 €/mois (1 écran, sans engagement), Pass Mensuel à 24,99 €/mois (2 écrans, sans engagement), Pass Ligue 1 à 14,99 €/mois les 3 premiers mois puis 19,99 €/mois (2 écrans, engagement 12 mois), Pass Direct 1 An à 199 € pour la saison complète (2 écrans, engagement 12 mois)."
      }
    },
    {
      "@type": "Question",
      "name": "Peut-on partager son abonnement Ligue 1+ ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Oui, trois formules sur quatre autorisent 2 connexions simultanées. En partageant le Pass Direct 1 An (199 €) à deux, le coût descend à 99,50 € par personne pour toute la saison."
      }
    },
    {
      "@type": "Question",
      "name": "Comment s'abonner à Ligue 1+ sans passer par le site officiel ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ligue 1+ est accessible via DAZN, Amazon Prime Video, OneFootball, Molotov, RMC Sport, L'Équipe, ainsi que directement depuis les décodeurs des opérateurs internet français (Free, Orange, SFR, Bouygues)."
      }
    },
    {
      "@type": "Question",
      "name": "Ligue 1+ diffuse-t-elle aussi la Ligue 3 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Oui. Ligue 1+ détient les droits exclusifs de la Ligue 3 Betclic pour trois saisons (2026-2027 à 2028-2029). L'abonnement Ligue 1+ donne accès aux 309 rencontres de la saison, en plus de tous les matchs de Ligue 1."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2 flex-wrap">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/droits-tv-football.php" class="hover:text-green-400 transition-colors">Guide droits TV</a>
    <span>›</span>
    <span class="text-gray-400">Ligue 1</span>
</nav>

<div class="max-w-3xl mx-auto">

    <!-- HERO -->
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-widest">Droits TV · Ligue 1</p>
            <span class="text-gray-600 text-xs">· mis à jour le <?= date_fr_long($date_maj_page) ?></span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Droits TV Ligue 1 2026-2027 : tout ce qu'il faut savoir sur Ligue 1+</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            Depuis cette saison, la Ligue 1 McDonald's n'est plus sur Canal+ ni sur Prime Video. Un seul diffuseur, une seule plateforme : Ligue 1+. On vous explique tout — formules, prix, partage, et où s'abonner.
        </p>
    </header>

    <!-- AdSense -->
    <div class="w-full flex justify-center mb-10">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-1397315006076063"
             data-ad-slot="6597827779"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>

    <!-- SECTION 1 — QUI DIFFUSE -->
    <section class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center h-12 px-3 bg-white rounded-xl shrink-0">
                <img src="/images/logo/Logo-diffusion-ligue-1+.webp" alt="Logo Ligue 1+" class="h-6 w-auto object-contain" />
            </span>
            <h2 class="text-2xl font-bold text-white">Ligue 1+ : le diffuseur exclusif de la Ligue 1</h2>
        </div>
        <p class="text-gray-300 leading-relaxed mb-4">
            La plateforme <strong class="text-white">Ligue 1+</strong>, éditée par la Filiale LFP 2, diffuse l'intégralité des matchs de la Ligue 1 McDonald's en exclusivité pour les saisons 2026-2027 à 2028-2029. Ce n'est plus Canal+, ce n'est plus Amazon Prime Video : un abonnement Ligue 1+ est désormais le seul moyen de regarder le championnat de France en direct.
        </p>
        <p class="text-gray-300 leading-relaxed mb-4">
            En bonus : l'abonnement inclut aussi l'intégralité de la <strong class="text-white">Ligue 3 Betclic</strong> (309 rencontres par saison), dont Ligue 1+ détient également les droits exclusifs sur trois saisons.
        </p>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5 mb-6">
            <p class="text-white font-semibold text-sm mb-3">📺 Ce que couvre Ligue 1+</p>
            <ul class="text-gray-400 text-sm space-y-1.5">
                <li>✓ 100 % des matchs de Ligue 1 McDonald's en direct (380 rencontres)</li>
                <li>✓ 100 % des matchs de Ligue 3 Betclic en direct (309 rencontres)</li>
                <li>✓ Résumés, replays et contenus éditoriaux</li>
                <li>✓ Diffusion sur TV, ordinateur, smartphone, tablette</li>
            </ul>
        </div>
    </section>

    <!-- SECTION 2 — FORMULES ET PRIX -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Les 4 formules Ligue 1+ et leurs prix</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-800 border border-red-800 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-red-400 mb-2">Offre limitée</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Ligue 1</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">14,99 €<span class="text-sm text-gray-400 font-normal"> /mois*</span></p>
                <p class="text-gray-500 text-xs mb-4">*pendant 3 mois, puis 19,99 €/mois — engagement 12 mois</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✓ 2 écrans simultanés</li>
                    <li>✓ TV, mobile, tablette, PC</li>
                </ul>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Sans engagement</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Mensuel</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">24,99 €<span class="text-sm text-gray-400 font-normal"> /mois</span></p>
                <p class="text-gray-500 text-xs mb-4">Résiliable à tout moment</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✓ 2 écrans simultanés</li>
                    <li>✓ TV, mobile, tablette, PC</li>
                </ul>
            </div>
            <div class="bg-gray-800 border border-green-700 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-green-400 mb-2">Meilleure offre</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Direct 1 An</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">199 €<span class="text-sm text-gray-400 font-normal"> /saison</span></p>
                <p class="text-gray-500 text-xs mb-4">Paiement unique — engagement 12 mois</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✓ 2 écrans simultanés</li>
                    <li>✓ TV, mobile, tablette, PC</li>
                </ul>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Mobile uniquement</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Mobile</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">19,99 €<span class="text-sm text-gray-400 font-normal"> /mois</span></p>
                <p class="text-gray-500 text-xs mb-4">Smartphone et tablette uniquement</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✗ 1 écran seulement</li>
                    <li>✗ Pas de TV / PC</li>
                </ul>
            </div>
        </div>

        <div class="bg-green-900/10 border border-green-800 rounded-xl p-5">
            <p class="text-green-400 font-bold text-sm uppercase tracking-wider mb-3">💡 Astuce Football-Passion</p>
            <p class="text-gray-300 text-sm leading-relaxed">
                Le <strong class="text-white">Pass Direct 1 An</strong> autorise 2 connexions simultanées. Partagé avec un proche, il revient à <strong class="text-white">99,50 € par personne</strong> pour toute la saison — soit moins de 5 € par journée de Ligue 1.
                Détail complet dans notre guide : <a href="/blog/partager-abonnement-ligue-1-plus" class="text-green-400 underline hover:text-green-300">peut-on partager son abonnement Ligue 1+ ?</a>
            </p>
            <p class="text-gray-600 text-xs mt-3">⚠️ Tarifs vérifiés sur <a href="https://plus.ligue1.com/home" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">plus.ligue1.com</a>, susceptibles d'évoluer à tout moment.</p>
        </div>
    </section>

    <!-- SECTION 3 — OÙ S'ABONNER -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Où s'abonner à Ligue 1+ ?</h2>
        <p class="text-gray-300 leading-relaxed mb-4">Plusieurs points d'entrée pour accéder à Ligue 1+ :</p>
        <div class="space-y-3">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                <p class="text-white font-semibold text-sm mb-1">🌐 Site officiel</p>
                <p class="text-gray-400 text-sm">plus.ligue1.com — accès direct, toutes les formules disponibles.</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                <p class="text-white font-semibold text-sm mb-1">📱 Application OneFootball</p>
                <p class="text-gray-400 text-sm">Formules spécifiques via OneFootball : Pass Annuel à 169,99 €, Pass Mensuel à 19,99 €, Pass Demi-Saison à 89 €, Pass App Mobile à 12,99 €. Tarifs distincts du site officiel.</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                <p class="text-white font-semibold text-sm mb-1">📡 Opérateurs internet</p>
                <p class="text-gray-400 text-sm">Free, Orange, SFR, Bouygues — Ligue 1+ est intégrable directement depuis votre décodeur TV.</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                <p class="text-white font-semibold text-sm mb-1">🎬 Plateformes partenaires</p>
                <p class="text-gray-400 text-sm">DAZN, Amazon Prime Video, Molotov, RMC Sport, L'Équipe — chacune peut proposer Ligue 1+ dans ses options.</p>
            </div>
        </div>
    </section>

    <!-- AdSense -->
    <div class="flex justify-center mb-10">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-1397315006076063"
             data-ad-slot="6597827779"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>

    <!-- SECTION 4 — FAQ -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions — Ligue 1 droits TV</h2>
        <div class="space-y-3">
            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Sur quelle chaîne voir la Ligue 1 en 2026-2027 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">La Ligue 1 McDonald's 2026-2027 est diffusée en exclusivité sur Ligue 1+, la plateforme officielle éditée par la LFP. Aucun match n'est disponible en clair ou sur une chaîne gratuite.</p>
            </details>
            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Quel est le prix de l'abonnement Ligue 1+ ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">Quatre formules : Pass Mobile à 19,99 €/mois (1 écran), Pass Mensuel à 24,99 €/mois (2 écrans, sans engagement), Pass Ligue 1 à 14,99 €/mois pendant 3 mois puis 19,99 €/mois (2 écrans, 12 mois), Pass Direct 1 An à 199 € (2 écrans, 12 mois).</p>
            </details>
            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Peut-on partager son abonnement Ligue 1+ ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">Oui, trois formules sur quatre autorisent 2 connexions simultanées. En partageant le Pass Direct 1 An à deux, la facture descend à 99,50 € par personne pour toute la saison. Le Pass Mobile est la seule exception : 1 écran uniquement.</p>
            </details>
            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    La Ligue 1+ est-elle disponible sur Apple TV, Chromecast, Fire TV ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">Ligue 1+ est accessible sur Smart TV, Apple TV, Chromecast, Fire TV Stick et consoles (PlayStation, Xbox) via les applications partenaires (DAZN, OneFootball, Molotov selon la formule choisie). Vérifiez la compatibilité de votre appareil sur plus.ligue1.com avant de souscrire.</p>
            </details>
            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Ligue 1+ diffuse-t-elle aussi la Ligue 3 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">Oui. Ligue 1+ détient les droits exclusifs de la Ligue 3 Betclic pour trois saisons (2026-2027 à 2028-2029). Les 309 rencontres sont incluses dans l'abonnement, sans supplément.</p>
            </details>
        </div>
    </section>

    <p class="text-gray-600 text-xs text-center mb-6">Tarifs vérifiés sur <a href="https://plus.ligue1.com/home" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">plus.ligue1.com</a> (Conditions Générales d'Abonnement, juillet 2026) — susceptibles d'évoluer à tout moment.</p>

    <!-- Liens internes -->
    <section class="mb-8">
        <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-4">Autres guides droits TV</h3>
        <div class="flex flex-wrap gap-3">
            <a href="/droits-tv-ligue-2.php" class="border border-gray-700 text-gray-300 hover:border-green-700 hover:text-green-400 px-4 py-2 text-sm rounded transition-colors">🥈 Droits TV Ligue 2</a>
            <a href="/droits-tv-champions-league.php" class="border border-gray-700 text-gray-300 hover:border-green-700 hover:text-green-400 px-4 py-2 text-sm rounded transition-colors">⭐ Droits TV Champions League</a>
            <a href="/droits-tv-europa-league.php" class="border border-gray-700 text-gray-300 hover:border-green-700 hover:text-green-400 px-4 py-2 text-sm rounded transition-colors">🌍 Droits TV Europa League</a>
            <a href="/droits-tv-football.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-4 py-2 text-sm font-semibold rounded transition-colors">📺 Comparatif complet tous droits TV</a>
        </div>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
