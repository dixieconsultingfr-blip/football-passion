# Procédure — Football Passion (football-passion.fr)

Historique complet des étapes de création et de configuration du site, dans l'ordre chronologique.

---

## 1. Nom de domaine (NDD)

| Élément | Valeur |
|---|---|
| **Domaine** | football-passion.fr |
| **Registrar** | *(à compléter — Hostinger ou autre)* |
| **Date d'achat** | *(à compléter)* |

---

## 2. Hébergement Hostinger

- Site hébergé sur **Hostinger**, même compte que coupe-du-monde-2026.info.
- Dossier racine du site sur le serveur : `public_html/`
- **Déploiement manuel** via le gestionnaire de fichiers Hostinger (pas de GitHub Actions configuré pour ce domaine, contrairement à CDM 2026).
- **Organisation locale** : tous les fichiers du site vivent dans `C:\Users\DIXIE\Projets-Claude\football-passion\public_html\` — cette arborescence est une copie miroir du `public_html` du serveur, pour simplifier l'upload (on sélectionne tout le contenu du dossier local et on l'envoie tel quel).
- À la racine du projet local (hors `public_html/`) : seulement `CLAUDE.md`, `.gitignore`, et ce fichier de procédure.

---

## 3. Création du site avec Claude Code — étapes

### 3.1 Socle du site
- Stack : **PHP 8 vanilla** (pas de framework) + **Tailwind CSS via CDN** (pas de build, toutes les classes disponibles directement).
- Structure de base : `index.php`, `templates/header.php`, `templates/footer.php`, `data/articles.json`, `data/matchs.json`, `data/categories.json`, `data/equipes.json`.
- Thème visuel : fond sombre (`bg-gray-950`), accent vert (`green-400`/`green-500`), cohérent avec l'identité "football".

### 3.2 Articles — premier contenu
- Création de `data/articles.json` avec structure standard (id, titre, auteur, meta_title, meta_desc, image, categorie, étiquettes, slug, extrait, contenu HTML, date).
- Article n°1 : *"FIFA Forward Enterprise : comment Infantino s'est retrouvé seul contre le monde du football"* — analyse détaillée liée à la crise de gouvernance FIFA, avec section stratégique dédiée à la **CDM 2030** (Maroc/Espagne/Portugal + centenaire Argentine/Uruguay/Paraguay).
- Article miroir plus court publié sur coupe-du-monde-2026.info (article 74), renvoyant vers l'article détaillé de Football Passion via un lien externe.

### 3.3 Page blog (liste + article)
- Constat : `/blog` n'existait pas alors que des liens y pointaient déjà (`/blog?slug=...`, `/blog?cat=...`).
- Création de `public_html/blog/index.php` en **double mode** :
  - Mode liste (pas de `?slug`) : filtre par catégorie, grille 12 articles/page, pagination.
  - Mode article (`?slug=...`) : fil d'ariane, image, contenu stylé (classe `.prose-fp`), étiquettes, lien retour.
- Création de `public_html/blog/helpers.php` : fonctions utilitaires (`slugify`, `date_fr_short`, `date_fr_long`, `load_articles` avec nettoyage BOM).

### 3.4 Pages E-E-A-T (crédibilité SEO / Google)
Objectif : donner à Google des signaux clairs d'auteur identifié et de site fiable.

- **`a-propos.php`** — page auteur avec markup `schema.org Person` (Jérôme Henry, Dixie Consulting, Aubagne, LinkedIn) + `schema.org WebSite`, ligne éditoriale (Passion / Fair-play / Fiabilité), liste des compétitions couvertes.
- **`mentions-legales.php`** — éditeur (Jérôme Henry / Dixie Consulting), hébergeur (Hostinger International Ltd, Larnaca Chypre), propriété intellectuelle, responsabilité, droit applicable.
- **`politique-confidentialite.php`** — conforme RGPD : données collectées, tableau des cookies (PHPSESSID, _ga/_gid), bases légales, durée de conservation, 6 droits RGPD, services tiers (Hostinger, football-data.org, Meta).
- **`templates/footer.php`** mis à jour : passage de 3 à 4 colonnes, ajout colonne "À propos" avec liens vers les 3 nouvelles pages + contact.

### 3.5 Règle nofollow sur liens externes
- Constat : les liens vers des sites tiers (CNIL, Hostinger, football-data.org, Meta, licences CC) doivent être en `rel="nofollow noopener noreferrer"` pour ne pas transmettre de "jus SEO" vers l'extérieur.
- Règle appliquée rétroactivement sur toutes les pages légales, et documentée dans `CLAUDE.md` comme règle absolue pour toute future page.
- Seule exception : les liens internes (entre pages football-passion.fr) restent sans `nofollow` ni `target="_blank"`.

### 3.6 Réorganisation `public_html/`
- Tous les fichiers du site déplacés/créés sous `public_html/` pour correspondre exactement à la structure attendue par Hostinger.
- `CLAUDE.md` mis à jour avec un schéma d'arborescence et la règle : **ne jamais créer de fichier de site à la racine du repo local**.
- L'utilisateur a supprimé les anciens fichiers dupliqués à la racine après vérification que `public_html/` était à jour.

### 3.7 Amélioration éditoriale — section CDM 2030
- Renforcement de la section "CDM 2030" dans l'article FIFA Forward Enterprise : ajout des enjeux concrets (budget développement FIFA amputé, gouvernance fragilisée avant négociations droits TV, démarrage des qualifications 2027, débat calendrier international), avec prise de position éditoriale claire.

### 3.8 Formulaire de contact (remplacement de l'email public)
- Constat : l'adresse `jerome@dixie.consulting` était exposée en clair sur plusieurs pages (footer, à-propos, mentions légales, politique de confidentialité) → risque de spam, et l'adresse n'était de toute façon pas valide.
- Solution : formulaire de contact sur le modèle de celui de coupe-du-monde-2026.info.
- **`public_html/contact.php`** créé :
  - Champs : nom, email, sujet (Question / Correction / Partenariat / Données personnelles / Autre), message.
  - Honeypot anti-bot (champ caché `website`).
  - Widget **Cloudflare Turnstile** (anti-robot sans friction).
  - Messages de statut (succès, captcha échoué, erreur, flood, échec serveur) affichés via `?status=...`.
- **`public_html/contact-send.php`** créé :
  - Vérifie la méthode POST, le honeypot, puis le token Turnstile auprès de l'API Cloudflare.
  - Valide les champs (longueur nom/message, format email, sujet non vide).
  - Anti-flood : 1 envoi max par minute (session PHP).
  - Envoi de l'email via la fonction native PHP `mail()` (même méthode que CDM 2026, **pas** de service tiers) — `Reply-To` = email du visiteur.
  - **Destinataire final : `info@coupe-du-monde-2026.info`** (adresse officielle Dixie Consulting/CDM déjà en usage, `jerome@dixie.consulting` abandonnée).
- Toutes les pages mises à jour pour pointer vers `/contact.php` au lieu de `mailto:jerome@dixie.consulting` : `templates/footer.php`, `a-propos.php`, `mentions-legales.php`, `politique-confidentialite.php` (2 occurrences, dont le lien RGPD qui pré-sélectionne le sujet "Données personnelles").

### 3.9 Debug formulaire de contact
- Premier test : erreur "Formulaire invalide" systématique.
- Diagnostic par ajout temporaire d'un paramètre `dbg` dans l'URL de redirection pour voir quel champ échouait.
- Cause identifiée : message de test trop court (3 caractères, minimum requis = 10) — le formulaire fonctionnait correctement, c'était une erreur de saisie de test.
- Code de debug retiré après validation.

### 3.10 Page 404 personnalisée
- Constat : les URLs inexistantes affichaient la page 404 générique d'Hostinger.
- Création de **`public_html/404.php`** dans le style du site (thème sombre, accent vert, thème "hors-jeu" ⚽), avec liens vers l'accueil, le blog, et les pages populaires (calendrier, équipe de France, CDM, Champions League, à-propos, contact).
- Création de **`public_html/.htaccess`** avec la directive :
  ```apache
  ErrorDocument 404 /404.php
  ```
  → toute URL non trouvée par le serveur est désormais redirigée vers cette page personnalisée.

### 3.11 Page Équipe de France
- Création de **`public_html/equipe-france.php`** : page évergreen dédiée aux Bleus (pas liée à un seul tournoi, contrairement à la page équivalente de coupe-du-monde-2026.info qui est spécifique CDM 2026).
- Contenu : hero avec drapeau, chiffres clés (titres CDM/Euro/Ligue des Nations), tableau palmarès Coupe du Monde, section "L'ère Zidane" (nouveau sélectionneur depuis l'été 2026, avec lien `nofollow` vers la couverture complète sur coupe-du-monde-2026.info), section actualités liées (filtre automatique des articles de `data/articles.json` par `categorie: "France"`), liens internes (calendrier, articles France, CDM).
- Markup `schema.org SportsTeam`.
- Lien "Équipe de France" du footer (colonne "Compétitions") mis à jour pour pointer vers `/equipe-france.php` au lieu de `/blog?cat=France`.

### 3.12 Correction durée mandat Deschamps + article bilan chiffré
- Correction sur `equipe-france.php` : "8 ans" → "14 ans" (Deschamps sélectionneur de juillet 2012 à juillet 2026).
- Ajout de l'**article n°2** dans `data/articles.json` : *"Équipe de France : le bilan chiffré des 14 ans de Didier Deschamps sur le banc des Bleus"* — catégorie `France`, contenu reformulé (non plagié) à partir de statistiques fournies par l'utilisateur (source RMC Sport) : 185 matchs, bilan 122V/35N/30D, 2 trophées (CDM 2018, Ligue des Nations 2021), tableau détaillé par compétition, rivalité avec l'Espagne (éliminée en demi-finale Euro 2024, LDN 2025, CDM 2026).
- Cet article apparaît désormais automatiquement dans la section "Actualités" de `/equipe-france.php` (filtre par `categorie: "France"`).

### 3.13 Correction liens catégories page d'accueil
- Constat : le bouton "France" de la section Catégories sur `index.php` ne menait nulle part d'utile (`/?cat=france`, jamais traité par la page d'accueil).
- Bug plus large identifié : **tous** les boutons de catégorie de l'accueil pointaient vers `/?cat=<slug>`, alors que le filtre par catégorie n'est géré que par `blog/index.php` via `/blog?cat=<nom>`.
- Correction dans `index.php` : le bouton "France" pointe désormais vers `/equipe-france.php` (page dédiée) ; tous les autres boutons de catégorie pointent vers `/blog?cat=<nom>` (nom exact de la catégorie, cohérent avec le filtre de `blog/index.php`).

### 3.14 Page Euro
- Création de **`public_html/euro.php`** : page évergreen consacrée à l'Euro 2028 (Royaume-Uni & Irlande), inspirée structurellement de `euro-2028.php` sur coupe-du-monde-2026.info mais restylée dans l'identité visuelle Football Passion (Tailwind classes, cartes `bg-gray-800`/`border-gray-700`, accents verts) plutôt que copiée telle quelle.
- Contenu : hero, chiffres clés (4 hôtes, 24 équipes, 9 stades, 51 matchs), présentation des 4 nations hôtes, format et dates de qualifications, section "La France de Zidane" avec lien vers `/equipe-france.php`, calendrier prévisionnel, actualités liées (filtre automatique `categorie: "Euro"`).
- Markup `schema.org SportsEvent`.
- Mécanisme généralisé dans `index.php` : les catégories "France" et "Euro" pointent désormais vers leurs pages hub dédiées (`/equipe-france.php`, `/euro.php`) via un tableau `$hubs`, les autres catégories restent redirigées vers `/blog?cat=...`.

### 3.15 Activation du déploiement automatique GitHub Actions
- Constat : un pipeline `.github/workflows/deploy.yml` existait déjà (upload SFTP vers Hostinger au push sur la branche `deploy`), mais il était mal aligné avec la réorganisation locale en `public_html/` — `localDir: '.'` uploadait la racine du repo (qui contenait encore les anciens fichiers pré-réorganisation), pas le contenu de `public_html/`.
- Correction : `localDir` changé en `./public_html`, pour que le pipeline reflète exactement la convention locale déjà en place.
- **Faille de sécurité identifiée et corrigée avant tout commit** : le dépôt GitHub `football-passion` est **public** (contrairement à `coupe-du-monde-2026` qui est privé). Le fichier `contact-send.php` contenait la clé secrète Cloudflare Turnstile en clair — la committer l'aurait rendue visible publiquement. Correction : clé déplacée dans `public_html/config/secrets.php`, ajouté à `.gitignore` (`public_html/config/secrets.php`), chargé via `require` dans `contact-send.php`.
- **Action manuelle requise une seule fois** : uploader `public_html/config/secrets.php` sur Hostinger via le gestionnaire de fichiers (ce fichier n'est pas et ne sera jamais versionné, donc jamais déployé automatiquement).
- Repository nettoyé : anciens fichiers racine (pré-réorganisation) supprimés du suivi git, contenu de `public_html/` ajouté.
- **Reste à faire côté utilisateur** : vérifier/configurer les secrets GitHub Actions `FTP_SERVER`, `FTP_USER`, `FTP_PASSWORD` (Settings → Secrets and variables → Actions du repo `football-passion`) avec les identifiants SFTP Hostinger, pour que le déploiement automatique fonctionne réellement.

### 3.16 Abandon de la structure public_html/ — retour à plat (comme CDM 2026)
- Constat après le premier échec de déploiement (voir 3.15) : Hostinger propose une intégration Git native (hPanel → Avancé → Git), identique au mécanisme utilisé par coupe-du-monde-2026.info, bien plus fiable que SFTP.
- Contrainte de cette intégration : elle clone l'intégralité du dépôt tel quel dans le dossier `public_html` du serveur. Avec un dossier `public_html/` imbriqué dans le dépôt local, ça aurait créé `public_html/public_html/index.php` sur le serveur — cassé.
- Deux options proposées à l'utilisateur : (a) revenir à une structure à plat comme CDM 2026, ou (b) garder `public_html/` localement avec une branche Git technique séparée (`git subtree`) ne contenant que ce sous-dossier.
- **Décision : option (a)**, structure à plat. Tous les fichiers (`index.php`, `templates/`, `data/`, `images/`, `blog/`, `config/`, pages) déplacés de `public_html/` vers la racine du dépôt via `git mv` (historique préservé), `config/secrets.php` déplacé manuellement (non suivi par git).
- Fichiers mis à jour en conséquence : `.gitignore` (`public_html/config/secrets.php` → `config/secrets.php`), `CLAUDE.md` (règle d'emplacement des fichiers entièrement réécrite, arborescence à jour).
- `contact-send.php` n'a nécessité aucune modification de code : son `require __DIR__ . '/config/secrets.php'` reste valide puisque `config/` s'est déplacé avec lui.

### 3.17 Remplacement SFTP → intégration Git native Hostinger
- `.github/workflows/deploy.yml` réécrit pour abandonner `wangyucode/sftp-upload-action` (7 tentatives échouées : `Timed out while waiting for handshake` — port 22 probablement incorrect pour Hostinger mutualisé) au profit d'un simple `curl -X POST` vers un **webhook Hostinger** (secret GitHub `HOSTINGER_WEBHOOK_URL`), stratégie identique à `coupe-du-monde-2026.info`.
- Étapes côté Hostinger (hPanel → Avancé → Git) : dépôt `https://github.com/dixieconsultingfr-blip/football-passion.git`, branche `deploy`, répertoire d'installation laissé vide (déploiement direct dans `public_html`).
- **Reste à faire côté utilisateur** : finaliser la connexion du dépôt dans hPanel, récupérer l'URL de webhook générée par Hostinger, l'ajouter comme secret GitHub `HOSTINGER_WEBHOOK_URL` sur le repo `football-passion`.

