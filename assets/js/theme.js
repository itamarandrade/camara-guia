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
    const externalMenu = document.querySelector('#external-links-menu');

    if (externalToggle && externalMenu) {
        const closeExternalMenu = () => {
            externalToggle.setAttribute('aria-expanded', 'false');
            externalMenu.classList.remove('is-open');
        };

        const openExternalMenu = () => {
            externalToggle.setAttribute('aria-expanded', 'true');
            externalMenu.classList.add('is-open');
        };

        externalToggle.addEventListener('click', () => {
            const expanded = externalToggle.getAttribute('aria-expanded') === 'true';
            if (expanded) {
                closeExternalMenu();
            } else {
                openExternalMenu();
            }
        });

        document.addEventListener('click', (event) => {
            if (
                externalMenu.classList.contains('is-open') &&
                !externalMenu.contains(event.target) &&
                !externalToggle.contains(event.target)
            ) {
                closeExternalMenu();
            }
        });

        externalMenu.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                closeExternalMenu();
            }
        });

        externalMenu.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeExternalMenu();
                externalToggle.focus();
            }
        });
    }
});
