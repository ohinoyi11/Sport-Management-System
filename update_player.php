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

    $player_id = mysqli_real_escape_string($conn, $_POST['player_id']);
    $team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $position_1 = mysqli_real_escape_string($conn, $_POST['position_1']);
    $position_2 = mysqli_real_escape_string($conn, $_POST['position_2']);
    $num_of_nat_match = mysqli_real_escape_string($conn, $_POST['num_of_nat_match']);
    $num_of_int_match = mysqli_real_escape_string($conn, $_POST['num_of_int_match']);
    $employment = mysqli_real_escape_string($conn, $_POST['employment']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);
    $expenses = mysqli_real_escape_string($conn, $_POST['expenses']);			
    $amateur = mysqli_real_escape_string($conn, $_POST['amateur']);	
    
    $sql = "UPDATE players ". "SET team_id = '$team_id', height = '$height', weight = '$weight', position_1 = '$position_1', position_2 = '$position_2', num_of_nat_match = '$num_of_nat_match', num_of_int_match = '$num_of_int_match', employment = '$employment', education = '$education', company = '$company', university = '$university', hobbies = '$hobbies', expenses = '$expenses', amateur = '$amateur' ".
        "WHERE player_id = $player_id";

    mysqli_select_db($conn, $dbdatabase);
    
    $retval = mysqli_query($conn, $sql);
    
    if(! $retval ) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    
    // Success message will be displayed by JavaScript
    mysqli_close($conn);
?>
    <div class="update-success">
        <div class="success-icon"><i class="fas fa-check-circle"></i></div>
        <h2>Player Updated Successfully!</h2>
        <p>The player information has been updated in the database.</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'player.php';
        }, 2000);
    </script>