### 3.18 Finalisation du déploiement Git automatique
- Dépôt Git connecté avec succès dans hPanel (public_html vidé au préalable côté serveur — condition requise par Hostinger : "Project directory is not empty" sinon).
- Secret GitHub `HOSTINGER_WEBHOOK_URL` ajouté par l'utilisateur (URL nettoyée des paramètres de tracking marketing parasites — `?_gl=...&_gcl_aw=...` etc. — copiés par erreur depuis la barre d'adresse ; seule la partie `https://webhooks.hostinger.com/deploy/<id>` est le vrai endpoint).
- Premier essai après ajout du secret : échec HTTP 400. Diagnostic par tests `curl` manuels directement sur le webhook : la requête échoue sans header `Content-Type`, réussit (`200`) avec `-H "Content-Type: application/json" -d '{}'`.
- `deploy.yml` corrigé en conséquence (ajout du header et d'un corps JSON vide à l'appel `curl`).
- ⚠️ Rappel : `config/secrets.php` (clé Turnstile) doit être re-uploadé manuellement sur Hostinger après le premier déploiement Git, puisqu'il n'est pas suivi par git et que `public_html` a été vidé.

---

## 4. Cloudflare Turnstile (anti-robot du formulaire de contact)

- Réutilisation du widget déjà créé pour coupe-du-monde-2026.info (compte Cloudflare "CDM2026").
- Un **nouveau widget dédié** a été créé pour football-passion.fr (et non une simple extension du widget CDM 2026), via **Turnstile → Add Widget** :
  - **Widget name** : `football-passion.fr`
  - **Hostname** : `football-passion.fr`
  - **Widget Mode** : Managed (recommandé)
  - **Pre-clearance** : décoché
