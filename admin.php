<!DOCTYPE html>
<html lang="en">
<head>
  <title>Skill Test</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  	<link rel="stylesheet" href="styles.css">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  	</head>
<body>
	<nav class="navbar navbar-expand-lg">
	<div class="container-fluid">
  		<a class="navbar-brand" href="#about">
  			<img src="K.jpeg" class="rounded-pill" height="50" width="100%">
  			<span class="text-warning m-0 ml-2">SKILL TEST</span>
  		</a>
  		<button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#mycanvas" role="button">
           <span class="navbar-toggler-icon"></span>
       </button>
       
       <div class="offcanvas offcanvas-start show" tabindex="-1" id="mycanvas">
		 	<div class="offcanvas-header">
			 <h5 class="offcanvas-title">Offcanvas</h5>
			 <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
		  	</div>
		  	<div class="offcanvas-body">
			 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
			   <li class="nav-item active">
			     <a class="nav-link" href="SkillTestWeb.html">Home </a>
			   </li>
			   <li class="nav-item">
			     <a class="nav-link" href="administration.html">Profile</a>
			   </li>
			   <li class="nav-item">
			     <a class="nav-link" href="#">Subjects</a>
			   </li>
			   <li class="nav-item">
			     <a class="nav-link" href="#">Students</a>
			   </li>
		      <li class="nav-item">
			     <a class="nav-link" href="#">LOGOUT</a>
			   </li>
			 </ul>
		 	</div>
		</div>
	</div> 
	</nav>

<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	$server = 'localhost';
	$user = 'root';
	$pwd = '';
	$database = 'ADMIN'; // Change this to your desired database name

	$connect = mysqli_connect($server, $user, $pwd);
	$error = mysqli_connect_error();
	if (!$connect) {
		 die("Failed to connect: " . $error);
	}

	$createDB = "CREATE DATABASE IF NOT EXISTS $database;";
	$result1 = mysqli_query($connect, $createDB);

	$useDB = "USE $database;";
	$result2 = mysqli_query($connect, $useDB);

	$create_table = "CREATE TABLE IF NOT EXISTS ADMIN(user_name VARCHAR(30), user_pwd VARCHAR(15));";
	$table_result = mysqli_query($connect, $create_table);

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		 $Username = $_POST['username'];
		 $Password = $_POST['password'];

		 $Username = mysqli_real_escape_string($connect, $Username);
		 $Password = mysqli_real_escape_string($connect, $Password);
		
			// Check if the username already exists in the database
    $check_query = "SELECT * FROM ADMIN WHERE user_name = '$Username'";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
        echo '<script>window.location.href = "administration.html";</script>';
        exit;
    } else {
		  $insert = "INSERT INTO ADMIN(user_name, user_pwd)
		            VALUES('$Username', '$Password')";
		 $ins_res = mysqli_query($connect, $insert);
		 if (!$ins_res) {
            die("Insertion error: " . mysqli_error($connect));
        } else {
            echo '<script>alert("Registration successful.");</script>';
            echo '<script>window.location.href = "adminlogin.php";</script>';
        }
        }
	}
	?>
</body>


</html>

