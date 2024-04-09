<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
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
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    
                        $query = "DELETE FROM searches WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id);
                        
                        if ($stmt->execute()) {
                            header("Location: searches.php");
                            exit();
                        } else {
                            echo "Error deleting record: " . $stmt->error;
                        }
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


    <div class="container  mt-5">
        <h1 >Search History</h1>

        <?php
        // Establish a database connection (you might need to adjust the connection details)
       
        // Retrieve data from the 'searches' table
        $sql = "SELECT * FROM searches ORDER BY id DESC";
        $result = $conn->query($sql);
        $serialNumber = 1;
        ?>

        <!-- Display data in a Bootstrap table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Search Query</th>
                    <th>Created At</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $serialNumber  . "</td>";
                        echo "<td>" . $row['search_query'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo '<td><a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a></td>'; // Add delete button
                        echo "</tr>";
                        $serialNumber++; // Increment serial number
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>


      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>