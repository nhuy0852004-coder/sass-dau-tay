document.addEventListener('DOMContentLoaded', function () {
    const nutDongMoSidebar = document.getElementById('sidebarToggle');
    const lopPhuSidebar = document.getElementById('sidebarOverlay');

    function laManHinhNho() {
        return window.innerWidth <= 768;
    }

    function dongSidebarMobile() {
        document.body.classList.remove('sidebar-open');
    }

    if (nutDongMoSidebar) {
        nutDongMoSidebar.addEventListener('click', function () {
            if (laManHinhNho()) {
                document.body.classList.toggle('sidebar-open');
                return;
            }

            document.body.classList.toggle('sidebar-collapsed');
        });
    }

    if (lopPhuSidebar) {
        lopPhuSidebar.addEventListener('click', function () {
            dongSidebarMobile();
        });
    }

    window.addEventListener('resize', function () {
        if (!laManHinhNho()) {
            dongSidebarMobile();
        }
    });
});
