# Artifact 02: Execution Checklist and Technology Proposal

## Final Stack Decision (Approved)
- Hosting: iqhost.pl
- Backend: Laravel + Blade
- Frontend: Tailwind CSS 4 + Vanilla JavaScript
- Database: MySQL
- Cache: Redis
- Mail: SMTP (provider from iqhost.pl or external transactional service)
- Build mode: precompile frontend assets in CI/local, deploy built files

## Purpose
Translate the phase plan into execution-ready tasks with effort estimates and a concrete, low-risk technology proposal for tekvero.pl.

## Assumptions
- Scope is one high-performance, single-page marketing site.
- Contact form stores and/or forwards inquiries to business email.
- Copy is available in one language for v1.
- One developer executes build + deployment.

## Effort Summary
- Total initial delivery: 56-76 hours
- Core build and launch window: 2-3 weeks (single developer)
- Optional post-launch optimization sprint: 8-12 hours/month
- Recommended launch contingency on shared hosting: add 20-25% buffer for environment and permission edge cases

---

## Phase-by-Phase Execution Checklist

## Phase 1: Foundation and Infrastructure (8-12h)
### Checklist
- [ ] Register and connect domain DNS for tekvero.pl
- [ ] Configure TLS/SSL and force HTTPS
- [ ] Initialize Laravel project with Blade templating
- [ ] Add Tailwind CSS 4 setup and build pipeline
- [ ] Add Docker local setup (app, web server, database/mail sandbox if needed)
- [ ] Configure environments: local, staging, production
- [ ] Set repository protections and branching rules

### Output
- Staging environment reachable with placeholder page
- Local run command documented

---

## Phase 2: Brand System and UI Tokens (8-10h)
### Checklist
- [ ] Define design tokens for brand palette
- [ ] Set typography scale and heading tracking-tight defaults
- [ ] Implement reusable Blade components: logo, button, section wrapper, card
- [ ] Embed Structural TV monogram SVG component
- [ ] Add accessible focus states and semantic color usage
- [ ] Document UI usage rules in project docs

### Output
- Reusable component library for landing sections

---

## Phase 3: Landing Page Assembly (16-22h)
### Checklist
- [ ] Build Hero section with dual CTA actions
- [ ] Build Why Tekvero manifesto block
- [ ] Build Services grid with 3 cards
- [ ] Build Tech stack trust banner
- [ ] Build contact form and validation UX
- [ ] Implement responsive behavior (mobile/tablet/desktop)
- [ ] Add smooth, minimal interactions and visual polish

### Output
- Content-complete single-page layout ready for QA

---

## Phase 4: Quality, Security, Performance (10-14h)
### Checklist
- [ ] Optimize CSS/JS/image payloads
- [ ] Validate Core Web Vitals and Lighthouse targets
- [ ] Add metadata: title, description, OG, canonical
- [ ] Validate accessibility basics (labels, hierarchy, tab flow)
- [ ] Add backend request validation and anti-spam controls
- [ ] Verify error and success states for contact flow

### Output
- QA report with pass/fail and remediation notes

---

## Phase 5: CI/CD and Launch (6-8h)
### Checklist
- [ ] Add CI pipeline: install, build, lint, tests
- [ ] Add CD pipeline for main branch deploy
- [ ] Add smoke check for homepage and form endpoint
- [ ] Create rollback checklist and launch runbook
- [ ] Execute launch-day verification

### Output
- Automated deploy path and launch-ready runbook

---

## Phase 6: Post-Launch Optimization (8-10h initial)
### Checklist
- [ ] Add analytics events for CTA clicks and form submission steps
- [ ] Review conversion funnel and section drop-off points
- [ ] Improve hero copy and CTA microcopy based on data
- [ ] Schedule monthly performance and dependency maintenance

### Output
- Prioritized optimization backlog

---

## Technology Proposal (Recommended)

## 1) Application Layer
- Framework: Laravel 11 (or latest stable) + Blade
- Styling: Tailwind CSS 4
- Interactivity: Vanilla JavaScript (no SPA framework for v1)
- Reasoning:
  - Fast delivery with low complexity
  - Excellent maintainability for marketing pages
  - No hydration overhead from frontend frameworks

## 2) Runtime and Infrastructure
- App runtime: PHP 8.3+
- Web server/process model: managed by iqhost.pl plan (Apache or Nginx + PHP handling)
- Containerization: optional for local development only
- Caching/session driver:
  - v1 final mode: Redis cache
  - sessions: Redis if stable on hosting, otherwise database fallback

## 3) Data and Form Handling
- Minimal DB need:
  - Option A (recommended): MySQL lead storage for auditability and follow-up
  - Option B: no DB and email-only relay for ultra-lean launch
- Contact form baseline requirements:
  - Honeypot field
  - Route rate limiting
  - Server-side validation and explicit user-facing success/error states
  - SMTP failure fallback logging with no sensitive output
- Email:
  - Transactional provider: Postmark or Mailgun
  - Fallback: SMTP relay from hosting provider

## 4) Deployment and Hosting
- Selected hosting path:
  - iqhost.pl shared hosting plan with MySQL and Redis
- Deployment model for simplicity:
  - Build assets locally or in GitHub Actions
  - Deploy compiled assets + Laravel app files to hosting
  - Use cron/scheduled tasks only if required and available
- Hosting checks to confirm:
  - Domain points to Laravel public directory
  - PHP 8.2+ with required Laravel extensions
  - SSH/Composer access (or alternate deployment upload workflow)
  - Cron availability for scheduler/maintenance tasks

## 5) CI/CD and DevOps
- Source control: GitHub
- CI/CD: GitHub Actions
- Required jobs:
  - PHP dependency install and build checks
  - Frontend build verification
  - Basic automated tests
  - Deploy on main after successful checks
- Secrets management:
  - GitHub encrypted secrets + server-side env files

## 6) Observability and Reliability
- Error monitoring: Sentry (recommended)
- Uptime checks: UptimeRobot or Better Stack
- Logs:
  - Laravel logs to files + optional centralized shipping
- Backups:
  - Daily DB backup if DB is enabled
  - Keep last 14-30 snapshots

## 7) Security Baseline
- Enforce HTTPS and HSTS
- CSRF protection for forms
- Input validation and sanitization
- Basic bot mitigation (honeypot + server-side rate limit)
- Security headers: CSP, X-Frame-Options, Referrer-Policy

## 8) Analytics and Conversion Tracking
- Privacy-conscious default:
  - Plausible or Fathom for lightweight analytics
- Event tracking for:
  - CTA click by section
  - Form start
  - Form submit success/fail

---

## Decision Table
- Recommended now: Laravel + Blade + Tailwind 4 + Vanilla JS + MySQL + Redis + GitHub Actions + iqhost.pl
- Choose if you need fastest launch with lowest complexity: email-only form relay, no DB
- Choose if you need CRM/reporting readiness from day one: MySQL lead storage + export workflow

---

## Immediate Next Tasks (First 5)
- [ ] Create Laravel project skeleton and Tailwind 4 integration
- [ ] Decide local workflow: native PHP environment or optional Docker
- [ ] Build design tokens and logo component
- [ ] Implement Hero + Manifest sections first
- [ ] Configure GitHub Actions pipeline with build checks
