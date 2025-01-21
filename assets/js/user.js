document.addEventListener("DOMContentLoaded", function () {
    const addUserForm = document.getElementById("addUserForm");
    const editUserForm = document.getElementById("editUserForm");
    const userTableBody = document.getElementById("userTableBody");

    // Add User
    addUserForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(addUserForm);

        fetch("../../controller/user.php?action=add", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload(); // Reload the page to reflect changes
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while adding the user.");
            });
    });

    // Open Edit Modal
    const openEditModal = (id) => {
        fetch(`../../controller/user.php?action=fetch&id=${id}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Populate the edit modal form
                    document.getElementById("editUserId").value = data.data.id;
                    document.getElementById("editUserName").value = data.data.name;
                    document.getElementById("editUserEmail").value = data.data.email;
                    document.getElementById("editUserPhone").value = data.data.phone;

                    // Show the modal
                    new bootstrap.Modal(document.getElementById("editUserModal")).show();
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Failed to fetch user details. Please try again.");
            });
    };

    // Update User
    editUserForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(editUserForm);

        fetch("../../controller/user.php?action=edit", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload(); // Reload the page to reflect changes
                } else {
                    alert(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Failed to update user. Please try again.");
            });
    });

    // Delete User
    const deleteUser = (id) => {
        if (confirm("Are you sure you want to delete this user?")) {
            fetch(`../../controller/user.php?action=delete&id=${id}`, {
                method: "GET",
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                        window.location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Failed to delete user. Please try again.");
                });
        }
    };
});