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
      
    $match_id = mysqli_real_escape_string($conn, $_POST['match_id']);
    $full_time = mysqli_real_escape_string($conn, $_POST['full_time']);
    $home_score = mysqli_real_escape_string($conn, $_POST['home_score']);
    $away_score = mysqli_real_escape_string($conn, $_POST['away_score']);
    $home_penalty = mysqli_real_escape_string($conn, $_POST['home_penalty']);
    $away_penalty = mysqli_real_escape_string($conn, $_POST['away_penalty']);
   
    $sql = "UPDATE matches SET full_time = '$full_time', home_score = '$home_score', away_score = '$away_score', home_penalty = '$home_penalty', away_penalty = '$away_penalty' WHERE match_id = $match_id";

    mysqli_select_db($conn, $dbdatabase);
    
    $retval = mysqli_query($conn, $sql);
    
    if(! $retval ) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    
    echo "<div class='success-message'>Match data updated successfully!</div>";
    ?>
    <script>
        setTimeout(function() {    
            window.location.href = 'match.php';
        }, 1500);
    </script>
    <?php
    
    mysqli_close($conn);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Match</title>
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
            justify-content: center;
            align-items: center;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
            color: white;
            padding: 25px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 100;
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

        /* Form container */
        .form-container {
            max-width: 500px;
            width: 90%;
            background: white;
            padding: 35px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin: 120px auto 40px;
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        .form-title {
            color: var(--dark);
            text-align: center;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary);
        }

        /* Form inputs */
        .input-container {
            position: relative;
            margin-bottom: 25px;
        }

        .input {
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            box-sizing: border-box;
            font-size: 16px;
            height: 50px;
            outline: 0;
            padding: 0 15px;
            width: 100%;
            transition: var(--transition);
        }

        .input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .input:focus ~ .placeholder,
        .input:not(:placeholder-shown) ~ .placeholder {
            transform: translateY(-30px) translateX(-10px) scale(0.75);
            background-color: white;
            padding: 0 8px;
            color: var(--primary);
        }

        .placeholder {
            color: #aaa;
            position: absolute;
            top: 15px;
            left: 15px;
            pointer-events: none;
            transition: var(--transition);
            transform-origin: 0 0;
        }

        /* Submit button */
        .submit {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: var(--border-radius);
            color: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            height: 50px;
            letter-spacing: 0.5px;
            text-align: center;
            transition: var(--transition);
            width: 100%;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
            margin-top: 10px;
        }

        .submit:hover {
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        /* Success message */
        .success-message {
            background-color: var(--secondary);
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: var(--border-radius);
            margin: 20px 0;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
            margin-top: auto;
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            .form-container {
                padding: 25px;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
        }

        /* Field group for score inputs */
        .field-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .field-label {
            margin-bottom: 8px;
            color: var(--dark-light);
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="match.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Matches
        </a>
        <h1>Update Match Result</h1>
        <p>Modify match details in the database</p>
    </header>

    <!-- Form Container -->
    <div class="form-container">
        <?php if(isset($logo_path) && file_exists($logo_path)): ?>
        <div class="logo">
            <img src="logo.png" alt="Sports Management System Logo">
        </div>
        <?php endif; ?>
        
        <h2 class="form-title">
            <i class="fas fa-futbol"></i> Match Update Form
        </h2>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-container">
                <input name="match_id" id="match_id" class="input" type="number" placeholder=" " required />
                <label for="match_id" class="placeholder">Match ID</label>
            </div>
            
            <div class="input-container">
                <input name="full_time" id="full_time" class="input" type="time" placeholder=" " required />
                <label for="full_time" class="placeholder">Full Time</label>
            </div>
            
            <div class="field-group">
                <div>
                    <div class="field-label">Home Team</div>
                    <div class="input-container" style="margin-bottom: 15px;">
                        <input name="home_score" id="home_score" class="input" type="number" min="0" placeholder=" " required />
                        <label for="home_score" class="placeholder">Score</label>
                    </div>
                </div>
                
                <div>
                    <div class="field-label">Away Team</div>
                    <div class="input-container" style="margin-bottom: 15px;">
                        <input name="away_score" id="away_score" class="input" type="number" min="0" placeholder=" " required />
                        <label for="away_score" class="placeholder">Score</label>
                    </div>
                </div>
            </div>
            
            <div class="field-group">
                <div class="input-container">
                    <input name="home_penalty" id="home_penalty" class="input" type="number" min="0" placeholder=" " />
                    <label for="home_penalty" class="placeholder">Home Penalty</label>
                </div>
                
                <div class="input-container">
                    <input name="away_penalty" id="away_penalty" class="input" type="number" min="0" placeholder=" " />
                    <label for="away_penalty" class="placeholder">Away Penalty</label>
                </div>
            </div>
            
            <button id="update" name="update" type="submit" class="submit">
                <i class="fas fa-save"></i> Update Match
            </button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(event) {
            const matchId = document.getElementById('match_id').value;
            const homeScore = document.getElementById('home_score').value;
            const awayScore = document.getElementById('away_score').value;
            
            if (!matchId || matchId <= 0) {
                alert('Please enter a valid Match ID');
                event.preventDefault();
                return;
            }
            
            if (homeScore < 0 || awayScore < 0) {
                alert('Scores cannot be negative');
                event.preventDefault();
                return;
            }
        });
    </script>
</body>
</html>
<?php
}
?>