<?php
} else {
    // Check if player_id is provided in URL for pre-filling the form
    $player_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $player_data = null;
    
    if ($player_id > 0) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbdatabase = 'fmdb';
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        
        if ($conn) {
            mysqli_select_db($conn, $dbdatabase);
            $sql = "SELECT * FROM players WHERE player_id = $player_id";
            $result = mysqli_query($conn, $sql);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $player_data = mysqli_fetch_assoc($result);
            }
            
            mysqli_close($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player</title>
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

        /* Main form container */
        .container {
            width: 95%;
            max-width: 900px;
            margin: 30px auto;
            padding: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
        }

        .form-header h1 {
            font-size: 24px;
            color: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-header p {
            color: #666;
            margin-top: 5px;
        }

        /* Form grid layout */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .input-group {
            margin-bottom: 5px;
        }

        .input-group label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 15px;
            background-color: #f9f9f9;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .input-group input:focus, .input-group select:focus {
            border-color: var(--primary);
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .input-group input::placeholder {
            color: #aaa;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .submit-btn i {
            font-size: 18px;
        }

        /* Search ID section */
        .search-section {
            background-color: #fff;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 0 15px var(--shadow);
            margin-bottom: 20px;
            display: <?php echo $player_data ? 'none' : 'block'; ?>;
        }

        .search-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 15px;
        }

        .search-btn {
            padding: 0 20px;
            background: linear-gradient(135deg, var(--info) 0%, var(--info) 100%);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
        }

        /* Success Message */
        .update-success {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
            border-radius: var(--border-radius);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: fadeIn 0.5s ease-out;
        }

        .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }

        /* Required field indicator */
        .required::after {
            content: "*";
            color: var(--danger);
            margin-left: 4px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
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
                width: 100%;
                padding: 0 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            nav a {
                margin: 0 5px;
                padding: 6px 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="player.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Players
        </a>
        <h1>Update Player Information</h1>
        <p>Modify player details in the database</p>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="input_player.html"><i class="fas fa-user-plus"></i> Add Player</a>
        <a href="update_player.php" class="active"><i class="fas fa-user-edit"></i> Update Player</a>
        <a href="delete_player.php"><i class="fas fa-user-minus"></i> Delete Player</a>
        <a href="player.php"><i class="fas fa-users"></i> View All Players</a>
    </nav>

    <div class="container">
        <!-- Search Player ID Section (only shown if no player_id is provided) -->
        <div class="search-section">
            <h2><i class="fas fa-search"></i> Find Player to Update</h2>
            <form class="search-form" action="update_player.php" method="get">
                <input type="number" name="id" placeholder="Enter Player ID" required>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Find
                </button>
            </form>
        </div>

        <!-- Update Form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-container">
            <div class="form-header">
                <h1><i class="fas fa-user-edit"></i> Update Player</h1>
                <p>Fields marked with * are required</p>
            </div>
            
            <div class="form-grid">
                <div class="input-group">
                    <label for="player_id" class="required">Player ID</label>
                    <input name="player_id" id="player_id" type="number" placeholder="Enter Player ID" required 
                           value="<?php echo $player_data ? $player_data['player_id'] : ''; ?>" 
                           <?php echo $player_data ? 'readonly' : ''; ?>>
                </div>

                <div class="input-group">
                    <label for="team_id">Team ID</label>
                    <input name="team_id" id="team_id" type="number" placeholder="Enter Team ID" 
                           value="<?php echo $player_data ? $player_data['team_id'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="height">Height (cm)</label>
                    <input name="height" id="height" type="number" step="0.01" placeholder="Enter Height" 
                           value="<?php echo $player_data ? $player_data['height'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="weight">Weight (kg)</label>
                    <input name="weight" id="weight" type="number" step="0.01" placeholder="Enter Weight" 
                           value="<?php echo $player_data ? $player_data['weight'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="position_1">Primary Position</label>
                    <select name="position_1" id="position_1">
                        <option value="" disabled selected>Select Position</option>
                        <option value="Goalkeeper" <?php echo ($player_data && $player_data['position_1'] == 'Goalkeeper') ? 'selected' : ''; ?>>Goalkeeper</option>
                        <option value="Defender" <?php echo ($player_data && $player_data['position_1'] == 'Defender') ? 'selected' : ''; ?>>Defender</option>
                        <option value="Midfielder" <?php echo ($player_data && $player_data['position_1'] == 'Midfielder') ? 'selected' : ''; ?>>Midfielder</option>
                        <option value="Forward" <?php echo ($player_data && $player_data['position_1'] == 'Forward') ? 'selected' : ''; ?>>Forward</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="position_2">Secondary Position</label>
                    <select name="position_2" id="position_2">
                        <option value="" selected>None</option>
                        <option value="Goalkeeper" <?php echo ($player_data && $player_data['position_2'] == 'Goalkeeper') ? 'selected' : ''; ?>>Goalkeeper</option>
                        <option value="Defender" <?php echo ($player_data && $player_data['position_2'] == 'Defender') ? 'selected' : ''; ?>>Defender</option>
                        <option value="Midfielder" <?php echo ($player_data && $player_data['position_2'] == 'Midfielder') ? 'selected' : ''; ?>>Midfielder</option>
                        <option value="Forward" <?php echo ($player_data && $player_data['position_2'] == 'Forward') ? 'selected' : ''; ?>>Forward</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="num_of_nat_match">National Matches</label>
                    <input name="num_of_nat_match" id="num_of_nat_match" type="number" placeholder="Enter National Matches" 
                           value="<?php echo $player_data ? $player_data['num_of_nat_match'] : '0'; ?>">
                </div>

                <div class="input-group">
                    <label for="num_of_int_match">International Matches</label>
                    <input name="num_of_int_match" id="num_of_int_match" type="number" placeholder="Enter International Matches" 
                           value="<?php echo $player_data ? $player_data['num_of_int_match'] : '0'; ?>">
                </div>

                <div class="input-group">
                    <label for="employment">Employment</label>
                    <input name="employment" id="employment" type="text" placeholder="Enter Employment" 
                           value="<?php echo $player_data ? $player_data['employment'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="education">Education</label>
                    <input name="education" id="education" type="text" placeholder="Enter Education" 
                           value="<?php echo $player_data ? $player_data['education'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="company">Company</label>
                    <input name="company" id="company" type="text" placeholder="Enter Company" 
                           value="<?php echo $player_data ? $player_data['company'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="university">University</label>
                    <input name="university" id="university" type="text" placeholder="Enter University" 
                           value="<?php echo $player_data ? $player_data['university'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="hobbies">Hobbies</label>
                    <input name="hobbies" id="hobbies" type="text" placeholder="Enter Hobbies" 
                           value="<?php echo $player_data ? $player_data['hobbies'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="expenses">Expenses</label>
                    <input name="expenses" id="expenses" type="number" placeholder="Enter Expenses" 
                           value="<?php echo $player_data ? $player_data['expenses'] : '0'; ?>">
                </div>

                <div class="input-group">
                    <label for="amateur">Status</label>
                    <select name="amateur" id="amateur">
                        <option value="1" <?php echo ($player_data && $player_data['amateur'] == 1) ? 'selected' : ''; ?>>Amateur</option>
                        <option value="0" <?php echo ($player_data && $player_data['amateur'] == 0) ? 'selected' : ''; ?>>Professional</option>
                    </select>
                </div>
            </div>

            <button type="submit" name="update" class="submit-btn">
                <i class="fas fa-save"></i> Update Player Information
            </button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="input_player.html">Add New Player</a>
            <a href="update_player.php">Update Player Info</a>
            <a href="delete_player.php">Delete Player</a>
            <a href="player.php">Player List</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(event) {
            const playerIdField = document.getElementById('player_id');
            
            if (!playerIdField.value) {
                event.preventDefault();
                alert('Player ID is required!');
                playerIdField.focus();
            }
        });
    </script>
</body>
</html>
<?php } ?>