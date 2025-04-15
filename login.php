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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --light-color: #f9f9f9;
            --accent-color: #e74c3c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e5799 0%,#207cca 35%,#2989d8 50%,#7db9e8 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            color: var(--text-color);
        }
        
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 28px;
        }
        
        .hero-button a {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .hero-button a:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .hero-button i {
            margin-right: 8px;
        }
        
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
        }
        
        .login-image {
            flex: 1;
            /* Method 1: Local image (create an images folder in your project) */
            background: url('images/Logo.png') center/cover;
            
            /* Method 2: If the above doesn't work, try this fallback gradient */
            background: linear-gradient(135deg, #3498db, #2c3e50);
            
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: relative;
        }
        
        .image-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 30px;
            color: white;
        }
        
        .image-overlay h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .image-overlay p {
            font-size: 16px;
            line-height: 1.6;
        }
        
        .login-card {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 350px;
            max-width: 500px;
        }
        
        .login-card h2 {
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
            font-size: 26px;
            position: relative;
        }
        
        .login-card h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            transform: translateX(-50%);
        }
        
        .login-form label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }
        
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        .login-input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }
        
        .login-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
            background-color: white;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .login-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .login-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .login-btn:active {
            transform: translateY(1px);
        }
        
        .alternative-login {
            margin-top: 30px;
            text-align: center;
        }
        
        .alternative-login p {
            position: relative;
            color: #777;
            margin-bottom: 20px;
        }
        
        .alternative-login p:before,
        .alternative-login p:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #ddd;
        }
        
        .alternative-login p:before {
            left: 0;
        }
        
        .alternative-login p:after {
            right: 0;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .facebook {
            background-color: #3b5998;
        }
        
        .google {
            background-color: #db4437;
        }
        
        .twitter {
            background-color: #1da1f2;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .signupnew {
            text-align: center;
            margin-top: 20px;
            font-size: 15px;
        }
        
        .signupnew a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .signupnew a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
        
        .footer p {
            margin: 0;
        }
        
        /* Responsive styles */
        @media (min-width: 1441px) {
            .container {
                max-width: 1200px;
            }
            
            .login-card {
                max-width: 550px;
                padding: 50px;
            }
        }
        
        @media (max-width: 1200px) {
            .container {
                max-width: 900px;
            }
        }
        
        @media (max-width: 992px) {
            .container {
                max-width: 800px;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-image {
                min-height: 200px;
            }
            
            .login-card {
                padding: 30px 20px;
                max-width: none;
                width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                max-width: 100%;
                border-radius: 0;
                margin: 0;
            }
            
            main {
                padding: 0;
            }
            
            .navbar {
                padding: 15px;
            }
            
            .logo {
                font-size: 20px;
            }
            
            .hero-button a {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-running"></i>
            <span>CUSTECH Sports</span>
        </div>
        <div class="hero-button">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="login-image">
                <div class="image-overlay">
                    <h2>CUSTECH Sport Team</h2>
                    <p>Manage your team, track performance, and achieve excellence in sports management.</p>
                </div>
            </div>
            
            <div class="login-card">
                <h2>Welcome Back</h2>
                
                <form action="#" method="POST" class="login-form">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" class="login-input" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="password">Password</label>
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="login-input" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    
                    <button type="submit" name="login" class="login-btn">Login</button>
                </form>
                
                <div class="alternative-login">
                    <p>Or login with</p>
                    <div class="social-login">
                        <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn google"><i class="fab fa-google"></i></a>
                        <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="signupnew">
                    <p>Don't have an account? <a href="signup.html">Sign up now</a></p>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>Copyright © 2025 CUSTECH Sport Team Management</p>
    </footer>
</body>
</html>