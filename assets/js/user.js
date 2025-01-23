// Add User
const addUser = (event) => {
    event.preventDefault();
    const formData = new FormData(document.getElementById('addUserForm'));

    fetch('../../controller/user.php?action=add', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            window.location.reload(); // Reload the page to reflect changes
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add user. Please try again.');
    });
};

// Open Edit Modal
const openEditModal = (id) => {
    fetch(`../../controller/user.php?action=fetch&id=${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(user => {
            if (user) {
                // Populate the edit modal form
                document.getElementById('editUserId').value = user.id;
                document.getElementById('editUserName').value = user.name;
                document.getElementById('editUserEmail').value = user.email;

                // Show the modal
                new bootstrap.Modal(document.getElementById('editUserModal')).show();
            } else {
                alert('User not found');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to fetch user details. Please try again.');
        });
};

// Update User
const updateUser = (event) => {
    event.preventDefault();
    const formData = new FormData(document.getElementById('editUserForm'));

    fetch('../../controller/user.php?action=edit', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            // Refresh the UI table
            fetchUsers();
            // Close the modal
            bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update user. Please try again.');
    });
};

// Delete User
const deleteUser = (id) => {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`../../controller/user.php?action=delete&id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.reload(); // Reload the page to reflect changes
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete user. Please try again.');
        });
    }
};

// Fetch Users on Page Load
const fetchUsers = () => {
    fetch('../../controller/user.php?action=fetch')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const userTableBody = document.getElementById('userTableBody');
                userTableBody.innerHTML = ''; // Clear existing rows

                data.users.forEach(user => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${user.name}</td>
                        <td><img src="../../${user.image}" alt="${user.name}" width="50"></td>
                        <td>${user.email}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="openEditModal(${user.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    `;
                    userTableBody.appendChild(newRow);
                });
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to fetch users. Please try again.');
        });
};

// Fetch users when the page loads
fetchUsers();

// Attach event listeners
document.getElementById('addUserForm').addEventListener('submit', addUser);
document.getElementById('editUserForm').addEventListener('submit', updateUser);