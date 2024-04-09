<?php
// Read the content of the downloaded HTML page
include('simple_html_dom.php');
include('config.php');


$html = file_get_contents('daraz.html'); // Replace with the actual path to your downloaded HTML file

// Create a DOMDocument instance and load the HTML content
$dom = new DOMDocument();
@$dom->loadHTML($html);

// Find product containers with the specified class
$productContainers = $dom->getElementsByTagName('div');
$productData = [];

// Iterate through each product container
foreach ($productContainers as $container) {
    // Check if the container has the specified class
    if ($container->getAttribute('class') == 'gridItem--Yd0sa') {
        $productName = '';
        $productImage = '';
        $productPrice = '';

        // Extract product name
        $nameElement = $container->getElementsByTagName('a')->item(1);
        if ($nameElement) {
            $productName = $nameElement->textContent;
        }

        // Extract product image
        $imageElement = $container->getElementsByTagName('img')->item(0);
        if ($imageElement) {
            $productImage = $imageElement->getAttribute('src');
        }

        // Extract product price
        $priceElement = $container->getElementsByTagName('span')->item(0);
        if ($priceElement) {
            $productPrice = $priceElement->textContent;
        }

        // Add data to the productData array
        $productData[] = [
            'name' => $productName,
            'image' => $productImage,
            'price' => $productPrice,
        ];
    }
}

// Get the search query from the form
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Filter product data based on the search query
$filteredProductData = [];
if (!empty($searchQuery)) {
    
        // Variable is set and not null
        mysqli_query($conn, "INSERT INTO searches ( search_query	) VALUES ('$searchQuery')"); 
      
      
    foreach ($productData as $product) {
        if (stripos($product['name'], $searchQuery) !== false) {
            $filteredProductData[] = $product;
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Cards</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
     .card-title {
        font-size: 1rem; /* Adjust font size as needed */
        font-family: 'Arial', sans-serif; /* Change to desired font family */
        color: #333;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.9rem; /* Adjust font size as needed */
        font-family: 'Arial', sans-serif; /* Change to desired font family */
        color: #e91e63;
        text-align: center;
    }
</style>
<body>
<header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <!-- Logo goes here -->
                    <a href="index.php">
                    <img src="logo.png" alt="Logo" width="100">
                    </a>
                </div>
                <div class="col-md-6 text-right">
                <?php

                    // Include the database configuration
                    include 'config.php';
                    session_start();


                    // Check if the user is logged in
                    if (isset($_SESSION['username'])) {
                        // Get the logged-in user's email
                        $username = $_SESSION['username'];
                        echo'
                        <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle text-capitalize" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ' . $username . '
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                      </div>
                    </div>';

                    }else{
                    echo'<a href="login.php" class="btn btn-primary">Login</a>';

                      
                    }
                    
                    
                    ?>
                    
                
                </div>
            </div>
        </div>
    </header>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm mt-3 bg-light">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>                  
                    
                    <li class="nav-item">
                        <a class="nav-link" href="searches.php">Search history</a>
                    </li>
                </ul>
               
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <form method="get" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for products">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="row">
    <?php if (!empty($filteredProductData)) { ?>
        <!-- Display filtered product data -->
        <?php foreach ($filteredProductData as $product) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="object-fit: contain; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><strong><?php echo $product['price']; ?></strong></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="col text-center">
            <p>No products found matching your search.</p>
        </div>
    <?php }
    
    
    
    
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
