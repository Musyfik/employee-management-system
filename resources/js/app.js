import './bootstrap';

// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('hidden');
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }

    // Delete confirmation modal
    const deleteButtons = document.querySelectorAll('[data-delete-id]');
    const deleteModal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');
    const deleteEmployeeName = document.getElementById('delete-employee-name');
    const cancelDelete = document.getElementById('cancel-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const employeeId = this.getAttribute('data-delete-id');
            const employeeName = this.getAttribute('data-delete-name');
            const deleteUrl = this.getAttribute('data-delete-url');

            if (deleteEmployeeName) deleteEmployeeName.textContent = employeeName;
            if (deleteForm) deleteForm.setAttribute('action', deleteUrl);
            if (deleteModal) deleteModal.classList.remove('hidden');
        });
    });

    if (cancelDelete) {
        cancelDelete.addEventListener('click', function () {
            if (deleteModal) deleteModal.classList.add('hidden');
        });
    }

    // Close modal on backdrop click
    if (deleteModal) {
        deleteModal.addEventListener('click', function (e) {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
    }

    // Auto-dismiss flash messages
    const flashMessages = document.querySelectorAll('[data-flash]');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }, 4000);
    });

    // Photo preview
    const photoInput = document.getElementById('photo-input');
    const photoPreview = document.getElementById('photo-preview');

    if (photoInput && photoPreview) {
        photoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    photoPreview.src = e.target.result;
                    photoPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
