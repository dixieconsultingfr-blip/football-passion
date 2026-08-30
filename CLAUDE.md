# CLAUDE.md — football-passion.fr

Ce fichier est lu automatiquement par Claude Code à chaque session.

---

## 🎯 Projet

**Hub evergreen football** : L1, L2, CL, Europa, Euro, CDM, CAN, France.

Calendriers en direct, matchs, analyses, news. Automatisation n8n + football-data.org.

**Auteur** : Jérôme Henry (Dixie Consulting)
**Stack** : PHP 8 vanilla + Tailwind CSS + JSON + n8n
**Hébergement** : Hostinger (même config que CDM 2026)
**Charte graphique** (site + réseaux sociaux) : voir `charte-graphique.md` à la racine du projet.
**Déploiement** : `git push origin deploy` → GitHub Actions (`.github/workflows/deploy.yml`) ping le webhook Hostinger (secret `HOSTINGER_WEBHOOK_URL`) → Hostinger pull automatiquement via son intégration Git native (hPanel → Avancé → Git). Identique au mécanisme de coupe-du-monde-2026.info — pas de SFTP.

**Sites satellites** : `coupe-du-monde-2026.info` (projet séparé, repo `coupe-du-monde-2026`) est un **site satellite** de football-passion.fr, conservé comme archive SEO jusqu'à fin 2027 (expiration prévue ensuite). Depuis le pivot stratégique de juillet 2026, football-passion.fr est le hub evergreen central — les futurs tournois (Euro 2028, CDM 2030/2034) vivent en pages internes ici plutôt qu'en nouveaux domaines dédiés.

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
- ✅ Citer des données précises (stats, dates réelles)
- ✅ Varier les introductions — ne pas répéter le même pattern
- ✅ **Ajouter un tableau HTML quand l'article contient des données comparables** (prix, formules, statistiques, calendrier...) — Google valorise les tableaux structurés (rich snippets, meilleure compréhension du contenu). Voir le format utilisé dans `data/articles/ligue-1-plus-comment-regarder-tous-les-matchs-2026-2027.json` comme référence de style (fond sombre, bordure verte `#16a34a`, `overflow-x:auto` pour le responsive).
- ✅ **Un tableau de résultats/calendrier doit toujours porter son contexte complet** (signal SEO — retour utilisateur du 30 août 2026, voir `procedure-football-passion.md` section 3.60) : compétition (L1, L2, CL...), numéro de journée, saison. Concrètement : une balise `<caption>` dans le `<table>` (ex. « Résultats de la Ligue 1, journée 2, saison 2026-2027 »), une colonne `Date` par ligne, et une phrase d'intro juste avant le tableau qui répète ce contexte en texte brut (ex. « Championnat de France de Ligue 1 (L1), saison 2026-2027, journée X sur 34 »). Un tableau de scores sans ces repères est ambigu pour Google (et pour un lecteur qui arrive via une recherche, sans avoir lu le paragraphe précédent).

### ✍️ Avis éditorial assumé — signal E-E-A-T (Experience)

**Chaque article de fond doit inclure un vrai avis personnel assumé**, pas juste un résumé neutre des faits — c'est le signal "Experience" que Google valorise depuis la mise à jour de mars 2026 (contenu avec un point de vue vérifiable, pas juste une compilation impersonnelle).

**Formulations à utiliser** : "À notre sens...", "Mon avis...", "Ce qui nous marque...", "On pense que...", "Franchement..." — varier les formules, ne pas toujours utiliser la même.

**L'avis doit rester dans la ligne éditoriale du site** (voir mémoire `project_cdm_strategie` : passion + fair play + neutralité entre clubs, "que le meilleur gagne, prône le beau jeu") :
- ✅ Apprécier le beau jeu, l'audace tactique, la prise de risque — indépendamment du club
- ✅ Commenter les choix tactiques des entraîneurs (formation, changements, gestion de groupe) avec un vrai point de vue, pas juste les décrire
- ✅ Saluer le fair play, la sportivité, les belles histoires humaines
- ✅ Soutenir les clubs français en compétitions européennes (CL, Europa, Conférence) — un angle patriotique assumé, sans tomber dans le partisan entre clubs français entre eux
- ❌ Ne jamais prendre parti pour un club français contre un autre club français (reste la neutralité de base)
- ❌ Pas d'attaque personnelle contre un joueur/entraîneur/dirigeant — critique du jeu ou des choix, jamais de la personne

