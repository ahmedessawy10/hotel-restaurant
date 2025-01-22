$(document).ready(function () {
    $('#productTable').DataTable({

    });


    // let products = JSON.parse(sessionStorage.getItem("products")) || [];

    // const saveToSessionStorage = () => {
    //     sessionStorage.setItem("products", JSON.stringify(products));
    // };

    // $("#saveProduct").click(function () {
    //     const productName = $("#productName").val();
    //     const productPrice = $("#productPrice").val();
    //     const productCategory = $("#productCategory").val();
    //     const productPicture = $("#productPicture").val().split("\\").pop();

    //     if (productName && productPrice && productCategory && productPicture) {
    //         const newProduct = {
    //             id: products.length + 1,
    //             name: productName,
    //             price: productPrice,
    //             image: productPicture,
    //             category: productCategory,
    //             available: "Yes",
    //             createdAt: new Date().toLocaleDateString(),
    //             updatedAt: new Date().toLocaleDateString()
    //         };
    //         products.push(newProduct);

    //         saveToSessionStorage();
    //         renderTable();
    //         $("#addProductModal").modal("hide");
    //         $("#addProductForm")[0].reset();
    //     } else {
    //         alert("Please fill all fields.");
    //     }
    // });

    // $("button[type='reset']").click(function () {
    //     $("#addProductForm")[0].reset();
    // });

    // function renderTable() {
    //     const tbody = $("#productTable tbody");
    //     tbody.empty();

    //     products.forEach(product => {
    //         const row = `
    //             <tr>
    //                 <td>${product.id}</td>
    //                 <td>${product.name}</td>
    //                 <td>$${product.price}</td>
    //                 <td><img src="${product.image}" alt="${product.name}" width="50"></td>
    //                 <td>${product.category}</td>
    //                 <td>${product.available}</td>
    //                 <td>${product.createdAt}</td>
    //                 <td>${product.updatedAt}</td>
    //                 <td>
    //                     <button class="btn btn-sm btn-warning edit-btn" data-id="${product.id}">Edit</button>
    //                     <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Delete</button>
    //                 </td>
    //             </tr>
    //         `;
    //         tbody.append(row);
    //     });
    // }

    // $(document).on("click", ".delete-btn", function () {
    //     const productId = $(this).data("id");
    //     products = products.filter(product => product.id !== productId);
    //     saveToSessionStorage();
    //     renderTable();
    // });

    $(document).on("click", ".edit-btn", function () {
        const productId = $(this).data("id");
        const product = products.find(product => product.id === productId);

        if (product) {
            $("#productName").val(product.name);
            $("#productPrice").val(product.price);
            $("#productCategory").val(product.category);
            $("#productPicture").val(product.image);
            $("#saveProduct").text("Update Product").data("id", productId);
            $("#addProductModal").modal("show");
        }
    });

    // renderTable();
});