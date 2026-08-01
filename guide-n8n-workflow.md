# Guide — Construction du workflow n8n "Football Passion — Récupération matchs"

Guide pas-à-pas pour construire le workflow dans l'interface n8n (`https://n8n.srv814711.hstgr.cloud`). Fichier de documentation uniquement — pas déployé sur le site.

---

## 0. Prérequis — Credentials à créer dans n8n

### football-data.org (Header Auth)
- n8n → Credentials → New → **Header Auth**
- Name : `X-Auth-Token`
- Value : le même token que celui utilisé sur CDM 2026 (`f27fd68cd71f482bb0577a13a4c8e59f`) — c'est un compte football-data.org unique, valable pour tous vos projets, la limite de 10 req/min s'applique **au total**, tous projets confondus. Si le workflow CDM 2026 tourne déjà toutes les 5 min et consomme déjà des requêtes, vérifier qu'on ne dépasse pas la limite en ajoutant ce nouveau workflow (4 appels/run ici + ceux de CDM 2026 sur la même fenêtre de 5 min).

### GitHub (Personal Access Token)
- Si un credential GitHub existe déjà dans n8n pour le compte `dixieconsultingfr-blip` (probablement réutilisé depuis le workflow CDM 2026), vérifier qu'il a bien accès au repo **`football-passion`** (les PAT scope "repo" classiques couvrent tous les repos du compte automatiquement — normalement pas besoin d'en recréer un).
- Sinon : GitHub → Settings → Developer settings → Personal access tokens → générer un token scope `repo`, puis n8n → Credentials → New → **GitHub API**.

---

## 1. Node : Schedule Trigger

- Type : `Schedule Trigger`
- Interval : **Every 5 minutes** (identique à CDM 2026)

---

## 2. Nodes : HTTP Request (un par compétition — 4 nodes en parallèle)

Créer 4 nodes `HTTP Request`, tous connectés en sortie du Schedule Trigger :

| Node name | URL |
|---|---|
| `Fetch L1` | `https://api.football-data.org/v4/competitions/FL1/matches` |
| `Fetch L2` | `https://api.football-data.org/v4/competitions/FL2/matches` |
| `Fetch CL` | `https://api.football-data.org/v4/competitions/CL/matches` |
| `Fetch EL` | `https://api.football-data.org/v4/competitions/EL/matches` |

Pour chacun :
- Method : `GET`
- Authentication : Generic Credential Type → Header Auth → sélectionner le credential `X-Auth-Token` créé à l'étape 0
- Response Format : JSON

---

## 3. Node : Merge (mode Append)

- Type : `Merge`
- Mode : **Append**
- Connecter les 4 sorties `Fetch L1`, `Fetch L2`, `Fetch CL`, `Fetch EL` dans ce node (4 inputs)

Ce node ne fait que concaténer les 4 réponses en une seule liste d'items, chacun contenant `{ matches: [...] }` de sa compétition respective.

---

## 4. Node : Code — "Transformer les matchs"

- Type : `Code` (JavaScript)
- Mode : **Run Once for All Items**

```javascript
// Correspondance code football-data.org → code utilisé sur football-passion.fr
const codeMap = { FL1: 'L1', FL2: 'L2', CL: 'CL', EL: 'Europa' };

const output = [];

for (const item of $input.all()) {
  const matches = item.json.matches || [];

  for (const m of matches) {
    const apiCode = m.competition?.code;
    const competition = codeMap[apiCode] || apiCode;
    const utc = new Date(m.utcDate);

    let status = 'SCHEDULED';
    if (m.status === 'FINISHED') status = 'FINISHED';
    else if (m.status === 'IN_PLAY' || m.status === 'PAUSED') status = 'LIVE';

    output.push({
      id: m.id,
      competition,
      domicile: m.homeTeam?.name || '',
      exterieur: m.awayTeam?.name || '',
      date: utc.toISOString().slice(0, 10),
      heure: utc.toISOString().slice(11, 16),
      stade: m.venue || '',
      status,
      score_dom: m.score?.fullTime?.home ?? null,
      score_ext: m.score?.fullTime?.away ?? null,
    });
  }
}

return output.map(json => ({ json }));
```

