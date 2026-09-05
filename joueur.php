<?php
require_once __DIR__ . '/blog/helpers.php';

$slug = $_GET['slug'] ?? '';
$joueur = load_joueur(__DIR__, $slug);

if (!$joueur) {
    http_response_code(404);
    $page_title = 'Joueur introuvable';
    include __DIR__ . '/templates/header.php';
    echo '<div class="text-center py-20 text-gray-400">Ce joueur n\'est pas encore référencé. <a href="/equipe-france.php" class="text-green-400 hover:text-green-300">Retour à l\'équipe de France</a></div>';
    include __DIR__ . '/templates/footer.php';
    exit;
}

$page_title = $joueur['nom'] . ' — Fiche joueur, sélections et Euro 2028';
$meta_desc  = $joueur['nom'] . ', ' . $joueur['poste'] . ' (' . $joueur['club_actuel'] . ') : fiche complète, statut en équipe de France et suivi des qualifications pour l\'Euro 2028.';
include __DIR__ . '/templates/header.php';

$statut = $joueur['statut_euro2028'] ?? [];
$convoqueQualifs = $statut['convoque_qualifs'] ?? null;
$convoqueFinale  = $statut['convoque_finale'] ?? null;
$dateMaj         = $statut['date_maj'] ?? null;

function badge_statut(?bool $val, string $labelOui, string $labelNon, string $labelAttente): string {
    if ($val === true)  return '<span class="inline-flex items-center gap-1.5 bg-green-900/30 border border-green-700 text-green-400 text-xs font-semibold px-3 py-1.5 rounded-full">✅ ' . htmlspecialchars($labelOui) . '</span>';
    if ($val === false) return '<span class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">➖ ' . htmlspecialchars($labelNon) . '</span>';
    return '<span class="inline-flex items-center gap-1.5 bg-gray-800 border border-gray-700 text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">⏳ ' . htmlspecialchars($labelAttente) . '</span>';
}
?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-400 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <a href="/equipe-france.php" class="hover:text-green-400 transition-colors">Équipe de France</a>
    <span>›</span>
    <span class="text-gray-400"><?= htmlspecialchars($joueur['nom']) ?></span>
</nav>

<!-- Hero -->
<header class="mb-8">
    <p class="text-green-400 text-xs font-semibold uppercase tracking-widest mb-1"><?= htmlspecialchars($joueur['poste']) ?> · N°<?= (int)$joueur['numero_selection'] ?> en Bleu</p>
    <h1 class="text-4xl font-bold text-white mb-4"><?= htmlspecialchars($joueur['nom']) ?></h1>

    <?php if (!empty($joueur['photo'])): ?>
    <figure class="mb-6">
        <img src="<?= htmlspecialchars($joueur['photo']) ?>" alt="<?= htmlspecialchars($joueur['nom']) ?> avec l'équipe de France" class="w-full max-w-2xl rounded-xl border border-gray-700" loading="eager" />
        <?php if (!empty($joueur['photo_credit_auteur'])): ?>
        <figcaption class="text-gray-400 text-xs mt-2">
            Photo : <?= htmlspecialchars($joueur['photo_credit_auteur']) ?>,
            <a href="<?= htmlspecialchars($joueur['photo_credit_licence_url']) ?>" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400"><?= htmlspecialchars($joueur['photo_credit_licence']) ?></a>
        </figcaption>
        <?php endif; ?>
    </figure>
    <?php endif; ?>

    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div>
            <p class="text-gray-400 text-xs mb-1">Né le</p>
            <p class="text-white text-sm font-semibold"><?= date_fr_long($joueur['date_naissance']) ?></p>
        </div>
        <div>
            <p class="text-gray-400 text-xs mb-1">Lieu de naissance</p>
            <p class="text-white text-sm font-semibold"><?= htmlspecialchars($joueur['lieu_naissance']) ?></p>
        </div>
        <div>
            <p class="text-gray-400 text-xs mb-1">Club actuel</p>
            <p class="text-white text-sm font-semibold"><?= htmlspecialchars($joueur['club_actuel']) ?> (n°<?= (int)$joueur['numero_club'] ?>)</p>
        </div>
        <div>
            <p class="text-gray-400 text-xs mb-1">Taille</p>
            <p class="text-white text-sm font-semibold"><?= htmlspecialchars($joueur['taille']) ?></p>
        </div>
    </div>

    <?php if (!empty($joueur['note'])): ?>
    <p class="text-gray-300 leading-relaxed max-w-2xl"><?= htmlspecialchars($joueur['note']) ?></p>
    <?php endif; ?>
</header>

<?php if (!empty($joueur['bio'])): ?>
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Parcours</h2>
    <p class="text-gray-300 leading-relaxed bg-gray-800 rounded-xl border border-gray-700 p-6"><?= htmlspecialchars($joueur['bio']) ?></p>
</section>
<?php endif; ?>

<?php if (!empty($joueur['forme_club_2026_27']) || !empty($joueur['palmares_cdm2026']) || !empty($joueur['ballon_or_2026'])): ?>
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">En forme, en club et en sélection</h2>
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-sm text-gray-300 leading-relaxed space-y-3">
        <?php if (!empty($joueur['forme_club_2026_27'])): ?>
        <p>⚽ <?= htmlspecialchars($joueur['forme_club_2026_27']) ?></p>
        <?php endif; ?>
        <?php if (!empty($joueur['palmares_cdm2026'])): ?>
        <p>🏆 <?= htmlspecialchars($joueur['palmares_cdm2026']) ?></p>
        <?php endif; ?>
        <?php if (!empty($joueur['ballon_or_2026'])): ?>
        <p>🥇 <?= htmlspecialchars($joueur['ballon_or_2026']) ?></p>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($joueur['clin_oeil'])): ?>
<section class="mb-12">
    <div class="bg-green-900/10 border border-green-800 rounded-xl p-6">
        <p class="text-green-400 text-xs font-semibold uppercase tracking-wider mb-2">😉 Le saviez-vous ?</p>
        <p class="text-gray-300 text-sm leading-relaxed"><?= htmlspecialchars($joueur['clin_oeil']) ?></p>
    </div>
</section>
<?php endif; ?>

<!-- Statut Euro 2028 (dynamique) -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-white mb-4">Statut pour l'Euro 2028</h2>
    <div class="bg-gray-800 rounded-xl border border-green-800/40 p-6">
        <div class="flex flex-wrap gap-3 mb-4">
            <?= badge_statut($convoqueQualifs, 'Convoqué pour les qualifications', 'Non retenu pour les qualifications', 'Liste des qualifications pas encore annoncée') ?>
            <?= badge_statut($convoqueFinale, 'Sélectionné pour l\'Euro 2028', 'Non retenu pour l\'Euro 2028', 'Liste de l\'Euro 2028 pas encore annoncée') ?>
        </div>
        <p class="text-gray-400 text-xs">
            Statut mis à jour le <?= $dateMaj ? date_fr_long($dateMaj) : 'non renseigné' ?>. Cette fiche est actualisée à chaque annonce officielle de sélection —
            <a href="/euro-2028-qualifications.php" class="text-green-400 hover:text-green-300 underline">suivre le calendrier complet des qualifications</a>.
        </p>
    </div>
</section>

<!-- Liens internes -->
<section class="flex flex-wrap gap-4 justify-center pb-4">
    <a href="/equipe-france.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">🇫🇷 Équipe de France</a>
    <a href="/euro-2028-qualifications.php" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-5 py-2 text-sm font-semibold rounded transition-colors">📋 Qualifications Euro 2028</a>
</section>

<?php include __DIR__ . '/templates/footer.php'; ?>
