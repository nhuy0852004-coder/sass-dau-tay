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

    document.querySelectorAll('[data-modal-target]').forEach(function (button) {
        button.addEventListener('click', function () {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);

            if (modal) {
                modal.classList.add('show');

                const inputDauTien = modal.querySelector('input, select, textarea');
                if (inputDauTien) {
                    setTimeout(function () {
                        inputDauTien.focus();
                    }, 120);
                }
            }
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(function (button) {
        button.addEventListener('click', function () {
            const modal = button.closest('.modal-backdrop-custom');

            if (modal) {
                modal.classList.remove('show');
            }
        });
    });

    document.querySelectorAll('.modal-backdrop-custom').forEach(function (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('.modal-backdrop-custom.show').forEach(function (modal) {
                modal.classList.remove('show');
            });
        }
    });

    document.querySelectorAll('.form-can-xac-nhan').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const message = form.getAttribute('data-message') || 'Bạn có chắc muốn thực hiện thao tác này không?';

            if (!confirm(message)) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function () {
            const submitButton = form.querySelector('button[type="submit"]');

            if (submitButton) {
                submitButton.classList.add('is-loading');
                submitButton.disabled = true;
            }
        });
    });
});
