<?php
	if(isset($_POST['update'])) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbdatabase = 'fmdb';
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        
        if(! $conn ) {
           die('Could not connect: ' . mysqli_error());
        }
		  
        $contract_id = mysqli_real_escape_string($conn, $_POST['contract_id']);
        $player_id = mysqli_real_escape_string($conn, $_POST['player_id']);
		$team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
		$previous_team_id = mysqli_real_escape_string($conn, $_POST['previous_team_id']);
		$salary = mysqli_real_escape_string($conn, $_POST['salary']);
		$signed_date = mysqli_real_escape_string($conn, $_POST['signed_date']);
		$expiry_date = mysqli_real_escape_string($conn, $_POST['expiry_date']);
		
        $sql = "UPDATE contract ". "SET team_id = '$team_id', previous_team_id = '$previous_team_id', salary = '$salary', signed_date = '$signed_date', expiry_date = '$expiry_date' ".
           "WHERE contract_id = $contract_id and player_id = $player_id" ;

        mysqli_select_db($conn, $dbdatabase);
        
        $retval = mysqli_query( $conn, $sql );
        
        if(! $retval ) {
           die('Could not update data: ' . mysqli_error($conn));
        }
        
        echo "<div class='success-message'>Contract updated successfully!</div>";
		?>
        <script>
            setTimeout(function () {    
                window.location.href = 'contract.php';
            }, 1500); 
        </script>
        <?php
        
        mysqli_close($conn);
    } else {
        // Check if we're editing an existing contract
        $contract_id = '';
        $player_id = '';
        $team_id = '';
        $previous_team_id = '';
        $salary = '';
        $signed_date = '';
        $expiry_date = '';
        
        if(isset($_GET['id'])) {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbdatabase = 'fmdb';
            
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
            
            if(!$conn) {
                die('Could not connect: ' . mysqli_error());
            }
            
            mysqli_select_db($conn, $dbdatabase);
            
            $edit_id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM contract WHERE contract_id = $edit_id";
            
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $contract_id = $row['contract_id'];
                $player_id = $row['player_id'];
                $team_id = $row['team_id'];
                $previous_team_id = $row['previous_team_id'];
                $salary = $row['salary'];
                $signed_date = $row['signed_date'];
                $expiry_date = $row['expiry_date'];
            }
            
            mysqli_close($conn);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contract</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2ecc71;
            --secondary-dark: #27ae60;
            --dark: #2c3e50;
            --dark-light: #34495e;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #1abc9c;
            --shadow: rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
            color: white;
            padding: 25px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .back-button {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        header h1 {
            font-size: 2.2rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.5px;
        }

        header p {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 5px;
        }

        /* Navbar */
        nav {
            background: var(--dark-light);
            padding: 12px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            margin: 0 12px;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        nav a:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
        }

        nav i {
            font-size: 14px;
        }

        /* Main container */
        .container {
            width: 95%;
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
            flex: 1;
        }

        /* Form styles */
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 600;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 6px 12px rgba(46, 204, 113, 0.4);
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        /* Logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 60px;
            border-radius: var(--border-radius);
        }

        /* Success message */
        .success-message {
            background-color: var(--secondary);
            color: white;
            padding: 15px;
            border-radius: var(--border-radius);
            text-align: center;
            margin: 20px 0;
            font-weight: 500;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        footer .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        footer a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 5px 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        footer a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
            
            .btn {
                padding: 10px 20px;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="contract.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Contracts
        </a>
        <h1>Update Contract</h1>
        <p>Modify contract details</p>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="input_contract.html"><i class="fas fa-file-signature"></i> New Contract</a>
        <a href="contract.php"><i class="fas fa-list"></i> View Contracts</a>
        <a href="adminhome.php"><i class="fas fa-home"></i> Dashboard</a>
    </nav>

    <!-- Main content -->
    <div class="container">
    
        
        <h2 class="form-title">
            <i class="fas fa-edit"></i> 
            <?php echo $contract_id ? "Edit Contract #$contract_id" : "Update Contract"; ?>
        </h2>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="contract_id">Contract ID <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="contract_id" id="contract_id" value="<?php echo $contract_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="player_id">Player ID <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="player_id" id="player_id" value="<?php echo $player_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="team_id">Team ID <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="team_id" id="team_id" value="<?php echo $team_id; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="previous_team_id">Previous Team ID</label>
                <input type="number" class="form-control" name="previous_team_id" id="previous_team_id" value="<?php echo $previous_team_id; ?>">
            </div>
            
            <div class="form-group">
                <label for="salary">Salary <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="salary" id="salary" value="<?php echo $salary; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="signed_date">Signed Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="signed_date" id="signed_date" value="<?php echo $signed_date; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="expiry_date">Expiry Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="expiry_date" id="expiry_date" value="<?php echo $expiry_date; ?>" required>
            </div>
            
            <div class="form-actions">
                <a href="contract.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary" name="update">
                    <i class="fas fa-save"></i> Update Contract
                </button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="input_contract.html">Add New Contract</a>
            <a href="contract.php">View Contracts</a>
            <a href="adminhome.php">Dashboard</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Add date picker enhancements if needed
        document.addEventListener('DOMContentLoaded', function() {
            // You could add date validation or other enhancements here
        });
    </script>
</body>
</html>
<?php
}
?>