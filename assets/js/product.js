// Fetch products from the database when the page loads
document.addEventListener('DOMContentLoaded', fetchProducts);

// Function to fetch products from the database
const fetchProducts = () => {
    fetch('controller/product.php?action=fetch')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data); // Debugging: Log the fetched data
            if (data.status === 'success') {
                renderTable(data.products); // Render the table with fetched data
            } else {
                console.error('Error fetching products:', data.message);
            }
        })
        .catch(error => console.error('Error fetching products:', error));
};

// Function to render the table with products
const renderTable = (products) => {
    const tbody = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    tbody.innerHTML = ''; // Clear existing rows

    if (products.length === 0) {
        // If no products are found, display a message
        tbody.innerHTML = '<tr><td colspan="9" class="text-center">No products found.</td></tr>';
        return;
    }

    // Loop through the products and add rows to the table
    products.forEach(product => {
        const row = `
            <tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>$${product.price}</td>
                <td><img src="${product.image}" alt="${product.name}" width="50" onerror="this.src='assets/images/default.png';"></td>
                <td>${product.category_id}</td>
                <td>${product.available ? 'Yes' : 'No'}</td>
                <td>${product.created_at}</td>
                <td>${product.updated_at}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="openEditModal(${product.id})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row); // Add the row to the table
    });
};

// Handle Add Product button click
document.querySelector('.add-product').addEventListener('click', () => {
    // Reset the form and set the save button to "Add Product"
    document.getElementById('addProductForm').reset();
    document.getElementById('saveProduct').textContent = "Add Product";
    document.getElementById('saveProduct').removeAttribute('data-id');
    new bootstrap.Modal(document.getElementById('addProductModal')).show();
});

// Handle Save Product button click
const saveProduct = (event) => {
    event.preventDefault(); // Prevent form submission

    const productId = document.getElementById('saveProduct').getAttribute('data-id');
    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;
    const productCategory = document.getElementById('productCategory').value;
    const productAvailable = document.getElementById('productAvailable').value;
    const productPicture = document.getElementById('productPicture').files[0];

    if (!productName || !productPrice || !productCategory || !productAvailable) {
        alert("Please fill all required fields.");
        return;
    }

    const formData = new FormData();
    formData.append('name', productName);
    formData.append('price', productPrice);
    formData.append('category_id', productCategory);
    formData.append('available', productAvailable);
    if (productPicture) {
        formData.append('image', productPicture);
    }

    const action = productId ? `edit&id=${productId}` : 'add';

    fetch(`controller/product.php?action=${action}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            fetchProducts(); // Refresh the table
            bootstrap.Modal.getInstance(document.getElementById('addProductModal')).hide();
            document.getElementById('addProductForm').reset();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to save product. Please try again.');
    });
};

// Handle Delete Product button click
const deleteProduct = (id) => {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch(`controller/product.php?action=delete&id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                fetchProducts(); // Refresh the table
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete product. Please try again.');
        });
    }
};

// Handle Edit Product button click
const openEditModal = (id) => {
    fetch(`controller/product.php?action=fetch&id=${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(product => {
            if (product) {
                // Populate the modal form
                document.getElementById('productName').value = product.name;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productCategory').value = product.category_id;
                document.getElementById('productAvailable').value = product.available ? '1' : '0';
                document.getElementById('productCreatedAt').value = product.created_at;
                document.getElementById('productUpdatedAt').value = product.updated_at;

                // Set the save button to "Update Product"
                document.getElementById('saveProduct').textContent = "Update Product";
                document.getElementById('saveProduct').setAttribute('data-id', product.id);

                // Show the modal
                new bootstrap.Modal(document.getElementById('addProductModal')).show();
            } else {
                alert('Product not found');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to fetch product details. Please try again.');
        });
};

// Attach event listeners
document.getElementById('addProductForm').addEventListener('submit', saveProduct);