const THEME_STORAGE_KEY = 'tekvero_theme';
const COOKIE_CONSENT_ACCEPTED = 'accepted';

const getCookieConsentState = () => document.documentElement.dataset.cookieConsent || 'unknown';

const applyTheme = (theme, toggleButton) => {
	const normalizedTheme = theme === 'light' ? 'light' : 'dark';

	document.documentElement.setAttribute('data-theme', normalizedTheme);

	if (!toggleButton) {
		return;
	}

	const labelTarget = toggleButton.querySelector('[data-theme-toggle-label]');
	const isLight = normalizedTheme === 'light';
	const nextLabel = isLight
		? toggleButton.dataset.labelDark
		: toggleButton.dataset.labelLight;

	toggleButton.setAttribute('aria-pressed', String(isLight));
	toggleButton.setAttribute('aria-label', nextLabel ?? 'Theme switch');

	if (labelTarget && nextLabel) {
		labelTarget.textContent = nextLabel;
	}
};

const initThemeToggle = () => {
	const toggleButton = document.querySelector('[data-theme-toggle]');
	if (!toggleButton) {
		return;
	}

	if (getCookieConsentState() !== COOKIE_CONSENT_ACCEPTED) {
		try {
			localStorage.removeItem(THEME_STORAGE_KEY);
		} catch (_) {
			// Ignore storage failures.
		}
	}

	const activeTheme = document.documentElement.getAttribute('data-theme') || 'dark';
	applyTheme(activeTheme, toggleButton);

	toggleButton.addEventListener('click', () => {
		const current = document.documentElement.getAttribute('data-theme') || 'dark';
		const next = current === 'light' ? 'dark' : 'light';

		applyTheme(next, toggleButton);

		if (getCookieConsentState() === COOKIE_CONSENT_ACCEPTED) {
			try {
				localStorage.setItem(THEME_STORAGE_KEY, next);
			} catch (_) {
				// Ignore storage failures and keep in-memory theme switch behavior.
			}
		}
	});
};

const initLanguageSwitchHashPreservation = () => {
	document.querySelectorAll('[data-language-switch]').forEach((link) => {
		link.addEventListener('click', (event) => {
			if (!window.location.hash) {
				return;
			}

			event.preventDefault();
			window.location.href = link.getAttribute('href') + window.location.hash;
		});
	});
};

const initConsentBannerControls = () => {
	const banner = document.querySelector('[data-consent-banner]');
	if (!banner) {
		return;
	}

	document.querySelectorAll('[data-consent-open]').forEach((button) => {
		button.addEventListener('click', () => {
			banner.classList.remove('hidden');
		});
	});
};

initThemeToggle();
initLanguageSwitchHashPreservation();
initConsentBannerControls();
