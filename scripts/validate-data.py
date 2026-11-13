#!/usr/bin/env python3
"""Controle des fichiers de donnees avant deploiement (appele par GitHub Actions).

Verifie : JSON valide en UTF-8 sans BOM, index des articles = tableau simple
(pas de wrapper {"value": [...]}), champs obligatoires, ids et slugs uniques,
chaque entree de l'index a son fichier data/articles/{slug}.json, matchs.json = tableau.
Sortie : code 1 si au moins une erreur (le deploiement est alors bloque).
"""
import json
import sys
from pathlib import Path

root = Path(__file__).resolve().parent.parent
errors = []
warnings = []


def load(path):
    raw = path.read_bytes()
    if raw.startswith(b"\xef\xbb\xbf"):
        errors.append(f"{path.relative_to(root)} : BOM UTF-8 interdit")
        raw = raw[3:]
    try:
        text = raw.decode("utf-8")
    except UnicodeDecodeError as e:
        errors.append(f"{path.relative_to(root)} : pas de l'UTF-8 valide ({e})")
        return None
    if "Ã" in text and "Ã©" in text:
        warnings.append(f"{path.relative_to(root)} : motif de mojibake possible (Ã©)")
    try:
        return json.loads(text)
    except json.JSONDecodeError as e:
        errors.append(f"{path.relative_to(root)} : JSON invalide ({e})")
        return None


# --- index des articles
idx_path = root / "data" / "articles-index.json"
idx = load(idx_path)
slugs = set()
if idx is not None:
    if not isinstance(idx, list):
        errors.append("data/articles-index.json doit etre un tableau JSON "
                      "(wrapper {\"value\": [...]} detecte ?)" if isinstance(idx, dict) else
                      "data/articles-index.json doit etre un tableau JSON")
    else:
        if len(idx) == 0:
            errors.append("data/articles-index.json est vide")
        ids = set()
        for i, a in enumerate(idx):
            if not isinstance(a, dict):
                errors.append(f"index[{i}] n'est pas un objet")
                continue
            for k in ("id", "slug", "titre", "categorie", "date"):
                if not a.get(k):
                    errors.append(f"index[{i}] ({a.get('slug', '?')}) : champ '{k}' manquant")
            if a.get("id") in ids:
                errors.append(f"index : id en double {a.get('id')}")
            ids.add(a.get("id"))
            s = a.get("slug")
            if s:
                if s in slugs:
                    errors.append(f"index : slug en double {s}")
                slugs.add(s)
                if not (root / "data" / "articles" / f"{s}.json").is_file():
                    errors.append(f"index : fichier data/articles/{s}.json introuvable")

# --- fichiers articles
for p in sorted((root / "data" / "articles").glob("*.json")):
    art = load(p)
    if art is None:
        continue
    if not isinstance(art, dict):
        errors.append(f"{p.relative_to(root)} : doit etre un objet JSON")
        continue
    for k in ("id", "titre", "slug", "contenu", "date", "categorie"):
        if not art.get(k):
            errors.append(f"{p.relative_to(root)} : champ '{k}' manquant")
    if art.get("slug") and art["slug"] != p.stem:
        errors.append(f"{p.relative_to(root)} : slug '{art['slug']}' different du nom de fichier")
    if art.get("slug") and slugs and art["slug"] not in slugs:
        warnings.append(f"{p.relative_to(root)} : absent de l'index (brouillon ?)")

# --- matchs
m = load(root / "data" / "matchs.json")
if m is not None:
    if not isinstance(m, list):
        errors.append("data/matchs.json doit etre un tableau JSON (wrapper {\"value\": [...]} ?)")
    elif len(m) < 50:
        errors.append(f"data/matchs.json suspect : seulement {len(m)} entrees")

# --- autres JSON de donnees
for p in sorted((root / "data").glob("*.json")):
    if p.name in ("articles-index.json", "matchs.json"):
        continue
    load(p)

for w in warnings:
    print("AVERTISSEMENT :", w)
if errors:
    for e in errors:
        print("ERREUR :", e)
    print(f"\n{len(errors)} erreur(s) : deploiement bloque.")
    sys.exit(1)
print(f"OK : donnees valides ({len(slugs)} articles dans l'index, {len(m) if isinstance(m, list) else '?'} matchs).")
