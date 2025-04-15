<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player of the Match</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2d25a0;
            --primary-dark: #2980b9;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --light-color: #f9f9f9;
            --accent-color: #e02c6d;
            --success-color: #2ecc71;
            --success-dark: #27ae60;
            --warning-color: #f39c12;
            --warning-dark: #d35400;
            --shadow: rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #34495e 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            flex-wrap: wrap;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        
        .logo-text {
            color: white;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .logo-text i {
            margin-right: 10px;
            font-size: 28px;
        }
        
        .nav-list {
            display: flex;
            align-items: center;
            list-style: none;
        }
        
        .nav-list li {
            margin-left: 20px;
        }
        
        .nav-list li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .nav-list li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #7ed6df;
        }
        
        /* Page header */
        .page-header {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .page-header h1 {
            font-size: clamp(24px, 5vw, 36px);
            margin-bottom: 15px;
        }
        
        .page-header p {
            font-size: clamp(16px, 3vw, 18px);
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        /* Table styles */
        .table-container {
            max-width: 800px;
            margin: 0 auto 60px;
            padding: 0 20px;
            width: 100%;
        }
        
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        
        .styled-table thead tr {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            text-align: left;
        }
        
        .styled-table th {
            padding: 18px 15px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .styled-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 16px;
            text-align: left;
            color: var(--text-color);
        }
        
        .styled-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .styled-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .styled-table tbody tr:hover {
            background-color: #f9f9f9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        /* Player highlight */
        .player-name {
            font-weight: 600;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
        }
        
        .player-name i {
            color: var(--warning-color);
            margin-right: 8px;
        }
        
        .match-id {
            font-weight: 500;
            color: #666;
        }
        
        /* Footer */
        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
        
        .footer p {
            margin: 0;
            font-size: 14px;
        }
        
        /* Mobile menu button */
        .menu-toggle {
            display: none;
            font-size: 24px;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px;
                position: relative;
            }
            
            .menu-toggle {
                display: block;
                position: absolute;
                right: 15px;
                top: 20px;
            }
            
            .logo {
                margin-bottom: 0;
            }
            
            .logo-text span {
                font-size: 20px;
            }
            
            .nav-list {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                overflow: hidden;
                max-height: 0;
                transition: max-height 0.3s ease;
            }
            
            .nav-list.active {
                max-height: 200px;
                margin-top: 15px;
            }
            
            .nav-list li {
                margin: 8px 0;
                width: 100%;
            }
            
            .page-header {
                padding: 30px 15px;
            }
            
            .table-container {
                padding: 0 15px;
            }
            
            .styled-table th,
            .styled-table td {
                padding: 12px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="/api/placeholder/45/45" alt="CUSTECH Logo">
            <div class="logo-text">
                <i class="fas fa-trophy"></i>
                <span>CUSTECH Sports</span>
            </div>
        </div>
        
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="nav-list" id="navList">
            <li><a href="adminhome.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="player_user.php"><i class="fas fa-user-alt"></i> Players</a></li>
            <li><a href="match_user.php"><i class="fas fa-futbol"></i> Matches</a></li>
            <li><a href="team_user.php"><i class="fas fa-users"></i> Teams</a></li>
        </ul>
    </nav>

    <section class="page-header">
        <h1>Player of the Match</h1>
        <p>Recognizing outstanding performances in each match</p>
    </section>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Player of the Match</th>
                    <th>Match ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $db_host = "localhost";
                $db_username = "root";
                $db_password = "";
                $db_database = "fmdb";

                // Establishing connection
                $db = mysqli_connect($db_host, $db_username, $db_password, $db_database);

                // Check connection
                if (!$db) {
                    die("<tr><td colspan='2'>Connection failed: " . mysqli_connect_error() . "</td></tr>");
                }

                // Query to fetch player of the match based on max goals
                $sql = "SELECT player_name, match_id FROM active_player WHERE goals_scored = (SELECT MAX(goals_scored) FROM active_player) GROUP BY match_id";

                // Execute the query and check for errors
                if ($result = mysqli_query($db, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td class='player-name'><i class='fas fa-medal'></i> " . $row["player_name"] . "</td>
                                <td class='match-id'>" . $row["match_id"] . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No records found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Error executing query: " . mysqli_error($db) . "</td></tr>";
                }

                // Close connection
                mysqli_close($db);
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>Copyright © 2025 CUSTECH Sport Team Management • All Rights Reserved</p>
    </footer>

    <script>
        // Mobile menu toggle functionality
        const menuToggle = document.getElementById('menuToggle');
        const navList = document.getElementById('navList');
        
        menuToggle.addEventListener('click', function() {
            navList.classList.toggle('active');
            // Change icon based on menu state
            const icon = menuToggle.querySelector('i');
            if (navList.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
</body>

</html>