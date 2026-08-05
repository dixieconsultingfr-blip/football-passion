# CLAUDE.md — football-passion.fr

Ce fichier est lu automatiquement par Claude Code à chaque session.

---

## 🎯 Projet

**Hub evergreen football** : L1, L2, CL, Europa, Euro, CDM, CAN, France.

Calendriers en direct, matchs, analyses, news. Automatisation n8n + football-data.org.

**Auteur** : Jérôme Henry (Dixie Consulting)
**Stack** : PHP 8 vanilla + Tailwind CSS + JSON + n8n
**Hébergement** : Hostinger (même config que CDM 2026)
**Déploiement** : `git push origin deploy` → GitHub Actions (`.github/workflows/deploy.yml`) ping le webhook Hostinger (secret `HOSTINGER_WEBHOOK_URL`) → Hostinger pull automatiquement via son intégration Git native (hPanel → Avancé → Git). Identique au mécanisme de coupe-du-monde-2026.info — pas de SFTP.

## 🚨 Règle critique — Journal de procédure

**Après chaque action sur ce projet** (nouvelle page, fonctionnalité, config, service tiers, correction), mettre à jour `procedure-football-passion.md` (à la racine, hors `public_html/`) en ajoutant une entrée décrivant l'action, dans l'ordre chronologique.

## 🚨 Règle critique — Dépôt GitHub PUBLIC, jamais de secret en clair

Le dépôt `football-passion` sur GitHub est **public** (contrairement à `coupe-du-monde-2026` qui est privé). **Ne jamais committer de clé secrète, mot de passe ou token en clair dans le code** (Turnstile secret, clés API, etc.).

Tout secret va dans **`config/secrets.php`** (fichier gitignore, jamais versionné) et est chargé via `require`. Après création/modification de ce fichier, il doit être **uploadé manuellement une seule fois** sur Hostinger — il n'est jamais déployé automatiquement puisqu'il n'est pas dans le repo.

## 🚨 Règle critique — Emplacement des fichiers (structure à PLAT, comme CDM 2026)

**Tous les fichiers du site vont directement à la racine du dépôt** — pas de dossier `public_html/` local.

**Raison** : le déploiement automatique passe par l'intégration Git native de Hostinger (hPanel → Avancé → Git), qui clone l'intégralité du dépôt tel quel dans le dossier `public_html` du serveur. Un dossier `public_html/` imbriqué dans le dépôt créerait un niveau de profondeur en trop (`public_html/public_html/index.php`) et casserait le déploiement.

> ⚠️ Historique : une structure `public_html/` locale a été utilisée un temps pour faciliter l'upload manuel, avant l'activation du déploiement Git automatique. Elle a été abandonnée le 1er août 2026 au profit de la structure à plat — voir `procedure-football-passion.md` section 3.16.

```
football-passion/                  ← racine du dépôt = racine du site
├── CLAUDE.md
├── .gitignore
├── procedure-football-passion.md
├── .github/workflows/deploy.yml
├── index.php
├── a-propos.php
├── mentions-legales.php
├── politique-confidentialite.php
├── equipe-france.php
├── euro.php
├── contact.php           ← formulaire (Turnstile + honeypot)
├── contact-send.php      ← traitement (mail() natif, destinataire caché)
├── 404.php
├── .htaccess
├── config/
│   └── secrets.php        ← gitignore, jamais commité
├── templates/
│   ├── header.php
│   └── footer.php
├── data/
│   ├── articles-index.json    ← index léger (liste, filtres, homepage)
│   ├── articles/
│   │   └── {slug}.json        ← un fichier par article (contenu complet)
│   ├── categories.json
│   ├── equipes.json
│   └── matchs.json
├── images/
└── blog/
    ├── index.php
    └── helpers.php
```

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

## 🖼️ Vignettes d'articles — format

