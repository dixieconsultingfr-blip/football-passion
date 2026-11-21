#!/usr/bin/env python3
"""Detecte le contenu duplique entre les articles de Football Passion et ceux d'un autre site
(satellite coupe-du-monde-2026.info) ou entre articles du meme site.

Usage :
  python scripts/check-duplicate-content.py                      # compare tout (FP vs CDM + FP vs FP)
  python scripts/check-duplicate-content.py --slug mon-slug      # un article FP contre tout le reste
  python scripts/check-duplicate-content.py --cdm ../autre/data/articles.json --seuil 10

Mesure : part des suites de 8 mots d'un article retrouvees dans un autre article (en %).
  < 10 %  : OK ; 10 a 20 % : a reformuler ; > 20 % : doublon, ne pas publier tel quel.
Code retour 1 si un article depasse le seuil (utilisable avant publication).
"""
import argparse
import json
import re
import sys
from pathlib import Path

root = Path(__file__).resolve().parent.parent


def clean(html):
    return re.sub(r'\s+', ' ', re.sub(r'<[^>]+>', ' ', html or ''))


def shingles(text, n=8):
    w = re.findall(r"\w+", text.lower())
    return {' '.join(w[i:i + n]) for i in range(max(0, len(w) - n + 1))}


def load_fp():
    out = {}
    for p in (root / 'data' / 'articles').glob('*.json'):
        d = json.loads(p.read_bytes().decode('utf-8').lstrip('﻿'))
        out[d['slug']] = ('FP', d['titre'], shingles(clean(d['contenu'])))
    return out


def load_cdm(path):
    p = Path(path)
    if not p.is_file():
        return {}
    arts = json.loads(p.read_bytes().decode('utf-8').lstrip('﻿'))
    return {a['slug']: ('CDM', a['titre'], shingles(clean(a['contenu']))) for a in arts}


ap = argparse.ArgumentParser()
ap.add_argument('--slug')
ap.add_argument('--cdm', default=str(root.parent / 'coupe-du-monde-2026' / 'data' / 'articles.json'))
ap.add_argument('--seuil', type=float, default=10.0)
args = ap.parse_args()

fp = load_fp()
cdm = load_cdm(args.cdm)
if not cdm:
    print("AVERTISSEMENT : articles du site satellite introuvables (", args.cdm, ") : comparaison FP/FP uniquement")
allarts = {('FP', k): v for k, v in fp.items()}
allarts.update({('CDM', k): v for k, v in cdm.items()})

pairs = []
keys = list(allarts)
for i, a in enumerate(keys):
    for b in keys[i + 1:]:
        if args.slug and args.slug not in (a[1], b[1]):
            continue
        if a[0] == b[0] == 'CDM':
            continue  # doublons internes au satellite : hors perimetre
        sa, sb = allarts[a][2], allarts[b][2]
        if not sa or not sb:
            continue
        inter = len(sa & sb)
        pct = 100 * inter / min(len(sa), len(sb))
        if pct >= args.seuil:
            pairs.append((pct, a, b))
pairs.sort(reverse=True)
bad = 0
for pct, a, b in pairs:
    niveau = 'DOUBLON' if pct > 20 else 'A REFORMULER'
    if pct > 20:
        bad += 1
    print(f"{niveau:12s} {pct:5.1f} %  [{a[0]}] {a[1]}  <->  [{b[0]}] {b[1]}")
if not pairs:
    print(f"OK : aucun couple d'articles au-dessus de {args.seuil:.0f} % de chevauchement ({len(allarts)} articles comparés).")
sys.exit(1 if bad else 0)
