<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "fmdb";

$db = mysqli_connect($db_host, $db_username, $db_password, $db_database);
if($db===false){
	die("connection error");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	$sql = "SELECT * FROM login where username='".$username."' AND password='".$password."'";

	$result = mysqli_query($db, $sql);
	
	$row=mysqli_fetch_array($result);
	
	if($row["usertype"]=="user"){
		header("location:userhome.php");
	}
	elseif($row["usertype"]=="admin"){
		header("location:adminhome.php");
	}
	else{
		echo "Incorrect username or password.";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CUSTECH Sport Team Management</title>

    <!-- font awesome integration -->
    <script src="https://kit.fontawesome.com/fd0753639b.js" crossorigin="anonymous"></script>

    <!-- stylesheet integration -->
    <link rel="stylesheet" href="login_page.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }

        .navbar .hero-button a {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .login-card {
            background: #fff;
            width: 300px;
            margin: 80px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-card h2 {
            text-align: center;
            color: #3498db;
            margin-bottom: 20px;
        }

        .login-card form {
            display: flex;
            flex-direction: column;
        }

        .login-card label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .login-card input[type="text"],
        .login-card input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .login-card input[type="text"]:focus,
        .login-card input[type="password"]:focus {
            border: 1px solid #3498db;
            outline: none;
        }

        .login-card input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-card input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .signupnew {
            text-align: center;
            margin-top: 10px;
        }

        .signupnew a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        .signupnew a:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <section class="navbar">
        <div class="hero-button">
            <a href="index1.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        </div>
    </section>

    <div class="login-card">
        <h2>CUSTECH Sport Team Management</h2>
        <form action="#" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <input type="submit" name="login" value="Login">
        </form>
        <div class="signupnew">
            <a href="signup.html">New user? Signup</a>
        </div>
    </div>

    <section class="footer">
        <p>Copyright © 2025 CUSTECH Sport Team Management</p>
    </section>
</body>
</html>
