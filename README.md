# football-passion.fr

Hub evergreen football : Ligue 1, 2 et 3, Champions League, Europa League, Ligue Conférence, Équipe de France, Ligue des Nations, Euro 2028, Coupe du Monde, CAN.

Calendriers, résultats, analyses, actualités. Automatisation n8n + football-data.org (L1 et Champions League).

## Stack

- **PHP 8** vanilla (pas de framework)
- **Tailwind CSS** (CDN, utility-first)
- **JSON** pour les données (articles, matchs, résultats)
- **n8n** pour l'automatisation (API football-data.org, posts Facebook)
- **GitHub Actions** → validation des données → déploiement Hostinger

## Structure

```
football-passion/
├── CLAUDE.md                    ← Règles du projet (à lire en premier)
├── procedure-football-passion.md← Journal chronologique de toutes les actions
├── index.php                    ← Accueil (bandeau « À LA UNE » + scores)
├── ligue-1.php, ligue-2.php, ligue-3.php, champions-league.php, europa-league.php, conference-league.php
├── equipe-france.php, euro.php, coupe-du-monde.php, calendrier.php, archives.php
├── euro-2028.php + euro-2028-*.php
├── ligue-des-nations.php, ligue-des-nations-2026-2027.php, ligue-des-nations-groupe-*.php
├── can-2027.php, droits-tv-can-2027.php
├── droits-tv-*.php              ← Guides droits TV
├── blog/                        ← Liste des articles et page article
├── templates/                   ← header, footer, bandeau défilant (ticker-resultats.php)
├── data/
│   ├── articles-index.json      ← Index léger des articles
│   ├── articles/{slug}.json     ← Un fichier par article
│   ├── matchs.json              ← Matchs (L1/CL via n8n, le reste à la main)
│   ├── resultats-selections.json← Scores Ligue des Nations et CAN (bandeaux)
│   └── categories.json, equipes.json, joueurs.json, archives/
├── scripts/                     ← validate-data.py, check-duplicate-content.py, archive-old-matches.ps1
├── config/                      ← secrets (gitignore, jamais versionnés)
├── images/                      ← Images du site (kebab-case)
└── .github/workflows/deploy.yml ← GitHub Actions → Hostinger
```

## Déploiement

```bash
python scripts/validate-data.py   # contrôle des données avant commit
git add <fichiers>
git commit -m "Description"
git push origin HEAD:deploy       # branche deploy = production
```

GitHub Actions valide les données (le déploiement est bloqué si elles sont invalides), signale d'éventuels doublons de contenu, puis déclenche le déploiement sur Hostinger (1 à 2 minutes). Le dépôt est **public** : aucun secret dans le code.

## Contact

Jérôme Henry — Dixie Consulting
https://www.dixie.consulting
