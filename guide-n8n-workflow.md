# Workflow n8n "Football Passion — Récupération matchs"

✅ **Statut : construit, testé de bout en bout, et publié (actif) le 4 août 2026.**

Ce document décrit le workflow **tel qu'il existe réellement** dans n8n (`https://n8n.srv814711.hstgr.cloud`), pas un plan théorique — il a été construit et exécuté avec succès en conditions réelles (commit GitHub réel + déploiement Hostinger vérifié).

---

## 0. Credentials utilisés

- **football-data.org** : credential Header Auth existant `Header Auth account` (le même que celui utilisé par CDM 2026 — un seul compte football-data.org pour tous les projets, limite 10 req/min **globale**).
- **GitHub** : credential `GitHub account` existant (même PAT que CDM 2026, scope `repo` couvre tous les repos du compte `dixieconsultingfr-blip`, y compris `football-passion`).

Aucun nouveau credential n'a été nécessaire.

---

## 1. Architecture réelle du workflow

```
Schedule Trigger (5 min)
  ├─→ Fetch L1  (HTTP GET, competitions/FL1/matches)
  └─→ Fetch CL  (HTTP GET, competitions/CL/matches)
                    │
                    ▼ (Fetch CL → )
          Transformer les matchs (Code)
                    │
                    ▼
          GitHub - Get matchs.json (GitHub Get file, branche deploy)
                    │
                    ▼
          Comparer hasUpdate (Code)
                    │
                    ▼
          Si mise à jour (IF hasUpdate === true)
                    │ (branche true uniquement)
                    ▼
          GitHub - Edit matchs.json (GitHub Edit file, branche deploy)
```

**Différences importantes avec le plan initial (voir section 3) :**
- **Pas de node `Merge`** : dans n8n, un Code node peut référencer n'importe quel node déjà exécuté dans le run via `$('Nom du node').all()`, même s'il n'est pas connecté directement en entrée. On chaîne donc les nodes linéairement (comme le fait CDM 2026) au lieu d'utiliser des Merge explicites — plus simple, moins de nodes.
- **Seulement 2 compétitions** : Ligue 1 (`FL1`) et Champions League (`CL`). **Ligue 2 (`FL2`) et Europa League (`EL`) ont été retirées** — voir section 3.

---

## 2. Détail des nodes

### Schedule Trigger
- Interval : **Minutes**, toutes les **5 minutes**

### Fetch L1 / Fetch CL (HTTP Request)
- Method : `GET`
- URL : `https://api.football-data.org/v4/competitions/FL1/matches` (resp. `CL`)
- Authentication : Generic Credential Type → Header Auth → `Header Auth account`

### Transformer les matchs (Code, JavaScript, Run Once for All Items)
```javascript
const codeMap = { FL1: 'L1', CL: 'CL' };
const output = [];
const sources = ['Fetch L1', 'Fetch CL'];
for (const name of sources) {
  const items = $(name).all();
  for (const item of items) {
    const matches = item.json.matches || [];
    for (const m of matches) {
      const apiCode = m.competition && m.competition.code;
      const competition = codeMap[apiCode] || apiCode;
      const utc = new Date(m.utcDate);
      let status = 'SCHEDULED';
      if (m.status === 'FINISHED') status = 'FINISHED';
      else if (m.status === 'IN_PLAY' || m.status === 'PAUSED') status = 'LIVE';
      output.push({
        id: m.id,
        competition,
        domicile: m.homeTeam ? m.homeTeam.name : '',
        exterieur: m.awayTeam ? m.awayTeam.name : '',
        date: utc.toISOString().slice(0, 10),
        heure: utc.toISOString().slice(11, 16),
        stade: m.venue || '',
        status,
        score_dom: m.score && m.score.fullTime ? m.score.fullTime.home : null,
        score_ext: m.score && m.score.fullTime ? m.score.fullTime.away : null,
      });
    }
  }
}
return [{ json: { matches: output } }];
```
Connecté en entrée directe depuis `Fetch CL` (dernier node de la chaîne du haut) — mais référence `Fetch L1` et `Fetch CL` explicitement par nom via `$(name)`, donc l'ordre des connexions visuelles n'a pas d'importance.

### GitHub - Get matchs.json (GitHub, Resource: File, Operation: Get)
- Repository Owner : By Name → `dixieconsultingfr-blip`
- Repository Name : By Name → `football-passion`
- File Path : `data/matchs.json`
- As Binary Property : **désactivé** (off)
- Additional Parameters n'a pas été nécessaire pour spécifier la branche via ce champ — le node a utilisé son comportement par défaut correctement (branche `deploy` du repo). Si jamais il fallait la forcer : Additional Parameters → Reference → `deploy`.

