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

### 3.19 Page calendrier + préparation automatisation n8n
- Création de **`calendrier.php`** : page listant "Prochains matchs" et "Derniers résultats", filtrable par compétition (L1, L2, CL, Europa, France), à partir de `data/matchs.json`. Gère l'état vide proprement (fichier actuellement `[]`).
- Schéma de `data/matchs.json` documenté dans `CLAUDE.md` (`competition`, `domicile`, `exterieur`, `date`, `heure`, `stade`, `status`, `score_dom`, `score_ext`).
- Guide de construction du workflow n8n documenté dans `CLAUDE.md` (section "n8n — Automation"), sur le modèle de CDM 2026 : Schedule Trigger 5 min, appels football-data.org (FL1/FL2/CL/EL), transformation vers le schéma du projet, comparaison `hasUpdate` avant commit (garde-fou anti-quota), commit GitHub direct sur `deploy` → déploiement auto via le webhook Hostinger désormais fonctionnel.
- **Limite identifiée** : football-data.org gratuit ne couvre pas bien les matchs amicaux de l'équipe de France hors grands tournois — cette branche restera manuelle pour l'instant.
- **Non fait par Claude** : la construction du workflow n8n lui-même (pas d'accès API/credentials à l'instance n8n dans cette session) — à faire par l'utilisateur dans l'interface n8n en suivant le guide, ou lors d'une session future avec accès approprié.

### 3.20 Guide n8n détaillé
- Création de **`guide-n8n-workflow.md`** (racine, documentation uniquement) : guide node par node pour construire le workflow n8n dans l'interface — Schedule Trigger, 4 nœuds HTTP Request (L1/L2/CL/EL), Merge (Append), nœud Code de transformation (code JS fourni intégralement), nœud GitHub "Get file", nœud Code de comparaison `hasUpdate` (code JS fourni), nœud IF, nœud GitHub "Edit file" (commit conditionnel).
- Prérequis credentials documentés : Header Auth football-data.org (réutilisation du même token que CDM 2026, attention à la limite globale 10 req/min tous projets confondus), GitHub PAT (probablement déjà réutilisable depuis le credential CDM 2026 si scope `repo` classique).
- Référencé depuis `CLAUDE.md`.

### 3.21 Construction réelle du workflow n8n — via contrôle navigateur Claude in Chrome
- Le workflow a été **effectivement construit et activé** dans n8n (pas seulement documenté) : Claude a piloté l'interface n8n directement via l'extension Claude in Chrome (session déjà connectée dans le navigateur de l'utilisateur — aucun mot de passe saisi).
- Inspection préalable du workflow CDM 2026 existant pour valider les types de nœuds, credentials à réutiliser (`Header Auth account`, `GitHub account`) et le pattern de chaînage (référencement de nœuds par nom `$('Nom du node')` sans passer par des nœuds Merge explicites).
- Workflow construit : Schedule Trigger (5 min) → Fetch L1 + Fetch CL (HTTP, football-data.org) → Transformer les matchs (Code) → GitHub - Get matchs.json → Comparer hasUpdate (Code) → Si mise à jour (IF) → GitHub - Edit matchs.json.
- **Écart majeur découvert en testant** : `FL2` (Ligue 2) et `EL` (Europa League) renvoient tous deux une erreur 403 *"restricted and apparently not within your permissions — check your subscription"* sur football-data.org. Confirmé que ce n'est pas un bug de credentials (FL1 et CL fonctionnent avec le même credential) mais une limitation du plan gratuit. **Nœuds Fetch L2 et Fetch EL supprimés du workflow**, code du nœud Transformer adapté en conséquence (uniquement L1 + CL).
- **Bug découvert et corrigé** : le champ "File Content" du nœud GitHub Edit, laissé en mode "Fixed" avec le texte `{{ $json.content }}` tapé littéralement, ne s'évalue PAS comme une expression en n8n — le premier commit réel a écrasé `data/matchs.json` avec le texte littéral (19 octets) au lieu du JSON des matchs. Corrigé en basculant explicitement le champ en mode **"Expression"** (toggle dédié à côté de "Fixed") et en retapant `$json.content` sans les accolades.
- Après correction : workflow exécuté avec succès de bout en bout, commit réel vérifié sur GitHub (`git log` API), fichier `data/matchs.json` déployé contient les vrais matchs Ligue 1 / Champions League, `https://football-passion.fr/calendrier.php` affiche les données en direct.
- **Workflow publié/activé** dans n8n — tourne désormais en autonomie toutes les 5 minutes.
- `guide-n8n-workflow.md` entièrement réécrit pour refléter l'architecture réelle (et non plus le plan théorique initial), avec la section "écarts et pourquoi" documentant les deux découvertes ci-dessus.

### 3.22 Matchs de qualification Champions League — ajout manuel + garde-fou n8n
- Constat : les matchs de qualification/barrages de la Ligue des Champions (tours 2/3 + playoffs, juillet-août 2026) n'apparaissaient pas dans `calendrier.php` — investigation confirmant que **football-data.org**, **api-football.com/api-sports.io** (plan gratuit verrouillé aux saisons 2022-2024) et l'API RapidAPI "Free API Live Football Data" (endpoints fixtures peu fiables) ne couvrent aucun ces tours qualificatifs. Aucune solution API viable trouvée — décision : saisie manuelle.
- **Convention adoptée** : les matchs ajoutés manuellement utilisent des `id >= 9000000` (séquentiels), pour les distinguer des IDs réels football-data.org (plage 300000-600000) et permettre à n8n de les identifier et les préserver.
- 33 matchs ajoutés à `data/matchs.json` (tours 2 et 3 de qualification + barrages), sourcés depuis des captures d'écran fournies par l'utilisateur.
- **Bug d'encodage découvert** : les noms d'équipes accentués tapés en dur dans un script `.ps1` (`AGF Århus`, `Bodø/Glimt`, `Kauno Žalgiris`...) ressortaient corrompus (mojibake, ex. `AGF Ã…rhus`) une fois déployés — cause probable : PowerShell lit le code source `.ps1` avec l'encodage ANSI système en l'absence de BOM. **Correction adoptée définitivement pour ce projet** : ne jamais taper de caractères accentués en dur dans un script `.ps1` — soit utiliser des noms d'équipes translittérés en ASCII pur pour toute donnée manuelle (`AGF Aarhus`, `Bodo/Glimt`, `Etoile Rouge`, `Fenerbahce`, `Zalgiris Kaunas`...), soit écrire le contenu accentué dans un fichier JSON séparé (via l'outil Write) et le faire lire par le script PowerShell en UTF-8 plutôt que de l'écrire en dur dans le `.ps1`.
- **Bug PowerShell découvert et documenté** : `@(ConvertFrom-Json $texte)` peut silencieusement tronquer un grand tableau JSON racine à un seul élément (reproduit deux fois sur un fichier de 495 entrées → `.Count` = 1 au lieu de 495). **Ne jamais wrapper `ConvertFrom-Json` dans `@()`** pour un tableau — utiliser `$var = ConvertFrom-Json $texte` directement.
- **Correctif n8n appliqué** : le nœud Code "Comparer hasUpdate" du workflow comparait l'intégralité du tableau API vs fichier existant, et écrasait tout `data/matchs.json` (y compris les entrées manuelles) à chaque différence détectée. Corrigé en filtrant `current` sur `id >= 9000000` et en les réinjectant (`merged = [...transformed, ...manual]`) avant comparaison et écriture. Workflow republié dans n8n (version "Preserve les matchs ajoutes manuellement...").
- Un conflit de fusion Git est survenu entre-temps (le workflow n8n non corrigé avait déjà écrasé les 33 matchs manuels via un commit automatique) — résolu en reconstruisant `data/matchs.json` à partir de la version fraîche d'`origin/deploy` (495 entrées) + réinjection des 33 matchs manuels ASCII-safe (528 entrées au total), commité et poussé.