- **Format** : `.webp` (25-35 % plus léger qu'un `.jpg` à qualité égale — meilleur pour le LCP)
- **Largeur max** : 1200px, ratio 16:9 recommandé
- **Poids cible** : 100-300 Ko — jamais de PNG brut ou d'export Canva non compressé
- **Nommage** : kebab-case descriptif, ex. `deschamps-bilan-14-ans-bleus.webp`
- **Emplacement** : `images/`
- Renseigner le même chemin dans `"image"` et `"vignette"` de `articles.json`

## 📁 Dossiers clés

| Dossier | Rôle |
|---------|------|
| `data/` | articles.json, matchs.json, categories.json, equipes.json |
| `templates/` | header.php, footer.php (partagés toutes les pages) |
| `images/` | Images du site (kebab-case) |
| `config/` | config/db.php (gitignore) |
| `.github/workflows/` | deploy.yml (GitHub Actions) |

---

## 📰 Structure d'un article — un fichier JSON par article

**Depuis le 5 août 2026**, les articles ne vivent plus dans un unique `data/articles.json` monolithique (non scalable au-delà de quelques dizaines d'articles — diffs Git énormes, tout le contenu HTML relu à chaque page liste). Nouvelle architecture à deux niveaux :

- **`data/articles/{slug}.json`** — un fichier par article, contenu complet (structure ci-dessous). Chargé uniquement à la vue d'un article précis (`load_article($basePath, $slug)` dans `blog/helpers.php`), jamais en liste.
- **`data/articles-index.json`** — tableau léger de **tous** les articles, utilisé pour la page liste (`/blog`), l'accueil et les pages hub (`equipe-france.php`, `euro.php`) : uniquement `id, slug, titre, categorie, etiquettes, date, extrait, vignette, image_alt` (pas de `contenu`, `meta_title`, `meta_desc`, `auteur`, `image`). Chargé via `load_articles_index($basePath)`.

**Structure complète d'un fichier `data/articles/{slug}.json`** :

```json
{
  "id": 1,
  "titre": "Titre de l'article",
  "auteur": "Jérôme Henry",
  "meta_title": "Titre SEO < 60 caractères",
  "meta_desc": "Description SEO < 160 caractères",
  "image": "/images/nom-kebab-case.webp",
  "image_alt": "Description alternative",
  "vignette": "/images/nom-kebab-case.webp",
  "categorie": "L1 | L2 | CL | Europa | Euro | CDM | CAN | France",
  "etiquettes": ["Tag1", "Tag2"],
  "slug": "slug-en-kebab-case",
  "extrait": "Résumé court (2-3 phrases)",
  "contenu": "<p>Contenu HTML...</p>",
  "date": "2026-07-29"
}
```

**🚨 Procédure obligatoire pour ajouter un nouvel article** :
1. Créer `data/articles/{slug}.json` avec la structure complète ci-dessus (`id` = dernier id existant + 1).
2. Ajouter l'entrée correspondante (champs légers uniquement) dans `data/articles-index.json`.
3. Les deux fichiers doivent être commités ensemble — ne jamais ajouter l'un sans l'autre.

**Étiquettes** : se limiter à 2 tags pertinents (ex. club + compétition : `["OL", "Champions League"]`). Ne pas ajouter d'étiquettes secondaires (adversaire, entraîneur, joueur cité...) — elles diluent le filtrage par tag sur `/blog?cat=...` et n'apportent pas de valeur de navigation supplémentaire.

⚠️ Toujours écrire le contenu accentué (titre, extrait, contenu HTML) via l'outil Write dans un fichier JSON séparé plutôt qu'en dur dans un script `.ps1`, pour éviter la corruption d'encodage (mojibake) documentée dans `procedure-football-passion.md` section 3.22.

---

## 📅 Structure d'un match (data/matchs.json)

Consommé par `calendrier.php`. Trié par `date` (croissant pour les matchs à venir, décroissant pour les résultats — géré côté PHP, pas besoin de trier le fichier).

```json
{
  "id": 1,
  "competition": "L1 | L2 | CL | Europa | France",
  "domicile": "Paris Saint-Germain",
  "exterieur": "Olympique de Marseille",
  "date": "2026-08-15",
  "heure": "21:00",
  "stade": "Parc des Princes",
  "status": "SCHEDULED | LIVE | FINISHED",
  "score_dom": null,
  "score_ext": null
}
```

- `status: FINISHED` + `score_dom`/`score_ext` renseignés → apparaît dans "Derniers résultats"
- Sinon → apparaît dans "Prochains matchs"
- `id` unique et stable (utile pour que n8n sache quelle entrée mettre à jour plutôt que dupliquer)

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

✅ **Statut : construit, testé et ACTIF depuis le 4 août 2026.** Workflow `Football Passion — Récupération matchs` sur l'instance self-hébergée `https://n8n.srv814711.hstgr.cloud`, publié et tournant en autonomie toutes les 5 minutes.

📄 **Documentation complète du workflow réel (architecture, code des nœuds, écarts par rapport au plan initial et pourquoi)** : voir `guide-n8n-workflow.md` à la racine du projet.

**Résumé** :
- Compétitions couvertes : **Ligue 1 (FL1) et Champions League (CL) uniquement**. Ligue 2 (FL2) et Europa League (EL) ont été testées et renvoient une erreur 403 (*"restricted... check your subscription"*) — limitation du plan football-data.org gratuit, pas un bug. Pour les activer un jour : upgrade du plan football-data.org.
- Équipe de France (amicaux/qualifs) : toujours hors périmètre, reste manuel (football-data.org ne couvre pas ces matchs).
- Architecture : Schedule Trigger (5 min) → Fetch L1 + Fetch CL (HTTP) → Transformer les matchs (Code) → GitHub Get matchs.json → Comparer hasUpdate (Code, garde-fou anti-quota) → IF → GitHub Edit matchs.json (commit sur branche `deploy`) → déploiement auto Hostinger.
- Piège n8n à connaître : un champ contenant `{{ }}` doit être explicitement basculé en mode **"Expression"** (toggle à côté de "Fixed") pour être évalué — sinon n8n écrit le texte littéral. Déjà corrigé dans ce workflow, mais à surveiller pour tout futur nœud.

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

## 🔗 Liens externes — règle absolue

**Tout lien vers un site tiers doit avoir `rel="nofollow noopener noreferrer"`**, sans exception.

```html
<a href="https://exemple.com" target="_blank" rel="nofollow noopener noreferrer">Texte</a>
```

- `nofollow` : ne transmet pas de jus SEO vers le site externe
- `noopener` : sécurité (empêche le site cible d'accéder à `window.opener`)
- `noreferrer` : ne transmet pas le referrer HTTP

**Cas concernés :**
- Liens de licences (CC BY, CC BY-SA…)
- Liens vers hébergeur, APIs tierces (football-data.org, Meta, CNIL…)
- Liens vers réseaux sociaux (Facebook, Instagram…)
- Liens vers sources d'articles
- Tout lien dans les pages légales (mentions légales, politique de confidentialité)

**Seule exception : liens internes** (entre pages de football-passion.fr) → pas de `nofollow`, pas de `target="_blank"`.

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
# → ping du webhook Hostinger (secret HOSTINGER_WEBHOOK_URL)
# → Hostinger pull automatiquement via son intégration Git
# → Site live en ~1-2 minutes
```

Identique au mécanisme de coupe-du-monde-2026.info — pas de SFTP.

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
