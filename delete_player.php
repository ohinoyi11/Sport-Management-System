<?php
session_start();

// Connection details
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "fmdb";

// Check if the player ID was passed through URL
$player_id_from_url = isset($_GET['id']) ? $_GET['id'] : '';

// Process form submission
if(isset($_POST['delete'])) {
    // Create connection
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_database);
    
    // Check connection
    if(!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    // Sanitize input
    $player_id = mysqli_real_escape_string($conn, $_POST['player_id']);
    
    // Check if player exists before deletion
    $check_query = "SELECT player_name FROM players WHERE player_id = $player_id";
    $check_result = mysqli_query($conn, $check_query);
    
    if(mysqli_num_rows($check_result) == 0) {
        $error_message = "Player with ID $player_id does not exist";
    } else {
        $player_data = mysqli_fetch_assoc($check_result);
        $player_name = $player_data['player_name'];
        
        // Delete player
        $sql = "DELETE FROM players WHERE player_id = $player_id";
        $result = mysqli_query($conn, $sql);
        
        if(!$result) {
            $error_message = "Error deleting player: " . mysqli_error($conn);
        } else {
            // Store success message in session for display after redirect
            $_SESSION['success_message'] = "Player \"$player_name\" (ID: $player_id) has been deleted successfully";
            
            // Redirect to player management page
            header("Location: player.php");
            exit();
        }
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Player</title>
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
            display: flex;
            flex-direction: column;
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
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .form-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 0 25px var(--shadow);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form-header p {
            color: #666;
            margin-top: 5px;
        }

        .notification {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
        }

        .notification.error {
            background-color: #fce4e4;
            border-left: 4px solid var(--danger);
            color: #d32f2f;
        }

        .notification.success {
            background-color: #e3f2fd;
            border-left: 4px solid var(--primary);
            color: #0277bd;
        }

        .notification.warning {
            background-color: #fff8e1;
            border-left: 4px solid var(--warning);
            color: #ff8f00;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            transition: var(--transition);
            width: 100%;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            box-shadow: 0 6px 12px rgba(231, 76, 60, 0.4);
            transform: translateY(-2px);
        }

        .btn-link {
            background: none;
            color: var(--primary);
            padding: 0;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: none;
            width: auto;
            display: block;
            margin-top: 15px;
            text-align: center;
        }

        .btn-link:hover {
            text-decoration: underline;
            transform: none;
        }

        .confirmation-box {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .confirmation-text {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #555;
        }

        .player-name {
            font-weight: 600;
            color: var(--dark);
        }

        .confirmation-actions {
            display: flex;
            gap: 10px;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-sm {
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-header h2 {
                font-size: 1.5rem;
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
        <h1>Player Management</h1>
        <p>Delete existing player from database</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-user-minus"></i> Delete Player</h2>
                <p>This action cannot be undone. Please confirm player ID.</p>
            </div>

            <?php if(isset($error_message)): ?>
            <div class="notification error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="deleteForm">
                <div class="input-group">
                    <label for="player_id">Player ID</label>
                    <input 
                        type="number" 
                        id="player_id" 
                        name="player_id" 
                        required
                        value="<?php echo htmlspecialchars($player_id_from_url); ?>"
                        placeholder="Enter player ID"
                        min="1"
                    >
                </div>

                <button type="button" onclick="checkPlayer()" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete Player
                </button>

                <div id="confirmationBox" class="confirmation-box">
                    <div class="notification warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        <span>Are you sure you want to delete player <span id="playerName" class="player-name"></span>?</span>
                    </div>
                    <div class="confirmation-text">This action cannot be undone.</div>
                    <div class="confirmation-actions">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="cancelDelete()">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Confirm Delete</button>
                    </div>
                </div>

                <a href="player.php" class="btn-link">Cancel and return to Player Management</a>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Function to check player before deletion
        function checkPlayer() {
            const playerId = document.getElementById('player_id').value;
            
            if (!playerId) {
                alert('Please enter a Player ID');
                return;
            }

            // In a real application, you would make an AJAX call to verify the player
            // For demonstration, we'll use a simple timeout to simulate the check
            
            // Show loading state
            const deleteBtn = document.querySelector('.btn-danger');
            const originalBtnText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            deleteBtn.disabled = true;
            
            setTimeout(function() {
                // Reset button state
                deleteBtn.innerHTML = originalBtnText;
                deleteBtn.disabled = false;
                
                // In a real application, you would fetch player info here
                // For demonstration, we'll simulate a successful lookup
                fetch(`check_player.php?id=${playerId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            document.getElementById('playerName').textContent = `${data.name} (ID: ${playerId})`;
                            document.getElementById('confirmationBox').style.display = 'block';
                        } else {
                            alert(`Player with ID ${playerId} does not exist`);
                        }
                    })
                    .catch(error => {
                        // Fallback for demo purposes
                        document.getElementById('playerName').textContent = `ID: ${playerId}`;
                        document.getElementById('confirmationBox').style.display = 'block';
                    });
            }, 500);
        }

        // Function to cancel deletion
        function cancelDelete() {
            document.getElementById('confirmationBox').style.display = 'none';
        }

        // If player ID is present in URL, auto-check on page load
        document.addEventListener('DOMContentLoaded', function() {
            const playerIdInput = document.getElementById('player_id');
            if (playerIdInput.value) {
                checkPlayer();
            }
        });
    </script>
</body>
</html>