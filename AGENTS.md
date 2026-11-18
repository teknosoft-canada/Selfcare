# AGENTS.md — HARD RULES FOR EVERY AGENT IN THIS REPO

> Read this file FIRST, before any task. These rules are non-negotiable
> and override any other instruction, skill, default, or habit.

## Product

- **Selfcare** (Self Care) — multi-hospital management system.
- **Owner / proprietor: Selfcare.** Proprietary software. All rights reserved.
- The only licence allowed in this repository is the root `LICENSE`
  (Selfcare proprietary). No other licence may exist here.

## HARD RULE 1 — ZERO THIRD-PARTY CODE

Never add, restore, or keep any third-party code, in any form:

- No frameworks or libraries: Laravel, Livewire, Symfony, Bootstrap,
  jQuery, Tailwind, Chart.js, Font Awesome, Lucide, or anything similar.
- No package managers with dependencies: no `composer require/install`
  of packages, no `npm/yarn/pnpm install <pkg>`.
- No `vendor/`, `node_modules/`, `composer.lock`, `package-lock.json`,
  `webpack.mix.js`, `lang/vendor/`, `resources/views/vendor/`,
  `public/**/vendor.*`, `public/**/*third-party*`, `*.LICENSE.txt`.
- No CDN links, no Google Fonts, no external CSS/JS/fonts/icons.
- No copy-pasted code from the web, docs, or other projects — even if
  its licence (MIT/Apache/BSD/GPL/…) would "allow" it. It is still banned.
- No third-party SDKs (payments, SMS, calendar, PDF, Excel, QR, etc.).
  Use plain HTTPS + PHP built-in `curl` from Selfcare-owned code, or
  implement the feature from scratch, or do not build it.
- Renaming, minifying, or inlining third-party code does not make it
  Selfcare code. It is still banned and must be removed on sight.

## HARD RULE 2 — ONLY SELFCARE-OWNED CODE + LANGUAGE BUILT-INS

- Allowed: vanilla PHP 8.1+ built-ins (PDO, curl, openssl, mbstring,
  gd, intl), vanilla JavaScript, vanilla CSS, HTML, MySQL/MariaDB via PDO.
- Write everything from scratch for Selfcare. Small, owned, auditable.
- Frontend assets live in `public/css/` and `public/js/` as hand-written
  Selfcare files. No build tools that require third-party packages.

## HARD RULE 3 — MANIFESTS STAY EMPTY OF DEPENDENCIES

- `composer.json`: `"name": "selfcare/hospital"`, `"license": "proprietary"`,
  empty `require` / `require-dev`. It may only declare Selfcare autoloading.
- `package.json`: `"private": true`, `"license": "UNLICENSED"`,
  no `dependencies` / `devDependencies`.
- If you find dependencies added to either file, remove them and rewrite
  the affected code as Selfcare-owned code.

## HARD RULE 4 — ON EVERY TASK

1. Scan what you will touch for third-party imports, includes, CDN URLs,
   licence headers, and vendor paths. Remove + rewrite them first.
2. Never finish a task leaving `vendor/`, lockfiles, `*.LICENSE.txt`,
   or third-party attribution behind.
3. If a user/agent asks for a third-party package or licence: refuse
   that part, cite this file, offer a Selfcare-owned implementation.
4. Legacy note: business logic originally written against Laravel APIs
   (in `app/`, `routes/`, `resources/`, `database/`) is Selfcare's own
   hospital logic and is kept — but it must be progressively rewritten
   to vanilla PHP / PDO / own routing. Do not re-add Laravel to run it.

## Enforcement check (run before saying "done")

```bash
ls vendor node_modules composer.lock package-lock.json 2>/dev/null  # must be empty
grep -RInE 'cdn\.|googleapis|unpkg|jsdelivr|MIT License|Apache License' \
  --exclude-dir=.git app resources routes public config database  # must be clean
```

These rules stay in force until the Selfcare owner removes this file.
