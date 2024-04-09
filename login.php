<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
  body {
      background-image: url("pic.jpe.jpg");
    background-repeat: no-repeat;
    background-size: cover;

        background-color: #f8f9fa;
    }
        h2 , p , label {
            color:Blackk;
        }

    </style>
</head>

<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-3" style="margin-top: 100px; margin-right:80px ;">
      <div class="panel panel-primary">
        <div class="panel-heading text-center"><h2>Member Login</h2></div>
        <div class="panel-body">
          <form action="" method="post">
          
           <div class="form-group">
          <label >Email</label>
          <input type="email" class="form-control"  name="email" required>
           </div>
           <div class="form-group">
          <label >Password</label>
          <input type="password" class="form-control"  name="password" required>
           </div>
           <input type="submit" class="btn btn-primary btn-block" name="login">
           </form>
           <a href="register.php" class="btn btn-success" style="margin-left:135px; width: 150px;"> Register Here</a>
        </div>
       
      </div>
    </div>
  </div>

</div>
<?php include('config.php')?>
<?php
session_start();

if (isset($_POST['login'])) {
 	$email = $_POST['email'];
	$password = $_POST['password'];
  echo $email, $password;

	
	$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
			$_SESSION['id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
      $_SESSION['username']=$row['username'];

       echo($_SESSION['id']);
    
			header("location: index.php");
			} 
		else {
            echo "<script>
            alert('Email / Password Wrong');
            window.location.href='login.php';
            </script>";
	}
 	
 }?>