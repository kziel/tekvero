# Tekvero Landing Page Creation Plan (Phased)

## Goal
Launch a high-performance, single-page marketing site for Tekvero (tekvero.pl) that reflects the "True Tech" brand promise: clean execution, transparent collaboration, and reliable delivery.

## Core Constraints
- Visual direction:
  - Primary canvas: `#0F172A` (`bg-slate-900`)
  - Brand accent: `#10B981` (`text-emerald-500`)
  - High-contrast type: `#F8FAFC` (`text-slate-50`)
  - Low-contrast type: `#64748B` (`text-slate-400`)
- Typography: geometric sans-serif (Geist Sans / Inter / Satoshi), headings with `tracking-tight`.
- Architecture: single-page flow optimized for conversion and minimal cognitive load.
- Stack confidence banner: Tailwind CSS 4, Vanilla JavaScript, Laravel, MySQL, Redis.
- Final hosting stack: iqhost.pl with Laravel + Blade, Tailwind CSS 4 (precompiled assets), Vanilla JavaScript, MySQL, Redis cache.
- Primary deployment mode: release-based GitHub Actions workflow with symlink switch and rollback.
- Fallback deployment mode: flat deploy workflow only if release workflow is unavailable.
- Include Structural TV monogram SVG directly in Blade/components.

---

## Phase 1: Foundation and Infrastructure Setup
### Objective
Prepare production-ready project infrastructure for fast and reliable landing page delivery.

### Tasks
- Secure domain and DNS for `tekvero.pl`.
- Initialize repository structure for Laravel + Blade + Tailwind CSS 4.
- Configure environment variables and deployment targets (preview/staging + production).
- Provision Docker setup for local parity with deployment runtime.
- Configure production deployment for iqhost.pl shared hosting constraints.
- Define branching strategy (`main` + short-lived feature branches).

### Deliverables
- Running local environment via Docker.
- Version-controlled repository with baseline Laravel app.
- Domain and SSL readiness checklist.

### Exit Criteria
- App starts consistently in local containerized environment.
- Team can deploy a placeholder page to one of: `staging.tekvero.pl` or a documented preview deployment process.

---

## Phase 2: Brand System and UI Direction
### Objective
Translate brand strategy into reusable UI tokens and page-level design decisions.

### Tasks
- Implement color tokens in Tailwind/theme config and utility usage guide.
- Set typography scale for hero, section headers, body copy, and metadata.
- Implement logo component with inline SVG (Structural TV monogram).
- Define spacing, grid, and card standards for consistent section rhythm.
- Set accessibility baseline (contrast, focus styles, keyboard flow).

### Deliverables
- UI style guide section in project docs.
- Reusable Blade components (`logo`, `section`, `card`, `cta-button`).

### Exit Criteria
- All sections can be assembled from reusable components without ad-hoc styles.

---

## Phase 3: Landing Page Assembly (Single-Page Build)
### Objective
Build all conversion-critical sections in final order.

### Section Build Order
1. Hero Section
   - Headline: "Engineering-grade web production. Delivered on time."
   - Subheadline and dual CTA: "Get a Free Estimate" / "Let's Talk"
2. Why Tekvero (Manifest / Marathon Metaphor)
   - Predictable Pace
   - Frictionless Collaboration
   - Validated Code
3. Services Grid (Cards)
   - Landing Page Production
   - Boutique Business Sites
   - Performance Optimization
4. Tech Stack Showcase Banner
   - Tailwind CSS 4, Vanilla JavaScript, Laravel, MySQL, Redis
5. Contact / Brief Form
   - Name / Company
   - Project Scope (New Landing Page, Website Redesign, Other)
   - Budget Range
   - Message

### Tasks
- Build page sections as modular Blade partials.
- Implement responsive behavior (mobile-first, desktop polish).
- Add subtle interaction states (hover/focus/active) without visual clutter.
- Ensure CTA hierarchy and conversion flow are clear.
- Implement contact flow hardening: honeypot field, route rate limit, server-side validation, and clear fallback path when SMTP fails.

### Deliverables
- Fully assembled single-page template.
- Functional contact form UI and server-side request handling endpoint.

### Exit Criteria
- All planned sections are implemented and content-complete.
- Form submissions validate correctly and return clear success/error states.
- Contact anti-spam controls are active and tested (honeypot + rate limit).

---

## Phase 4: Performance, Quality, and Validation
### Objective
Guarantee engineering quality standards promised by the brand.

### Tasks
- Run performance optimization pass (asset size, caching, critical CSS strategy).
- Execute responsiveness QA across common breakpoints.
- Validate SEO essentials (title, description, Open Graph, semantic landmarks).
- Add security hygiene checks for form handling and request validation.
- Configure Redis-backed caching strategy and verify cache invalidation workflow.
- Verify accessibility fundamentals (heading structure, labels, tab order).

### Deliverables
- Lighthouse/performance report.
- QA checklist with pass/fail status.
- Security and validation notes for form pipeline.

### Exit Criteria
- Lighthouse mobile targets on production build: Performance >= 90, Accessibility >= 95, Best Practices >= 95, SEO >= 95.
- Contact submit route median response time <= 700 ms for successful validation-only request in smoke checks.
- No blocking issues in functional, visual, or form validation checks.

---

## Phase 5: Deployment Pipeline and Launch
### Objective
Ship reliably with a lean CI/CD process and rollback-safe deployment.

### Tasks
- Configure CI workflow (build, lint, basic checks).
- Configure CD workflow for automatic deploy from `main`.
- Add smoke test for homepage availability and form endpoint health.
- Prepare rollback procedure and launch-day checklist.

### Deliverables
- CI/CD pipeline configuration.
- Production deployment runbook.
- Live landing page on `tekvero.pl`.

### Exit Criteria
- Merge to `main` deploys automatically.
- Smoke tests pass post-deploy.

---

## Phase 6: Post-Launch Optimization
### Objective
Improve conversion and performance based on real usage data.

### Tasks
- Track CTA click-through and form completion funnel.
- Analyze drop-off by section and adjust copy/structure.
- Run iterative improvements to hero, CTA microcopy, and form friction.
- Schedule monthly performance + dependency maintenance checks.

### Deliverables
- Optimization backlog prioritized by impact.
- First post-launch iteration plan.

### Exit Criteria
- Measured improvement cycle established with clear KPIs.

---

## Suggested Timeline
- Week 1: Phase 1-2 (foundation + brand system)
- Week 2: Phase 3 (full page assembly)
- Week 3: Phase 4-5 (QA + launch)
- Ongoing: Phase 6 (optimization)
- Add 20-25% contingency for first launch on shared hosting constraints.

## Definition of Done (Overall)
- Brand-consistent UI (color, typography, tone) implemented end-to-end.
- All planned landing page sections shipped in single-page architecture.
- Contact form operational and validated.
- Performance/SEO/accessibility baseline achieved.
- CI/CD active with reliable deployment to `tekvero.pl`.
