function openEditModal(data) {
    const editModal = document.getElementById('edit-cert-modal');
    if (editModal) {
        document.getElementById('edit-id').value = data.id;
        document.getElementById('edit-date').value = data.cert_date;
        document.getElementById('edit-name').value = data.cert_name;
        document.getElementById('edit-link').value = data.link_cert;
        document.getElementById('edit-desc').value = data.issuer;
        editModal.style.display = 'block';
    }
}

function openAddModal() {
    const addModal = document.getElementById('add-cert-modal');
    if (addModal) {
        addModal.style.display = 'block';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
}

window.onclick = function(event) {
    const editModal = document.getElementById('edit-cert-modal');
    const addModal = document.getElementById('add-cert-modal');
    
    if (event.target == editModal) {
        editModal.style.display = "none";
    }
    if (event.target == addModal) {
        addModal.style.display = "none";
    }
}

function openEditEduModal(data) {
    const modal = document.getElementById('edit-edu-modal');
    if (modal) {
        document.getElementById('edit-edu-id').value = data.id;
        document.getElementById('edit-edu-inst').value = data.institution;
        document.getElementById('edit-edu-period').value = data.period;
        document.getElementById('edit-edu-major').value = data.major;
        modal.style.display = 'block';
    }
}

function openEditProjectModal(data) {
    document.getElementById('edit-id').value = data.id;
    document.getElementById('edit-name').value = data.project_name;
    document.getElementById('edit-date').value = data.period;
    document.getElementById('edit-status').value = data.status;
    document.getElementById('edit-stack').value = data.tech_stack;
    document.getElementById('edit-url').value = data.url;
    document.getElementById('edit-desc').value = data.description;
    
    document.getElementById('edit-project-modal').style.display = 'block';
}

// Menutup modal jika user klik di luar area modal
window.onclick = function(event) {
    if (event.target.className === 'modal') {
        event.target.style.display = "none";
    }
}

// work logs
function openEditWorkModal(data) {
    const modal = document.getElementById('edit-work-modal');
    if (modal) {
        document.getElementById('edit-work-id').value = data.id;
        document.getElementById('edit-work-role').value = data.role;
        document.getElementById('edit-work-cp').value = data.company_project;
        document.getElementById('edit-work-period').value = data.period;
        document.getElementById('edit-work-status').value = data.status;
        modal.style.display = 'block';
    }
}