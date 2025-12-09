document.addEventListener('DOMContentLoaded', () => {
    const mainToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.primary-nav');

    if (mainToggle && mainNav) {
        mainToggle.addEventListener('click', () => {
            const expanded = mainToggle.getAttribute('aria-expanded') === 'true';
            mainToggle.setAttribute('aria-expanded', (!expanded).toString());
            mainNav.classList.toggle('is-open', !expanded);
        });
    }

    const externalToggle = document.querySelector('.external-links-toggle');
    const externalPanel = document.querySelector('#external-links-panel');

    if (externalToggle && externalPanel) {
        const closeButtons = externalPanel.querySelectorAll('[data-panel-close]');
        const menuLinks = externalPanel.querySelectorAll('.external-links-menu a');

        const closeExternalPanel = (options = { focusToggle: true }) => {
            externalToggle.setAttribute('aria-expanded', 'false');
            externalPanel.classList.remove('is-open');
            externalPanel.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('external-links-panel-open');

            if (options.focusToggle) {
                externalToggle.focus();
            }
        };

        const openExternalPanel = () => {
            externalToggle.setAttribute('aria-expanded', 'true');
            externalPanel.classList.add('is-open');
            externalPanel.setAttribute('aria-hidden', 'false');
            document.body.classList.add('external-links-panel-open');

            const focusTarget = externalPanel.querySelector('.external-links-panel__close');
            if (focusTarget) {
                focusTarget.focus();
            }
        };

        externalToggle.addEventListener('click', () => {
            const expanded = externalToggle.getAttribute('aria-expanded') === 'true';
            if (expanded) {
                closeExternalPanel();
            } else {
                openExternalPanel();
            }
        });

        closeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                closeExternalPanel();
            });
        });

        menuLinks.forEach((link) => {
            link.addEventListener('click', () => {
                closeExternalPanel({ focusToggle: false });
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && externalPanel.classList.contains('is-open')) {
                event.preventDefault();
                closeExternalPanel();
            }
        });
    }
});
