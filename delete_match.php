<?php
    // Initialize header
    $pageTitle = "Delete Match";
    
    // Process delete request
    if(isset($_POST['delete'])) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbdatabase = 'fmdb';
             
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
             
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }

        $match_id = mysqli_real_escape_string($conn, $_POST['match_id']);
        $sql = "DELETE FROM matches WHERE match_id = $match_id";
        mysqli_select_db($conn, $dbdatabase);
             
        $retval = mysqli_query($conn, $sql);
             
        if(! $retval ) {
            die('Could not delete data: ' . mysqli_error($conn));
        }
        
        // Set success message for display
        $successMessage = "Match #$match_id deleted successfully";
        
        // Display success message and redirect
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Delete Match - Success</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <style>
                :root {
                    --primary: #3498db;
                    --primary-dark: #2980b9;
                    --dark: #2c3e50;
                    --dark-light: #34495e;
                    --light: #ecf0f1;
                    --danger: #e74c3c;
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
                    height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .success-message {
                    text-align: center;
                    background-color: white;
                    padding: 30px;
                    border-radius: var(--border-radius);
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    max-width: 500px;
                    width: 90%;
                }
                
                .success-icon {
                    font-size: 60px;
                    color: #2ecc71;
                    margin-bottom: 20px;
                }
                
                h2 {
                    margin-bottom: 15px;
                    color: var(--dark);
                }
                
                p {
                    margin-bottom: 25px;
                    color: #666;
                }
                
                .redirect-text {
                    font-size: 14px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class="success-message">
                <i class="fas fa-check-circle success-icon"></i>
                <h2>Success!</h2>
                <p><?php echo $successMessage; ?></p>
                <p class="redirect-text">Redirecting to Match Management page...</p>
            </div>
            
            <script>
                setTimeout(function() {
                    window.location.href = 'match.php';
                }, 2000);
            </script>
        </body>
        </html>
        <?php
        mysqli_close($conn);
        exit();
    } 
    // Display delete form
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Match</title>
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

        /* Main Form Container */
        .container {
            width: 95%;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }

        .form-title:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            transform: translateX(-50%);
        }

        .form-group {
            margin-bottom: 25px;
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
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .alert-warning {
            background-color: rgba(243, 156, 18, 0.1);
            border-left: 4px solid var(--warning);
            padding: 15px;
            margin-bottom: 20px;
            color: #333;
            border-radius: var(--border-radius);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            font-size: 1rem;
            width: 100%;
            justify-content: center;
        }

        .btn-danger:hover {
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
            transform: translateY(-2px);
        }

        .form-footer {
            margin-top: 30px;
            text-align: center;
        }

        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        .form-footer a:hover {
            color: var(--primary-dark);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 120px;
            height: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            .container {
                padding: 20px;
                width: 90%;
            }
            
            .form-control {
                padding: 10px;
            }
            
            .btn-danger {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <a href="match.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1>Delete Match</h1>
        <p>Remove match data from the system</p>
    </header>

    <!-- Main content -->
    <div class="container">
       
        
        <h2 class="form-title">Delete Match Record</h2>
        
        <div class="alert-warning">
            <i class="fas fa-exclamation-triangle"></i> Warning: This action cannot be undone. Please make sure you want to delete this match record permanently.
        </div>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="match_id"><i class="fas fa-hashtag"></i> Match ID</label>
                <input type="number" class="form-control" id="match_id" name="match_id" min="1" required>
            </div>
            
            <button type="submit" name="delete" class="btn-danger">
                <i class="fas fa-trash-alt"></i> Delete Match
            </button>
            
            <div class="form-footer">
                <p>Changed your mind? <a href="match.php">Return to Match Management</a></p>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Confirm deletion before submitting form
        document.querySelector('form').addEventListener('submit', function(e) {
            const matchId = document.getElementById('match_id').value;
            if (!confirm(`Are you sure you want to delete Match #${matchId}? This action cannot be undone.`)) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
<?php
    }
?>