**Exception documentée** : le dossier Bordeaux/DNCG (voir procédure section 3.55) sort de la neutralité habituelle par décision explicite de l'utilisateur — cas isolé, pas un précédent généralisable sans nouvelle demande.

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
  "date": "2026-07-29",
  "date_maj": "2026-07-31"
}
```

**Champ `date_maj` (optionnel)** — signal E-E-A-T (voir section dédiée plus bas). À ajouter uniquement quand le contenu publié est corrigé ou complété après coup (ex. score corrigé après une erreur de l'API, info mise à jour). Ne pas l'ajouter systématiquement à la création — seulement lors d'une vraie modification ultérieure. Affiché sur la page article (« mis à jour le... ») et utilisé comme `dateModified` dans le schema `NewsArticle`.

**🚨 Procédure obligatoire pour ajouter un nouvel article** :
1. Créer `data/articles/{slug}.json` avec la structure complète ci-dessus (`id` = dernier id existant + 1).
2. Ajouter l'entrée correspondante (champs légers uniquement) dans `data/articles-index.json`.
3. Les deux fichiers doivent être commités ensemble — ne jamais ajouter l'un sans l'autre.

**Sitemap** : `sitemap.php` (accessible en `/sitemap.xml` via réécriture `.htaccess`) lit `data/articles-index.json` **à la volée à chaque requête** — aucune régénération manuelle n'est nécessaire. Tant que l'étape 2 ci-dessus est respectée pour chaque nouvel article, le sitemap est automatiquement à jour. `robots.txt` référence son URL.

**Étiquettes** : se limiter à 2 tags pertinents (ex. club + compétition : `["OL", "Champions League"]`). Ne pas ajouter d'étiquettes secondaires (adversaire, entraîneur, joueur cité...) — elles diluent le filtrage par tag sur `/blog?cat=...` et n'apportent pas de valeur de navigation supplémentaire.

⚠️ Toujours écrire le contenu accentué **ou contenant des emoji** (titre, extrait, contenu HTML) via l'outil Write dans un fichier JSON séparé plutôt qu'en dur dans un script `.ps1` — le bug de mojibake touche aussi les emoji, pas seulement les caractères accentués (vu en pratique sur `▶️` dans un lien vidéo, section 3.31 de `procedure-football-passion.md`). Voir aussi section 3.22.

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
- `saison` (optionnel, ex. `"2026-2027"`) : ajouté automatiquement par le script d'archivage si absent (calculé depuis `date` : saison = année de juillet à juin suivant)

### Archivage — éviter que matchs.json grossisse indéfiniment

**Depuis le 7 août 2026**, `data/matchs.json` est une **fenêtre glissante** (résultats récents + tous les matchs à venir), pas un historique complet. Les matchs `FINISHED` de plus de 45 jours sont déplacés vers `data/archives/{competition}-{saison}.json` (un fichier par compétition+saison), consultables via `archives.php`.

**Script** : `scripts/archive-old-matches.ps1` — à exécuter périodiquement (manuellement pour l'instant, pas encore automatisé) :
```bash
powershell -NoProfile -ExecutionPolicy Bypass -File scripts/archive-old-matches.ps1
```
Recalcule la saison à la volée depuis `date` (indépendant du champ `saison`, donc fonctionne même sur des matchs synchronisés par n8n qui ne le renseigne pas), fusionne avec l'archive existante sans dupliquer (dédoublonnage par `id`), puis retire ces entrées de `matchs.json`.

`archives.php` liste les saisons/compétitions disponibles en scannant `data/archives/` et affiche les résultats de la sélection. `sitemap.php` référence automatiquement chaque page d'archive existante.

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
- Compétitions couvertes : **Ligue 1 (FL1) et Champions League (CL) uniquement**. Ligue 2 (FL2) et Europa League (EL) renvoient une erreur 403 (*"restricted... check your subscription"*) — limitation du plan football-data.org gratuit.
- **Décision définitive (7 août 2026) : pas d'upgrade payant.** Ligue 2, Europa League, les tours de qualification/barrages de Champions League, et l'Équipe de France (amicaux/qualifs) restent **manuels en permanence** — ce n'est pas un état transitoire en attendant un upgrade, c'est le mode de fonctionnement retenu.
- Architecture automatisée : Schedule Trigger (5 min) → Fetch L1 + Fetch CL (HTTP) → Transformer les matchs (Code) → GitHub Get matchs.json → Comparer hasUpdate (Code, garde-fou anti-quota, **préserve les entrées manuelles `id >= 9000000`** — voir procédure 3.22) → IF → GitHub Edit matchs.json (commit sur branche `deploy`) → déploiement auto Hostinger.
- Piège n8n à connaître : un champ contenant `{{ }}` doit être explicitement basculé en mode **"Expression"** (toggle à côté de "Fixed") pour être évalué — sinon n8n écrit le texte littéral. Déjà corrigé dans ce workflow, mais à surveiller pour tout futur nœud.

### Procédure pour les compétitions manuelles (L2, Europa, qualifs CL, Équipe de France)

L'utilisateur colle des captures d'écran ou du texte copié depuis un site de scores en direct (type flashscore.fr). Procédure standard, à appliquer sans redemander confirmation à chaque fois :

1. **Extraire** les matchs (équipes, date, heure, score si le match est terminé) — ne jamais inventer une info absente (règle anti-hallucination).
2. **ID** : prochain `id` libre à partir de `9000000` (convention établie section 3.22 de `procedure-football-passion.md`), incrémental.
3. **Noms d'équipes en ASCII pur** (pas d'accents) pour éviter le bug de mojibake documenté en 3.22 — ex. `Saint-Etienne` pas `Saint-Étienne`, `Bodo/Glimt` pas `Bodø/Glimt`.
4. **`status`** : `FINISHED` + scores si le match a déjà eu lieu, sinon `SCHEDULED` avec `heure` renseignée et scores `null`.
4bis. **`journee`** (entier) : renseigner le numéro de journée quand la source l'indique (ex. "Journée 3 sur 34" sur flashscore.fr) — utilisé pour grouper "Derniers résultats"/"Prochains matchs" par journée plutôt que par date (une journée s'étale souvent sur 2-3 jours).
5. `git pull origin deploy` **avant** toute modification (n8n peut avoir committé entre-temps sur L1/CL), puis ajouter les entrées via script PowerShell (jamais de JSON écrit en dur dans le message pour de gros volumes — toujours passer par `ConvertFrom-Json`/`ConvertTo-Json`, sans wrapper `@()` autour de `ConvertFrom-Json` — voir bug documenté en 3.22).
6. Vérifier absence de mojibake (`grep -c "Ã" data/matchs.json`) avant de committer.
7. `git add data/matchs.json && git commit && git push origin deploy`.

**🚨 Piège PowerShell découvert le 26 août 2026 — wrapper `{"value": [...]}` inattendu** : appeler `ConvertTo-Json` **directement sur le résultat brut de `ConvertFrom-Json`** (même après avoir muté des objets dedans via `Where-Object`) peut produire un objet enveloppé `{"value": [...], "Count": N}` au lieu d'un tableau JSON simple — a transformé `matchs.json` en fichier quasi vide lors d'un test raté avec `-AsArray` (paramètre inexistant en Windows PowerShell 5.1). **Toujours reconstruire un tableau propre avant `ConvertTo-Json`** :
```powershell
$matchList = [System.Collections.Generic.List[object]]::new()
foreach ($m in $matchArray) { $matchList.Add($m) }   # $matchArray = $data.value si wrapper deja present, sinon $data
$json = ConvertTo-Json $matchList -Depth 10
```
Ne jamais faire `ConvertTo-Json $data -Depth 10` directement. **Toujours vérifier le résultat avant de committer** : `head -c 50 data/matchs.json` doit afficher `[` puis un premier objet, jamais `{"value":`. Si le fichier fait moins de quelques centaines de lignes après une modification censée être mineure, c'est le signe d'une perte de données — restaurer immédiatement avec `git checkout -- data/matchs.json` avant de retenter.

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
