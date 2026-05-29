# Artifact 10: Tekvero Plan v2 (Kickoff Snapshot)

## Purpose
Single source of truth for implementation kickoff of tekvero.pl, aligned to final stack and deployment policy.

## Project Goal
Launch a high-performance, single-page Tekvero website that reflects engineering reliability, clean design, and frictionless delivery.

## Final Architecture (Locked)
- Hosting: iqhost.pl
- Backend: Laravel + Blade
- Frontend: Tailwind CSS 4 + Vanilla JavaScript
- Database: MySQL
- Cache: Redis
- Mail: SMTP
- Build strategy: precompile assets before deploy

## Deployment Policy (Locked)
- Primary deployment: release-based workflow with symlink switch and rollback
  - `.github/workflows/ci-deploy-iqhost-releases.yml`
- Fallback deployment only: flat workflow
  - `.github/workflows/ci-deploy-iqhost.yml`

## Brand and UX Constraints
- Primary canvas: `#0F172A` (`bg-slate-900`)
- Accent: `#10B981` (`text-emerald-500`)
- High-contrast typography: `#F8FAFC` (`text-slate-50`)
- Low-contrast typography: `#64748B` (`text-slate-400`)
- Typography: geometric sans-serif, heading `tracking-tight`
- Page type: single-page architecture, conversion-first, minimal cognitive load

## Page Sections (Implementation Scope)
1. Hero
- Headline: Engineering-grade web production. Delivered on time.
- Subheadline and two CTAs

2. Why Tekvero (Manifest)
- Predictable Pace
- Frictionless Collaboration
- Validated Code

3. Services Grid
- Landing Page Production
- Boutique Business Sites
- Performance Optimization

4. Tech Stack Banner
- Tailwind CSS 4, Vanilla JavaScript, Laravel, MySQL, Redis

5. Contact Form
- Name/Company
- Project Scope (New Landing Page, Website Redesign, Other)
- Budget Range
- Message

## Contact Form Baseline (Mandatory)
- CSRF protection
- Server-side validation
- Honeypot anti-spam field
- Route-level rate limiting
- Clear success/error feedback
- SMTP failure fallback logging without sensitive leakage

## Measurable Acceptance Criteria
- Lighthouse mobile (production build):
  - Performance >= 90
  - Accessibility >= 95
  - Best Practices >= 95
  - SEO >= 95
- Smoke tests pass after deploy/rollback:
  - homepage returns 200
  - asset manifest returns 200
  - optional form endpoint check passes when configured
- Contact submit route median response time <= 700 ms for validation-only successful request
- No blocking visual/functional/accessibility defects

## Delivery Phases
## Phase 1: Foundation (Week 1)
- Laravel + Tailwind setup
- Environment and secrets mapping
- iqhost deployment readiness
- Preview/staging decision (subdomain staging or documented preview process)

## Phase 2: Brand System (Week 1)
- Design tokens and typography scale
- Reusable components (logo, section, card, CTA)
- Accessibility baseline styles

## Phase 3: Page Build (Week 2)
- Implement all 5 sections
- Responsive behavior
- Contact form wiring and hardening

## Phase 4: QA and Performance (Week 3)
- Lighthouse and responsive QA
- SEO metadata
- Security checks for form and headers
- Redis cache validation

## Phase 5: Release and Launch (Week 3)
- CI/CD verification
- Release deploy
- Smoke tests
- Manual business-flow verification

## Phase 6: Optimization (Post-launch)
- CTA and form funnel tracking
- Iterative content and UX improvements
- Monthly maintenance cycle

## Timeline and Effort
- Core delivery: 2-3 weeks
- Estimated effort: 56-76 hours
- Risk buffer: add 20-25% contingency for shared-hosting edge cases

## Kickoff Checklist (First 8 Actions)
1. Confirm release workflow as default pipeline.
2. Set all required GitHub secrets.
3. Bootstrap server release layout.
4. Create production shared .env.
5. Point web root to current/public.
6. Build Hero + Manifest first.
7. Push to main and execute first release deploy.
8. Validate smoke tests and contact flow manually.

## Canonical Supporting Docs
- `plan.md`
- `artifact-02-execution-checklist-tech-proposal.md`
- `artifact-03-iqhost-deployment-package.md`
- `artifact-05-release-deploy-and-rollback.md`
- `artifact-07-production-smoke-tests.md`
- `artifact-08-deploy-preflight-and-secret-validation.md`
- `artifact-09-go-live-onboarding-checklist.md`