---

## 5. Node : GitHub — "Récupérer matchs.json actuel"

- Type : `GitHub`
- Resource : `File`
- Operation : `Get`
- Owner : `dixieconsultingfr-blip`
- Repository : `football-passion`
- File Path : `data/matchs.json`
- Branch : `deploy` (paramètre "As Binary Property" **désactivé** — on veut le JSON parsé/texte, pas un binaire)

> Ce node n'est **pas** connecté en entrée depuis "Transformer les matchs" — il part directement du Schedule Trigger en parallèle (ou après, peu importe l'ordre, il faut juste que les deux résultats arrivent avant l'étape de comparaison). Le plus simple : ajouter un second `Merge` (mode **Combine** cette fois, pas Append) juste avant l'étape 6, avec en entrée 1 = sortie de "Transformer les matchs", entrée 2 = sortie de "Récupérer matchs.json actuel".

---

## 6. Node : Code — "Comparer hasUpdate"

- Type : `Code` (JavaScript)
- Mode : **Run Once for All Items**
- Entrée : le node `Merge` (Combine) de l'étape précédente — `$input.all()` contiendra 2 items : `[0]` = résultat du GitHub Get (avec `.content` en base64 et `.sha`), `[1]` = le tableau transformé

```javascript
const githubFile = $input.all()[0].json;
const newArray = $('Transformer les matchs').all().map(i => i.json);

const currentContent = Buffer.from(githubFile.content, 'base64').toString('utf-8');
let currentArray;
try {
  currentArray = JSON.parse(currentContent);
} catch (e) {
  currentArray = [];
}

const sortFn = (a, b) => a.id - b.id;
const currentSorted = JSON.stringify([...currentArray].sort(sortFn));
const newSorted = JSON.stringify([...newArray].sort(sortFn));

const hasUpdate = currentSorted !== newSorted;

return [{
  json: {
    hasUpdate,
    newArray,
    sha: githubFile.sha,
  }
}];
```

> ⚠️ Adapter le nom `'Transformer les matchs'` dans `$('Transformer les matchs')` si vous renommez le node de l'étape 4 différemment dans n8n.

---

## 7. Node : IF — "Si mise à jour"

- Type : `IF`
- Condition : `{{$json.hasUpdate}}` **is equal to** `true` (Boolean)
- Seule la branche **true** continue vers l'étape 8

---

## 8. Node : GitHub — "Committer matchs.json"

- Type : `GitHub`
- Resource : `File`
- Operation : `Edit`
- Owner : `dixieconsultingfr-blip`
- Repository : `football-passion`
- File Path : `data/matchs.json`
- Branch : `deploy`
- File Content : `={{ JSON.stringify($json.newArray, null, 4) }}`
- Commit Message : `Mise à jour automatique des matchs (n8n)`
- Additional Fields → SHA : `={{$json.sha}}` (obligatoire pour l'opération Edit — GitHub refuse sans le SHA du fichier actuel)

---

## 9. Résultat

Ce commit déclenche automatiquement `.github/workflows/deploy.yml` → webhook Hostinger → `calendrier.php` affiche les données à jour en ~1-2 minutes.

---

## Garde-fous — ne pas répéter l'incident CDM 2026 (juin 2026)

- **Ne jamais retirer l'étape 6-7** (comparaison + IF) — sans elle, le workflow committe à chaque exécution même sans changement réel, ce qui épuise le quota GitHub Actions (2000 min/mois gratuites) en quelques jours à raison d'une exécution toutes les 5 minutes.
- Vérifier périodiquement dans n8n (onglet Executions) que le node IF prend bien la branche "false" la majorité du temps — s'il committe à chaque run, la comparaison a un bug (souvent : oubli de trier avant de comparer, ou un champ qui change à chaque appel API sans raison, comme un timestamp).

---

## Ce qui reste hors périmètre de cette automatisation

- **Équipe de France (amicaux, qualifications)** : football-data.org gratuit ne couvre pas correctement ces matchs hors grands tournois (WC/EC). Pas de branche automatique pour l'instant — à ajouter manuellement dans `data/matchs.json` (`"competition": "France"`) le cas échéant, ou explorer une source alternative plus tard.
