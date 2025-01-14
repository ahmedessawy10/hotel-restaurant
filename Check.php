<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar Styles */
        nav a {
            text-decoration: none;
            color: black;
        }
        nav a:hover {
            color: #007bff;
        }
        nav {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .btn-admin {
            border-radius: 20px;
        }

        /* Form Styles */
        label {
            font-weight: bold;
        }
        input, select {
            border-radius: 10px;
        }

        /* Table Styles */
        table {
            border-radius: 10px;
            overflow: hidden;
        }

        /* Product Images */
        .product-img {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
        }
        .page-link {
            border-radius: 50%;
        }

        /* Page Title */
        h3 {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Navigation Bar -->
        <nav class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="#" class="me-3">Home</a>
                <a href="#" class="me-3">Products</a>
                <a href="#" class="me-3">Users</a>
                <a href="#" class="me-3">Manual Order</a>
                <a href="#" class="me-3">Checks</a>
            </div>
            <div>
                <a href="#" class="btn btn-outline-secondary btn-admin">Admin</a>
            </div>
        </nav>

        <!-- Page Title -->
        <h3>Checks</h3>

        <!-- Filters Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="dateFrom" class="form-label">Date From</label>
                <input type="date" id="dateFrom" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="dateTo" class="form-label">Date To</label>
                <input type="date" id="dateTo" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="user" class="form-label">User</label>
                <select id="user" class="form-select">
                    <option selected>Choose...</option>
                    <option value="1">Abdulrahman Hamdy</option>
                    <option value="2">Islam Aker</option>
                    <option value="3">Sayed Fathy</option>
                </select>
            </div>
        </div>

        <!-- User Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><Button>+</Button> Abdulrahman Hamdy</td>
                    <td>110</td>
                </tr>
                <tr>
                    <td><Button>+</Button> Islam Aker</td>
                    <td>500</td>
                </tr>
                <tr>
                    <td><Button>+</Button> Sayed Fathy</td>
                    <td>1000</td>
                </tr>
            </tbody>
        </table>

        <!-- Order Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2015/02/02 10:30 AM</td>
                    <td>25 EGP</td>
                </tr>
                <tr>
                    <td>2015/02/02 11:30 AM</td>
                    <td>30 EGP</td>
                </tr>
                <tr>
                    <td>2015/01/01 11:36 AM</td>
                    <td>20 EGP</td>
                </tr>
            </tbody>
        </table>

        <!-- Product Images -->
        <div class="d-flex justify-content-center mb-4">
            <img src="tea.png" alt="Tea" class="product-img">
            <img src="coffee.png" alt="Coffee" class="product-img">
            <img src="nescafe.png" alt="Nescafe" class="product-img">
            <img src="cola.png" alt="Cola" class="product-img">
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>