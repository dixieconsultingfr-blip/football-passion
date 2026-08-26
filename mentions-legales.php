<?php
$page_title = 'Mentions légales — Football Passion';
$meta_desc  = 'Mentions légales du site Football Passion : éditeur, hébergeur, propriété intellectuelle et conditions d\'utilisation.';
include __DIR__ . '/templates/header.php';
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Mentions légales</span>
</nav>

<div class="max-w-3xl mx-auto">

    <h1 class="text-4xl font-bold text-white mb-2">Mentions légales</h1>
    <p class="text-gray-500 text-sm mb-10">Conformément à la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique (LCEN).</p>

    <div class="space-y-8 text-gray-300 leading-relaxed">

        <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold text-white mb-4">Éditeur du site</h2>
            <ul class="space-y-2 text-sm">
                <li><span class="text-gray-500">Nom :</span> Jérôme Henry</li>
                <li><span class="text-gray-500">Entreprise :</span> Dixie Consulting</li>
                <li><span class="text-gray-500">Activité :</span> Consultant et formateur en intelligence artificielle</li>
                <li><span class="text-gray-500">Localisation :</span> Aubagne, France</li>
                <li><span class="text-gray-500">Contact :</span>
                    <a href="/contact.php" class="text-green-400 hover:text-green-300">Formulaire de contact</a>
                </li>
                <li><span class="text-gray-500">Site professionnel :</span>
                    <a href="https://www.dixie.consulting" target="_blank" rel="noopener noreferrer" class="text-green-400 hover:text-green-300">www.dixie.consulting</a>
                </li>
                <li><span class="text-gray-500">En savoir plus :</span>
                    <a href="/a-propos.php" class="text-green-400 hover:text-green-300">page À propos</a>
                </li>
            </ul>
        </section>

        <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold text-white mb-4">Hébergeur</h2>
            <ul class="space-y-2 text-sm">
                <li><span class="text-gray-500">Société :</span> Hostinger International Ltd</li>
                <li><span class="text-gray-500">Adresse :</span> 61 Lordou Vironos Street, 6023 Larnaca, Chypre</li>
                <li><span class="text-gray-500">Site :</span>
                    <a href="https://www.hostinger.fr" target="_blank" rel="noopener noreferrer" class="text-green-400 hover:text-green-300">www.hostinger.fr</a>
                </li>
            </ul>
        </section>

        <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold text-white mb-4">Propriété intellectuelle</h2>
            <p class="text-sm">
                L'ensemble du contenu de ce site (textes, analyses, structure, mise en page) est la propriété exclusive de Jérôme Henry / Dixie Consulting,
                sauf mention contraire. Toute reproduction, même partielle, est interdite sans autorisation préalable écrite.
            </p>
            <p class="text-sm mt-3">
                Les données sportives (scores, classements, statistiques) sont issues de sources publiques et d'APIs tierces
                (football-data.org). Les droits sur ces données appartiennent à leurs propriétaires respectifs.
            </p>
        </section>

        <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold text-white mb-4">Responsabilité</h2>
            <p class="text-sm">
                Football Passion s'efforce de maintenir ses informations à jour et exactes. Toutefois, l'éditeur ne peut garantir
                l'exactitude, la complétude ou l'actualité des données sportives en temps réel (résultats, classements, compositions).
                Ces informations sont fournies à titre indicatif.
            </p>
            <p class="text-sm mt-3">
                Les liens hypertextes vers des sites tiers sont fournis à titre informatif. Football Passion n'est pas responsable
                du contenu des sites référencés.
            </p>
        </section>

        <section class="bg-gray-800 rounded-xl border border-gray-700 p-6">
            <h2 class="text-xl font-bold text-white mb-4">Droit applicable</h2>
            <p class="text-sm">
                Ce site est soumis au droit français. En cas de litige, les tribunaux français sont seuls compétents.
            </p>
        </section>

    </div>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
