# Cleanup log — Selfcare proprietary

Owner directive: Selfcare is proprietary. All external code, names,
attributions, and licences were removed; agents must never add them back
(see `AGENTS.md` and root `LICENSE`).

## 2026-11-18 — phase 1
- Removed dependency folders, lockfiles, build manifests, published
  package views/translations, vendor bundles, and bundled licence files.
- `composer.json` / `package.json` emptied of dependencies and marked
  proprietary / UNLICENSED.

## 2026-11-18 — phase 2
- Removed bundled library CSS/JS, icon/font packs, and template bundles
  from `public/` and `resources/assets/`.
- Removed external-service and package config files from `config/`.
- Removed CDN script/style links and external font imports from views
  and Selfcare CSS.
- Renamed other-brand identifiers (loaders, language keys, asset names,
  domains) to Selfcare.
- Stripped licence/copyright attribution headers from remaining files.

## Kept
Selfcare's own hospital business logic (`app/`, `routes/`, `database/`,
own views and hand-written `public/css` / `public/js`). Files that still
reference old framework APIs must be rewritten to vanilla PHP/PDO/vanilla
JS — never by restoring a dependency. Removed files remain in git history;
restoring them violates `AGENTS.md` unless the Selfcare owner lifts the rule.
