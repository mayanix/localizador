document.addEventListener("DOMContentLoaded", function(){
    const editFormContainer = document.getElementById('editFormContainer');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editName = document.getElementById('editName');
    const editSurname = document.getElementById('editSurname');
    const editNumber = document.getElementById('editNumber');
    const editEmail = document.getElementById('editEmail');

    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            editId.value = this.dataset.id;
            editName.value = this.dataset.name;
            editSurname.value = this.dataset.surname;
            editNumber.value = this.dataset.number;
            editEmail.value = this.dataset.email;
            editFormContainer.style.display = 'block';
        });
    });

    editForm.addEventListener('submit', function(e) {
        if (!confirm('¿Está seguro que desea actualizar este contacto?')) {
            e.preventDefault();
        }
    });

    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('¿Está seguro de que desea eliminar este usuario?')) {
                e.preventDefault();
            }
        });
    });
});