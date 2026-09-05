# football-passion.fr

Hub evergreen football — L1, L2, Champions League, Europa League, Euro, Coupe du Monde, CAN.

Calendriers en direct, matchs, analyses, actualités. Automatisation n8n + football-data.org.

## Stack

- **PHP 8** vanilla (pas de framework)
- **Tailwind CSS** (utility-first)
- **JSON** pour les données (articles, matchs, catégories)
- **n8n** pour l'automatisation (API football-data.org, posts Facebook)
- **GitHub Actions** → déploiement Hostinger

## Structure

```
football-passion/
├── CLAUDE.md                ← Règles projet
├── README.md                ← Ce fichier
├── index.php                ← Accueil
├── calendrier.php           ← Calendrier matchs
├── articles/                ← Blog
├── templates/               ← Header/footer communs
│   ├── header.php
│   └── footer.php
├── data/
│   ├── articles.json        ← Articles de blog
│   ├── matchs.json          ← Matchs en direct (football-data.org)
│   ├── categories.json      ← Catégories (L1, L2, CL, etc.)
│   └── equipes.json         ← Données équipes
├── config/
│   └── db.php               ← Config BD (gitignore)
├── images/                  ← Images du site
├── .github/workflows/
│   └── deploy.yml           ← GitHub Actions → Hostinger
└── tailwind.config.js       ← Tailwind config
```

## Déploiement

```bash
git add .
git commit -m "Description"
git push origin deploy      # ← Branche deploy = production
```

GitHub Actions se déclenche automatiquement → déploiement sur Hostinger.

## Contact

Jérôme Henry — Dixie Consulting
https://www.dixie.consulting
"# Updated" 
