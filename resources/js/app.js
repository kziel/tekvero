const THEME_STORAGE_KEY = 'tekvero_theme';

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

	const activeTheme = document.documentElement.getAttribute('data-theme') || 'dark';
	applyTheme(activeTheme, toggleButton);

	toggleButton.addEventListener('click', () => {
		const current = document.documentElement.getAttribute('data-theme') || 'dark';
		const next = current === 'light' ? 'dark' : 'light';

		applyTheme(next, toggleButton);

		try {
			localStorage.setItem(THEME_STORAGE_KEY, next);
		} catch (_) {
			// Ignore storage failures and keep in-memory theme switch behavior.
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

initThemeToggle();
initLanguageSwitchHashPreservation();
