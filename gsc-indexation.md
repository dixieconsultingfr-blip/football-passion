# GSC — Indexation des pages (football-passion.fr)

Catégorie : **Google Search Console › Indexation › Pages**.
Ce fichier garde une trace des relevés d'indexation (les captures GSC ne sont pas versionnées), des causes identifiées et des actions menées. À compléter à chaque relevé (**tous les 15 jours**, voir `todolist.md`).

> Les relevés GSC portent la mention « Dernière mise à jour : 23/10/2026 » (GSC a quelques jours de décalage). Le relevé ci-dessous est consigné à la date du **1er novembre 2026**.

---

## Relevé du 1er novembre 2026 — pages non indexées

| Motif GSC | Pages | Première détection | Verdict |
|---|---:|---|---|
| Page avec redirection | **94** | 22/08/2026 | Normal (301 http→https, www→non-www, `/blog`→`/blog/`, anciens `?slug=`). Liens internes corrigés le 1er nov. |
| Autre page avec balise canonique correcte | **62** | 05/09/2026 | Normal : variantes à paramètres (`?cat=`, `?page=`, `?comp=`, `?sujet=`) dont la canonique est la page sans paramètre. Rien à faire. |
| Détectée, actuellement non indexée | **25** | 05/09/2026 | À surveiller : 13 pages groupes Ligue des Nations (B à N), 3 droits TV, 2 CDM 2030, `euro-2028-qualifications.php`, archives L3 et quelques articles récents. Maillage renforcé le 1er nov. |
| Introuvable (404) | **9** | 05/09/2026 | URLs d'articles tronquées + `/joueur.php` sans paramètre. 5 redirigées en 301 le 1er nov., les autres restent 404 (normal). |
| Explorée, actuellement non indexée | **4** | 22/08/2026 | `/blog/?page=4` (x2, normal) + `comment-regarder-euro-2028.php` + `euro-2028-les-9-stades.php` (à surveiller). |
| Bloquée en raison d'un autre problème de type 4xx | **1** | 05/09/2026 | `/newsletter-subscribe.php` (endpoint de formulaire, 405 en GET). Bloqué dans `robots.txt` le 1er nov. |
| **Total pages non indexées** | **195** | | Dont ~156 sans enjeu (redirections + canoniques) |

**Pages réellement à surveiller : 29** (25 « détectée non indexée » + 4 « explorée non indexée »), dont 2 pages Euro 2028 et 13 pages groupes LDN temporaires.

---

## Causes et décisions

### Page avec redirection (94)
- Origine : le site pointait lui-même vers des URLs qui redirigent (`/blog`, `/blog?cat=…`, `/blog?page=…`), et le sitemap listait `/blog` (sans barre finale).
- Actions du 1er novembre 2026 :
  - Liens internes passés en URL finale (`/blog/`, `/blog/?cat=…`, `/blog/?page=…`) sur 23 fichiers PHP (header, footer, accueil, pages de compétitions).
  - Sitemap : `/blog` → `/blog/`.
  - `.htaccess` : les anciennes URLs `/blog/?slug=mon-slug` (et `/blog?slug=…`) font un 301 direct vers `/blog/mon-slug`.
- Attendu : le compteur baisse progressivement (réexploration sur plusieurs semaines). Les URLs `http://` et `www.` resteront dans la liste (redirections légitimes).

### Autre page avec balise canonique correcte (62)
- La canonique du header retire la query string : `/blog/?cat=L2` → `/blog/`, `/calendrier.php?comp=L1` → `/calendrier.php`, `/archives.php?comp=…&saison=…` → `/archives.php`, `/contact.php?sujet=…` → `/contact.php`.
- Décision : ne rien changer. Ne pas donner de canonique propre aux catégories du blog (concurrence avec `ligue-1.php`, `champions-league.php`…).
- Option non retenue : canonique auto-référente pour `?page=N`.

