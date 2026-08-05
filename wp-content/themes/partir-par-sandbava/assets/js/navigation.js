document.addEventListener('DOMContentLoaded', () => {
    const submenuLinks = document.querySelectorAll(
        '.navigation-menu .menu-item-has-children > a'
    );

    submenuLinks.forEach((link, index) => {
        const submenu = link.nextElementSibling;

        if (!submenu || !submenu.classList.contains('sub-menu')) {
            return;
        }

        const submenuId = `navigation-submenu-${index + 1}`;
        submenu.id = submenu.id || submenuId;
        link.setAttribute('aria-controls', submenu.id);
        link.setAttribute('aria-expanded', 'false');

        link.addEventListener('click', (event) => {
            event.preventDefault();

            const menuItem = link.parentElement;
            const isOpen = menuItem.classList.toggle('is-open');
            link.setAttribute('aria-expanded', String(isOpen));
        });
    });
});
