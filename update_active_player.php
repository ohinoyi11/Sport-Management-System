<?php
	if(isset($_POST['update'])) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbdatabase = 'fmdb';
        
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        
        if(! $conn ) {
           die('Could not connect: ' . mysqli_error($conn));
        }
          
        $match_id = mysqli_real_escape_string($conn, $_POST['match_id']);
        $player_id = mysqli_real_escape_string($conn, $_POST['player_id']);
        $goals_scored = mysqli_real_escape_string($conn, $_POST['goals_scored']);
        $com_passes = mysqli_real_escape_string($conn, $_POST['com_passes']);
        $fail_passes = mysqli_real_escape_string($conn, $_POST['fail_passes']);
        $tot_attempts = mysqli_real_escape_string($conn, $_POST['tot_attempts']);
        $attempts_on_targ = mysqli_real_escape_string($conn, $_POST['attempts_on_targ']);
        $tackles = mysqli_real_escape_string($conn, $_POST['tackles']);
        $yellow_cards = mysqli_real_escape_string($conn, $_POST['yellow_cards']);
        $red_card = mysqli_real_escape_string($conn, $_POST['red_card']);
        $distance_ran = mysqli_real_escape_string($conn, $_POST['distance_ran']);
        $fouls = mysqli_real_escape_string($conn, $_POST['fouls']);
        
        $sql = "UPDATE active_player ".
               "SET goals_scored = '$goals_scored', 
                com_passes = '$com_passes', 
                fail_passes = '$fail_passes', 
                tot_attempts = '$tot_attempts', 
                attempts_on_targ = '$attempts_on_targ', 
                tackles = '$tackles', 
                yellow_cards = '$yellow_cards', 
                red_card = '$red_card', 
                distance_ran = '$distance_ran', 
                fouls = '$fouls' ".
               "WHERE match_id = $match_id AND player_id = $player_id";

        mysqli_select_db($conn, $dbdatabase);
        
        $retval = mysqli_query($conn, $sql);
        
        if(! $retval ) {
           die('Could not update data: ' . mysqli_error($conn));
        }
        
        echo "<div class='success-message'>Updated player statistics successfully!</div>";
        ?>
        <script>
            setTimeout(function () {    
                window.location.href = 'active_player.php';
            }, 800); 
        </script>

        <?php
        mysqli_close($conn);
    } else {
        // Get player data if ID is provided via GET
        $player_name = "";
        $team_name = "";
        $match_details = "";
        
        if(isset($_GET['player_id']) && isset($_GET['match_id'])) {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbdatabase = 'fmdb';
            
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error($conn));
            }
            
            $player_id = mysqli_real_escape_string($conn, $_GET['player_id']);
            $match_id = mysqli_real_escape_string($conn, $_GET['match_id']);
            
            // Get player details
            $player_sql = "SELECT p.player_name, t.team_name 
                           FROM players p
                           JOIN teams t ON p.team_id = t.team_id
                           WHERE p.player_id = $player_id";
            
            $player_result = mysqli_query($conn, $player_sql);
            if($player_result && mysqli_num_rows($player_result) > 0) {
                $player_row = mysqli_fetch_assoc($player_result);
                $player_name = $player_row['player_name'];
                $team_name = $player_row['team_name'];
            }
            
            // Get match details
            $match_sql = "SELECT m.match_date, t1.team_name as home_team, t2.team_name as away_team
                          FROM matches m
                          JOIN teams t1 ON m.home_team_id = t1.team_id
                          JOIN teams t2 ON m.away_team_id = t2.team_id
                          WHERE m.match_id = $match_id";
            
            $match_result = mysqli_query($conn, $match_sql);
            if($match_result && mysqli_num_rows($match_result) > 0) {
                $match_row = mysqli_fetch_assoc($match_result);
                $match_details = $match_row['home_team'] . " vs " . $match_row['away_team'] . " (" . date('d M Y', strtotime($match_row['match_date'])) . ")";
            }
            
            mysqli_close($conn);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player Match Statistics</title>
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

        /* Main container */
        .container {
            width: 95%;
            max-width: 800px;
            margin: 30px auto;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
            padding: 25px;
            flex: 1;
        }

        .logo img {
            display: block;
            max-width: 120px;
            margin: 0 auto 20px;
        }

        .subtitle {
            text-align: center;
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 25px;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
        }
        
        .player-info {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--primary);
        }
        
        .player-info p {
            margin: 5px 0;
        }
        
        .player-name {
            font-weight: 600;
            color: var(--dark);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .input-container {
            position: relative;
            margin-bottom: 15px;
        }

        .input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
        }

        .input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .placeholder {
            position: absolute;
            top: 0;
            left: 10px;
            transform: translateY(-50%);
            background-color: white;
            padding: 0 5px;
            font-size: 0.85rem;
            color: #777;
            transition: var(--transition);
        }

        .input:focus + .cut + .placeholder,
        .input:not(:placeholder-shown) + .cut + .placeholder {
            color: var(--primary);
        }

        .cut {
            display: block;
            height: 1px;
        }

        .submit {
            display: inline-block;
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .submit:hover {
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        .success-message {
            background-color: var(--secondary);
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            .container {
                padding: 15px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="active_player.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Players
        </a>
        <h1>Match Statistics</h1>
        <p>Update player performance data</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <?php if(!empty($player_name)): ?>
        <div class="player-info">
            <p class="player-name"><i class="fas fa-user"></i> <?php echo $player_name; ?> <span style="color:#777">(<?php echo $team_name; ?>)</span></p>
            <p><i class="fas fa-futbol"></i> Match: <?php echo $match_details; ?></p>
        </div>
        <?php endif; ?>
        
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <div class="subtitle">Update Player Match Statistics</div>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-grid">
                <div class="input-container">
                    <input name="match_id" id="match_id" class="input" type="number" placeholder=" " value="<?php echo isset($_GET['match_id']) ? $_GET['match_id'] : ''; ?>" required />
                    <div class="cut"></div>
                    <label for="match_id" class="placeholder">Match ID</label>
                </div>
                
                <div class="input-container">
                    <input name="player_id" id="player_id" class="input" type="number" placeholder=" " value="<?php echo isset($_GET['player_id']) ? $_GET['player_id'] : ''; ?>" required />
                    <div class="cut"></div>
                    <label for="player_id" class="placeholder">Player ID</label>
                </div>
                
                <div class="input-container">
                    <input name="goals_scored" id="goals_scored" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="goals_scored" class="placeholder">Goals Scored</label>
                </div>
                
                <div class="input-container">
                    <input name="com_passes" id="com_passes" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="com_passes" class="placeholder">Completed Passes</label>
                </div>
                
                <div class="input-container">
                    <input name="fail_passes" id="fail_passes" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="fail_passes" class="placeholder">Failed Passes</label>
                </div>
                
                <div class="input-container">
                    <input name="tot_attempts" id="tot_attempts" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="tot_attempts" class="placeholder">Total Attempts</label>
                </div>
                
                <div class="input-container">
                    <input name="attempts_on_targ" id="attempts_on_targ" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="attempts_on_targ" class="placeholder">Attempts on Target</label>
                </div>
                
                <div class="input-container">
                    <input name="tackles" id="tackles" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="tackles" class="placeholder">Tackles</label>
                </div>
                
                <div class="input-container">
                    <input name="yellow_cards" id="yellow_cards" class="input" type="number" placeholder=" " value="0" min="0" max="2" />
                    <div class="cut"></div>
                    <label for="yellow_cards" class="placeholder">Yellow Cards</label>
                </div>
                
                <div class="input-container">
                    <input name="red_card" id="red_card" class="input" type="number" placeholder=" " value="0" min="0" max="1" />
                    <div class="cut"></div>
                    <label for="red_card" class="placeholder">Red Card</label>
                </div>
                
                <div class="input-container">
                    <input name="distance_ran" id="distance_ran" class="input" type="number" placeholder=" " value="0" min="0" step="0.1" />
                    <div class="cut"></div>
                    <label for="distance_ran" class="placeholder">Distance Ran (km)</label>
                </div>
                
                <div class="input-container">
                    <input name="fouls" id="fouls" class="input" type="number" placeholder=" " value="0" min="0" />
                    <div class="cut"></div>
                    <label for="fouls" class="placeholder">Fouls</label>
                </div>
            </div>
            
            <button id="update" name="update" type="submit" class="submit">
                <i class="fas fa-save"></i> Update Statistics
            </button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const matchId = document.getElementById('match_id').value;
            const playerId = document.getElementById('player_id').value;
            
            if (!matchId || !playerId) {
                e.preventDefault();
                alert('Match ID and Player ID are required fields');
                return false;
            }
            
            const yellowCards = parseInt(document.getElementById('yellow_cards').value);
            const redCard = parseInt(document.getElementById('red_card').value);
            
            if (yellowCards > 2) {
                e.preventDefault();
                alert('A player cannot receive more than 2 yellow cards in a match');
                return false;
            }
            
            if (redCard > 1) {
                e.preventDefault();
                alert('A player cannot receive more than 1 red card in a match');
                return false;
            }
            
            if (redCard === 1 && yellowCards > 1) {
                e.preventDefault();
                alert('If a player has a red card, they can have at most 1 yellow card (second yellow leads to red)');
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>
<?php } ?>