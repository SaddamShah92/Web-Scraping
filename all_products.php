<?php
include('simple_html_dom.php');

// Read the content of the downloaded HTML page
$html = file_get_contents('daraz.html'); // Replace with the actual path to your downloaded HTML file

// Create a DOMDocument instance and load the HTML content
$dom = new DOMDocument();
@$dom->loadHTML($html);

// Find product containers with the specified class
$productContainers = $dom->getElementsByTagName('div');
$productData = [];

foreach ($productContainers as $container) {
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional CSS styling */
        .product-card {
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            max-height: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Number of Products: <?php echo count($productData); ?></h1>

        <div class="row ">
            <?php foreach ($productData as $product): ?>
                <div class="col-md-2 border">
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h6><?php echo $product['name']; ?></h6>
                        <p>Price: <?php echo $product['price']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

