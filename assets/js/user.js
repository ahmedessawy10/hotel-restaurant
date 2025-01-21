const openEditModal = (id) => {
    fetch(`../../controller/user.php?action=fetch&id=${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editUserName').value = user.name;
            document.getElementById('editUserRoom').value = user.room;
            document.getElementById('editUserExt').value = user.ext;
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
};

// Open Edit Modal
function openEditModal(id) {
    fetch(`../../controller/user.php?action=fetch&id=${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editUserName').value = user.name;
            document.getElementById('editUserRoom').value = user.room;
            document.getElementById('editUserExt').value = user.ext;
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        })
        .catch(error => console.error('Error fetching user:', error));
}

// Delete User
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`../../controller/user.php?action=delete&id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            }
        })
        .catch(error => console.error('Error deleting user:', error));
    }
}