### Introuvable (404) (9)
- URLs tronquées (liens coupés sur réseaux sociaux) : `/blog/tirage-ligue-`, `/blog/tirage-`, `/blog/tirage-ligue`, `/blog/nantes-rodez`, `/blog/nantes-`, `/blog/rennes-psg-`, `/blog/psg-rennes`, `/blog/qui-sera-`, `/joueur.php`.
- Action du 1er novembre : `blog/index.php` redirige en 301 si le début du slug (≥ 8 caractères) ne correspond qu'à un seul article publié. Résultat : `tirage-ligue`, `tirage-ligue-`, `nantes-rodez`, `rennes-psg-` → 301 ; `tirage-`, `nantes-`, `psg-rennes`, `joueur.php` restent 404 (ambiguës ou sans objet).
- À décider : `/blog/qui-sera-` renvoie à un brouillon non publié (`qui-sera-meilleur-congolais-ligue-1-2026-2027.json`, non indexé, non commité). Publier ou non.

### Détectée, actuellement non indexée (25)
- Google connaît l'URL mais ne l'a pas encore explorée (faible priorité perçue, site récent).
- Pages groupes LDN B à N : template unique, 1 seul lien entrant (le hub). Action du 1er novembre : bloc « Les autres groupes de la Ligue des Nations » ajouté dans `templates/ligue-des-nations-groupe-template.php` (14 liens entre groupes). Pages temporaires (phase de ligue jusqu'au 17 novembre 2026), à archiver après juin 2027.
- Pistes : demander l'indexation dans GSC pour les pages utiles (10 par jour max), laisser les articles récents s'indexer seuls.

### Explorée, actuellement non indexée (4)
- `/blog/?page=4` : pagination, canonique `/blog/`, normal.
- `comment-regarder-euro-2028.php` (~1 180 mots) et `euro-2028-les-9-stades.php` (~1 860 mots) : jugées secondaires par rapport à `euro-2028.php`. Action du 1er novembre : liens ajoutés depuis les articles Euro (`qualifications-euro-2028-mode-emploi-barrages-pays-hotes`, `euro-2028-route-des-bleus-dates-format-qualifications`). Piste suivante si rien ne bouge : enrichir ces pages avec du contenu plus original.

### Bloquée 4xx (1)
- `/newsletter-subscribe.php` est appelé en POST par le footer ; GET → 405. `robots.txt` : `Disallow: /newsletter-subscribe.php` et `Disallow: /contact-send.php` (1er novembre 2026).

---

## Checklist de suivi (tous les 15 jours)

À chaque relevé : GSC › Indexation › Pages › « Pourquoi des pages ne sont-elles pas indexées ? ». Noter la date, les chiffres, comparer au relevé précédent.

- [ ] **Page avec redirection** : le nombre baisse-t-il (cible : < 60 après un mois) ?
- [ ] **Détectée, actuellement non indexée** : les pages groupes LDN et droits TV passent-elles en « Indexée » ?
- [ ] **Explorée, actuellement non indexée** : le chiffre reste-t-il à 4 ? Pages Euro 2028 indexées ?
- [ ] **Introuvable (404)** : nouvelles URLs tronquées ? Redirections de préfixe OK ?
- [ ] **Bloquée 4xx** : `/newsletter-subscribe.php` disparu ?
- [ ] Nouveaux motifs apparus (ex. « Soft 404 », « Duplicate sans canonique choisie par l'utilisateur ») ?
- [ ] Nombre de pages **indexées** (rapport « Pages ») et de **pages dans le sitemap** (134 URLs au 1er novembre 2026).

## Historique des relevés

| Date | Redirection | Canonique | Détectée non indexée | 404 | Explorée non indexée | Bloquée 4xx | Total |
|---|---:|---:|---:|---:|---:|---:|---:|
| **2026-11-01** | 94 | 62 | 25 | 9 | 4 | 1 | **195** |
| 2026-11-15 | | | | | | | |
| 2026-11-30 | | | | | | | |
