<?php
// Page pilier SEO — comparatif droits TV football, prépare un futur emplacement de monétisation
// (liens d'affiliation CTA + emplacements publicitaires AdSense, tous deux encore à activer).
$page_title = 'Droits TV Football 2026-2027 : Quel abonnement choisir ?';
$meta_desc  = "Comparez Ligue 1+, DAZN, Canal+ et beIN Sports pour 2026-2027, et découvrez où voir les Bleus en clair sur TF1. Nos astuces pour payer moins.";
$date_maj_page = '2026-09-21'; // à mettre à jour à chaque modification de tarifs/offres — signal E-E-A-T pour Google
require_once __DIR__ . '/blog/helpers.php';
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "datePublished": "2026-08-01T08:00:00+02:00",
  "dateModified": "<?= $date_maj_page ?>T08:00:00+02:00",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Quel est le prix d'un abonnement à la Ligue 1 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le prix dépend de la formule choisie sur Ligue 1+ : Pass Mobile à 19,99 €/mois (sans engagement, 1 utilisateur), Pass Mensuel à 24,99 €/mois (sans engagement, 2 utilisateurs), Pass Ligue 1 - Offre Limitée à 14,99 €/mois les 3 premiers mois puis 19,99 €/mois (engagement 12 mois, 2 utilisateurs), ou Pass Direct 1 An à 199 € payables en une fois (engagement 12 mois, 2 utilisateurs)."
      }
    },
    {
      "@type": "Question",
      "name": "Qui va diffuser la Ligue 1 en 2026 et 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "C'est la plateforme officielle Ligue 1+, éditée par la Filiale LFP 2, qui détient l'exclusivité et diffuse 100 % des matchs de la Ligue 1 McDonald's. Elle diffuse également l'intégralité des 309 rencontres de la Ligue 3 Betclic, dont elle détient les droits exclusifs pour trois saisons (2026-2027 à 2028-2029)."
      }
    },
    {
      "@type": "Question",
      "name": "Quel est l'abonnement le moins cher à la Ligue 1 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Le Pass Ligue 1 - Offre Limitée est l'entrée de gamme à 14,99 €/mois les 3 premiers mois (puis 19,99 €/mois, engagement 12 mois). En partageant le Pass Direct 1 An (199 € pour la saison, 2 utilisateurs autorisés) avec un proche, le coût redescend à 99,50 € par personne."
      }
    },
    {
      "@type": "Question",
      "name": "Peut-on résilier un abonnement Ligue 1+ en cours de saison ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Cela dépend de l'offre. Le Pass Mensuel et le Pass Mobile sont sans engagement et résiliables à tout moment. En revanche, le Pass Ligue 1 - Offre Limitée et le Pass Direct 1 An sont des offres avec engagement de 12 mois : la résiliation anticipée n'est pas possible en cours d'engagement, sauf cas prévus par la loi (déménagement, changement de foyer fiscal, justificatifs à l'appui)."
      }
    },
    {
      "@type": "Question",
      "name": "Comment s'abonner à Ligue 1 Plus ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Vous pouvez vous abonner sur le site officiel plus.ligue1.com, via l'application smartphone/TV, directement depuis le décodeur TV de votre opérateur internet (Free, Orange, SFR, Bouygues), ou encore via une plateforme de streaming partenaire comme DAZN, Amazon Prime Video, OneFootball, Molotov, RMC Sport ou L'Équipe."
      }
    },
    {
      "@type": "Question",
      "name": "Qui va diffuser la Ligue 2 en 2026 et 2027 ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "beIN SPORTS diffuse 100 % des matchs de la Ligue 2 BKT en direct et en exclusivité pour les saisons 2026-2027 et suivantes, jusqu'en 2028-2029. Les 9 matchs de chaque journée sont proposés en direct ou en multiplex, sur les chaînes beIN SPORTS ou via des offres partenaires comme les bouquets CANAL+ Sport."
      }
    },
    {
      "@type": "Question",
      "name": "Sur quelle chaîne voir les matchs de l'équipe de France ?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Les matchs de l'équipe de France en Ligue des nations 2026-2027 sont diffusés en exclusivité et en clair sur TF1 et TF1+, sans abonnement. Le groupe TF1 détient aussi les droits des matchs des Bleus jusqu'en 2028, ce qui inclut les qualifications à l'Euro 2028 prévues en 2027."
      }
    }
  ]
}
</script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Guide des droits TV</span>
</nav>

