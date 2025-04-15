<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - CUSTECH Sport Team Management</title>
    
    <!-- font awesome integration -->
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
        
        .user-welcome {
            color: #ecf0f1;
            font-size: 16px;
            margin-right: 20px;
        }
        
        .logout-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .logout-btn i {
            margin-right: 8px;
        }
        
        .logout-btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .welcome-banner {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-banner h1 {
            font-size: clamp(24px, 5vw, 36px);
            margin-bottom: 15px;
        }
        
        .welcome-banner p {
            font-size: clamp(16px, 3vw, 18px);
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        /* Stats summary */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            padding: 0 30px;
            margin-bottom: 40px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 20px var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card .stat-icon {
            font-size: 28px;
            width: 60px;
            height: 60px;
            line-height: 60px;
            margin: 0 auto 15px;
            border-radius: 50%;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        }

        .stat-card:nth-child(2) .stat-icon {
            background: linear-gradient(135deg, var(--success-color) 0%, var(--success-dark) 100%);
        }

        .stat-card:nth-child(3) .stat-icon {
            background: linear-gradient(135deg, var(--accent-color) 0%, #c0392b 100%);
        }

        .stat-card:nth-child(4) .stat-icon {
            background: linear-gradient(135deg, var(--warning-color) 0%, var(--warning-dark) 100%);
        }

        .stat-card h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--secondary-color);
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: var(--text-color);
        }
        
        .dashboard-tiles {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            padding: 0 30px;
            max-width: 1200px;
            margin: 0 auto 40px auto;
            width: 100%;
        }
        
        .tile {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .tile:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .tile-image {
            height: 180px;
            position: relative;
            overflow: hidden;
        }
        
        .tile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .tile:hover .tile-image img {
            transform: scale(1.1);
        }
        
        .tile-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .tile:hover .tile-image-overlay {
            opacity: 1;
        }
        
        .tile-content {
            padding: 25px 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .tile-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .tile-description {
            color: #777;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .tile-button {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: auto;
            text-align: center;
            box-shadow: 0 4px 10px rgba(45, 37, 160, 0.3);
        }
        
        .tile-button:hover {
            background: linear-gradient(135deg, #3621d4 0%, #2069a0 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(45, 37, 160, 0.4);
        }
        
        /* Upcoming Matches Section - Fixed and Improved */
        .upcoming-matches {
            max-width: 1200px;
            margin: 0 auto 60px;
            padding: 0 30px;
            width: 100%;
        }
        
        .section-title {
            font-size: clamp(22px, 4vw, 26px);
            color: var(--secondary-color);
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 12px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .match-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .match-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .match-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .match-header {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ef 100%);
            padding: 15px 20px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .match-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }
        
        .match-date {
            font-size: 14px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .match-date i {
            color: var(--accent-color);
        }
        
        .match-content {
            padding: 25px;
        }
        
        .match-teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
        }
        
        .team-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 5px;
            background-color: white;
            border: 1px solid #eaeaea;
        }
        
        .team-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            text-align: center;
        }
        
        .match-vs {
            font-size: 22px;
            font-weight: bold;
            color: var(--accent-color);
            width: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        
        .match-vs::before, 
        .match-vs::after {
            content: '';
            position: absolute;
            height: 1px;
            width: 20px;
            background-color: #ddd;
        }
        
        .match-vs::before {
            left: 5px;
        }
        
        .match-vs::after {
            right: 5px;
        }
        
        .match-details {
            background-color: #f9f9f9;
            padding: 15px 20px;
            border-top: 1px solid #eaeaea;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .match-venue {
            font-size: 14px;
            color: #666;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .match-venue i {
            color: var(--primary-color);
        }
        
        .match-button {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(45, 37, 160, 0.2);
        }
        
        .match-button:hover {
            background-color: #3621d4;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(45, 37, 160, 0.3);
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
            font-size: clamp(12px, 2vw, 14px);
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
        
        @media (max-width: 992px) {
            .dashboard-tiles,
            .stats-container {
                gap: 20px;
            }
            
            .match-list {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
            
            .navbar {
                padding: 15px 20px;
            }
        }
        
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
            
            .logout-btn {
                width: 100%;
                justify-content: center;
            }
            
            .welcome-banner {
                padding: 30px 15px;
            }
            
            .dashboard-tiles, 
            .stats-container,
            .upcoming-matches {
                padding: 0 15px;
            }
            
            .match-teams {
                flex-direction: row;
            }
        }
        
        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            }
            
            .dashboard-tiles {
                grid-template-columns: 1fr;
            }
            
            .match-list {
                grid-template-columns: 1fr;
            }
            
            .match-teams {
                flex-direction: column;
                gap: 20px;
            }
            
            .team {
                width: 100%;
            }
            
            .match-vs {
                width: 100%;
                margin: 10px 0;
            }
            
            .match-vs::before, 
            .match-vs::after {
                width: 60px;
            }
            
            .match-vs::before {
                left: 30px;
            }
            
            .match-vs::after {
                right: 30px;
            }
            
            .match-details {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .match-button {
                width: 100%;
                justify-content: center;
            }
            
            .tile-image {
                height: 160px;
            }
        }
        
        @media (max-width: 400px) {
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }
            
            .stat-card .stat-icon {
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 22px;
            }
            
            .stat-card h3 {
                font-size: 16px;
            }
            
            .stat-card p {
                font-size: 20px;
            }
            
            .user-welcome {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="/api/placeholder/50/50" alt="CUSTECH Logo">
            <div class="logo-text">
                <i class="fas fa-running"></i>
                <span>CUSTECH Sports</span>
            </div>
        </div>
        
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul class="nav-list" id="navList">
            <li class="user-welcome">Welcome, John Doe</li>
            <li><a href="login.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <section class="welcome-banner">
        <h1>Welcome to CUSTECH Sport Team Management</h1>
        <p>Track your favorite teams, players, and matches all in one place</p>
    </section>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-alt"></i></div>
            <h3>Players</h3>
            <p>248</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <h3>Teams</h3>
            <p>16</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-trophy"></i></div>
            <h3>Matches</h3>
            <p>92</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-medal"></i></div>
            <h3>Awards</h3>
            <p>35</p>
        </div>
    </div>

    <div class="dashboard-tiles">
        <div class="tile">
            <div class="tile-image">
                <img src="/api/placeholder/400/200" alt="Players">
                <div class="tile-image-overlay">
                    <i class="fas fa-search-plus fa-2x" style="color: white;"></i>
                </div>
            </div>
            <div class="tile-content">
                <div>
                    <h3 class="tile-title">Players</h3>
                    <p class="tile-description">View player profiles, statistics, performance data, and career highlights.</p>
                </div>
                <a href="player_user.php" class="tile-button"><i class="fas fa-user-alt"></i> View Players</a>
            </div>
        </div>

        <div class="tile">
            <div class="tile-image">
                <img src="/api/placeholder/400/200" alt="Matches">
                <div class="tile-image-overlay">
                    <i class="fas fa-search-plus fa-2x" style="color: white;"></i>
                </div>
            </div>
            <div class="tile-content">
                <div>
                    <h3 class="tile-title">Matches</h3>
                    <p class="tile-description">Access match schedules, results, detailed match statistics, and highlights.</p>
                </div>
                <a href="match_user.php" class="tile-button"><i class="fas fa-trophy"></i> View Matches</a>
            </div>
        </div>

        <div class="tile">
            <div class="tile-image">
                <img src="/api/placeholder/400/200" alt="Teams">
                <div class="tile-image-overlay">
                    <i class="fas fa-search-plus fa-2x" style="color: white;"></i>
                </div>
            </div>
            <div class="tile-content">
                <div>
                    <h3 class="tile-title">Teams</h3>
                    <p class="tile-description">Explore team compositions, rankings, historical performance, and team news.</p>
                </div>
                <a href="team_user.php" class="tile-button"><i class="fas fa-users"></i> View Teams</a>
            </div>
        </div>

        <div class="tile">
            <div class="tile-image">
                <img src="/api/placeholder/400/200" alt="Player of the Match">
                <div class="tile-image-overlay">
                    <i class="fas fa-search-plus fa-2x" style="color: white;"></i>
                </div>
            </div>
            <div class="tile-content">
                <div>
                    <h3 class="tile-title">Man of the Match</h3>
                    <p class="tile-description">Check out outstanding performances and award winners from each match.</p>
                </div>
                <a href="player_of_the_match_user.php" class="tile-button"><i class="fas fa-medal"></i> View Awards</a>
            </div>
        </div>
    </div>

    <!-- Improved Upcoming Matches Section -->
    <section class="upcoming-matches">
        <h2 class="section-title">Upcoming Matches</h2>
        <div class="match-list">
            <div class="match-card">
                <div class="match-header">
                    <h3 class="match-title">Premier League - Round 24</h3>
                    <div class="match-date">
                        <i class="far fa-calendar-alt"></i> April 18, 2025 • 15:00
                    </div>
                </div>
                <div class="match-content">
                    <div class="match-teams">
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Red Dragons" class="team-logo">
                            <span class="team-name">Red Dragons</span>
                        </div>
                        <div class="match-vs">VS</div>
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Blue Eagles" class="team-logo">
                            <span class="team-name">Blue Eagles</span>
                        </div>
                    </div>
                </div>
                <div class="match-details">
                    <div class="match-venue">
                        <i class="fas fa-map-marker-alt"></i> CUSTECH Main Stadium
                    </div>
                    <a href="#" class="match-button">
                        <i class="fas fa-info-circle"></i> Match Details
                    </a>
                </div>
            </div>
            
            <div class="match-card">
                <div class="match-header">
                    <h3 class="match-title">Cup Quarter-Final</h3>
                    <div class="match-date">
                        <i class="far fa-calendar-alt"></i> April 22, 2025 • 19:30
                    </div>
                </div>
                <div class="match-content">
                    <div class="match-teams">
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Green Tigers" class="team-logo">
                            <span class="team-name">Green Tigers</span>
                        </div>
                        <div class="match-vs">VS</div>
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Yellow Lions" class="team-logo">
                            <span class="team-name">Yellow Lions</span>
                        </div>
                    </div>
                </div>
                <div class="match-details">
                    <div class="match-venue">
                        <i class="fas fa-map-marker-alt"></i> East Wing Field
                    </div>
                    <a href="#" class="match-button">
                        <i class="fas fa-info-circle"></i> Match Details
                    </a>
                </div>
            </div>
            
            <div class="match-card">
                <div class="match-header">
                    <h3 class="match-title">League Championship</h3>
                    <div class="match-date">
                        <i class="far fa-calendar-alt"></i> April 25, 2025 • 18:00
                    </div>
                </div>
                <div class="match-content">
                    <div class="match-teams">
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Purple Hawks" class="team-logo">
                            <span class="team-name">Purple Hawks</span>
                        </div>
                        <div class="match-vs">VS</div>
                        <div class="team">
                            <img src="/api/placeholder/70/70" alt="Orange Stars" class="team-logo">
                            <span class="team-name">Orange Stars</span>
                        </div>
                    </div>
                </div>
                <div class="match-details">
                    <div class="match-venue">
                        <i class="fas fa-map-marker-alt"></i> South Campus Arena
                    </div>
                    <a href="#" class="match-button">
                        <i class="fas fa-info-circle"></i> Match Details
                    </a>
                </div>
            </div>
        </div>
    </section>

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
                icon.classList.remove('