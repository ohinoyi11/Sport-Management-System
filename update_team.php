<?php
if (isset($_POST['update'])) {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbdatabase = 'fmdb';
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }

    $team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $manager = mysqli_real_escape_string($conn, $_POST['manager']);
    $coach = mysqli_real_escape_string($conn, $_POST['coach']);
    $tot_players = mysqli_real_escape_string($conn, $_POST['tot_players']);

    $sql = "UPDATE team SET team_name = '$team_name', location = '$location', manager = '$manager', coach = '$coach', tot_players = '$tot_players' WHERE team_id = $team_id";

    mysqli_select_db($conn, $dbdatabase);
    
    $retval = mysqli_query($conn, $sql);
    
    if (!$retval) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    
    echo "<div class='alert-success'>Team data updated successfully!</div>";
    ?>
    <script>
        setTimeout(function () {    
            window.location.href = 'team.php';
        }, 1500); 
    </script>

    <?php
    mysqli_close($conn);
} else {
    // Get team_id from URL parameter if available
    $team_id = isset($_GET['id']) ? $_GET['id'] : '';
    
    // If team_id is available, fetch team data
    $team_data = null;
    if ($team_id) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbdatabase = 'fmdb';
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        
        if (!$conn) {
            die('Could not connect: ' . mysqli_error($conn));
        }
        
        mysqli_select_db($conn, $dbdatabase);
        
        $sql = "SELECT * FROM team WHERE team_id = $team_id";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $team_data = mysqli_fetch_assoc($result);
        }
        
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Team</title>
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

        /* Main content */
        .container {
            width: 95%;
            max-width: 800px;
            margin: 30px auto;
            padding: 0;
        }

        /* Form container */
        .form-container {
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            margin-bottom: 30px;
        }

        .form-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
        }

        .form-header h2 {
            font-size: 1.8rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: #f9f9f9;
        }

        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
            background-color: #fff;
        }

        .input-group input:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .input-row {
            display: flex;
            gap: 20px;
        }

        .input-row .input-group {
            flex: 1;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .submit-btn:hover {
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        .alert-success {
            background-color: var(--secondary);
            color: white;
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 15px;
            }
            
            .form-container {
                padding: 25px;
            }
            
            .input-row {
                flex-direction: column;
                gap: 0;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            .back-button {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="team.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Teams
        </a>
        <h1>Update Team</h1>
        <p>Modify team information in the database</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-container">
                <div class="form-header">
                    <h2><i class="fas fa-users"></i> Team Information</h2>
                </div>

                <div class="input-group">
                    <label for="team_id">Team ID</label>
                    <input type="number" name="team_id" id="team_id" placeholder="Enter Team ID" required 
                           value="<?php echo $team_data ? $team_data['team_id'] : $team_id; ?>" 
                           <?php echo $team_data ? 'readonly' : ''; ?>>
                </div>

                <div class="input-group">
                    <label for="team_name">Team Name</label>
                    <input type="text" name="team_name" id="team_name" placeholder="Enter Team Name" required
                           value="<?php echo $team_data ? $team_data['team_name'] : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="Enter Location" required
                           value="<?php echo $team_data ? $team_data['location'] : ''; ?>">
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="manager">Manager</label>
                        <input type="text" name="manager" id="manager" placeholder="Enter Manager Name" required
                               value="<?php echo $team_data ? $team_data['manager'] : ''; ?>">
                    </div>

                    <div class="input-group">
                        <label for="coach">Coach</label>
                        <input type="text" name="coach" id="coach" placeholder="Enter Coach Name" required
                               value="<?php echo $team_data ? $team_data['coach'] : ''; ?>">
                    </div>
                </div>

                <div class="input-group">
                    <label for="tot_players">Total Players</label>
                    <input type="number" name="tot_players" id="tot_players" placeholder="Enter Total Players" min="0" required
                           value="<?php echo $team_data ? $team_data['tot_players'] : ''; ?>">
                </div>

                <button type="submit" name="update" class="submit-btn">
                    <i class="fas fa-save"></i> Update Team
                </button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Add form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const teamId = document.getElementById('team_id').value;
            const teamName = document.getElementById('team_name').value;
            const location = document.getElementById('location').value;
            const manager = document.getElementById('manager').value;
            const coach = document.getElementById('coach').value;
            const totPlayers = document.getElementById('tot_players').value;
            
            let isValid = true;
            
            if (!teamId || isNaN(teamId) || teamId < 1) {
                alert('Please enter a valid Team ID');
                isValid = false;
            } else if (!teamName.trim()) {
                alert('Please enter a Team Name');
                isValid = false;
            } else if (!location.trim()) {
                alert('Please enter a Location');
                isValid = false;
            } else if (!manager.trim()) {
                alert('Please enter a Manager name');
                isValid = false;
            } else if (!coach.trim()) {
                alert('Please enter a Coach name');
                isValid = false;
            } else if (!totPlayers || isNaN(totPlayers) || totPlayers < 0) {
                alert('Please enter a valid number for Total Players');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // If URL has team ID parameter, fetch team data automatically
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!$team_id && !$team_data): ?>
            const urlParams = new URLSearchParams(window.location.search);
            const teamIdParam = urlParams.get('id');
            
            if (teamIdParam) {
                document.getElementById('team_id').value = teamIdParam;
                // Could trigger an AJAX call here to fetch team data
            }
            <?php endif; ?>
        });
    </script>
</body>
</html>
<?php
}
?>