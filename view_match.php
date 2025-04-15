<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Match Details</title>
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

        /* Main container */
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Match summary card */
        .match-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 0 20px var(--shadow);
            overflow: hidden;
        }

        .match-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .match-header h2 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .match-header p {
            opacity: 0.9;
        }

        .match-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            background-color: var(--secondary);
        }

        .match-details {
            padding: 25px;
        }

        .teams-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .team {
            text-align: center;
            width: 40%;
        }

        .team-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .team-logo {
            width: 80px;
            height: 80px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .team-logo i {
            font-size: 40px;
            color: var(--dark);
        }

        .score-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 20%;
        }

        .main-score {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
            color: white;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            margin-bottom: 5px;
        }

        .penalty-score {
            font-size: 1rem;
            color: #666;
        }

        .match-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item i {
            background-color: var(--light);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
        }

        .info-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 3px;
        }

        .info-value {
            font-weight: 500;
        }

        /* Tabs system */
        .tabs {
            display: flex;
            background-color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px var(--shadow);
        }

        .tab {
            padding: 15px 20px;
            cursor: pointer;
            background-color: #f8f9fa;
            border: none;
            border-bottom: 3px solid transparent;
            font-weight: 500;
            color: #666;
            transition: var(--transition);
            flex: 1;
            text-align: center;
        }

        .tab.active {
            background-color: white;
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
        }

        .tab:hover:not(.active) {
            background-color: #e9ecef;
        }

        .tab-content {
            background-color: white;
            padding: 25px;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: 0 4px 20px var(--shadow);
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
        }

        table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .timeline-content {
            position: relative;
            width: 45%;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .timeline-content::after {
            content: '';
            position: absolute;
            top: 20px;
            width: 15px;
            height: 15px;
            background-color: var(--primary);
            border-radius: 50%;
        }

        .timeline-content.left {
            margin-right: 55%;
        }

        .timeline-content.left::after {
            right: -7.5px;
        }

        .timeline-content.right {
            margin-left: 55%;
        }

        .timeline-content.right::after {
            left: -7.5px;
        }

        .timeline-time {
            position: absolute;
            top: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .timeline-content.left .timeline-time {
            right: -60px;
        }

        .timeline-content.right .timeline-time {
            left: -60px;
        }

        .timeline-icon {
            margin-right: 10px;
            color: var(--primary);
        }

        .timeline-event {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .timeline-detail {
            font-size: 0.9rem;
            color: #666;
        }

        /* Button styles */
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
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

        /* No data message */
        .no-data {
            text-align: center;
            padding: 30px;
            color: #666;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .timeline-content {
                width: 100%;
                margin: 0 0 30px 0;
            }
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-content::after {
                left: -25px !important;
            }
            
            .timeline-content.left, .timeline-content.right {
                margin-left: 40px;
            }
            
            .timeline-content.left .timeline-time, .timeline-content.right .timeline-time {
                left: -65px;
                width: 55px;
                text-align: right;
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 15px;
            }
            
            .teams-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .team, .score-container {
                width: 100%;
            }
            
            .main-score {
                margin: 15px 0;
            }
            
            .match-info {
                grid-template-columns: 1fr;
            }
            
            .tab {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_database = "fmdb";

    $db = mysqli_connect($db_host, $db_username, $db_password);
    mysqli_select_db($db, $db_database);

    // Get match ID from URL parameter
    $matchId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch match details
    $matchQuery = "SELECT * FROM matches WHERE match_id = $matchId";
    $matchResult = mysqli_query($db, $matchQuery);
    
    // Check if match exists
    if (!$matchResult || mysqli_num_rows($matchResult) == 0) {
        echo "<div style='text-align:center; margin-top:50px;'>
                <h2>Match not found</h2>
                <p>The match you are looking for doesn't exist or has been removed.</p>
                <a href='manage_matches.php' style='color:var(--primary);'>Back to Match Management</a>
              </div>";
        exit;
    }
    
    $match = mysqli_fetch_assoc($matchResult);
    
    // Use team IDs directly since we don't have a teams table
    $homeTeamId = $match['home_team_id'];
    $awayTeamId = $match['away_team_id'];
    
    // Check if active_players table exists
    $activePlayersExist = false;
    $tablesQuery = "SHOW TABLES LIKE 'active_players'";
    $tablesResult = mysqli_query($db, $tablesQuery);
    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
        $activePlayersExist = true;
    }
    
    // Check if benched_players table exists
    $benchedPlayersExist = false;
    $tablesQuery = "SHOW TABLES LIKE 'benched_players'";
    $tablesResult = mysqli_query($db, $tablesQuery);
    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
        $benchedPlayersExist = true;
    }
    
    // Check if match_events table exists
    $eventsExist = false;
    $tablesQuery = "SHOW TABLES LIKE 'match_events'";
    $tablesResult = mysqli_query($db, $tablesQuery);
    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
        $eventsExist = true;
    }
    ?>

    <!-- Header -->
    <header>
        <a href="manage_matches.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Matches
        </a>
        <h1>Match Details</h1>
        <p>Comprehensive view of match #<?php echo $matchId; ?></p>
    </header>

    <!-- Main content -->
    <div class="container">
        <!-- Match summary card -->
        <div class="match-card">
            <div class="match-header">
                <h2>Team #<?php echo $homeTeamId; ?> vs Team #<?php echo $awayTeamId; ?></h2>
                <p><?php echo date('j F Y', strtotime($match['match_date'])); ?></p>
                <?php
                $currentTime = strtotime(date('Y-m-d H:i:s'));
                $matchTime = strtotime($match['match_date']);
                
                if ($currentTime < $matchTime) {
                    echo '<div class="match-status" style="background-color: var(--warning);">Upcoming</div>';
                } elseif ($match['full_time'] == 'Yes') {
                    echo '<div class="match-status">Completed</div>';
                } else {
                    echo '<div class="match-status" style="background-color: var(--danger);">In Progress</div>';
                }
                ?>
            </div>

            <div class="match-details">
                <div class="teams-container">
                    <div class="team">
                        <div class="team-logo">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="team-name">Home Team</div>
                        <div class="team-id">Team ID: <?php echo $homeTeamId; ?></div>
                    </div>

                    <div class="score-container">
                        <div class="main-score"><?php echo $match['home_score']; ?> - <?php echo $match['away_score']; ?></div>
                        <?php if ($match['home_penalty'] != 0 || $match['away_penalty'] != 0): ?>
                        <div class="penalty-score">Penalties: <?php echo $match['home_penalty']; ?> - <?php echo $match['away_penalty']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="team">
                        <div class="team-logo">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="team-name">Away Team</div>
                        <div class="team-id">Team ID: <?php echo $awayTeamId; ?></div>
                    </div>
                </div>

                <div class="match-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value"><?php echo $match['location']; ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <div class="info-label">Date & Time</div>
                            <div class="info-value"><?php echo date('j F Y, h:i A', strtotime($match['match_date'])); ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <div>
                            <div class="info-label">Referee</div>
                            <div class="info-value"><?php echo $match['referee']; ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-stopwatch"></i>
                        <div>
                            <div class="info-label">Status</div>
                            <div class="info-value"><?php echo $match['full_time'] == 'Yes' ? 'Full Time' : 'In Progress'; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs system -->
        <div class="tabs">
            <button class="tab active" data-tab="lineups">Lineups</button>
            <button class="tab" data-tab="bench">Bench</button>
            <button class="tab" data-tab="events">Match Events</button>
            <button class="tab" data-tab="stats">Statistics</button>
        </div>

        <div class="tab-content">
            <!-- Lineups Tab -->
            <div class="tab-pane active" id="lineups">
                <?php if ($activePlayersExist): ?>
                    <?php
                    // Check if there's a players table
                    $playersTableExists = false;
                    $tablesQuery = "SHOW TABLES LIKE 'players'";
                    $tablesResult = mysqli_query($db, $tablesQuery);
                    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
                        $playersTableExists = true;
                        
                        // Fetch active players with player names if possible
                        $activePlayersQuery = "SELECT ap.*, p.player_name 
                                              FROM active_players ap
                                              LEFT JOIN players p ON ap.player_id = p.player_id
                                              WHERE ap.match_id = $matchId
                                              ORDER BY ap.position";
                    } else {
                        // Fetch active players without joining to players table
                        $activePlayersQuery = "SELECT * FROM active_players WHERE match_id = $matchId ORDER BY position";
                    }
                    
                    $activePlayersResult = mysqli_query($db, $activePlayersQuery);
                    
                    if ($activePlayersResult && mysqli_num_rows($activePlayersResult) > 0):
                    ?>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Player ID</th>
                                    <?php if ($playersTableExists): ?>
                                    <th>Player Name</th>
                                    <?php endif; ?>
                                    <th>Position</th>
                                    <th>Team ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($player = mysqli_fetch_assoc($activePlayersResult)): ?>
                                <tr>
                                    <td><?php echo $player['player_id']; ?></td>
                                    <?php if ($playersTableExists && isset($player['player_name'])): ?>
                                    <td><?php echo $player['player_name']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo $player['position']; ?></td>
                                    <td><?php echo isset($player['team_id']) ? $player['team_id'] : 'N/A'; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="no-data">
                        <i class="fas fa-info-circle fa-2x" style="color: var(--primary); margin-bottom: 10px;"></i>
                        <p>No active players found for this match.</p>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                <div class="no-data">
                    <i class="fas fa-exclamation-triangle fa-2x" style="color: var(--warning); margin-bottom: 10px;"></i>
                    <p>The active players data is not available in the database.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Bench Tab -->
            <div class="tab-pane" id="bench">
                <?php if ($benchedPlayersExist): ?>
                    <?php
                    // Check if there's a players table
                    $playersTableExists = false;
                    $tablesQuery = "SHOW TABLES LIKE 'players'";
                    $tablesResult = mysqli_query($db, $tablesQuery);
                    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
                        $playersTableExists = true;
                        
                        // Fetch benched players with player names if possible
                        $benchedPlayersQuery = "SELECT bp.*, p.player_name 
                                              FROM benched_players bp
                                              LEFT JOIN players p ON bp.player_id = p.player_id
                                              WHERE bp.match_id = $matchId";
                    } else {
                        // Fetch benched players without joining to players table
                        $benchedPlayersQuery = "SELECT * FROM benched_players WHERE match_id = $matchId";
                    }
                    
                    $benchedPlayersResult = mysqli_query($db, $benchedPlayersQuery);
                    
                    if ($benchedPlayersResult && mysqli_num_rows($benchedPlayersResult) > 0):
                    ?>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Player ID</th>
                                    <?php if ($playersTableExists): ?>
                                    <th>Player Name</th>
                                    <?php endif; ?>
                                    <th>Team ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($player = mysqli_fetch_assoc($benchedPlayersResult)): ?>
                                <tr>
                                    <td><?php echo $player['player_id']; ?></td>
                                    <?php if ($playersTableExists && isset($player['player_name'])): ?>
                                    <td><?php echo $player['player_name']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo isset($player['team_id']) ? $player['team_id'] : 'N/A'; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="no-data">
                        <i class="fas fa-info-circle fa-2x" style="color: var(--primary); margin-bottom: 10px;"></i>
                        <p>No benched players found for this match.</p>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                <div class="no-data">
                    <i class="fas fa-exclamation-triangle fa-2x" style="color: var(--warning); margin-bottom: 10px;"></i>
                    <p>The benched players data is not available in the database.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Events Tab -->