- Clés générées et intégrées dans le code :

| Fichier | Constante | Clé |
|---|---|---|
| `contact.php` | `TURNSTILE_SITE_KEY` (publique) | `0x4AAAAAAEDqZ19uLzGwdbhT` |
| `contact-send.php` | `TURNSTILE_SECRET` (privée, jamais exposée en HTML) | `0x4AAAAAAEDqZ5SnnCJod3ByrMEmwvEONlc` |

---

## 5. Brevo (tentative, puis abandon au profit de `mail()`)

- Une première version de `contact-send.php` a été écrite pour envoyer les emails via l'**API transactionnelle Brevo** (`https://api.brevo.com/v3/smtp/email`), plutôt que la fonction `mail()` native de PHP.
- Étapes réalisées côté Brevo (compte "CDM 2026") :
  - Vérification que **`info@coupe-du-monde-2026.info`** est bien un expéditeur validé.
  - Génération d'une nouvelle clé API dédiée (**sans cocher** l'option "Créer une clé API de serveur MCP", qui sert à un usage différent — intégration Claude Code, pas envoi d'emails).
  - Clé intégrée temporairement dans `contact-send.php` (`BREVO_API_KEY`).
- **Décision finale** : abandon de Brevo pour ce formulaire — retour à la fonction `mail()` native, **à l'identique de la méthode utilisée sur coupe-du-monde-2026.info**, pour rester cohérent entre les deux sites et éviter une dépendance API supplémentaire.
- La clé API Brevo générée reste disponible dans le compte Brevo si un usage futur (newsletter, autre formulaire) est envisagé pour football-passion.fr.

