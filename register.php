<head>
  <title>Registration page</title>
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
      <div class="panel panel-Primary">
        <div class="panel-heading text-center"><h2>Registration Form</h2></div>
        <div class="panel-body">
          <form action="" method="post">
          <div class="form-group">
          <label >User Name</label>
          <input type="text" class="form-control"  name="uname" required>
           </div>
           <div class="form-group">
          <label >Email</label>
          <input type="email" class="form-control"  name="email" required>
           </div>
           <div class="form-group">
          <label >phone No</label>
          <input type="number" class="form-control"  name="ph" required>
           </div>
           <div class="form-group">
          <label >Password</label>
          <input type="password" class="form-control"  name="password" required>
           </div>
           <input type="submit" name="submit" class="btn btn-success btn-block">
           </form>
        
        </div>
       
      </div>
    </div>
  </div>

</div>

<?php
 $con=mysqli_connect("localhost","root","","prototype");

if(isset($_POST['submit']))
{
 $uname = $_POST['uname'];
  $email = $_POST['email'];
    $ph = $_POST['ph'];
	  $password = $_POST['password'];
	
$query=mysqli_query($con,"INSERT INTO `users`(`username`, `email`, `phone`, `password`) VALUES ('$uname','$email','$ph','$password')");
if($query){
    echo "<script>
    alert(' Successfully Register');
    window.location.href='login.php';
    </script>";
}
else{
	echo '<script>alert("Please enter correct data")</script>';
}
}
?>