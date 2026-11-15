<?php
// Bandeau défilant : derniers résultats des éliminatoires de la CAN 2027 (journée 3, 12 au 14 novembre 2026).
// À mettre à jour après chaque journée (source : Foot Mercato, groupe par groupe).
$canResultats = [
    ['Angola', 2, 0, 'Soudan du Sud'],
    ['Ouganda', 1, 1, 'Botswana'],
    ['Algérie', 1, 0, 'Togo'],
    ['Gabon', 2, 0, 'Lesotho'],
    ['Maroc', 5, 1, 'Niger'],
    ['Égypte', 5, 0, 'Malawi'],
    ['Afrique du Sud', 2, 2, 'Kenya'],
    ['Burkina Faso', 1, 0, 'Mauritanie'],
    ['Comores', 0, 0, 'Congo'],
    ['Tunisie', 0, 2, 'Libye'],
    ['Zambie', 1, 1, 'Burundi'],
    ['Mozambique', 0, 1, 'Éthiopie'],
    ['Cap-Vert', 4, 2, 'Liberia'],
    ['Mali', 3, 2, 'Rwanda'],
    ['Nigeria', 3, 1, 'Tanzanie'],
    ['Ghana', 2, 0, 'Somalie'],
    ['Côte d\'Ivoire', 2, 1, 'Gambie'],
    ['Guinée', 2, 1, 'Érythrée'],
    ['RD Congo', 3, 1, 'Sierra Leone'],
    ['Guinée équatoriale', 0, 0, 'Zimbabwe'],
    ['Bénin', 4, 1, 'Centrafrique'],
    ['Cameroun', 2, 0, 'Namibie'],
    ['Sénégal', 4, 1, 'Soudan'],
    ['Madagascar', 1, 1, 'Guinée-Bissau'],
];
$canTickerLabel = 'Éliminatoires CAN 2027 · journée 3';
?>
<style>
.can-ticker{overflow:hidden;white-space:nowrap}
.can-track{display:inline-flex;animation:can-scroll 120s linear infinite}
.can-ticker:hover .can-track{animation-play-state:paused}
@keyframes can-scroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media (prefers-reduced-motion:reduce){.can-ticker{overflow-x:auto}.can-track{animation:none}}
</style>
<div class="mb-6 flex items-stretch bg-gray-800 border border-green-800 rounded-lg overflow-hidden text-sm" role="region" aria-label="CAN 2027 : derniers résultats des éliminatoires">
    <a href="/can-2027.php#classements" class="shrink-0 bg-green-700 hover:bg-green-600 text-white font-semibold px-3 py-2 text-xs sm:text-sm flex items-center transition-colors">🌍 CAN 2027 · derniers résultats</a>
    <div class="can-ticker flex-1 py-2">
        <div class="can-track">
            <?php for ($i = 0; $i < 2; $i++): ?>
            <a href="/can-2027.php#classements" class="inline-flex items-center gap-6 pr-6 text-gray-300 hover:text-white" <?= $i ? 'aria-hidden="true" tabindex="-1"' : '' ?>>
                <?php foreach ($canResultats as $r): ?>
                <span><?= htmlspecialchars($r[0]) ?> <strong class="text-white"><?= $r[1] ?>-<?= $r[2] ?></strong> <?= htmlspecialchars($r[3]) ?></span>
                <?php endforeach; ?>
                <span class="text-gray-500"><?= htmlspecialchars($canTickerLabel) ?></span>
            </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