---

## 6. État actuel — récapitulatif des fichiers clés

Structure à plat depuis le 1er août 2026 (voir 3.16) — plus de dossier `public_html/` local, le dépôt racine EST la racine du site.

```
football-passion/                  ← racine du dépôt = racine du site
├── CLAUDE.md
├── procedure-football-passion.md   ← ce fichier
├── .gitignore
├── .github/workflows/deploy.yml    ← webhook Hostinger
├── index.php
├── equipe-france.php
├── euro.php
├── a-propos.php
├── mentions-legales.php
├── politique-confidentialite.php
├── contact.php                 ← formulaire (Turnstile + honeypot)
├── contact-send.php            ← traitement (mail() natif, destinataire caché)
├── 404.php                     ← page erreur personnalisée
├── .htaccess                   ← ErrorDocument 404
├── config/
│   └── secrets.php             ← gitignore, jamais commité (clé Turnstile)
├── templates/
│   ├── header.php
│   └── footer.php
├── data/
│   ├── articles.json
│   ├── categories.json
│   ├── equipes.json
│   └── matchs.json
├── images/
└── blog/
    ├── index.php
    └── helpers.php
```

⚠️ **`calendrier.php` n'existe toujours pas** — lié depuis le header/footer (donc sur toutes les pages) et depuis `equipe-france.php`/`euro.php`/`404.php`, mais jamais créé. Toujours en attente (cf. échange du 1er août sur les liens cassés).

**Adresse de contact officielle** : `info@coupe-du-monde-2026.info` (destinataire caché côté serveur, jamais affiché en HTML).

---

*Dernière mise à jour : 1er août 2026*
