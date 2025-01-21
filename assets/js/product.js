$(document).ready(function () {
    // Fetch products from the database
    function fetchProducts() {
        fetch('../../controller/product.php?action=fetchAll')
            .then(response => response.json())
            .then(products => {
                renderTable(products);
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    // Render the table with products
    function renderTable(products) {
        const tbody = $("#productTable tbody");
        tbody.empty();

        products.forEach(product => {
            const row = `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>$${product.price}</td>
                    <td><img src="${product.image}" alt="${product.name}" width="50"></td>
                    <td>${product.category_id}</td>
                    <td>${product.available}</td>
                    <td>${product.created_at}</td>
                    <td>${product.updated_at}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${product.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Delete</button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Fetch products on page load
    fetchProducts();

    // Handle Add Product button click
    $('#saveProduct').click(function () {
        const productName = $('#productName').val();
        const productPrice = $('#productPrice').val();
        const productCategory = $('#productCategory').val();
        const productPicture = $('#productPicture').val().split("\\").pop();

        if (productName && productPrice && productCategory && productPicture) {
            const formData = new FormData();
            formData.append('name', productName);
            formData.append('price', productPrice);
            formData.append('category_id', productCategory);
            formData.append('image', $('#productPicture')[0].files[0]);

            fetch('../../controller/product.php?action=add', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    fetchProducts(); // Refresh the table
                    $('#addProductModal').modal('hide');
                    $('#addProductForm')[0].reset();
                }
            })
            .catch(error => console.error('Error adding product:', error));
        } else {
            alert("Please fill all fields.");
        }
    });

    // Handle Delete Product button click
    $(document).on("click", ".delete-btn", function () {
        const productId = $(this).data("id");
        if (confirm("Are you sure you want to delete this product?")) {
            fetch(`../../controller/product.php?action=delete&id=${productId}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    fetchProducts(); // Refresh the table
                }
            })
            .catch(error => console.error('Error deleting product:', error));
        }
    });

    // Handle Edit Product button click
    $(document).on("click", ".edit-btn", function () {
        const productId = $(this).data("id");
        fetch(`../../controller/product.php?action=fetch&id=${productId}`)
            .then(response => response.json())
            .then(product => {
                $('#productName').val(product.name);
                $('#productPrice').val(product.price);
                $('#productCategory').val(product.category_id);
                $('#productPicture').val(product.image);
                $('#saveProduct').text("Update Product").data("id", productId);
                $('#addProductModal').modal('show');
            })
            .catch(error => console.error('Error fetching product:', error));
    });
});