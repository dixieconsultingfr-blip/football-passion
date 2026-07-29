# CLAUDE.md — football-passion.fr

Ce fichier est lu automatiquement par Claude Code à chaque session.

---

## 🎯 Projet

**Hub evergreen football** : L1, L2, CL, Europa, Euro, CDM, CAN, France.

Calendriers en direct, matchs, analyses, news. Automatisation n8n + football-data.org.

**Auteur** : Jérôme Henry (Dixie Consulting)
**Stack** : PHP 8 vanilla + Tailwind CSS + JSON + n8n
**Hébergement** : Hostinger (même config que CDM 2026)
**Déploiement** : GitHub Actions → `deploy` branch

---

## 🚨 Règles critiques (priorité maximale)

### Anti-hallucination — Restrictions strictes

**NE JAMAIS inventer de faits sans source** :
- ❌ Scores/résultats (inventer un but, une minute)
- ❌ Compositions d'équipes
- ❌ Statistiques de match (possession, tirs, etc.)
- ❌ Droits TV / chaînes de diffusion
- ❌ Citations entre guillemets
- ❌ Horaires/dates non confirmés

**Règle** : n'écrire que ce qui est fourni ou vérifié (WebSearch/WebFetch).

### JSON — Procédure correcte

**Tous les fichiers JSON** doivent être :
- ✅ UTF-8 **sans BOM** (commence par `[` ou `{`, pas `EF BB BF`)
- ✅ Validés avant commit (https://jsonlint.com/)
- ✅ Triés correctement (`articles.json` par ID décroissant)

### Tailwind CSS — Pas de footprint IA

- ✅ Varier les combinaisons de classes (ne pas cloner le même bloc)
- ✅ Utiliser des classes custom via `@apply`
- ✅ Varier la structure HTML entre les pages
- ✅ **Tailwind n'est PAS détecté comme "AI-generated" par Google** — le problème n'est jamais Tailwind, c'est le contenu/structure

### Contenu — Anti-footprint

- ✅ Varier la longueur des paragraphes
- ✅ Éviter les listes à puces systématiques
- ✅ Introduire des avis éditoriaux ("À notre sens...")
- ✅ Citer des données précises (stats, dates réelles)
- ✅ Varier les introductions — ne pas répéter le même pattern

---

## 📁 Dossiers clés

| Dossier | Rôle |
|---------|------|
| `data/` | articles.json, matchs.json, categories.json, equipes.json |
| `templates/` | header.php, footer.php (partagés toutes les pages) |
| `images/` | Images du site (kebab-case) |
| `config/` | config/db.php (gitignore) |
| `.github/workflows/` | deploy.yml (GitHub Actions) |

---

## 📰 Structure d'un article (articles.json)

```json
{
  "id": 1,
  "titre": "Titre de l'article",
  "auteur": "Jérôme Henry",
  "meta_title": "Titre SEO < 60 caractères",
  "meta_desc": "Description SEO < 160 caractères",
  "image": "/images/nom-kebab-case.jpg",
  "image_alt": "Description alternative",
  "categorie": "L1 | L2 | CL | Europa | Euro | CDM | CAN | France",
  "etiquettes": ["Tag1", "Tag2"],
  "slug": "slug-en-kebab-case",
  "extrait": "Résumé court (2-3 phrases)",
  "contenu": "<p>Contenu HTML...</p>",
  "date": "2026-07-29"
}
```

**Important** : articles.json doit être **trié par ID décroissant** (plus récent en tête).

---

## 🔄 Données en direct

### football-data.org

- **Endpoint** : `https://api.football-data.org/v4/competitions/...`
- **Token** : dans `config/api-keys.php`
- **Compétitions** : 
  - `PL` = Premier League (non FR)
  - `FL1` = Ligue 1
  - `FL2` = Ligue 2
  - `CL` = Champions League
  - `EL` = Europa League
  - `EC` = Euro
  - `WC` = Coupe du Monde
  - `AC` = Coupe d'Afrique des Nations
- **Limite** : 10 req/min (tier gratuit)

### n8n — Automation

**Workflow** : récupère données football-data.org toutes les 5 min
- Branches : scores L1/L2/CL/Europa, posts Facebook auto
- Commit direct sur `data/matchs.json` via GitHub
- **Garde-fous** : ne committe que si changement réel (sinon épuise quota GitHub Actions)

---

## 🌍 Catégories & Structure

| Catégorie | Compétition | Fréquence |
|-----------|-------------|-----------|
| **L1** | Ligue 1 (FR) | Août-mai + été |
| **L2** | Ligue 2 (FR) | Août-mai |
| **CL** | Champions League | Septembre-juin |
| **Europa** | Europa League | Septembre-juin |
| **CAN** | Coupe d'Afrique | Janvier-février |
| **Euro** | Championnat d'Europe | Juin-juillet 2028 |
| **CDM** | Coupe du Monde | Juin-juillet 2026/2030/2034 |
| **France** | Équipe de France | Année-rond |

---

## 📸 Crédits & Licences

Toujours utiliser `rel="nofollow noopener noreferrer"` sur les liens de licence CC.

```html
<a href="https://creativecommons.org/licenses/by-sa/3.0/"
   target="_blank" rel="nofollow noopener noreferrer">CC BY-SA 3.0</a>
```

---

## 🚀 Déploiement

```bash
# Commit + push sur branche 'deploy'
git push origin deploy

# GitHub Actions se déclenche automatiquement
# → FTP push vers Hostinger
# → Site live en ~2 minutes
```

---

## 🔧 Outils & Stack

- **PHP 8** : pas de framework
- **Tailwind CSS** : utility-first
- **JSON** : données
- **GitHub** : versioning
- **GitHub Actions** : CI/CD
- **Hostinger** : hébergement
- **n8n** : automation

---

## 📧 Contact

**Jérôme Henry** — Dixie Consulting
- Site : https://www.dixie.consulting
- Email : jerome@dixie.consulting
- LinkedIn : https://www.linkedin.com/in/jerome13henry/

---

## ⚠️ À ne jamais modifier sans vérification

- `templates/header.php` — utilisé par toutes les pages
- `templates/footer.php` — idem
- `data/articles.json` — toujours valider le JSON
- `data/matchs.json` — données officielles

---

## 📋 Conventions

| Élément | Convention | Exemple |
|---------|-----------|---------|
| Slugs | kebab-case FR | `analyse-ligue-1-psg-om` |
| Images | kebab-case | `psg-om-2026.jpg` |
| Classes PHP | camelCase | `$nouvelArticle` |
| IDs articles | Incrément | Si dernier = 5, suivant = 6 |

---

## ✍️ Notes finales

Ce projet est pensé pour la **scalabilité** et l'**automatisation**. Chaque article, chaque match, chaque news doit avoir de la **valeur réelle** pour l'utilisateur — pas du contenu générique.

**Objectif** : devenir LA référence evergreen pour les passionnés de foot en France (L1, L2, Europe, Coupe du Monde).

---

*Dernière mise à jour : 29 juillet 2026*
