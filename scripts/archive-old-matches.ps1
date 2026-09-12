# Archive les matchs FINISHED de plus de $joursConserves jours hors de data/matchs.json
# vers data/archives/{competition}-{saison}.json, pour garder matchs.json leger
# (fenetre glissante : resultats recents + tous les matchs a venir).
#
# Usage : powershell -File scripts/archive-old-matches.ps1

$root = Split-Path -Parent $PSScriptRoot
$matchsPath = "$root\data\matchs.json"
$archiveDir = "$root\data\archives"
$joursConserves = 45

if (-not (Test-Path $archiveDir)) { New-Item -ItemType Directory -Path $archiveDir | Out-Null }

$raw = [System.IO.File]::ReadAllText($matchsPath, [System.Text.Encoding]::UTF8)
$matchs = ConvertFrom-Json $raw
Write-Host ("Matchs dans matchs.json : " + $matchs.Count)

function Get-Saison([DateTime]$d) {
    if ($d.Month -ge 7) { return "$($d.Year)-$($d.Year + 1)" }
    return "$($d.Year - 1)-$($d.Year)"
}

$limite = (Get-Date).AddDays(-$joursConserves)
$aArchiver = @($matchs | Where-Object { $_.status -eq 'FINISHED' -and [DateTime]::Parse($_.date) -lt $limite })
$aConserver = @($matchs | Where-Object { -not ($_.status -eq 'FINISHED' -and [DateTime]::Parse($_.date) -lt $limite) })

# Calcule/recalcule la saison a la volee (independant du champ 'saison' eventuellement absent,
# ex. pour les matchs synchronises par n8n qui ne renseigne pas ce champ)
foreach ($m in $aArchiver) {
    $m | Add-Member -NotePropertyName 'saison' -NotePropertyValue (Get-Saison ([DateTime]::Parse($m.date))) -Force
}

Write-Host ("A archiver (FINISHED, plus de $joursConserves jours) : " + $aArchiver.Count)
Write-Host ("Conserves dans matchs.json : " + $aConserver.Count)

if ($aArchiver.Count -eq 0) {
    Write-Host "Rien a archiver."
    exit
}

$utf8NoBom = New-Object System.Text.UTF8Encoding($false)
$groupes = $aArchiver | Group-Object -Property competition, saison

foreach ($g in $groupes) {
    $comp = $g.Group[0].competition
    $saison = $g.Group[0].saison
    $archiveFile = "$archiveDir\$comp-$saison.json"

    $existants = @()
    if (Test-Path $archiveFile) {
        $existants = @(ConvertFrom-Json ([System.IO.File]::ReadAllText($archiveFile, [System.Text.Encoding]::UTF8)))
    }

    $idsExistants = $existants | ForEach-Object { $_.id }
    $nouveaux = @($g.Group | Where-Object { $_.id -notin $idsExistants })

    $fusion = @($existants) + @($nouveaux)
    $fusion = $fusion | Sort-Object -Property date

    $json = $fusion | ConvertTo-Json -Depth 10
    [System.IO.File]::WriteAllText($archiveFile, $json, $utf8NoBom)
    Write-Host ("$archiveFile : " + $fusion.Count + " matchs (+ " + $nouveaux.Count + " nouveaux)")
}

$json = $aConserver | ConvertTo-Json -Depth 10
[System.IO.File]::WriteAllText($matchsPath, $json, $utf8NoBom)
Write-Host "matchs.json mis a jour (matchs archives retires)."
