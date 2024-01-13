<?php
session_start();
if (!isset($_SESSION['user'])) {
    return header('Location: http://localhost:8080/kontermilah/views/login/' );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-image: url(https://dosenit.com/wp-content/uploads/2020/10/Gunung-Fuji-Jepang-1024x640-1.jpg);
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 80vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-container {
            display: flex;
            height: 80%;
            width: 80%;
            overflow: hidden;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .menu {
            width: 250px;
            padding: 20px;
            overflow-y: auto;
            background: linear-gradient(180deg, #dc3545 0%, #dc3545 100%);
            color: #fff;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .menu-item {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            color: #fff; /* Warna tetap putih */
            text-decoration: none; /* Menghapus dekorasi link */
        }

        .menu-item:hover {
            background-color: #dc3545;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #dc3545;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1;
        }

        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #dc3545;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dashboard-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            text-align: center; /* Membuat teks di tengah */
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .card {
            flex: 0 0 calc(30% - 20px);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center; /* Membuat teks di tengah */
            transition: transform 0.3s;
        }

        h1 {
            color: #dc3545;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="menu">
            <div class="menu-item">Home</div>
            <a href="http://localhost:8080/kontermilah/views/users/index.php" class="menu-item">Users</a>
            <a href="http://localhost:8080/kontermilah/views/barangs/index.php" class="menu-item">Barang</a>
            <div class="dropdown">
                <div class="menu-item">Transaksi</div>
                <div class="dropdown-content">
                    <a href="http://localhost:8080/kontermilah/views/penjualan/index.php">Penjualan</a>
                    <a href="http://localhost:8080/kontermilah/views/pembelian/index.php">Pembelian</a>
                </div>
            </div>
            <div class="menu-item">Settings</div>
            <div class="menu-item">Logout</div>
        </div>
        <div class="dashboard-content">
            <br><h1>Welcome to Your Dashboard</br></h1>

            <div class="card-container">
                <div class="card">
                    <h2>Card 1</h2>
                    <p>This is some content for card 1.</p>
                </div>
                <div class="card">
                    <h2>Card 2</h2>
                    <p>This is some content for card 2.</p>
                </div>
                <div class="card">
                    <h2>Card 3</h2>
                    <p>This is some content for card 3.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
