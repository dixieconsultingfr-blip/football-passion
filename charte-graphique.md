# Charte graphique — Football Passion

Site web (football-passion.fr) + réseaux sociaux (Facebook, Instagram).

---

## 1. Positionnement

Hub evergreen football grand public : L1, L2, Champions League, Europa League, Équipe de France, Euro, Coupe du Monde, CAN.

**Ton éditorial** : passion + fair-play + neutralité entre clubs — *"que le meilleur gagne, prône le beau jeu"*. Pas d'angle partisan (ex. pas d'angle OM affiché, trop clivant). Avis éditoriaux mesurés ("à notre sens...") plutôt que des titres putaclic.

**Anti-hallucination** : jamais de fait inventé (score, compo, statistique, citation) — seulement des données fournies ou vérifiées. Voir `CLAUDE.md` pour le détail complet des règles de contenu.

---

## 2. Palette couleurs

Thème sombre, un seul accent. Valeurs exactes utilisées dans le code (classes Tailwind) :

| Rôle | Classe Tailwind | Hex approx. | Usage |
|---|---|---|---|
| Fond principal | `bg-gray-950` | `#030712` | Fond de page (`<body>`) |
| Fond secondaire | `bg-gray-900` | `#111827` | Header, footer, panneaux |
| Fond carte | `bg-gray-800` | `#1f2937` | Cartes, blocs de contenu |
| Fond carte alt. | `bg-gray-900/40` | — | Panneaux "fenêtre" (pages compétitions) |
| Bordure | `border-gray-700` / `border-gray-800` | `#374151` / `#1f2937` | Séparateurs, contours de carte |
| **Accent (marque)** | `green-400` à `green-700` | `#4ade80` → `#15803d` | Liens, titres de section, CTA, bordure header/footer |
| Texte principal | `text-gray-100` | `#f3f4f6` | Corps de texte |
| Texte secondaire | `text-gray-400` / `500` / `600` | `#9ca3af` / `#6b7280` / `#4b5563` | Métadonnées, légendes |
| Succès / victoire | `bg-green-900/10` | — | Ligne de classement (top 3 / zone de montée) |
| Alerte / défaite | `bg-red-900/10` | — | Ligne de classement (zone de relégation) |

**Règle** : le vert est le **seul** accent de la marque. Ne pas introduire d'autre couleur vive (pas de bleu, orange, jaune) sauf pour les logos de compétitions tiers (Ligue 1, Champions League...), qui gardent leurs couleurs officielles et sont toujours affichés sur un badge blanc arrondi pour rester lisibles sur fond sombre (`bg-white rounded-full p-1`).

---

## 3. Typographie

**Aucune police custom chargée** — le site utilise la police système par défaut de Tailwind (`font-sans` : -apple-system, Segoe UI, Roboto...). C'est un choix de simplicité/performance (pas de requête externe, pas de flash de police non stylée), à conserver.

Hiérarchie (classes utilisées) :
- Titres de page (`<h1>`) : `text-4xl font-bold text-white` (jusqu'à `text-5xl` sur la page d'accueil)
- Titres de section (`<h2>`) : `text-2xl font-bold text-white` ou `text-xl`/`text-lg` selon densité
- Corps de texte : `text-sm` à `text-base`, `text-gray-300`/`text-gray-200`
- Labels/métadonnées : `text-xs uppercase tracking-wider`, `text-gray-500`

---

## 4. Logo

**État actuel : pas de logo image.** La marque s'affiche uniquement en texte : `⚽ Football Passion` (emoji ballon + wordmark, `text-2xl font-bold text-green-400`), dans le header et en avatar/couverture des réseaux sociaux (actuellement encore l'ancien visuel "Coupe du Monde 2026").

**Recommandé** : créer un logo simple (ballon stylisé + texte, ou monogramme "FP") en `.webp`/`.svg`, décliné en :
- Version horizontale (header du site, signature email)
- Version carrée/icône seule (favicon, avatar réseaux sociaux)
- Fond transparent, lisible sur fond sombre (`#030712`/`#111827`) ET sur fond clair (au cas où)

**⚠️ Favicon manquant** : `templates/header.php` référence `/images/favicon.ico` mais ce fichier n'existe pas dans `images/`. Le site n'affiche donc actuellement aucune icône d'onglet — à corriger dès qu'un visuel de marque est prêt (voir procédure).

---

## 5. Iconographie

Emoji utilisés comme puces visuelles de navigation, cohérents dans tout le site :
- ⚽ Football Passion (marque), Ligue 1
- 📅 Calendrier
- 🗂️ Archives
- 📰 Blog / articles
- 📘 Facebook · 📸 Instagram
- 🏆 Coupe du Monde / trophées
- 🇫🇷 Équipe de France

Pas d'icônes SVG/librairie d'icônes — volontairement simple (emoji natifs, zéro dépendance).

---

## 6. Réseaux sociaux — Facebook

**Page actuelle** : `facebook.com/footballpassionfr` (renommée depuis "Coupe du Monde 2026 INFO", 227 followers conservés — voir `procedure-football-passion.md` section 3.32 pour l'historique complet du renommage).

**Formats d'image à respecter** (recommandations Meta, à jour 2026) :
| Élément | Dimensions | Format |
|---|---|---|
| Photo de couverture | 820 × 312 px (desktop) | `.jpg`/`.png`, < 100 Ko idéalement |
| Photo de profil | 170 × 170 px (affiché ~128×128) | `.png` fond transparent si logo, sinon `.jpg` |
| Image de publication (lien/actu) | 1200 × 630 px (ratio 1.91:1) | `.webp`/`.jpg` — même format que les vignettes d'articles du site |

**Cohérence avec le site** : réutiliser la palette (fond sombre `#030712`/`#111827`, accent vert `#4ade80`/`#22c55e`) sur les visuels de couverture et les images de publication, pour que la Page FB soit immédiatement identifiable comme la même marque que football-passion.fr.

**État actuel — à mettre à jour** (voir section 7) : couverture et photo de profil encore à l'identité "Coupe du Monde 2026" (trophée doré sur fond noir), bio encore "Actu, analyses et pronostics CDM 2026", lien site encore `coupe-du-monde-2026.info`.

---

## 7. Actions restantes (checklist)

- [ ] Créer un logo Football Passion (image, pas juste texte) — voir section 4
- [ ] Ajouter `images/favicon.ico` (et idéalement un `favicon.png` haute résolution)
- [ ] Remplacer photo de couverture Facebook (identité CDM 2026 → Football Passion)
- [ ] Remplacer photo de profil Facebook
- [ ] Mettre à jour la bio Facebook (retirer mention CDM 2026)
- [ ] Mettre à jour le lien site Facebook → `football-passion.fr`
- [ ] Vers le 18 octobre 2026 : finaliser le renommage du nom principal de la Page (verrouillé 60 jours, voir procédure 3.32)
- [ ] Aligner l'identité Instagram (`@cdm2026.info` actuellement — à renommer ou migrer selon la même logique que Facebook)

---

*Document créé le 19 août 2026. À maintenir à jour à mesure que les éléments visuels (logo, favicon) sont produits.*