<div class="tab-pane" id="events">
    <?php if ($eventsExist): ?>
        <?php
        // Fetch match events
        $eventsQuery = "SELECT * FROM match_events WHERE match_id = $matchId ORDER BY event_time";
        $eventsResult = mysqli_query($db, $eventsQuery);
        
        if ($eventsResult && mysqli_num_rows($eventsResult) > 0):
        ?>
            <div class="timeline">
                <?php
                $eventCount = 0;
                while ($event = mysqli_fetch_assoc($eventsResult)) {
                    $eventCount++;
                    $eventType = $event['event_type'];
                    $eventIcon = '';
                    
                    switch ($eventType) {
                        case 'Goal':
                            $eventIcon = 'fa-futbol';
                            break;
                        case 'Yellow Card':
                            $eventIcon = 'fa-square text-warning';
                            break;
                        case 'Red Card':
                            $eventIcon = 'fa-square text-danger';
                            break;
                        case 'Substitution':
                            $eventIcon = 'fa-exchange-alt';
                            break;
                        case 'Injury':
                            $eventIcon = 'fa-medkit';
                            break;
                        case 'Penalty':
                            $eventIcon = 'fa-bullseye';
                            break;
                        default:
                            $eventIcon = 'fa-circle';
                    }
                    
                    $isLeft = $eventCount % 2 !== 0;
                    $positionClass = $isLeft ? 'left' : 'right';
                    
                    echo "<div class='timeline-item'>
                            <div class='timeline-content $positionClass'>
                                <span class='timeline-time'>" . $event['event_time'] . "'</span>
                                <div class='timeline-event'>
                                    <i class='fas $eventIcon timeline-icon'></i>
                                    $eventType
                                </div>
                                <div class='timeline-detail'>
                                    Player ID: " . $event['player_id'] . " - Team ID: " . $event['team_id'] . "
                                </div>";
                                
                    if (isset($event['event_description']) && !empty($event['event_description'])) {
                        echo "<div class='timeline-detail'>
                                " . $event['event_description'] . "
                              </div>";
                    }
                    
                    echo "</div></div>";
                }
                ?>
            </div>
        <?php else: ?>
            <div class="no-data">
                <i class="fas fa-info-circle fa-2x" style="color: var(--primary); margin-bottom: 10px;"></i>
                <p>No events recorded for this match yet.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Statistics Tab -->
