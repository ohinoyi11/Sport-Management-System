<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2d25a0;
            --primary-dark: #2980b9;
            --secondary: #e02c6d;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --danger-dark: #c0392b;
            --shadow: rgba(0, 0, 0, 0.1);
            --card-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--dark) 0%, #34495e 100%);
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .logo img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .navbar .logo span {
            color: white;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .navbar .nav-list {
            list-style: none;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navbar .welcome {
            color: #ecf0f1;
            font-size: 16px;
            margin-right: 20px;
        }

        .navbar .logout-btn {
            font-size: 16px;
            color: #fff;
            background-color: var(--danger);
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar .logout-btn:hover {
            background-color: var(--danger-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Dashboard header */
        .dashboard-header {
            text-align: center;
            padding: 40px 20px 20px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .dashboard-header p {
            font-size: 16px;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Stats summary */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 0 30px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .stat-card:nth-child(2) .stat-icon {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        }

        .stat-card:nth-child(3) .stat-icon {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .stat-card:nth-child(4) .stat-icon {
            background: linear-gradient(135deg, #f39c12 0%, #d35400 100%);
        }

        .stat-card h3 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #34495e;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Grid layout for the main menu items */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 0 30px;
            margin-bottom: 50px;
        }

        .menu-item {
            background-color: white;
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: 0 4px 15px var(--shadow);
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .menu-item .item-image {
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .menu-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .menu-item:hover img {
            transform: scale(1.1);
        }

        .menu-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            opacity: 0.7;
        }

        .menu-item .item-content {
            padding: 20px;
            text-align: center;
        }

        .menu-item h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #2c3e50;
            font-weight: 600;
        }

        .menu-item p {
            color: #7f8c8d;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .menu-item .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .menu-item .btn:hover {
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
            transform: translateY(-3px);
        }

        /* Footer styles */
        footer {
            background-color: var(--dark);
            color: var(--light);
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer p {
            font-size: 14px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }
            
            .navbar .nav-list {
                margin-top: 15px;
            }
            
            .dashboard-header {
                padding: 30px 15px 15px;
            }
            
            .dashboard-header h1 {
                font-size: 26px;
            }
            
            .stats-container,
            .menu-container {
                padding: 0 15px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="./images/logo.png" alt="Logo">
            <span>Sports Manager</span>
        </div>
        <ul class="nav-list">
            <li class="welcome">Welcome, Admin</li>
            <li><a href="login.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Manage your sports organization from one central location</p>
    </div>

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

    <div class="menu-container">
        <div class="menu-item">
            <div class="item-image">
                <img src="./images/players/player-1.png" alt="Players">
                <div class="overlay"></div>
            </div>
            <div class="item-content">
                <h3>Player Management</h3>
                <p>Add, edit, or remove players. View player statistics and performance history.</p>
                <a href="player.php" class="btn"><i class="fas fa-user-alt"></i> Manage Players</a>
            </div>
        </div>
        
        <div class="menu-item">
            <div class="item-image">
                <img src="./images/match.png" alt="Matches">
                <div class="overlay"></div>
            </div>
            <div class="item-content">
                <h3>Match Administration</h3>
                <p>Schedule new matches, update scores, and manage match details.</p>
                <a href="match.php" class="btn"><i class="fas fa-trophy"></i> Manage Matches</a>
            </div>
        </div>
        
        <div class="menu-item">
            <div class="item-image">
                <img src="./images/Logo.png" alt="Teams">
                <div class="overlay"></div>
            </div>
            <div class="item-content">
                <h3>Team Organization</h3>
                <p>Create and manage teams, assign players, and track team performance.</p>
                <a href="team.php" class="btn"><i class="fas fa-users"></i> Manage Teams</a>
            </div>
        </div>
        
        
    </div>

    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>
</body>
</html>