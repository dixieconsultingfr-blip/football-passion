# To-do — Football Passion

Suivi des actions en attente. Le détail/historique complet de chaque action reste dans `procedure-football-passion.md` (journal chronologique) — ce fichier est juste la vue "qu'est-ce qu'il reste à faire".

---

## ⏳ En attente (délai externe, rien à faire pour l'instant)

- [ ] **Facebook — renommage du nom principal de la Page** : verrouillé 60 jours suite à un précédent changement. Déblocage prévu **~18 octobre 2026**. Une fois débloqué : finaliser le nom principal "Football Passion" (actuellement affiché via le username `footballpassionfr` + AKA).
- [ ] **Google AdSense — annonces pas encore visibles** : code correctement en place sur `droits-tv-football.php` (vérifié en live le 24 août 2026), mais aucune annonce ne s'affiche encore. Normal dans les 24-48h suivant l'approbation du site — Google met du temps à commencer à diffuser. **À revérifier le 26-27 août 2026** (avoir désactivé tout bloqueur de pub pour le test).

## 🔲 À faire, pas de blocage externe

- [ ] **SEO — vérifier l'impact GSC des correctifs Euro 2028** (title/meta "Coupe d'Europe", FAQ, canonical/OG/Twitter Card ajoutés le 23 août 2026) : relever les nouvelles données GSC vers **mi-septembre 2026** pour voir si la position/CTR progressent sur les requêtes "coupe d'europe 2028", "euro 2028 lieu", "date euro 2028".
- [ ] **SEO — vérifier la fusion des URLs dupliquées d'un même article** dans GSC : au 23 août 2026, l'article `om-aguerd-retour-real-sociedad-mercato` apparaît sous 2 variantes distinctes (`/blog?slug=...` et `/blog/?slug=...`, slash en plus) + mélange `www.`/sans `www.` selon les pages. La balise canonical ajoutée le 23 août (section 3.51) devrait résoudre ça — à recontrôler mi-septembre 2026 en même temps que le point ci-dessus.
- [ ] **SEO — généraliser `$og_image`** aux pages qui utilisent encore l'image de fallback générique (`ligue-1.php`, `ligue-2.php`, `calendrier.php`, `champions-league.php`, `europa-league.php`, `equipe-france.php`, hubs CDM 2030...) : à faire au fil de l'eau, pas un chantier dédié.
- [ ] **SEO — schema BreadcrumbList** (fil d'Ariane structuré) : pas automatisable via `templates/header.php`, nécessite un traitement page par page. Faible priorité (gain marginal, juste l'affichage du fil d'Ariane dans les résultats Google).
- [ ] **Image d'en-tête pour `droits-tv-football.php`** : emplacement en commentaire dans le code (`images/droits-tv-football-2026-2027.webp` à créer puis décommenter).
- [ ] **Aligner l'identité Instagram** (`@cdm2026.info` actuellement) — renommer ou migrer selon la même logique que le renommage Facebook.
- [ ] **Automatisation n8n pour la rédaction d'articles** — base de prompt déjà rédigée dans `instructions-gpt-redaction.md`, workflow n8n restant à construire.
- [ ] **Pages club dédiées** (OM en priorité, cohérent avec la ligne éditoriale) — non commencées.

## 💡 Pistes moyen/long terme (non actées)

- [ ] Panel admin léger
- [ ] Fonctionnalités d'engagement communautaire (sondages...)
- [ ] Liens d'affiliation réels sur les CTA de `droits-tv-football.php` (actuellement `href="#"`) — penser à ajouter `rel="sponsored noopener noreferrer"` au moment de les activer.

---

*Mis à jour à chaque changement de statut — voir `procedure-football-passion.md` pour l'historique détaillé de chaque point.*