<div class="tab-pane" id="stats">
    <?php
    // Check if we have any statistics in the database
    $statsTableExists = false;
    $tablesQuery = "SHOW TABLES LIKE 'match_statistics'";
    $tablesResult = mysqli_query($db, $tablesQuery);
    if ($tablesResult && mysqli_num_rows($tablesResult) > 0) {
        $statsTableExists = true;
        
        // Fetch stats if they exist
        $statsQuery = "SELECT * FROM match_statistics WHERE match_id = $matchId";
        $statsResult = mysqli_query($db, $statsQuery);
        
        if ($statsResult && mysqli_num_rows($statsResult) > 0):
            $stats = mysqli_fetch_assoc($statsResult);
    ?>
            <div class="table-responsive" style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>Statistic</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($stats['home_possession']) && isset($stats['away_possession'])): ?>
                        <tr>
                            <td>Possession</td>
                            <td><?php echo $stats['home_possession']; ?>%</td>
                            <td><?php echo $stats['away_possession']; ?>%</td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_shots']) && isset($stats['away_shots'])): ?>
                        <tr>
                            <td>Shots</td>
                            <td><?php echo $stats['home_shots']; ?></td>
                            <td><?php echo $stats['away_shots']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_shots_on_target']) && isset($stats['away_shots_on_target'])): ?>
                        <tr>
                            <td>Shots on Target</td>
                            <td><?php echo $stats['home_shots_on_target']; ?></td>
                            <td><?php echo $stats['away_shots_on_target']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_corners']) && isset($stats['away_corners'])): ?>
                        <tr>
                            <td>Corners</td>
                            <td><?php echo $stats['home_corners']; ?></td>
                            <td><?php echo $stats['away_corners']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_fouls']) && isset($stats['away_fouls'])): ?>
                        <tr>
                            <td>Fouls</td>
                            <td><?php echo $stats['home_fouls']; ?></td>
                            <td><?php echo $stats['away_fouls']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_yellow_cards']) && isset($stats['away_yellow_cards'])): ?>
                        <tr>
                            <td>Yellow Cards</td>
                            <td><?php echo $stats['home_yellow_cards']; ?></td>
                            <td><?php echo $stats['away_yellow_cards']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_red_cards']) && isset($stats['away_red_cards'])): ?>
                        <tr>
                            <td>Red Cards</td>
                            <td><?php echo $stats['home_red_cards']; ?></td>
                            <td><?php echo $stats['away_red_cards']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if (isset($stats['home_offsides']) && isset($stats['away_offsides'])): ?>
                        <tr>
                            <td>Offsides</td>
                            <td><?php echo $stats['home_offsides']; ?></td>
                            <td><?php echo $stats['away_offsides']; ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-data">
                <i class="fas fa-chart-bar fa-2x" style="color: var(--info); margin-bottom: 10px;"></i>
                <p>Match statistics are not available for this match yet.</p>
            </div>
        <?php endif; ?>
    <?php } else { ?>
        <div class="no-data">
            <i class="fas fa-chart-bar fa-2x" style="color: var(--info); margin-bottom: 10px;"></i>
            <p>Match statistics are not available for this match yet.</p>
        </div>
    <?php } ?>
</div>

<!-- Action buttons -->
<div class="btn-container">
    <a href="edit_match.php?id=<?php echo $matchId; ?>" class="btn btn-primary">
        <i class="fas fa-edit"></i> Edit Match
    </a>
    <?php if ($match['full_time'] != 'Yes'): ?>
    <a href="update_score.php?id=<?php echo $matchId; ?>" class="btn btn-secondary">
        <i class="fas fa-futbol"></i> Update Score
    </a>
    <a href="record_event.php?id=<?php echo $matchId; ?>" class="btn btn-secondary">
        <i class="fas fa-plus-circle"></i> Add Event
    </a>
    <?php endif; ?>
    <a href="delete_match.php?id=<?php echo $matchId; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this match? This action cannot be undone.')">
        <i class="fas fa-trash-alt"></i> Delete Match
    </a>
</div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date('Y'); ?> Football Match Manager. All rights reserved.</p>
</footer>

<!-- JavaScript for tab functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all tab panes
                tabPanes.forEach(pane => pane.classList.remove('active'));
                
                // Show the corresponding tab pane
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });
</script>
</body>
</html>