<div class="max-w-3xl mx-auto">

    <!-- ══════════ HERO ══════════ -->
    <header class="mb-8">
        <!-- TODO image bannière : 1200x630, à générer/déposer dans /images/ (ex. images/droits-tv-football-2026-2027.webp) puis décommenter :
        <img src="/images/droits-tv-football-2026-2027.webp" alt="Droits TV football 2026-2027 : Ligue 1+, Canal+, beIN Sports" class="w-full rounded-2xl border border-gray-800 mb-6" />
        -->
        <div class="flex items-center gap-3 mb-2">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-widest">Guide abonnement</p>
            <span class="text-gray-600 text-xs">· mis à jour le <?= date_fr_long($date_maj_page) ?></span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-4 leading-tight">Droits TV Football 2026-2027 : Quel abonnement choisir pour ne rien rater ?</h1>
        <p class="text-gray-300 text-lg leading-relaxed border-l-4 border-green-500 pl-4">
            La saison est lancée ! Entre Ligue 1+, DAZN, Canal+ et beIN Sports, la facture peut vite grimper. Voici notre guide complet pour trouver la meilleure offre et regarder vos compétitions favorites au juste prix.
        </p>
    </header>

    <!-- Emplacement publicitaire AdSense (leaderboard, desktop) -->
    <div class="w-full flex justify-center mb-10">
        <!-- FP-DROITS-TV -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-1397315006076063"
             data-ad-slot="6597827779"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <!-- ══════════ SECTION 1 — LIGUE 1+ ══════════ -->
    <section class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center h-12 px-3 bg-white rounded-xl shrink-0">
                <img src="/images/logo/Logo-diffusion-ligue-1+.webp" alt="Logo Ligue 1+" class="h-6 w-auto object-contain" />
            </span>
            <h2 class="text-2xl font-bold text-white">Regarder 100 % de la Ligue 1 McDonald's : l'offre Ligue 1+ au crible</h2>
        </div>
        <p class="text-gray-300 leading-relaxed mb-6">
            Pour cette saison 2026-2027, la solution incontournable pour suivre le championnat de France s'appelle Ligue 1+. Si votre objectif est uniquement de vibrer au rythme de la Ligue 1 (et de la Ligue 3), c'est l'option la plus directe du marché — encore faut-il choisir la bonne formule.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-800 border border-green-800 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-red-400 mb-2">Offre limitée</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Ligue 1</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">14,99 €<span class="text-sm text-gray-400 font-normal"> /mois*</span></p>
                <p class="text-gray-500 text-xs mb-4">*pendant 3 mois, puis 19,99 €/mois</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✓ 2 utilisateurs</li>
                    <li>✓ Engagement 12 mois</li>
                </ul>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-green-400 mb-2">Meilleure offre</p>
                <h3 class="text-white font-bold text-lg mb-1">Pass Direct 1 An</h3>
                <p class="text-3xl font-bold text-green-400 mb-1">199 €<span class="text-sm text-gray-400 font-normal"> /année</span></p>
                <p class="text-gray-500 text-xs mb-4">Paiement en une seule fois</p>
                <ul class="text-gray-400 text-sm space-y-1.5">
                    <li>✓ 2 utilisateurs</li>
                    <li>✓ Engagement 12 mois</li>
                </ul>
            </div>
        </div>

        <!-- Bloc astuce Football-Passion -->
        <div class="bg-green-900/10 border border-green-800 rounded-xl p-5 mb-6">
            <p class="text-green-400 font-bold text-sm uppercase tracking-wider mb-3">💡 Astuce Football-Passion</p>
            <p class="text-gray-300 text-sm leading-relaxed">
                <strong class="text-white">Le secret du partage d'écran :</strong> le Pass Direct 1 An inclut 2 connexions en simultané. Partagez l'abonnement avec un proche (colocataire, famille) et le coût de la saison complète tombe à <strong class="text-white">99,50 € par personne</strong>.
            </p>
            <p class="text-gray-500 text-xs mt-3">
                ⚠️ Les Pass Offre Limitée et Direct 1 An sont des offres <strong>avec engagement de 12 mois</strong> : la résiliation anticipée n'est pas possible en cours d'engagement (sauf déménagement ou changement de foyer fiscal, justificatifs à l'appui). Seuls le Pass Mensuel et le Pass Mobile sont sans engagement.
            </p>
            <p class="text-gray-600 text-xs mt-3">
                ⚠️ Tarifs Ligue 1+ ci-dessus communiqués à titre indicatif, susceptibles d'évoluer à tout moment : vérifiez le prix et les conditions à jour sur <a href="https://plus.ligue1.com/home" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">plus.ligue1.com</a> avant toute souscription.
            </p>
        </div>

        <div class="text-center mb-8">
            <a href="#" class="inline-block bg-green-700 hover:bg-green-600 text-white font-bold px-8 py-3.5 rounded-lg transition-colors">
                Comparer toutes les offres sur Ligue 1+
            </a>
            <!-- TODO : remplacer href="#" par le lien d'affiliation dès qu'il sera disponible, et ajouter rel="sponsored noopener noreferrer" -->
        </div>

        <!-- Bloc alternative OneFootball -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
            <p class="text-white font-bold text-sm mb-3">📱 Autre option : Ligue 1+ via l'appli OneFootball</p>
            <p class="text-gray-400 text-sm leading-relaxed mb-4">
                Ligue 1+ est également accessible en France directement depuis l'application OneFootball, avec sa propre grille de pass (distincte des tarifs plus.ligue1.com) :
            </p>
            <ul class="text-gray-400 text-sm space-y-1.5 mb-4">
                <li>✓ Pass App Mobile (30 jours) — <strong class="text-white">12,99 €</strong>, visionnage sur l'appli mobile uniquement</li>
                <li>✓ Pass Mensuel (30 jours) — <strong class="text-white">19,99 €</strong></li>
                <li>✓ Pass Demi-Saison — <strong class="text-white">89 €</strong></li>
                <li>✓ Pass Annuel (365 jours) — <strong class="text-white">169,99 €</strong>, sans renouvellement automatique</li>
            </ul>
            <p class="text-gray-500 text-xs">
                Le Pass Annuel et le Pass Mensuel se regardent sur le web (tv.onefootball.com), l'appli mobile/tablette ou une TV connectée (achat à effectuer au préalable sur le web ou mobile) ; le Pass App Mobile ne fonctionne que dans l'appli iOS/Android. Deux appareils simultanés autorisés par compte. Les résumés et replays de la page créateur Ligue 1+ restent consultables même sans pass complet, selon les droits d'accès.
            </p>
            <p class="text-gray-600 text-xs mt-3">
                ⚠️ Tarifs communiqués par OneFootball, susceptibles d'évoluer à tout moment : vérifiez le prix et les conditions à jour directement dans l'application ou sur <a href="https://onefootballsupport.zendesk.com/hc/fr/articles/39144484562449" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">le centre d'aide OneFootball</a> avant tout achat.
            </p>
        </div>
    </section>

    <!-- ══════════ SECTION 1BIS — LIGUE 3 BETCLIC ══════════ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">🥉 Ligue 3 Betclic : où la regarder ?</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Depuis la saison 2026-2027, <strong class="text-white">Ligue 1+</strong> est le diffuseur exclusif de la Ligue 3 Betclic (ex-National), pour trois saisons (2026-2027 à 2028-2029). L'intégralité des 309 rencontres de la saison est retransmise, play-offs compris — l'abonnement Ligue 1+ donne donc accès aux deux championnats en même temps.
        </p>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5 mb-6">
            <p class="text-white font-semibold text-sm mb-2">📅 Programmation type</p>
            <p class="text-gray-400 text-sm leading-relaxed">
                Une affiche de la journée diffusée le jeudi soir, complétée par un multiplex regroupant les autres rencontres le samedi après-midi.
            </p>
        </div>
    </section>

    <!-- ══════════ SECTION 2 — LIGUE 2 & COUPES D'EUROPE ══════════ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Ligue 2 BKT et Coupes d'Europe</h2>
        <div class="bg-gray-800 border border-gray-700 rounded-xl p-5 mb-4">
            <h3 class="text-white font-bold text-lg mb-3">🥈 Ligue 2 BKT : 100 % des matchs sur beIN SPORTS</h3>
            <figure class="mb-4">
                <img src="/images/ligue-2-bkt-100-pour-cent-bein-sports.jpg" alt="Ligue 2 BKT, 100 % des matchs en exclusivité sur beIN SPORTS, cycle 2024-2029" class="w-full max-w-xl rounded-lg border border-gray-700" loading="lazy" />
                <figcaption class="text-gray-500 text-xs mt-2">La Ligue 2 BKT est diffusée en exclusivité sur beIN SPORTS pour le cycle 2024-2029 — Image : beIN SPORTS</figcaption>
            </figure>
            <p class="text-gray-300 text-sm leading-relaxed mb-3">
                Selon l'accord annoncé fin septembre 2025, <a href="https://www.beinregie.beinsports.com/ligue-2-bkt-2026-2027-bein/" target="_blank" rel="nofollow noopener noreferrer" class="text-green-400 underline hover:text-green-300">beIN SPORTS</a> détient l'exclusivité de la Ligue 2 BKT et retransmet la totalité du championnat en direct jusqu'à la saison 2028-2029, y compris pour 2026-2027. Un changement de taille : jusqu'ici, la chaîne ne proposait que deux affiches par journée, le reste étant partagé avec Prime Video et L'Équipe.
            </p>
            <ul class="text-gray-400 text-sm space-y-1.5 mb-3">
                <li>✓ <strong class="text-white">Les 9 matchs de chaque journée</strong>, en direct ou en multiplex</li>
                <li>✓ Accessible directement sur les chaînes beIN SPORTS, ou via des offres partenaires comme les bouquets <a href="https://boutique.canalplus.com/offres/ligue-2/" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-300">CANAL+ Sport</a></li>
                <li>✓ Abonnement beIN SPORTS autour de 15 €/mois, sans engagement</li>
            </ul>
            <p class="text-gray-600 text-xs">
                ⚠️ Tarifs et modalités susceptibles d'évoluer : vérifiez l'offre en vigueur sur le site officiel de beIN SPORTS avant toute souscription.
            </p>
        </div>
        <div class="grid grid-cols-1 gap-4 mb-6">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
                <h3 class="text-white font-bold mb-2">⭐ Coupes d'Europe</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Ligue des champions, Europa League et Ligue Conférence sont diffusées en intégralité par <strong class="text-white">Canal+</strong>.
                </p>
            </div>
        </div>
        <div class="text-center mb-8">
            <a href="#" class="inline-block border border-green-700 text-green-400 hover:bg-green-700 hover:text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                Découvrir les offres Canal+ Sport
            </a>
            <!-- TODO : remplacer href="#" par le lien d'affiliation dès qu'il sera disponible, et ajouter rel="sponsored noopener noreferrer" -->
        </div>

        <!-- Emplacement publicitaire AdSense (rectangle) -->
        <div class="flex justify-center">
            <!-- FP-DROITS-TV -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-1397315006076063"
                 data-ad-slot="6597827779"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </section>

    <!-- ══════════ SECTION 2BIS — ÉQUIPE DE FRANCE ══════════ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">🇫🇷 Équipe de France : Ligue des nations et qualifications à l'Euro 2028</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Bonne nouvelle : les matchs des Bleus ne nécessitent aucun abonnement payant. <strong class="text-white">TF1 et TF1+</strong> diffusent en exclusivité et en clair la Ligue des nations 2026-2027 de l'équipe de France, dont le premier rendez-vous de l'ère Zidane, le vendredi 25 septembre en Turquie. Le groupe TF1 détient par ailleurs les droits des matchs des Bleus jusqu'en 2028, ce qui devrait inclure les qualifications à l'Euro 2028.
        </p>

        <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto mb-4">
            <table class="w-full text-sm">
                <caption class="text-left text-gray-400 text-xs px-4 pt-3 pb-1">Calendrier de l'équipe de France en Ligue des nations 2026-2027, groupe A1, avec diffusion</caption>
                <thead>
                    <tr class="text-gray-500 uppercase text-xs border-b border-gray-700">
                        <th class="text-left px-4 py-2 font-semibold">Date</th>
                        <th class="text-left px-4 py-2 font-semibold">Match</th>
                        <th class="text-left px-4 py-2 font-semibold">Lieu</th>
                        <th class="text-left px-4 py-2 font-semibold text-green-400">Diffusion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/60 text-gray-300">
                    <tr><td class="px-4 py-2 whitespace-nowrap">Ven. 25 sept., 20h45</td><td class="px-4 py-2">Turquie - France</td><td class="px-4 py-2">Kocaeli</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                    <tr><td class="px-4 py-2 whitespace-nowrap">Lun. 28 sept., 20h45</td><td class="px-4 py-2">Belgique - France</td><td class="px-4 py-2">Bruxelles</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                    <tr><td class="px-4 py-2 whitespace-nowrap">Ven. 2 oct., 20h45</td><td class="px-4 py-2">France - Italie</td><td class="px-4 py-2">Stade de France</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                    <tr><td class="px-4 py-2 whitespace-nowrap">Lun. 5 oct., 20h45</td><td class="px-4 py-2">France - Belgique</td><td class="px-4 py-2">Stade de France</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                    <tr><td class="px-4 py-2 whitespace-nowrap">Jeu. 12 nov., 20h45</td><td class="px-4 py-2">Italie - France</td><td class="px-4 py-2">Italie</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                    <tr><td class="px-4 py-2 whitespace-nowrap">Dim. 15 nov., 20h45</td><td class="px-4 py-2">France - Turquie</td><td class="px-4 py-2">Bordeaux</td><td class="px-4 py-2 text-green-400">TF1 / TF1+</td></tr>
                </tbody>
            </table>
        </div>

        <p class="text-gray-400 text-sm leading-relaxed mb-3">
            Si les Bleus se qualifient, les quarts de finale de la Ligue des nations se joueront du 25 au 30 mars 2027. Côté Euro 2028, le tirage au sort des qualifications aura lieu le 6 décembre 2026 à Belfast (Irlande du Nord), et les matchs aller-retour se disputeront entre mars et novembre 2027.
        </p>
        <p class="text-gray-600 text-xs">
            ⚠️ Calendrier et diffuseur susceptibles d'évoluer : vérifiez la programmation sur <a href="https://www.tf1.fr" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">tf1.fr</a> avant chaque match. Le détail de la liste de Zidane est à retrouver dans <a href="/blog/premiere-liste-zidane-23-bleus-ce-quil-faut-retenir" class="underline hover:text-gray-400">notre article</a>.
        </p>
    </section>

    <!-- ══════════ SECTION 3 — FAQ ══════════ -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-5">Foire aux questions : droits TV et abonnements</h2>
        <div class="space-y-3">

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Quel est le prix d'un abonnement à la Ligue 1 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Le prix dépend de la formule choisie sur Ligue 1+ : Pass Mobile à 19,99 €/mois (sans engagement, 1 utilisateur), Pass Mensuel à 24,99 €/mois (sans engagement, 2 utilisateurs), Pass Ligue 1 - Offre Limitée à 14,99 €/mois les 3 premiers mois puis 19,99 €/mois (engagement 12 mois, 2 utilisateurs), ou Pass Direct 1 An à 199 € payables en une fois (engagement 12 mois, 2 utilisateurs).
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Qui va diffuser la Ligue 1 en 2026 et 2027 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    C'est la plateforme officielle Ligue 1+, éditée par la Filiale LFP 2, qui détient l'exclusivité et diffuse 100 % des matchs de la Ligue 1 McDonald's. Elle diffuse également l'intégralité des 309 rencontres de la Ligue 3 Betclic, dont elle détient les droits exclusifs pour trois saisons (2026-2027 à 2028-2029).
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Quel est l'abonnement le moins cher à la Ligue 1 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Le Pass Ligue 1 - Offre Limitée est l'entrée de gamme à 14,99 €/mois les 3 premiers mois (puis 19,99 €/mois, engagement 12 mois). En partageant le Pass Direct 1 An (199 € pour la saison, 2 utilisateurs autorisés) avec un proche, le coût redescend à 99,50 € par personne.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Peut-on résilier un abonnement Ligue 1+ en cours de saison ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Cela dépend de l'offre. Le Pass Mensuel et le Pass Mobile sont sans engagement et résiliables à tout moment. En revanche, le Pass Ligue 1 - Offre Limitée et le Pass Direct 1 An sont des offres avec engagement de 12 mois : la résiliation anticipée n'est pas possible en cours d'engagement, sauf cas prévus par la loi (déménagement, changement de foyer fiscal, justificatifs à l'appui).
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Comment s'abonner à Ligue 1 Plus ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Vous pouvez vous abonner sur le site officiel plus.ligue1.com, via l'application smartphone/TV, directement depuis le décodeur TV de votre opérateur internet (Free, Orange, SFR, Bouygues), ou encore via une plateforme de streaming partenaire comme DAZN, Amazon Prime Video, OneFootball, Molotov, RMC Sport ou L'Équipe.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Qui va diffuser la Ligue 2 en 2026 et 2027 ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    beIN SPORTS diffuse 100 % des matchs de la Ligue 2 BKT en direct et en exclusivité pour les saisons 2026-2027 et suivantes, jusqu'en 2028-2029. Les 9 matchs de chaque journée sont proposés en direct ou en multiplex, sur les chaînes beIN SPORTS ou via des offres partenaires comme les bouquets CANAL+ Sport.
                </p>
            </details>

            <details class="group bg-gray-800 border border-gray-700 rounded-xl p-5 open:border-green-700">
                <summary class="text-white font-semibold cursor-pointer list-none flex justify-between items-center gap-4">
                    Sur quelle chaîne voir les matchs de l'équipe de France ?
                    <span class="text-green-400 shrink-0 group-open:rotate-45 transition-transform">＋</span>
                </summary>
                <p class="text-gray-400 text-sm leading-relaxed mt-3">
                    Les matchs de l'équipe de France en Ligue des nations 2026-2027 sont diffusés en exclusivité et en clair sur TF1 et TF1+, sans abonnement. Le groupe TF1 détient aussi les droits des matchs des Bleus jusqu'en 2028, ce qui inclut les qualifications à l'Euro 2028 prévues en 2027.
                </p>
            </details>

        </div>
    </section>

    <p class="text-gray-600 text-xs text-center mb-4">
        Tarifs vérifiés sur <a href="https://plus.ligue1.com/home" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">plus.ligue1.com</a> (Conditions Générales d'Abonnement Ligue 1+, version du 28 juillet 2026) et sur <a href="https://onefootballsupport.zendesk.com/hc/fr/articles/39144484562449" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">le centre d'aide OneFootball</a> — susceptibles d'évoluer à tout moment, se référer au site ou à l'application officielle pour toute souscription.
    </p>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-2">
        <a href="/ligue-1.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Ligue 1 : résultats et actualités</a>
        <a href="/champions-league.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">⭐ Champions League</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