### Comparer hasUpdate (Code, JavaScript, Run Once for All Items)
```javascript
const transformed = $('Transformer les matchs').first().json.matches;
const githubFile = $('GitHub - Get matchs.json').first().json;

const currentContent = Buffer.from(githubFile.content, 'base64').toString('utf8');
let current;
try { current = JSON.parse(currentContent); } catch (e) { current = []; }
if (!Array.isArray(current) && current && Array.isArray(current.value)) current = current.value;

const sortFn = (a, b) => a.id - b.id;
const currentSorted = JSON.stringify([...current].sort(sortFn));
const newSorted = JSON.stringify([...transformed].sort(sortFn));
const hasUpdate = currentSorted !== newSorted;

return [{
  json: {
    hasUpdate,
    content: JSON.stringify(transformed, null, 4),
  }
}];
```

### Si mise à jour (IF)
- Condition : `{{$json.hasUpdate}}` **is true** (Boolean)

### GitHub - Edit matchs.json (GitHub, Resource: File, Operation: Edit)
- Repository Owner : By Name → `dixieconsultingfr-blip`
- Repository Name : By Name → `football-passion`
- File Path : `data/matchs.json`
- Binary File : désactivé
- **File Content : `$json.content`, en MODE EXPRESSION** (⚠️ voir piège ci-dessous)
- Commit Message : `Mise a jour automatique des matchs (n8n)`
- Additional Parameters → Branch → `deploy`

---

## 3. Écarts par rapport au plan initial — pourquoi

### 🔴 Ligue 2 et Europa League retirées
Testées individuellement dans n8n : `FL2` et `EL` renvoient tous deux :
> *"The resource you are looking for is restricted and apparently not within your permissions. Please check your subscription."*

C'est une limitation du **plan football-data.org actuel** (gratuit), pas un bug de configuration — `FL1` et `CL` fonctionnent avec le même credential. Pour ajouter L2/Europa plus tard, il faudra soit upgrader l'abonnement football-data.org, soit trouver une autre source de données pour ces compétitions.

### ⚠️ Piège découvert : "Fixed" vs "Expression" sur File Content
Premier test réel : le commit GitHub Edit a réussi, mais le fichier déployé contenait le texte **littéral** `{{ $json.content }}` (19 octets) au lieu du JSON réel des matchs. Cause : dans n8n, taper `{{ ... }}` dans un champ texte **laissé en mode "Fixed"** ne déclenche PAS l'évaluation de l'expression — il faut explicitement cliquer sur le toggle **"Expression"** en haut à droite du champ (à côté de "Fixed"), puis écrire l'expression **sans** les accolades `{{ }}` (juste `$json.content`). Une fois en mode Expression, l'aperçu "Result" en bas du champ confirme l'évaluation correcte avant de sauvegarder.

**Règle à retenir pour tout futur champ dynamique dans n8n** : toujours vérifier/cliquer sur "Expression" quand une valeur doit être calculée dynamiquement — ne jamais se fier au simple fait d'avoir tapé `{{ }}` dans un champ "Fixed".

### Pas de node Merge
Le plan initial prévoyait des nodes `Merge` explicites pour combiner les branches. En pratique, comme observé sur le workflow CDM 2026 existant, les Code nodes n8n peuvent référencer directement n'importe quel node antérieur du run via `$('Nom du node')`, donc les Merge n'étaient pas nécessaires — chaînage linéaire simple, comme CDM 2026 le fait déjà.

---

## 4. Vérification effectuée (4 août 2026)

1. Exécution manuelle complète du workflow dans n8n → tous les nodes verts ✅
2. Commit réel visible sur GitHub : `"Mise a jour automatique des matchs (n8n)"` sur la branche `deploy`
3. Déploiement automatique déclenché → `data/matchs.json` sur le site contient les vrais matchs (ex: Olympique de Marseille vs RC Strasbourg Alsace, 21/08/2026)
4. `https://football-passion.fr/calendrier.php` affiche bien ces données en direct
5. Workflow **publié/activé** dans n8n → le Schedule Trigger tourne maintenant en autonomie toutes les 5 minutes

---

## Garde-fous — ne pas répéter l'incident CDM 2026 (juin 2026)

- **Ne jamais retirer le node "Comparer hasUpdate" ni le node IF** — sans eux, le workflow committe à chaque exécution même sans changement réel, ce qui épuise le quota GitHub Actions (2000 min/mois gratuites) en quelques jours à raison d'une exécution toutes les 5 minutes.
- Vérifier périodiquement dans n8n (onglet Executions) que le node IF prend bien la branche "false" la majorité du temps.

---

## Ce qui reste hors périmètre

- **Ligue 2, Europa League** : nécessitent un upgrade du plan football-data.org (voir section 3).
- **Équipe de France (amicaux, qualifications)** : football-data.org ne couvre pas ces matchs hors grands tournois (WC/EC). Reste manuel — ajouter directement dans `data/matchs.json` (`"competition": "France"`) le cas échéant.
