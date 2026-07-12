(function () {
    var saved = localStorage.getItem('admin-theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);
})();

document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('adminSidebarOverlay');
    var menuToggle = document.getElementById('adminMenuToggle');
    var themeToggle = document.getElementById('adminThemeToggle');
    var html = document.documentElement;

    function updateThemeIcon(theme) {
        if (!themeToggle) return;
        var icon = themeToggle.querySelector('i');
        if (icon) {
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
        themeToggle.setAttribute('aria-label', theme === 'dark' ? 'Mode clair' : 'Mode sombre');
        themeToggle.setAttribute('title', theme === 'dark' ? 'Mode clair' : 'Mode sombre');
    }

    function setTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem('admin-theme', theme);
        updateThemeIcon(theme);
    }

    updateThemeIcon(html.getAttribute('data-theme') || 'light');

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var current = html.getAttribute('data-theme') || 'dark';
            setTheme(current === 'dark' ? 'light' : 'dark');
        });
    }

    if (menuToggle && sidebar && overlay) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    }

    document.querySelectorAll('.admin-sidebar .sidebar-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992 && sidebar && overlay) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }
        });
    });

    document.querySelectorAll('.message-row[data-href]').forEach(function (row) {
        row.addEventListener('click', function (e) {
            if (e.target.closest('a, button, form, input, textarea, select, label')) {
                return;
            }
            window.location.href = row.dataset.href;
        });

        row.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                window.location.href = row.dataset.href;
            }
        });
    });
});
