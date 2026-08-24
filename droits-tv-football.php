<?php
// Page pilier SEO — comparatif droits TV football, prépare un futur emplacement de monétisation
// (liens d'affiliation CTA + emplacements publicitaires AdSense, tous deux encore à activer).
$page_title = 'Droits TV Football 2026-2027 : Quel abonnement choisir ?';
$meta_desc  = "Comparez les offres Ligue 1+, DAZN, Canal+ et beIN Sports pour la saison 2026-2027. Découvrez nos astuces pour regarder le foot au meilleur prix.";
include __DIR__ . '/templates/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
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
        "text": "C'est la plateforme officielle Ligue 1+, éditée par la Filiale LFP 2, qui détient l'exclusivité et diffuse 100 % des matchs de la Ligue 1 McDonald's et de la Ligue 3 Betclic pour la saison 2026-2027."
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
        "text": "Vous pouvez vous abonner sur le site officiel plus.ligue1.com, via l'application smartphone/TV, ou directement depuis le décodeur TV de votre opérateur internet (Free, Orange, SFR, Bouygues)."
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
        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-2">Guide abonnement</p>
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
        </div>

        <div class="text-center">
            <a href="#" class="inline-block bg-green-700 hover:bg-green-600 text-white font-bold px-8 py-3.5 rounded-lg transition-colors">
                Comparer toutes les offres sur Ligue 1+
            </a>
            <!-- TODO : remplacer href="#" par le lien d'affiliation dès qu'il sera disponible, et ajouter rel="sponsored noopener noreferrer" -->
        </div>
    </section>

    <!-- ══════════ SECTION 2 — LIGUE 2 & COUPES D'EUROPE ══════════ -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-white mb-4">Ligue 2 BKT et Coupes d'Europe</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">
                <h3 class="text-white font-bold mb-2">🥈 Ligue 2 BKT</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Diffusée principalement par <strong class="text-white">beIN SPORTS</strong>, autour de 15 €/mois sans engagement.
                </p>
            </div>
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

        <!-- Emplacement publicitaire AdSense 300x250 (rectangle) — reserve pour un 2e bloc AdSense dedie, pas encore cree au 24 aout 2026 -->
        <div class="flex justify-center">
            <div class="flex items-center justify-center w-[300px] max-w-full h-[250px] bg-gray-900 border border-dashed border-gray-700 rounded text-gray-600 text-xs">
                Emplacement publicitaire 300×250 (Google AdSense)
            </div>
        </div>
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
                    C'est la plateforme officielle Ligue 1+, éditée par la Filiale LFP 2, qui détient l'exclusivité et diffuse 100 % des matchs de la Ligue 1 McDonald's et de la Ligue 3 Betclic pour la saison 2026-2027.
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
                    Vous pouvez vous abonner sur le site officiel plus.ligue1.com, via l'application smartphone/TV, ou directement depuis le décodeur TV de votre opérateur internet (Free, Orange, SFR, Bouygues).
                </p>
            </details>

        </div>
    </section>

    <p class="text-gray-600 text-xs text-center mb-4">
        Tarifs vérifiés sur <a href="https://plus.ligue1.com/home" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400">plus.ligue1.com</a> et les Conditions Générales d'Abonnement Ligue 1+ (version du 28 juillet 2026) — susceptibles d'évoluer, se référer au site officiel pour toute souscription.
    </p>

    <!-- Liens internes -->
    <section class="flex flex-wrap gap-4 justify-center pt-4 pb-2">
        <a href="/ligue-1.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Ligue 1 : résultats et actualités</a>
        <a href="/champions-league.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">⭐ Champions League</a>
    </section>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