### 3.23 Article n°3 — Mercato OM (Nayef Aguerd)
- Ajout de l'**article n°3** dans `data/articles.json` : *"OM : Nayef Aguerd vers un retour en Espagne ? La Real Sociedad accélère"* — catégorie `L1`, étiquettes `OM`, `Mercato`, `Real Sociedad`, `Aguerd`.
- Pas d'image/vignette fournie pour cet article — champs `image`/`vignette` laissés vides (le template `blog/index.php` gère cet état proprement avec un bloc dégradé de repli).
- Contenu accentué écrit via un fichier JSON de données intermédiaire (plutôt qu'en dur dans un script `.ps1`), conformément à la règle établie en 3.22 pour éviter la corruption d'encodage.

### 3.24 Articles n°4 et n°5 + règle de limitation des étiquettes
- Ajout de l'**article n°4** : *"Zinédine Zidane sélectionneur des Bleus : le rêve est devenu réalité"* — catégorie `France`, étiquettes `France`, `Zidane`, `CDM`, `Euro`, avec intégration d'une vidéo Facebook (iframe officielle) de la conférence de présentation. Vignette ajoutée ensuite (`zidane-nouveau-selectionneur-equipe-de-france-2030.webp`).
- Ajout de l'**article n°5** : *"Ligue des champions : Lyon battu à Prague, l'OL devra renverser la situation au retour"* — catégorie `L1`.
- **Constat utilisateur** : trop d'étiquettes par article (initialement `OL`, `Champions League`, `Sparta Prague`, `Fonseca` sur l'article n°5) diluent le filtrage par tag et n'apportent pas de valeur — retiré à `OL` + `Champions League` uniquement.
- **Règle ajoutée à `CLAUDE.md`** (section structure d'un article) : se limiter à **2 étiquettes pertinentes** (typiquement club + compétition), ne plus ajouter d'étiquettes secondaires (adversaire, entraîneur, joueur cité...) pour les prochains articles.

### 3.25 Migration articles.json → un fichier JSON par article
- **Motivation** : anticipation de plusieurs centaines d'articles à terme. Un unique `data/articles.json` posait deux problèmes réels : la page liste (`/blog`) chargeait et parsait le `contenu` HTML complet de tous les articles juste pour afficher les extraits, et chaque ajout d'article produisait un diff Git portant sur l'intégralité du fichier (risque de corruption accru — cf. bugs `@()` de la section 3.22).
- **Nouvelle architecture** : `data/articles/{slug}.json` (un fichier par article, contenu complet) + `data/articles-index.json` (tableau léger : id, slug, titre, categorie, etiquettes, date, extrait, vignette, image_alt — utilisé pour la liste, l'accueil, et les pages hub `equipe-france.php`/`euro.php`).
- **Fichiers modifiés** :
  - `blog/helpers.php` : `load_articles()` remplacée par `load_articles_index($basePath)` (lit `articles-index.json`) et `load_article($basePath, $slug)` (lit directement `data/articles/{slug}.json`, avec validation regex du slug contre le path traversal).
  - `blog/index.php` : vue article utilise `load_article()` (lecture ciblée, plus de scan du tableau complet) ; vue liste utilise `load_articles_index()`.
  - `index.php` (accueil) et `equipe-france.php`/`euro.php` : basculés sur `load_articles_index()` au lieu de lire `data/articles.json` directement.
- Script de migration one-shot (`split-articles.ps1`, hors repo) : a splitté les 5 articles existants en 5 fichiers `data/articles/{slug}.json` + généré `data/articles-index.json` trié par date décroissante.
- `data/articles.json` retiré du suivi Git (supplanté par la nouvelle structure) et documenté dans `CLAUDE.md` (nouvelle section "Structure d'un article" avec procédure obligatoire en 2 étapes pour tout futur article).
- Aucun changement d'URL ni de rendu HTML — migration invisible pour le SEO/Google (confirmé à l'utilisateur qui s'en inquiétait).

### 3.26 Sitemap XML dynamique + robots.txt
- **Constat** : le site n'avait ni `sitemap.xml` ni `robots.txt`. Google découvrait les articles uniquement par exploration de liens (accueil → blog → article), suffisant pour quelques articles mais insuffisant à l'échelle de plusieurs centaines évoquée pour la migration de la section 3.25 — risque que d'anciens articles (au-delà de la première page du blog) deviennent difficiles à (re)découvrir par le crawl seul.
- **Création de `sitemap.php`** (racine) : génère le XML à la volée à chaque requête, en lisant `data/articles-index.json` (via `load_articles_index()`) pour la liste des articles (`<lastmod>` = champ `date`) + un tableau statique des pages fixes du site (accueil, blog, calendrier, équipe de France, euro, à-propos, contact, mentions légales, confidentialité) avec `changefreq`/`priority` adaptés.
- **Accessible en `/sitemap.xml`** via une règle de réécriture ajoutée dans `.htaccess` (`RewriteRule ^sitemap\.xml$ sitemap.php [L]`).
- **Création de `robots.txt`** (racine) : autorise tout le crawl (`Allow: /`) et référence `Sitemap: https://football-passion.fr/sitemap.xml`.
- **Mise à jour automatique, par construction** : `sitemap.php` interroge `articles-index.json` en direct à chaque appel — aucun script de régénération, cron ou action manuelle n'est nécessaire. La seule condition est de continuer à suivre la procédure en 2 étapes de la section 3.25 (fichier article + entrée index) pour chaque nouvel article ; le sitemap reflète alors automatiquement l'état courant.
- **Reste à faire côté utilisateur** : soumettre `https://football-passion.fr/sitemap.xml` dans Google Search Console pour accélérer la découverte initiale (le fichier fonctionnera aussi passivement, référencé par `robots.txt`, mais la soumission manuelle accélère l'indexation).

### 3.27 Bug critique n8n — accolades orphelines bloquant toute mise à jour des matchs
- **Symptôme signalé par l'utilisateur** : plus de "derniers résultats" affichés sur `calendrier.php`, alors que des matchs récents avaient bien été joués.
- **Diagnostic** (capture d'écran n8n fournie par l'utilisateur) : le nœud Code "Comparer hasUpdate" affichait une erreur `SyntaxError: Unexpected token '}'`. Cause : des accolades de fermeture orphelines (`}`, `}]`, `}`, `}`, `}`) laissées après le `return` légitime lors d'une édition précédente du node (section 3.22) — reliquat non nettoyé. Résultat : le node échouait à **chaque exécution** depuis cette édition, empêchant toute mise à jour de `data/matchs.json` par l'automatisation.
- **Correction** : pilotage direct de l'éditeur n8n via Claude in Chrome (session déjà connectée), ouverture du node en plein écran ("Edit JavaScript"), suppression des lignes orphelines (30-34), workflow republié sous le nom "Corrige une erreur de syntaxe (accolades orphelines)...".
- **Point d'attention pour l'avenir** : après toute édition de code dans un nœud n8n via automatisation navigateur, toujours relire l'intégralité du code affiché (scroll jusqu'en bas) avant de fermer le panneau, pour repérer d'éventuels restes de l'ancien contenu non supprimés par un `Ctrl+Shift+End` + `Delete` mal positionné.

### 3.28 Archivage des matchs — matchs.json en fenêtre glissante
- **Motivation** : question de l'utilisateur sur la gestion des résultats "au fil de la saison, sur plusieurs années", en référence à flashscore.fr (calendrier courant séparé des archives par saison). Anticipation du même problème que celui résolu pour les articles (section 3.25) : `data/matchs.json` grossirait indéfiniment sans purge, saison après saison.
- **Architecture retenue** : `data/matchs.json` devient une **fenêtre glissante** — résultats `FINISHED` récents (moins de 45 jours) + tous les matchs à venir. Les résultats plus anciens sont déplacés vers `data/archives/{competition}-{saison}.json` (un fichier par compétition+saison, ex. `CL-2025-2026.json`).
- **Script créé** : `scripts/archive-old-matches.ps1` (versionné dans le repo, contrairement aux scripts habituels en scratchpad car destiné à être réexécuté régulièrement). Calcule la saison à la volée depuis le champ `date` (indépendant d'un éventuel champ `saison` manquant — donc pas besoin de modifier le node n8n "Transformer les matchs", limite les risques après le bug de la section 3.27), fusionne avec l'archive existante en dédoublonnant par `id`, retire les entrées archivées de `matchs.json`.
- **Premier run** : a archivé 189 matchs Champions League phase de ligue 2025-2026 (données réelles football-data.org, datées de septembre 2025, largement hors fenêtre de 45 jours) vers `data/archives/CL-2025-2026.json`. `matchs.json` passé de 554 à 365 entrées ; tous les 59 matchs ajoutés manuellement (qualifs CL + Europa League) préservés car soit récents soit à venir.
- **Champ `saison`** ajouté à toutes les entrées existantes de `matchs.json` (calculé depuis `date`, format `"YYYY-YYYY+1"`, année sportive de juillet à juin).
- **Nouvelle page `archives.php`** : scanne `data/archives/` pour lister les couples compétition+saison disponibles, affiche les résultats de la sélection (`?comp=CL&saison=2025-2026`). Lien ajouté depuis `calendrier.php`.
- **`sitemap.php`** mis à jour pour référencer automatiquement chaque page d'archive existante (une entrée par fichier trouvé dans `data/archives/`).
- **Pas encore automatisé** : le script d'archivage s'exécute manuellement pour l'instant (pas de cron ni de déclenchement n8n) — à réévaluer si le volume de matchs justifie une automatisation, mais pas prioritaire tant que `matchs.json` reste sous ~1000 entrées.

### 3.29 Décision définitive — pas d'upgrade payant football-data.org, L2/Europa/qualifs CL/Équipe de France restent manuels
- **Décision de l'utilisateur** : ne pas payer pour un plan football-data.org supérieur afin de débloquer Ligue 2 et Europa League via n8n. Ces compétitions (+ les tours de qualification/barrages de Champions League, + l'Équipe de France) resteront **manuelles en permanence** — pas un état transitoire.
- Ajout des résultats/matchs L2 journée 1 et 2 (18 entrées, `id` 9000060-9000077) selon le même procédé que les qualifs CL et Europa League.
- **Documentation formalisée dans `CLAUDE.md`** (section n8n — Automation) : procédure standard en 7 étapes pour toute compétition manuelle (extraction sans hallucination, ID `>= 9000000`, noms ASCII purs, `git pull` avant modification, script PowerShell sans `@()` autour de `ConvertFrom-Json`, vérification anti-mojibake, commit+push) — à appliquer directement sans redemander confirmation à chaque nouvelle capture d'écran fournie par l'utilisateur.

### 3.30 Numéro de journée + historique de saison consultable en direct
- **Demande utilisateur** : afficher le numéro de journée dans "Derniers résultats"/"Prochains matchs" de `ligue-2.php`, et garder un historique consultable sur le long terme (saison 2026-2027) plutôt que de dépendre uniquement de l'archivage à 45 jours (section 3.28).
- **Champ `journee`** ajouté aux 27 matchs L2 déjà en base (backfill par plage d'`id` : 9000060-9000068 → J1, 9000069-9000077 → J2, 9000078-9000086 → J3) et à la procédure de saisie manuelle (`CLAUDE.md`, étape 4bis) pour toutes les prochaines journées.
- **`ligue-2.php`** : "Derniers résultats" et "Prochains matchs" groupés par `journee` (plus par date) — une journée peut s'étaler sur plusieurs jours (ex. Ven/Sam/Lun pour J3), le regroupement par date seule aurait cassé l'affichage.
- **`archives.php` retravaillé** : ne se limite plus aux fichiers déjà archivés dans `data/archives/`. Fusionne désormais à la volée les résultats `FINISHED` encore présents dans `data/matchs.json` (saison en cours, pas encore purgée) avec l'archive existante le cas échéant, dédoublonnage par `id`. Le sélecteur de saisons liste donc aussi la saison en cours dès le premier résultat. Affichage groupé par journée si le champ est renseigné.
- **Nouvelle fonction partagée `saison_fr()`** dans `blog/helpers.php` (calcul de la saison sportive depuis une date, même logique que `Get-Saison` dans `scripts/archive-old-matches.ps1`), utilisée par `archives.php` et `sitemap.php`.
- Lien direct ajouté sur `ligue-2.php` : "Historique de la saison →" pointe vers `archives.php?comp=L2&saison=2026-2027`, visible dès qu'il y a au moins un résultat.

### 3.31 Vidéos LFP bloquées en embed — utiliser un lien externe, pas un iframe
- **Constat** : l'iframe YouTube intégrée dans l'article Trophée des champions (section précédente) affichait "Vidéo non disponible — contenu LFP bloqué sur ce site" au lieu de la vidéo. La Ligue de Football Professionnel désactive l'embed externe sur ses contenus vidéo officiels (contrairement aux vidéos Facebook utilisées pour l'article Zidane, qui s'intègrent normalement).
- **Correction** : remplacé l'`<iframe>` par un lien externe classique (`<a target="_blank" rel="nofollow noopener noreferrer">`) vers la page YouTube, stylé comme une carte cliquable.
- **Règle pour l'avenir** : ne pas utiliser d'iframe `youtube.com/embed/...` pour du contenu vidéo officiel LFP/Ligue 1 — toujours un lien externe direct. Les vidéos Facebook et les vidéos YouTube non-LFP peuvent en revanche être embarquées normalement (déjà validé avec l'article Zidane).

### 3.32 Renommage de la page Facebook CDM 2026 → Football Passion (étape 1)
- **Contexte** : la page Facebook "Coupe du Monde 2026 INFO" (227 followers, marquée Inactive dans le portefeuille business Meta) devait être réutilisée pour "Football Passion" plutôt que d'en créer une nouvelle, pour ne pas perdre l'audience déjà acquise (cf. `project_cdm_strategie.md`, mémoire long terme).
- **Blocage rencontré** : le nom principal de la Page ("Nom") ne pouvait pas être changé directement — Facebook affichait *"Impossible de changer votre nom sur Facebook pour le moment car vous l'avez déjà fait au cours des 60 derniers jours"*, résidu d'une tentative de renommage antérieure. Ce verrou dure typiquement 60 jours après un changement/rejet.
- **Ce qui a pu être fait malgré le verrou** (ces champs sont indépendants du "Nom" principal) :
  - **Nom de profil / identifiant** changé en `footballpassionfr` → nouvelle URL publique : `https://www.facebook.com/footballpassionfr`.
  - **Nom principal** finalement passé à `footballpassion.fr` (le 19 août 2026) — accepté par Facebook mais avec un mauvais formatage (style URL, sans espace ni majuscules, à cause d'une confusion entre le champ "Nom" et "Nom de profil" pendant la manipulation). Ce nom est maintenant lui aussi verrouillé pour 60 jours (jusqu'à environ **le 18 octobre 2026**).
  - **Autre nom (AKA)** ajouté via `À propos → Noms → Autres noms` : `Football Passion` (type "Pseudo", option "Affiché en haut de la Page" cochée) — s'affiche maintenant correctement à côté du nom principal : *"footballpassion.fr (Football Passion)"*.
- **État actuel (19 août 2026)** : Page publique affichant "footballpassion.fr (Football Passion)", URL `facebook.com/footballpassionfr`, 227 followers conservés. Photo de couverture et de profil encore à l'ancienne identité visuelle CDM 2026 — pas encore mises à jour.
- **Reste à faire** :
  - Changer photo de profil et photo de couverture pour l'identité visuelle Football Passion.
  - Mettre à jour la bio/description (actuellement encore "Actu, analyses et pronostics CDM 2026") et le lien site web (actuellement `coupe-du-monde-2026.info`, à remplacer par `football-passion.fr`).
  - **Vers le 18 octobre 2026** (60 jours après le 19 août) : retenter le changement du "Nom" principal, cette fois en tapant correctement `Football Passion` (avec espace et majuscule), pas une variante façon URL.

### 3.33 Logo Football Passion (concept C) + bandeau héro de l'accueil
- **Logo retenu** : concept C, monogramme "FP" (voir présentation en artifact, trois pistes comparées). Fichiers produits via un script PowerShell (`System.Drawing`, pas d'outil de conversion d'image disponible sur la machine — ni ImageMagick, ni Python) : `favicon.svg`, `favicon.ico` (16/32/48 multi-résolution), `apple-touch-icon.png` (180×180), `logo-fp-icon-512.png` (512×512, pour avatar réseaux sociaux), `logo-football-passion.svg` (wordmark complet pour le header). Regroupés depuis dans `images/charte-graphique/` (voir section 3.34).
- **Bug corrigé en cours de route** : le premier rendu du monogramme affichait le "P" décalé trop à droite (mesure manuelle de la largeur du "F" faussée par le bearing par défaut de `MeasureString`). Corrigé en passant à `StringFormat.GenericTypographic` pour une mesure de texte fidèle.
- **`templates/header.php`** : remplace le texte `⚽ Football Passion` par `logo-football-passion.svg`, favicon enfin présent (référencé mais absent auparavant — voir `charte-graphique.md`).
- **Bandeau héro de l'accueil (`index.php`) validé par l'utilisateur** : remplace l'ancien bloc `bg-gradient-to-r` plat par une bannière avec le logo FP (badge arrondi), une texture terrain discrète en SVG inline (ligne médiane, cercle central, arcs de corner, opacité ~6-15%), deux halos verts diffus (`blur-3xl`), et les compétitions affichées en pastilles (`border-gray-700 rounded-full`) plutôt qu'en texte séparé par des puces.
- **Correctifs suite aux retours de l'utilisateur** : (1) pastilles de compétitions du bandeau initialement non cliquables (`<span>`) — corrigé en `<a>` réutilisant le mapping `$hubs` (hoisté en tête de fichier, partagé avec la grille "Catégories") ; (2) ajout de `football-passion.fr` sous la tagline du bandeau (pas dans le header, jugé trop contraint en espace) pour renforcer le nom de domaine exact face à la concurrence sur le nom "football passion" ; (3) espacement incorrect entre "Football" et "Passion" dans le wordmark du header (deux `<text>` positionnés en dur au lieu d'un seul avec `tspan`) — corrigé, puis le texte du wordmark lui-même changé en `football-passion.fr` (couleurs blanc/vert conservées) à la demande de l'utilisateur, `viewBox` élargi de 300 à 340 pour éviter que le texte plus long déborde.

### 3.34 Réorganisation des assets de marque dans images/charte-graphique/
- **Demande utilisateur** : le dossier `images/` mélangeait vignettes d'articles, logos de compétitions tierces (`images/logo/`) et assets de marque Football Passion — régroupement demandé dans un nouveau sous-dossier `images/charte-graphique/` créé par l'utilisateur.
- **Fichiers déplacés** (`git mv`, historique préservé) : `favicon.svg`, `favicon.ico`, `apple-touch-icon.png`, `logo-fp-icon-512.png`, `logo-football-passion.svg`, `facebook-cover.png`. Les vignettes d'articles (racine de `images/`) et les logos de compétitions (`images/logo/`) ne sont **pas** déplacés — ce ne sont pas des assets de marque Football Passion.
- **Références mises à jour** : `templates/header.php` (favicon, apple-touch-icon, logo header) et `index.php` (logo du bandeau héro) pointent désormais vers `/images/charte-graphique/...`.
- `charte-graphique.md` et cette procédure mis à jour avec les nouveaux chemins.

### 3.35 Post d'annonce Facebook — transition CDM 2026 → Football Passion
- **Vignette** générée : `images/charte-graphique/facebook-post-annonce-nouveau-nom.png` (1200×630) — "Coupe du Monde 2026" barré, flèche vers le badge FP + wordmark "Football Passion", tagline `football-passion.fr`. Texte dessiné en ASCII pur dans le script PowerShell (flèche dessinée en formes vectorielles, pas en caractère Unicode) pour éviter le bug de mojibake habituel.
- **Texte du post rédigé** (ton passion + fair-play, cohérent avec la ligne éditoriale de `CLAUDE.md`), en texte brut sans Markdown — rappel fait à l'utilisateur que Facebook ne supporte pas `**gras**` dans le composeur, seulement retours à la ligne/emojis/URL brutes auto-cliquables.
- **Formats vidéo Facebook** communiqués à l'utilisateur (post feed, vidéo de couverture, Reels) suite à sa question.
- **L'utilisateur a transformé l'image 1200×630 en vidéo via Canva** pour publier le post — ratio proche du 16:9 recommandé, compatible sans ajustement nécessaire.

### 3.36 Bilan Football Passion vs CDM 2026 + début de stratégie de monétisation
- **Point complet demandé par l'utilisateur** (21 août 2026) : bilan de ce qui a été construit sur Football Passion (16 pages, architecture données scalable, automatisation n8n L1/CL + procédure manuelle L2/Europa/qualifs CL/France, SEO — sitemap/robots/redirection www, identité de marque, réseaux sociaux, 9 articles publiés), comparé aux fonctionnalités de `coupe-du-monde-2026` (newsletter Brevo, panel admin, chatbot, sondages, ~20 pages équipe/confédération — que FP n'a pas encore).
- **Décision stratégique actée** : préparer dès maintenant le terrain SEO pour une **monétisation future** (liens sponsorisés, publicité) autour des mots-clés **"pronostic"** et **"abonnement"**, ciblés sur les 3 compétitions à plus fort trafic potentiel : Ligue 1, Ligue 2, Champions League.
- **Mots-clés intégrés** dans `ligue-1.php`, `ligue-2.php`, `champions-league.php` : `meta_desc` reformulée (mention "pronostics" + "infos abonnement") et sous-titre du bandeau héro modifié pour inclure "pronostics" en texte visible (le poids SEO du texte visible étant supérieur à celui de la seule meta description).
- **"Abonnement" volontairement laissé uniquement en meta_desc pour l'instant**, pas encore dans le texte visible des pages — aucune fonctionnalité d'abonnement/diffusion TV n'existe encore sur le site, éviter une promesse vide en visible tant que la section correspondante (ex. comparateur d'offres, lien affilié diffuseur) n'est pas construite.
- **Piste de plan d'action proposée** (court terme = nettoyage bio/liens Facebook [voir 3.32/3.35] + Google Search Console + récupération de la newsletter Brevo existante ; moyen terme = finalisation renommage FB (~18 oct.) + automatisation n8n rédaction (base : `instructions-gpt-redaction.md`) + éventuelles pages club prioritaires (OM en tête, cohérent avec la stratégie éditoriale) ; plus tard = panel admin léger, engagement communautaire) — **le volet court terme est désormais entièrement réalisé** : nettoyage Facebook fait (3.32/3.35), newsletter Brevo branchée (3.37), Google Search Console validé + sitemap actif (3.38).

### 3.37 Newsletter Brevo — inscription depuis le footer (21 août 2026)
- **Réutilisation du capital Brevo existant** (compte utilisé pour `coupe-du-monde-2026`) mais avec une **nouvelle liste dédiée `Football Passion` (id `#3`)**, créée par l'utilisateur — plutôt que de réutiliser la liste CDM 2026 (`#2`), pour respecter le périmètre de consentement RGPD : les abonnés CDM 2026 ont consenti à du contenu CDM 2026, pas à du contenu evergreen L1/L2/CL.
- **Nouvelle clé API Brevo dédiée** créée par l'utilisateur (nom `FOOT-PASSION`, visible dans SMTP et API → Clés API et MCP), distincte de la clé `cdm 2026 info newsl...` existante. **Aucune "liaison" clé↔liste à faire côté Brevo** : une clé API a accès à tout le compte, c'est le paramètre `listIds` envoyé dans chaque appel API qui détermine la liste cible.
- **Architecture** : contrairement à CDM 2026 (MySQL + Brevo + notification email admin), Football Passion n'a pas de base de données — **Brevo est la seule source de vérité des abonnés**. Endpoint `newsletter-subscribe.php` à la racine : reçoit un POST (email + honeypot anti-bot), valide, appelle `POST https://api.brevo.com/v3/contacts` avec `listIds: [3]`.
- **Secrets** : `BREVO_API_KEY` et `BREVO_LIST_ID` ajoutées à la suite du `config/secrets.php` déjà existant sur le serveur Hostinger (jamais commité, upload/édition manuelle uniquement — clé fournie en direct dans le chat par l'utilisateur, même pattern que le secret Turnstile).
- **Formulaire** ajouté dans `templates/footer.php` (juste avant la grille de navigation à 4 colonnes) : champ email + honeypot caché (`name="website"`) + bouton "S'abonner", géré en JS (`fetch` vers `newsletter-subscribe.php`, sans rechargement de page, message de succès/erreur inline). Lien vers `/politique-confidentialite.php` affiché sous le formulaire (mention RGPD).
- **Pas de Turnstile sur ce formulaire** (contrairement à `contact.php`) — choix délibéré pour une inscription sans friction, protection anti-bot limitée au honeypot.
- **Testé et validé en production** : deux contacts de test (`test-verif-fp@dixie.consulting`, `test-verif-fp-2@dixie.consulting`) envoyés via `curl` vers l'endpoint live, confirmés apparus dans la liste `Football Passion` (#3) côté interface Brevo par l'utilisateur, puis supprimés.

### 3.38 Google Search Console — validation de la propriété + soumission du sitemap (21 août 2026)
- **Propriété validée** par l'utilisateur (méthode DNS TXT, TTL 14400s = 4h — valeur standard, sans incidence sur la validité, seulement sur la vitesse de propagation).
- **Soumission du sitemap** (`sitemap.xml`, chemin relatif) initialement rejetée par le formulaire GSC ("Adresse de sitemap incorrecte") ; l'URL absolue `https://football-passion.fr/sitemap.xml` a été acceptée par le formulaire mais est ensuite passée en erreur **"Impossible de récupérer le sitemap"**.
- **Diagnostic** : vérification serveur (`curl`, y compris avec `User-Agent: Googlebot`) confirmait un `sitemap.xml` accessible en HTTP 200, XML valide, `robots.txt` correct (`Allow: /` + ligne `Sitemap:`) et `.htaccess` sans règle bloquant les bots — aucune anomalie détectée côté code/serveur.
- **Résolution** : l'échec était **transitoire** — un nouveau test via l'outil "Inspection d'URL" de GSC (qui simule un vrai fetch Googlebot, contrairement à la page Sitemaps) a montré **"Traitement du sitemap réussi"**, 26 pages découvertes, 0 vidéo. Google réessaie apparemment automatiquement après un premier échec juste après validation d'une propriété toute neuve.
- **Statut** : sitemap actif, indexation en cours (délai normal de quelques jours à quelques semaines pour une propriété neuve).

### 3.39 Page pilier SEO "Guide des droits TV football 2026-2027" + intégration Google AdSense (21 août 2026)
- **Contexte** : première mise en œuvre concrète de la stratégie de monétisation actée en 3.36 (mots-clés "abonnement"/"pronostic"). L'utilisateur a fourni un brief détaillé (structure, textes, CTA, FAQ) pour une page comparative des droits TV Ligue 1/Ligue 2/Coupes d'Europe, destinée à terme à des liens d'affiliation.
- **Corrections factuelles appliquées avant publication** (règle anti-hallucination — l'utilisateur a rappelé explicitement "on ne prend jamais de risque, pas d'hallucination c'est la règle d'or") après vérification croisée (recherche web + capture d'écran officielle plus.ligue1.com + Conditions Générales d'Abonnement Ligue 1+ version du 28 juillet 2026 collées par l'utilisateur) :
  - Prix réels confirmés : Pass Ligue 1 - Offre Limitée (14,99 €/mois les 3 premiers mois puis 19,99 €/mois, **engagement 12 mois**, 2 utilisateurs), Pass Direct 1 An (199 €/année, **engagement 12 mois**, 2 utilisateurs), Pass Mensuel (24,99 €/mois, sans engagement, 2 utilisateurs), Pass Mobile (19,99 €/mois, sans engagement, 1 utilisateur).
  - **Pass -26 ans exclu** de la page à la demande explicite de l'utilisateur.
  - **Astuce "se désabonner fin mai pour ne payer que 10 mois" supprimée** : le brief initial la présentait comme valable, mais l'article 3.5.2 des CGA Ligue 1+ interdit la résiliation anticipée sur les offres avec engagement 12 mois (sauf déménagement/changement de foyer fiscal justifié) — publier cette astuce aurait induit les lecteurs en erreur sur leurs droits contractuels.
  - Astuce partage d'écran recalculée avec le bon montant : 199 € / 2 utilisateurs = **99,50 €/personne** (le brief initial annonçait "moins de 95 €", non vérifié).
- **Fichier créé** : `droits-tv-football.php` (racine), suit le pattern des pages statiques (`$page_title`/`$meta_desc` + `templates/header.php`/`footer.php`, pas de page autonome en CSS custom). Contient : hero, cartes tarifaires Ligue 1+, bloc "Astuce Football-Passion", CTA vers Ligue 1+ et Canal+ Sport (`href="#"`, en attente de liens d'affiliation — commentaire TODO pour ajouter `rel="sponsored noopener noreferrer"` le jour venu), FAQ en `<details>/<summary>` + balisage JSON-LD `FAQPage` correspondant, deux emplacements publicitaires réservés (728×90 et 300×250, actuellement des blocs placeholder en pointillés).
- **FAQPage schema** : ajouté pour la donnée structurée, avec la réserve que Google a fortement restreint depuis 2023 l'éligibilité au rich snippet "People Also Ask" pour ce balisage (quasi réservé sites gouvernementaux/santé) — pas de garantie de gain SERP direct, mais utile pour la compréhension du contenu par les moteurs/IA.
- **Référencement interne** : page ajoutée à `sitemap.php` (priorité 0.7, changefreq monthly), au footer (colonne Compétitions, libellé "Guide droits TV") et à la nav du header (libellé "Droits TV") — visibilité maximale car c'est une page à vocation de monétisation.
- **Image d'en-tête** : pas encore générée — emplacement en commentaire dans le code (`images/droits-tv-football-2026-2027.webp` à créer puis décommenter).
- **Google AdSense** : script de vérification (`ca-pub-1397315006076063`) ajouté dans `templates/header.php` (`<head>`, sur toutes les pages du site) pour valider la propriété football-passion.fr côté Google AdSense. Vérifié en production via `curl` sur la homepage — script bien présent. Les deux emplacements placeholder de `droits-tv-football.php` sont prêts à recevoir les balises `<ins class="adsbygoogle">` une fois les unités publicitaires créées côté AdSense.
- **Site validé par AdSense** (21 août 2026, 13:02) — statut "Examen demandé" : Google effectue désormais une revue du site avant activation effective des annonces, délai annoncé de quelques jours à 4 semaines. Rien à faire côté site en attendant ; à suivre pour activer les unités publicitaires dans les emplacements réservés une fois l'examen validé.

### 3.40 Incident déploiement Hostinger — fichier uploadé manuellement bloquant le pull Git (21 août 2026)
- **Symptôme** : après remplacement de la vignette de l'article PSG-Rennes (nouveau fichier `.webp` + JSON modifiés), l'image s'est déployée mais les deux fichiers JSON (`data/articles-index.json` et `data/articles/psg-rennes-inverse-roazhon-park-2026.json`) sont restés bloqués sur l'ancienne version pendant plusieurs minutes, malgré un `git push` réussi côté GitHub et même un commit vide de retrigger.
- **Cause identifiée** : l'utilisateur avait auparavant uploadé manuellement un fichier `images/psg-rennes-inverse-roazhon-park-2026.webp` directement sur le serveur (hors Git). Ce fichier, présent sur le disque mais non suivi par le dépôt Git côté serveur, faisait échouer silencieusement le `git pull` automatique déclenché par le webhook (erreur "untracked working tree files would be overwritten by merge"), bloquant du même coup la mise à jour de tous les autres fichiers du même déploiement — pas seulement le fichier en conflit.
- **Diagnostic** : le déploiement webhook-automatique de Hostinger échoue **sans notification visible** en cas de conflit — seul un déploiement manuel déclenché depuis hPanel (Sites → Avancé → Git → menu ⋮ → Déployer) affiche le message d'erreur réel.
- **Résolution** : suppression du fichier en conflit via le gestionnaire de fichiers hPanel, puis nouveau déploiement manuel réussi — a rattrapé d'un coup l'image et les deux JSON en retard.
- **Règle à retenir** : **ne jamais uploader manuellement un fichier sur le serveur Hostinger portant le même nom qu'un fichier prévu pour être commité/poussé via Git** — ça bloque silencieusement tout le pipeline de déploiement automatique jusqu'à intervention manuelle. En cas de doute sur un déploiement qui semble bloqué (fichier neuf déployé mais JSON/PHP modifiés qui ne suivent pas), vérifier d'abord côté hPanel → Git → Déployer manuellement pour voir le message d'erreur exact plutôt que de multiplier les retry silencieux.

### 3.41 Règle éditoriale — tableau HTML dans les articles à données comparables (21 août 2026)
- **Décision** : ajouter un tableau HTML structuré dès qu'un article contient des données comparables (prix, formules d'abonnement, statistiques, calendrier...) — Google valorise ce type de contenu structuré pour la compréhension et les rich snippets. Règle ajoutée dans `CLAUDE.md` (section "Contenu — Anti-footprint").
- **Appliqué immédiatement** : ajout d'un tableau comparatif des 4 formules Ligue 1+ (prix, utilisateurs, engagement) dans l'article `ligue-1-plus-comment-regarder-tous-les-matchs-2026-2027.json`, repris du style déjà utilisé dans l'article PSG-Rennes (fond sombre, bordure verte `#16a34a`, `overflow-x:auto` responsive) — sert désormais de référence de style pour les futurs tableaux.
- **Vignette de l'article** : `images/ligue-1-plus-comment-regarder-2026-2027.webp` fournie par l'utilisateur (visuel Ligue 1+ avec logos de clubs, cohérent avec la charte FP).

### 3.42 Champ "tour" + badge "saison" sur `calendrier.php`, résultats CL et Europa League qualifs/barrages (21 août 2026)
- **Demande** : marquer la saison en cours et le tour de la compétition (ex. "3e tour de qualification · Manche 1 sur 2") sur `calendrier.php?comp=CL`, plus mise à jour des résultats depuis des captures d'écran fournies par l'utilisateur.
- **Nouveau champ `tour`** ajouté aux entrées manuelles de qualification/barrages (`data/matchs.json`) — chaîne descriptive complète (ex. `"Europa League - Barrages - Manche 2 sur 2"`), affichée sur chaque carte de match dans `calendrier.php` quand elle est renseignée.
- **Badge saison** : `Saison 2026-2027` affiché à côté du H1 quand un filtre compétition est actif, calculé dynamiquement via `saison_fr(date('Y-m-d'))` (fonction déjà existante dans `blog/helpers.php`, utilisée par `archives.php`) — **aucune valeur codée en dur**, fonctionne automatiquement pour les saisons futures.
- **Champions League** : résultats de la Manche 2 du 3e tour de qualification (10 matchs) et de la Manche 1 des barrages (4 matchs manquants) complétés depuis les captures ; correction de date sur LASK - Celtic Glasgow (26/08 et non 25/08).
- **Europa League** : ajout de 50 rencontres de qualification manuelles (3e tour manche 1+2, barrages manche 1+2) — équipes issues des tours préliminaires de Champions League. Cohérence vérifiée entre les 3 captures (score de la manche + cumul agrégé) avant écriture, conformément à la règle anti-hallucination.
- **⚠️ Incident détecté et corrigé** : la Manche 2 du 3e tour Europa League avait déjà été pré-créée le 7 août (`ids 9000047-9000059`, statut `SCHEDULED` sans score, commit `9a92f00`) — non repérée avant l'ajout des nouvelles données, ce qui a créé 13 doublons (`ids 9000100-9000112`). Corrigé : suppression des doublons, mise à jour des entrées d'origine avec les vrais résultats + libellé `tour`. **Leçon retenue : avant d'ajouter manuellement des matchs d'un tour de qualification, toujours vérifier par équipes/dates si des entrées SCHEDULED placeholder n'existent pas déjà dans `matchs.json`** (`grep`/filtre PowerShell sur les noms d'équipes concernées) plutôt que de supposer l'absence de données.
- **Nouvelle compétition — Ligue Conférence UEFA** : absente jusqu'ici du site. Ajoutée dans `calendrier.php` (`$competitions`/`$logosCompetitions`, code `Conference`, logo `images/logo/logo-conference-uefa.png` fourni par l'utilisateur). L'utilisateur a collé l'intégralité du bracket de qualification (4 tours depuis juillet, ~230 matchs) — **portée volontairement limitée aux Barrages** (48 matchs, Manche 1 terminée + Manche 2 à venir le 27/08) après clarification avec l'utilisateur : `calendrier.php` n'affichant que les 15 derniers résultats/15 prochains matchs par compétition, les tours antérieurs (1er/2e/3e tour, joués en juillet) ne s'afficheraient de toute façon jamais sur le site en l'état. Les 24 confrontations des barrages vérifiées par cohérence score-de-la-manche/cumul-agrégé avant écriture. Champ `tour` = `"Ligue Conference - Barrages - Manche X sur 2"` (sans accent, évite tout risque de mojibake).

### 3.43 Renommage `euro.php` → `euro-2028.php` (SEO exact-match) + section stades (21 août 2026)
- **Constat de l'utilisateur** : la page équivalente sur coupe-du-monde-2026.info (`/euro-2028.php`) rank bien sur Google (2162 impressions, position moyenne 10,7 sur la requête "euro 2028" d'après un export Search Console collé par l'utilisateur), alors que la page Football Passion existait sous `/euro.php` — sans "2028" dans l'URL, contrairement à un signal exact-match qui a fait ses preuves sur le site jumeau.
- **Comparatif de contenu** : le contenu de FP était déjà substantiellement équivalent (dates, pays hôtes, format, qualifications, angle France/Zidane) — l'écart identifié était **l'URL** et l'**absence d'une section "Stades" dédiée** (présente sur CDM2026).
- **Action** : renommage `euro.php` → `euro-2028.php` via `git mv` (conserve l'historique), redirection **301** ajoutée dans `.htaccess` (`euro.php` → `/euro-2028.php`) pour ne pas perdre le référencement déjà accumulé sur l'ancienne URL, liens internes mis à jour (`calendrier.php`, `index.php` \$hubs, `sitemap.php`), JSON-LD `SportsEvent.url` mis à jour.
- **Nouvelle section "Les 9 stades retenus"** ajoutée (noms officiels + villes + capacités), données vérifiées via recherche web (Wembley Stadium 90 652 places pour la finale, Principality Stadium Cardiff pour l'ouverture, etc.) — comble l'écart de contenu identifié face à la page de référence.
- **Vérifié en production** : nouvelle URL 200, ancienne URL redirige bien en 301, section stades visible.
- **FAQ ajoutée** (JSON-LD `FAQPage` + accordéon `<details>/<summary>`, même pattern que `droits-tv-football.php`) ciblant explicitement les requêtes remontées par l'utilisateur via Search Console : "dates euro 2028", "euro 2028 lieu", "coupe d'europe 2028"/"coupe d europe 2028" (clarifie que c'est le même événement que l'Euro), et surtout "coupe du monde 2028"/"coupe du monde foot 2028"/"coupe du monde football 2028" — une question dédiée explique qu'il n'y a pas de Coupe du Monde en 2028 (2026 puis 2030) pour capter et bien informer ces internautes confus plutôt que les laisser sur une fausse piste.
- **Revirement architecture** : après réflexion de l'utilisateur, `euro.php` n'est **plus une redirection 301** vers `euro-2028.php` mais redevient une vraie **page hub évergreen** listant les éditions de l'Euro (tableau `$editions`, une seule entrée pour l'instant : Euro 2028) — pensée pour rester pertinente quand l'Euro 2032 sera connu, sans devoir renommer une nouvelle fois une URL. `euro-2028.php` reste la page détaillée/SEO exact-match, reliée depuis le hub et via son propre breadcrumb (`Accueil › Euro › 2028`). Liens internes (`calendrier.php`, `index.php` \$hubs) repointés vers `/euro.php` ; `sitemap.php` référence les deux URLs. Redirection 301 retirée de `.htaccess`.

### 3.44 Deux sous-pages piliers Euro 2028 : les 9 stades et les 8 villes hôtes (22 août 2026)
- **Contenu fourni par l'utilisateur** (comme pour la page hub), réparti en deux nouvelles pages sans redondance entre elles ni avec `euro-2028.php` (qui garde ses sections courtes existantes + un lien "en savoir plus" vers chaque page fille) : `euro-2028-les-9-stades.php` (détail par stade, tableau capacités, tableau répartition des matchs par tour) et `euro-2028-les-8-villes-hotes.php` (les 4 nations, le centenaire n'est pas concerné ici — c'est l'Euro, pas la CDM — plutôt la répartition géographique par ville).
- FAQ + JSON-LD `FAQPage` sur chaque page, breadcrumb `Accueil › Euro › 2028 › [page]`, liens croisés entre les deux pages filles.

### 3.45 Photos des 9 stades Euro 2028 + vignettes/liens sur la page hub (22 août 2026)
- L'utilisateur a fourni au fil de l'eau les 9 photos (Wikimedia Commons) dans `images/Stades/` (dossier créé avec majuscule — **piège Windows/Linux** : insensible à la casse en local mais pas sur le serveur Linux, corrigé en standardisant tout en minuscules `images/stades/`).
- Chaque photo redimensionnée/compressée en JPEG qualité ~78 (100-300 Ko, convention du site) et créditée sous l'image selon sa licence exacte : Arne Müseler (CC BY-SA 3.0 DE) pour Wembley/Tottenham/Etihad/Everton/St James' Park/Villa Park, Dan Kearney recadrée par Blackcat (CC BY-SA 3.0) pour Hampden Park, Dominic Nelson (CC BY-SA 4.0) pour Principality Stadium, tarafuku10 (domaine public) pour Aviva Stadium.
- Ancres `id` ajoutées sur chaque `<h3>` de stade (`scroll-mt-24` pour ne pas passer sous le header sticky) pour permettre un lien direct depuis d'autres pages.
- Sur `euro-2028.php`, la grille "Les 9 stades retenus" affiche désormais une vignette photo par stade et chaque carte devient un lien direct vers l'ancre du stade correspondant sur `euro-2028-les-9-stades.php`.
- **Carte illustrée des 9 stades** (fournie par l'utilisateur, PNG 2 Mo compressé en JPEG 259 Ko) ajoutée en tête de `euro-2028-les-9-stades.php`.
- **Découverte technique** : `System.Drawing` (GDI+) ne sait pas décoder le WebP (erreur "Mémoire insuffisante" systématique), mais `PresentationCore`/WPF (`BitmapDecoder`, moteur WIC de Windows) le sait sur cette machine — utile pour convertir un WebP en PNG avant de l'incruster dans une image composée via System.Drawing, sans dépendance externe (ImageMagick/Python toujours absents).

### 3.46 Coupe du Monde 2030 : hub multi-éditions + page détaillée + 2 pages piliers (22 août 2026)
- Même structure que l'Euro, mais construite entièrement par recherche web (l'utilisateur n'a fourni aucun contenu rédigé cette fois, contrairement à l'Euro 2028) : `coupe-du-monde.php` (hub évergreen multi-éditions, une seule entrée pour l'instant), `coupe-du-monde-2030.php` (page détaillée), `coupe-du-monde-2030-les-stades.php`, `coupe-du-monde-2030-les-villes-hotes.php`.
- **Vérification renforcée** car l'édition 2030 est beaucoup plus mouvante que l'Euro 2028 à 4 ans de l'échéance : format 48 équipes maintenu à ce jour malgré une proposition d'extension à 64 rejetée par les hôtes (les deux versions mentionnées avec la bonne nuance) ; 23 stades annoncés (11 Espagne, 6 Maroc, 3 Portugal, 3 Amérique du Sud) mais Malaga s'est retirée du projet en juillet 2025 sans remplaçant confirmé — mentionné explicitement plutôt que tu silencieusement ; demi-finale Estádio da Luz (Lisbonne) confirmée, lieu de la finale explicitement signalé comme non confirmé à ce jour (pas inventé).
- Tous les liens sitewide qui pointaient vers `/blog?cat=CDM` (footer, `euro.php`/`euro-2028.php`, `equipe-france.php`, `404.php`, `index.php` \$hubs) repointés vers le nouveau hub `/coupe-du-monde.php`.

### 3.47 Correctif affichage des matchs LIVE + regroupement par compétition sur calendrier.php (22 août 2026)
- **Bug signalé par l'utilisateur** : un match Lens-Auxerre en direct n'affichait pas son score sur `ligue-1.php`. Cause : le filtre "prochains matchs" ne testait que `!== 'FINISHED'`, donc un match `LIVE` y tombait sans jamais afficher de score (le gabarit "à venir" n'a pas de colonne score). Corrigé sur les 5 pages concernées (`calendrier.php`, `ligue-1.php`, `ligue-2.php`, `champions-league.php`, `europa-league.php`) : nouvelle section "🔴 En direct" dédiée (badge rouge animé + score), et le bucket "à venir" exclut désormais explicitement `LIVE` en plus de `FINISHED`.
- **Deuxième retour utilisateur** : sur `calendrier.php`, le badge de compétition (texte gris à droite) n'était pas assez visible pour distinguer L1/L2/CL au premier coup d'œil. D'abord remplacé par un badge/pill plus contrasté (fond sombre, bordure, texte blanc gras), puis — sur suggestion de l'utilisateur — **entièrement restructuré en sous-groupes par compétition** : chaque section (En direct, Prochains matchs, Derniers résultats) affiche désormais un sous-titre par compétition (logo + nom, ordre fixe L1 → L2 → CL → Europa → Conférence → France) via une fonction `grouper_par_competition()` réutilisée sur les 3 sections, plutôt qu'un badge par ligne sur une liste mélangée.

### 3.48 Google AdSense — ads.txt et meta tag (22 août 2026)
- L'utilisateur a signalé un statut "Non autorisé"/"Introuvable" pour `ads.txt` dans la console AdSense. Fichier `ads.txt` créé à la racine avec la ligne standard (`google.com, pub-1397315006076063, DIRECT, f08c47fec0942fa0`).
- Meta tag `<meta name="google-adsense-account" content="ca-pub-1397315006076063">` ajouté dans `templates/header.php` (complément au script de vérification déjà en place depuis la section 3.39).

### 3.49 Article L2 — Nantes 2-5 Rodez, correction factuelle importante (22 août 2026)
- Le brief fourni par l'utilisateur attribuait un doublé de Killian Corredor à Rodez, alors qu'il joue à **Nantes** — c'est justement ce doublé (4e, 24e) qui a donné aux Canaris une avance 2-1 à la pause, avant l'effondrement en seconde période (triplé de Baldé, buts de Ponti et Joly côté Rodez). Corrigé après vérification du compte-rendu minute par minute sur fcnantes.com, recoupé avec eurosport.fr et ici.fr — la citation du coach Michel Der Zakarian ("j'ai honte, surtout de la deuxième mi-temps") est authentique et sourcée.
- Logo FC Nantes fourni par l'utilisateur sous l'extension `.svg` alors qu'il s'agissait en réalité d'un fichier WebP mal renommé (détecté via l'en-tête binaire `RIFF...WEBP`) — corrigé, converti en PNG via WPF/WIC (voir découverte technique en 3.45) puis retouché par l'utilisateur pour retirer un fond noir parasite et obtenir un vrai fond transparent ; vignette de l'article régénérée en conséquence.
- Score du match mis à jour dans `matchs.json` (id 9000084, `SCHEDULED` → `FINISHED` 2-5) — l'entrée existait déjà comme placeholder programmé, seule la mise à jour de statut était nécessaire, pas de création d'entrée.
- Reel Facebook fourni par l'utilisateur intégré en iframe dans l'article.

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

### 3.50 Audit SEO des sous-pages Euro 2028 (stades + villes hôtes) — 23 août 2026

Suite à la demande de vérification du référencement des pages `euro-2028-les-9-stades.php` et `euro-2028-les-8-villes-hotes.php` :

**Ce qui est correct sur les deux pages** :
- `page_title`/`meta_desc` uniques et distincts de `euro-2028.php` (pas de duplicate title/desc).
- Un seul `<h1>` par page, distinct.
- Schema `FAQPage` présent sur les deux.
- Les deux pages sont référencées dans `sitemap.php`.
- Maillage interne bidirectionnel complet : `euro-2028.php` ↔ chaque sous-page ↔ l'autre sous-page (breadcrumb + boutons "Retour" + liens contextuels).

**Lacune découverte — site-wide, pas spécifique à ces deux pages** : `templates/header.php` ne génère **aucune balise `<link rel="canonical">`, aucune balise Open Graph (`og:title`, `og:description`, `og:image`, `og:url`, `og:type`), aucune Twitter Card, et aucun schema `BreadcrumbList`** — sur aucune page du site (vérifié par grep sur l'ensemble du repo, 0 occurrence).

**Pourquoi c'est important** :
- **Canonical absent** : risque de contenu dupliqué non arbitré par Google, notamment si `euro-2028-les-9-stades.php`/`euro-2028-les-8-villes-hotes.php` chevauchent en partie le contenu de `euro-2028.php` (stades, villes) — pas critique à ce stade (peu de pages, contenu suffisamment différencié), mais deviendra un vrai risque quand le site grossira.
- **Open Graph absent** : tout partage d'un lien football-passion.fr sur Facebook/Twitter (ex. les posts FB de match) affiche un aperçu générique sans image/titre/description personnalisés — impact direct sur le CTR social, alors que le site produit justement des posts FB régulièrement.
- **BreadcrumbList absent** : prive Google d'un signal structuré supplémentaire pour l'affichage du fil d'Ariane dans les résultats de recherche (le breadcrumb visuel existe déjà sur les pages, juste pas en JSON-LD).

### 3.51 Correctif SEO site-wide : canonical, Open Graph, Twitter Card — 23 août 2026

Suite au constat de la section 3.50, correction appliquée dans `templates/header.php` (donc sur toutes les pages du site) :
- `<link rel="canonical">` calculé automatiquement depuis `$_SERVER['REQUEST_URI']` (sans query string), overridable via une variable optionnelle `$canonical_url` si une page en a besoin.
- Balises Open Graph complètes (`og:type`, `og:site_name`, `og:locale`, `og:url`, `og:title`, `og:description`, `og:image`) avec fallback sur `logo-fp-icon-512.png` si la page ne fournit pas `$og_image`.
- Twitter Card (`summary_large_image`) alignée sur les mêmes valeurs.
- `blog/index.php` (vue article individuel) câble automatiquement `$og_image` sur la vignette de l'article (déjà au format 1200x630/16:9) et `$og_type = 'article'`.
- `euro-2028.php`, `euro-2028-les-9-stades.php`, `euro-2028-les-8-villes-hotes.php` reçoivent chacune une `$og_image` dédiée (photo Wembley / carte des stades).

**BreadcrumbList non traité** : contrairement au canonical/OG (génériques via header.php), un schema `BreadcrumbList` correct nécessite de connaître la hiérarchie de chaque page individuellement — pas automatisable depuis le header commun. Reste un chantier séparé, page par page, si jugé prioritaire.

D'autres pages du site (ligue-1.php, calendrier.php, etc.) utilisent encore l'image de fallback générique — leur donner une `$og_image` dédiée est une amélioration incrémentale possible plus tard, pas un blocage.

### 3.52 Sitemap confirmé opérationnel dans Google Search Console — 23 août 2026

Vérification dans GSC (Sitemaps envoyés) : `https://football-passion.fr/sitemap.xml` (soumis le 21 août 2026) affiche le statut **« Opération effectuée »**, dernière lecture le 23 août 2026, **42 pages découvertes**, 0 vidéo. Confirme que le sitemap est bien lu et exploité par Google — aucune action requise, simple point de suivi.

### 3.53 Correctif convertisseur gras Unicode pour posts Facebook (accents) — 23 août 2026

Les posts FB générés pour ce site (texte prêt à coller, jamais publié directement) utilisent un script PowerShell qui convertit `**texte**`/`# titre` en gras Unicode réel (police "Mathematical Bold", ex. 𝐀𝐁𝐂), car Facebook n'interprète pas le Markdown.

**Bug découvert** : la plage Unicode "Mathematical Bold" ne couvre que A-Z/a-z/0-9 ASCII — un caractère accentué (`É`, `à`, `ê`...) présent dans un segment en gras (ex. "BOUDÉ") n'était pas converti et restait affiché en police normale, cassant visuellement l'uniformité du gras au milieu du mot.

**Correction** : le script mappe désormais chaque lettre accentuée courante du français vers sa lettre de base en gras Unicode + un caractère combinant Unicode pour l'accent (ex. `É` → lettre `E` en gras U+1D404 + accent aigu combinant U+0301), ce qui restitue visuellement l'accent par-dessus la lettre en gras. Couvre à/â/ä, ç, è/é/ê/ë, î/ï, ô/ö, ù/û/ü (majuscules et minuscules).

**Autre ajustement de style** : sur demande explicite, le titre d'accroche d'un post FB ne doit **pas** être entièrement en majuscules/gras — seul le nom des clubs/équipes (ex. "PSG - RENNES") reste en gras capitales, le reste de la phrase d'accroche est en gras minuscules normal (casse de phrase). Convention à réutiliser pour les prochains posts.

### 3.54 Playlists Facebook (Meta Business Suite) — 23 août 2026

Création des premières playlists sur la page Facebook Football Passion, pour regrouper les reels par thème (recommandation faite par Meta lui-même, structure proposée : Ligue 1, Ligue 2, Champions/Europa League, Équipe de France, Route vers l'Euro 2028, Prochains matchs de la semaine).

**Astuce d'usage découverte** : dans Meta Business Suite (Contenu → Publications et reels), pour associer un reel déjà publié à une playlist existante après coup, l'option n'est pas dans le menu "..." de la ligne du reel — il faut cliquer sur le **lien hypertexte affiché sous la vignette/image** du reel dans la liste. C'est ce lien qui ouvre l'option de rattachement à une playlist.

Couvertures des playlists : logos de compétition déjà disponibles dans `images/logo/` (`logo-ligue-1.webp`, `logo-ligue-2.png`, `logo-champions-league.webp`, `logo-europa-league.webp`) — pas de logo FFF ni Euro 2028 en local à ce jour, à créer si besoin.

### 3.55 Exception éditoriale assumée : soutien à Bordeaux dans son dossier DNCG — 24 août 2026

Article publié sur la relégation administrative des Girondins de Bordeaux (`bordeaux-tribunal-administratif-relegation-2026`), suite à la décision du tribunal administratif de Paris confirmant leur exclusion de tous les championnats nationaux.

**Position éditoriale explicite, demandée par l'utilisateur** : contrairement à la ligne éditoriale générale du site (neutralité entre clubs, "que le meilleur gagne" — voir mémoire `project_cdm_strategie`), Football Passion prend position en faveur de Bordeaux sur ce dossier précis. Justification assumée dans l'article : le palmarès historique du club (6 titres de champion de France, 4 Coupes de France, 3 Coupes de la Ligue, une finale de Coupe UEFA 1996 — faits vérifiés) et l'injustice perçue d'une exclusion actée sur un point de calendrier procédural plutôt que sur le fond du dossier financier.

**Catégorie** : classé en `France` (et non `L2`), le club étant désormais exclu de tous les championnats nationaux, donc plus rattachable à une compétition suivie par le site.

**Portée de l'exception** : ceci ne change pas la ligne éditoriale générale du site (toujours neutre entre clubs pour le contenu sportif courant) — c'est une prise de position spécifique au dossier existentiel de Bordeaux, à reconduire uniquement pour les prochains articles sur ce sujet précis, pas à généraliser à d'autres clubs sans nouvelle demande explicite.

### 3.56 Recherche E-E-A-T et corrections — 26 août 2026

Recherche approfondie sur les critères Google E-E-A-T (Experience, Expertise, Authoritativeness, Trustworthiness), en particulier la mise à jour de mars 2026 qui renforce le poids du signal "Experience" (contenu avec point de vue vérifiable > compilation impersonnelle).

**Corrections techniques appliquées** :
- Byline auteur sur les articles de blog : le nom "Jérôme Henry" était affiché en texte brut, sans lien — désormais un lien vers `/a-propos.php` (page déjà bien pourvue en schema.org `Person`).
- Ajout du schema `NewsArticle` (headline, description, image, auteur, éditeur, dates) sur `blog/index.php`, absent jusque-là — lacune technique importante pour l'association contenu ↔ auteur identifiable aux yeux de Google. Sécurisé avec `JSON_HEX_TAG` pour éviter tout risque d'injection si un titre contenait `</script>`.
- Support du champ optionnel `date_maj` (voir `CLAUDE.md`) : affiché sur la page article (« mis à jour le... ») quand présent, et utilisé comme `dateModified` du schema (sinon la date de publication sert de repli). À ajouter uniquement lors d'une vraie correction a posteriori (ex. score corrigé), jamais systématiquement à la création.

**Convention éditoriale durable ajoutée dans `CLAUDE.md`** : chaque article de fond doit inclure un avis personnel assumé (formules variées : "à notre sens", "mon avis"...), dans le respect de la ligne éditoriale du site (fair play, beau jeu, jugement assumé sur les choix tactiques des entraîneurs, soutien aux clubs français en coupes d'Europe, neutralité stricte entre clubs français). Documenté en détail dans `CLAUDE.md` section "Avis éditorial assumé".

**Mentions légales et politique de confidentialité déjà mises à jour la veille** (SIRET/RCS/TVA Dixie Consulting SASU, divulgation Google AdSense) — voir sections précédentes de ce journal, non répétées ici.

### 3.57 Prototype de génération d'images titre + phrase choc (n8n/Pillow) — 30 août 2026

Démarrage de l'automatisation de la création d'images (branche "Pillow" du futur workflow n8n). Principe validé avec l'utilisateur : Claude Code recherche des faits vérifiés à partir d'un prompt court (ex. "Saint-Étienne en route vers la 4e victoire ?"), produit un **Titre** + une **Phrase choc**, ensuite superposés sur un template graphique.

Deux templates Canva fournis par l'utilisateur dans `images/charte-graphique/` : `model_l2_FB.png` (941×1672, portrait, pour Facebook/Reel) et `model_l2_vignette_site.webp` (1731×909, paysage, pour la vignette d'article).

Exemple travaillé : Saint-Étienne, 3 victoires sur 3 sous Ian Cathro (nouveau coach depuis le 8 juin 2026), prochain match à Dijon le 31 août 2026 — faits vérifiés par recherche web avant rédaction (règle anti-hallucination).

Prototype de positionnement du texte réalisé en PowerShell/System.Drawing (`preview-l2-templates.ps1`, script de session, non versionné) pour valider tailles de police et zones de texte avant d'écrire le vrai code de production. Un bug de troncature du titre (police trop grande / zone trop étroite) corrigé par réduction de la taille de police (40pt → 34pt sur le template portrait).

### 3.58 Endpoint `generate-image.php` (GD) — décision d'architecture n8n — 30 août 2026

**Constat** : l'instance n8n de l'utilisateur (`n8n.srv814711.hstgr.cloud`) est une offre managée Hostinger, pas un VPS avec accès SSH — le node "Execute Command" n'y est pas disponible (comme sur n8n Cloud), et le node "Code" en Python tourne en Pyodide (bac à sable WebAssembly, sans accès disque ni `pip install`), donc inutilisable pour du traitement d'image avec Pillow.

**Décision** : plutôt que Python+Pillow, le traitement d'image se fait en **PHP + GD**, directement sur l'hébergement Hostinger de football-passion.fr (cohérent avec le stack existant, pas de nouveau service à héberger). Création de `generate-image.php` à la racine : endpoint HTTP POST (JSON `{secret, template, titre1, titre2, phrase, output}`), protégé par une clé secrète (`GENERATE_IMAGE_SECRET` dans `config/secrets.php`), qui charge un template (`images/charte-graphique/`), dessine le texte avec retour à la ligne automatique (`imagettftext` + calcul de largeur via `imagettfbbox`), et enregistre le résultat en JPEG dans `images/`. Logique de positionnement (portrait vs paysage) reprise du prototype PowerShell de la section 3.57.

**Police retenue : Montserrat** (Bold + SemiBold, licence SIL Open Font License, gratuite) — cohérente avec l'esprit géométrique/condensé du logo FP. Fichiers `.ttf` récupérés depuis le dépôt officiel du projet Montserrat (`github.com/JulietaUla/Montserrat`, versions à poids fixes — la version distribuée par Google Fonts est désormais une police variable, non exploitable telle quelle par `imagettftext`) et ajoutés dans `fonts/` à la racine du dépôt.

**Diagnostic GD réalisé en production** (script temporaire `gd-check.php`, supprimé après usage) : PHP 8.3.30, GD 2.3.3 avec support complet FreeType, WebP (lecture/écriture), PNG, JPEG — aucune limitation côté serveur.

**Blocage restant** : `config/secrets.php` n'est jamais déployé automatiquement (fichier gitignoré, dépôt public — voir règle critique en tête de `CLAUDE.md`). La constante `GENERATE_IMAGE_SECRET` doit être ajoutée manuellement au fichier existant sur Hostinger. Upload bloqué le 30 août 2026 par un problème d'accès au gestionnaire de fichiers côté utilisateur — noté dans `todolist.md`, à reprendre dès que l'accès est rétabli.

### 3.59 Article : Ligue 1 journée 2, tous les résultats (Monaco-OM en attente) — 30 août 2026

Article de récapitulatif complet de la 2e journée de Ligue 1 2026-2027 (id 28, `ligue-1-journee-2-resultats-2026-2027`), les 8 rencontres jouées vérifiées contre `data/matchs.json` avant rédaction (Lille 2-2 PSG, Strasbourg 2-1 Lens, Auxerre 1-3 Angers, Brest 2-2 Toulouse, Lyon 1-1 Le Havre, Lorient 1-2 Troyes, Paris FC 3-0 Nice, Rennes 3-2 Le Mans), tableau HTML récapitulatif inclus, lien interne vers l'article dédié Lille-PSG (id 26) pour éviter la duplication de contenu détaillé. Monaco-OM signalé comme non encore joué, réservé pour un article séparé.

Vignette fournie par l'utilisateur (`l1 j2 sans om.webp`, 1731×909) redimensionnée à 1200×630 (largeur max de la charte) et réencodée en JPEG qualité 82 (158,6 Ko) — pas d'encodeur WebP local disponible (limitation connue, voir sections précédentes).

**Incident et correction** : la première tentative d'ajout de l'entrée dans `articles-index.json` via un script PowerShell contenant le texte accentué en dur a produit un mojibake réel (`journÃ©e` au lieu de `journée`) — repéré par la vérification systématique `grep -c "Ã"`, fichier restauré via `git checkout` avant tout commit. Corrigé en écrivant l'entrée dans un fichier JSON séparé via l'outil Write (règle déjà documentée dans `CLAUDE.md`, réappliquée ici après un oubli ponctuel).

### 3.60 Enrichissement SEO du tableau de résultats (contexte compétition/journée/saison) — 30 août 2026

Retour utilisateur sur l'article J2 (section 3.59) : le tableau de résultats manquait de repères de contexte (numéro de journée, saison, compétition) — problématique pour le référencement, un tableau isolé de scores étant ambigu pour Google sans ces informations.

**Corrections appliquées sur l'article** : ajout d'une balise `<caption>` dans le tableau (« Résultats de la Ligue 1, journée 2, saison 2026-2027 »), ajout d'une colonne `Date` par rencontre, et ajout d'une phrase d'intro juste avant le tableau répétant le contexte en texte brut (« Championnat de France de Ligue 1 (L1), saison 2026-2027, journée 2 sur 34 »).

**Convention durable ajoutée dans `CLAUDE.md`** (section anti-footprint) : tout tableau de résultats/calendrier doit désormais systématiquement inclure ces trois repères (caption + colonne date + phrase de contexte), pas seulement pour cet article.

### 3.61 Monaco 2-0 OM confirmé, article dédié et correction factuelle des prénoms — 30 août 2026

Le match Monaco-OM (dernière affiche de la journée 2, en direct au moment de la section 3.60) s'est terminé sur un score de 2-0. Mise à jour de `matchs.json` (statut `FINISHED`) et de l'article J2 (section 3.59) : tableau, titre, extrait et meta corrigés, `date_maj` ajouté (correction a posteriori d'un contenu déjà publié — voir convention `date_maj` dans `CLAUDE.md`).

**Nouvel article dédié** (id 29, `monaco-om-2-0-brunner-journee-2-2026-2027`) rédigé à partir d'un live-blog complet fourni par l'utilisateur (source : 20 Minutes, journaliste Nicolas Camus) — reformulé intégralement dans le style éditorial du site, jamais copié tel quel (règle anti-plagiat). Doublé de Paris Brunner (13e, 54e), Monaco prend seul la tête du classement (6 pts) devant Paris FC et Lille, l'OM retombe 8e (3 pts).

**Incident anti-hallucination évité** : le live-blog source ne donne que des noms de famille pour la plupart des joueurs (« Brunner », « De Lange », « Egan-Riley »...). Une première version de l'article inventait des prénoms plausibles mais non vérifiés (« Paul Brunner », coach monégasque « Adi Hütter », « Amir Abdallah », « Georges Kondogbia »...) — repéré avant publication, corrigé par recherche web ciblée (confirmation : le joueur est bien **Paris Brunner**, attaquant allemand né en 2006, ex-Dortmund ; l'entraîneur de l'AS Monaco est **Filipe Luis**, celui de l'OM **Bruno Genesio**, déjà correct). Pour tous les autres joueurs dont le prénom n'a pas été vérifié, le nom de famille seul a été conservé plutôt que d'inventer un prénom — convention à réappliquer systématiquement pour tout article basé sur un live-blog ou une transcription qui ne donne que des noms de famille.

Lien interne ajouté depuis l'article J2 (section 3.59) vers ce nouvel article, sur le modèle déjà utilisé pour Lille-PSG (section 3.59) — éviter la duplication de contenu détaillé entre l'article de synthèse et l'article de match dédié.

### 3.62 Statistiques Facebook — bilan à 28 jours (3-30 août 2026) — 31 août 2026

Premier point de suivi chiffré de la page Facebook depuis la reprise de la Ligue 1.

**Vue d'ensemble de la page (28 derniers jours, 3-30 août 2026)** :
- Vues totales : 109 557 (+2377 % vs période précédente)
- Vues de 3 secondes : 49 338 (+3525 %)
- Vues de 1 minute : 0 (normal, pas encore de format vidéo long — reels/voix off pas encore lancés)
- Followers : 368 au total (+57,1 %), dont 129 followers nets sur la période, 2 anciens followers perdus
- Croissance des vues nettement accélérée à partir du 18 août 2026, coïncidant avec la reprise de la Ligue 1 (journée 1) et la montée en cadence de publication (tirages CL/Europa, comptes rendus de match, articles dédiés)

**Meilleur post de la période : « Ligue 1 – Journée 2 : une deuxième journée riche en buts ! »** (le post-carrousel de résultats, voir article id 28 en section 3.59) :
- 51 142 vues, dont 99,8 % auprès de non-followers (54 followers actifs seulement) → forte portée organique/algorithmique, largement au-delà de l'audience actuelle de la page
- 46 632 spectateur(ice)s, 236 interactions (202 likes, 4 ❤️, 1 😆)
- Durée de visionnage moyenne : 9 secondes, avec un décrochage marqué dès la 4e seconde

**Enseignement retenu** : les posts factuels de résultats (récaps de journée, comptes rendus de match comme Lille-PSG ou Monaco-OM) semblent être le principal moteur de croissance actuel de la page, davantage que la portée naturelle liée aux abonnés existants. Point d'amélioration identifié : soigner l'accroche des 3 premières secondes des reels/vidéos pour limiter le décrochage précoce.

---

*Dernière mise à jour : 31 août 2026*
