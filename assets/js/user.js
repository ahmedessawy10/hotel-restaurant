let users = JSON.parse(sessionStorage.getItem("users")) || [];

const userTableBody = document.getElementById("userTableBody");
const addUserForm = document.getElementById("addUserForm");
const saveUserBtn = document.getElementById("saveUserBtn");
const editUserForm = document.getElementById("editUserForm");
const updateUserBtn = document.getElementById("updateUserBtn");

const saveToSessionStorage = () => {
    sessionStorage.setItem("users", JSON.stringify(users));
};

saveUserBtn.addEventListener("click", () => {
    const userName = document.getElementById("userName").value;
    const userRoom = document.getElementById("userRoom").value;
    const userImage = document.getElementById("userImage").files[0];
    const userExt = document.getElementById("userExt").value;

    if (userName && userRoom && userImage && userExt) {
        const user = {
            id: Date.now(),
            name: userName,
            room: userRoom,
            image: URL.createObjectURL(userImage),
            ext: userExt,
        };
        users.push(user);
        saveToSessionStorage();
        renderUsers();
        addUserForm.reset();
        bootstrap.Modal.getInstance(document.getElementById("addUserModal")).hide();
    } else {
        alert("Please fill all fields!");
    }
});

const openEditModal = (id) => {
    const user = users.find((user) => user.id === id);
    if (user) {
        document.getElementById("editUserName").value = user.name;
        document.getElementById("editUserRoom").value = user.room;
        document.getElementById("editUserExt").value = user.ext;
        updateUserBtn.setAttribute("data-id", id);
        new bootstrap.Modal(document.getElementById("editUserModal")).show();
    }
};

updateUserBtn.addEventListener("click", () => {
    const id = parseInt(updateUserBtn.getAttribute("data-id"));
    const userName = document.getElementById("editUserName").value;
    const userRoom = document.getElementById("editUserRoom").value;
    const userImage = document.getElementById("editUserImage").files[0];
    const userExt = document.getElementById("editUserExt").value;

    if (userName && userRoom && userExt) {
        const user = users.find((user) => user.id === id);
        if (user) {
            user.name = userName;
            user.room = userRoom;
            user.ext = userExt;
            if (userImage) {
                user.image = URL.createObjectURL(userImage);
            }
            saveToSessionStorage();
            renderUsers();
            bootstrap.Modal.getInstance(document.getElementById("editUserModal")).hide();
        }
    } else {
        alert("Please fill all fields!");
    }
});

const deleteUser = (id) => {
    users = users.filter((user) => user.id !== id);
    saveToSessionStorage();
    renderUsers();
};

const renderUsers = () => {
    userTableBody.innerHTML = users
        .map(
            (user) => `
        <tr>
            <td>${user.name}</td>
            <td>${user.room}</td>
            <td><img src="${user.image}" alt="${user.name}" width="50"></td>
            <td>${user.ext}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="openEditModal(${user.id})">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </td>
        </tr>
    `
        )
        .join("");
};

renderUsers();