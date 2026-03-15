import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('navbar');
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');
    const processButtons = document.querySelectorAll('[data-process-toggle]');

    if (navbar) {
        const syncNavbar = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        };

        syncNavbar();
        window.addEventListener('scroll', syncNavbar);
    }

    if (burger && navLinks) {
        burger.addEventListener('click', () => {
            navLinks.classList.toggle('open');
        });

        navLinks.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
            });
        });
    }

    processButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const currentItem = button.closest('.process-item');

            processButtons.forEach((otherButton) => {
                const item = otherButton.closest('.process-item');
                const icon = otherButton.querySelector('.step-toggle');
                const isCurrent = item === currentItem;
                const shouldOpen = isCurrent && !item.classList.contains('active');

                item.classList.toggle('active', shouldOpen);

                if (icon) {
                    icon.innerHTML = shouldOpen ? '&#8722;' : '&#43;';
                }
            });
        });
    });
});
