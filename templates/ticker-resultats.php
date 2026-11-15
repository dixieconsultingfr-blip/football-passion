<?php
/**
 * Bandeau défilant : derniers résultats (data/matchs.json).
 * Variables attendues avant l'include :
 *   $tickerComps  (array)  ex. ['L1'] ou ['L1', 'L2', 'L3']
 *   $tickerLabel  (string) libellé de gauche
 *   $tickerLink   (string) lien du libellé
 *   $tickerLimit  (int)    nombre de matchs par compétition (défaut 9)
 *   $tickerGlobal (int)    optionnel : si défini, garde les N matchs les plus récents toutes compétitions confondues
 */
$tickerLimit = $tickerLimit ?? 9;
$tickerAll = json_decode(@file_get_contents(__DIR__ . '/../data/matchs.json'), true) ?? [];
$tickerCourt = [
    'AS Monaco FC' => 'Monaco', 'Angers SCO' => 'Angers', 'ES Troyes AC' => 'Troyes', 'FC Lorient' => 'Lorient', 'Le Havre AC' => 'Le Havre',
    'Le Mans FC' => 'Le Mans', 'Lille OSC' => 'Lille', 'OGC Nice' => 'Nice', 'Olympique Lyonnais' => 'Lyon', 'Olympique de Marseille' => 'OM',
    'Paris Saint-Germain FC' => 'PSG', 'RC Strasbourg Alsace' => 'Strasbourg', 'Racing Club de Lens' => 'Lens', 'Stade Brestois 29' => 'Brest',
    'Stade Rennais FC 1901' => 'Rennes', 'Toulouse FC' => 'Toulouse', 'AJ Auxerre' => 'Auxerre',
];
$tickerItems = [];
$tickerEtiquettes = ['CL' => 'C1', 'Europa' => 'C3', 'Conference' => 'C4'];
if (isset($tickerGlobal)) {
    $f = array_values(array_filter($tickerAll, fn($m) => in_array($m['competition'] ?? '', $tickerComps, true) && ($m['status'] ?? '') === 'FINISHED' && $m['score_dom'] !== null && $m['score_ext'] !== null));
    usort($f, fn($a, $b) => strcmp($b['date'] . ($b['heure'] ?? ''), $a['date'] . ($a['heure'] ?? '')));
    foreach (array_slice($f, 0, (int) $tickerGlobal) as $m) {
        $tickerItems[] = [$tickerEtiquettes[$m['competition']] ?? $m['competition'], $tickerCourt[$m['domicile']] ?? $m['domicile'], (int) $m['score_dom'], (int) $m['score_ext'], $tickerCourt[$m['exterieur']] ?? $m['exterieur']];
    }
    $tickerComps = [];
}
foreach ($tickerComps as $comp) {
    $f = array_values(array_filter($tickerAll, fn($m) => ($m['competition'] ?? '') === $comp && ($m['status'] ?? '') === 'FINISHED' && $m['score_dom'] !== null && $m['score_ext'] !== null));
    usort($f, fn($a, $b) => strcmp($b['date'] . ($b['heure'] ?? ''), $a['date'] . ($a['heure'] ?? '')));
    foreach (array_slice($f, 0, $tickerLimit) as $m) {
        $tickerItems[] = [$comp, $tickerCourt[$m['domicile']] ?? $m['domicile'], (int) $m['score_dom'], (int) $m['score_ext'], $tickerCourt[$m['exterieur']] ?? $m['exterieur']];
    }
}
if (!empty($tickerItems)):
    $tickerMulti = isset($tickerGlobal) || count($tickerComps) > 1;
    $tickerDuree = max(40, count($tickerItems) * 6);
?>
<style>
.res-ticker{overflow:hidden;white-space:nowrap}
.res-track{display:inline-flex;animation:res-scroll linear infinite}
.res-ticker:hover .res-track{animation-play-state:paused}
@keyframes res-scroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media (prefers-reduced-motion:reduce){.res-ticker{overflow-x:auto}.res-track{animation:none}}
</style>
<div class="mb-6 flex items-stretch bg-gray-800 border border-green-800 rounded-lg overflow-hidden text-sm" role="region" aria-label="<?= htmlspecialchars($tickerLabel) ?>">
    <a href="<?= htmlspecialchars($tickerLink) ?>" class="shrink-0 bg-green-700 hover:bg-green-600 text-white font-semibold px-3 py-2 text-xs sm:text-sm flex items-center transition-colors"><?= htmlspecialchars($tickerLabel) ?></a>
    <div class="res-ticker flex-1 py-2">
        <div class="res-track" style="animation-duration:<?= $tickerDuree ?>s">
            <?php for ($i = 0; $i < 2; $i++): ?>
            <a href="<?= htmlspecialchars($tickerLink) ?>" class="inline-flex items-center gap-6 pr-6 text-gray-300 hover:text-white" <?= $i ? 'aria-hidden="true" tabindex="-1"' : '' ?>>
                <?php foreach ($tickerItems as $r): ?>
                <span><?php if ($tickerMulti): ?><em class="not-italic text-green-400 text-xs font-semibold mr-1"><?= htmlspecialchars($r[0]) ?></em><?php endif; ?><?= htmlspecialchars($r[1]) ?> <strong class="text-white"><?= $r[2] ?>-<?= $r[3] ?></strong> <?= htmlspecialchars($r[4]) ?></span>
                <?php endforeach; ?>
            </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php endif; ?>
