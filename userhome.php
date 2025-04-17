<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - CUSTECH Sport Team Management</title>
    
    <!-- Font Awesome + Alpine.js for interactivity -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    
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
        
        /* Simplified navbar with dark gradient */
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
        
        .nav-list a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .nav-list a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #7ed6df;
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
        
        /* Main content sections */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }
        
        /* Banner section */
        .welcome-banner {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/1200/200') center/cover;
            opacity: 0.1;
        }
        
        .welcome-banner h1 {
            font-size: clamp(22px, 5vw, 32px);
            margin-bottom: 15px;
            position: relative;
        }
        
        .welcome-banner p {
            font-size: clamp(16px, 3vw, 18px);
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
            position: relative;
        }
        
        /* Stats section */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
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
        
        .stat-icon {
            font-size: 26px;
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
        
        /* Dashboard tiles */
        .dashboard-tiles {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
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
            transform: translateY(-8px);
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
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .tile-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 12px;
        }
        
        .tile-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .tile-button {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 12px 15px;
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
        
        /* Section headers */
        .section-title {
            font-size: clamp(20px, 4vw, 24px);
            color: var(--secondary-color);
            margin-bottom: 25px;
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
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        /* Tabs system */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .tab-btn {
            background: white;
            color: var(--secondary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .tab-btn.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(45, 37, 160, 0.3);
        }
        
        .tab-btn:hover:not(.active) {
            background: #f0f0f0;
            transform: translateY(-2px);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Match cards */
        .match-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
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
        
        .match-content {
            padding: 20px;
        }
        
        .match-teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
        }
        
        .team-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
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
            font-size: 20px;
            font-weight: bold;
            color: var(--accent-color);
            width: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        
        .match-details {
            background-color: #f9f9f9;
            padding: 12px 20px;
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
        
        .match-button {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 16px;
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
        
        /* Live score section */
        .live-scores {
            background-color: var(--primary-color);
            padding: 15px 0;
            overflow: hidden;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .score-ticker {
            display: flex;
            gap: 30px;
            animation: scrollScores 30s linear infinite;
            white-space: nowrap;
        }
        
        @keyframes scrollScores {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        
        .score-item {
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }
        
        .live-badge {
            background-color: var(--accent-color);
            color: white;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 10px;
            margin-right: 8px;
        }
        
        /* News section */
        .news-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .news-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        
        .news-image {
            height: 180px;
            overflow: hidden;
        }
        
        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .news-card:hover .news-image img {
            transform: scale(1.1);
        }
        
        .news-content {
            padding: 20px;
        }
        
        .news-date {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .news-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--secondary-color);
        }
        
        .news-excerpt {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .read-more {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        
        .read-more:hover {
            color: var(--primary-dark);
            gap: 8px;
        }
        
        /* Footer */
        .footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 20px;
            margin-top: auto;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            transform: translateY(-3px);
            color: #7ed6df;
        }
        
        /* Notification badge */
        .notification-badge {
            position: relative;
        }
        
        .notification-badge .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* User menu dropdown */
        .user-menu {
            position: relative;
        }
        
        .user-menu-button {
            background: none;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        .user-menu-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-menu-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 200px;
            overflow: hidden;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .user-menu.active .user-menu-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(5px);
        }
        
        .user-menu-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .user-menu-dropdown a:hover {
            background-color: #f5f5f5;
            color: var(--primary-color);
        }
        
        .user-menu-divider {
            height: 1px;
            background-color: #eaeaea;
            margin: 5px 0;
        }
        
        /* Mobile menu */
        .menu-toggle {
            display: none;
            font-size: 24px;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .container {
                padding: 0 15px;
            }
            
            .stats-container,
            .dashboard-tiles,
            .match-cards,
            .news-list {
                gap: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 15px;
                position: relative;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .nav-list {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--secondary-color);
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .nav-list.active {
                max-height: 300px;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            
            .nav-list li {
                margin: 10px 0;
                width: 100%;
            }
            
            .nav-list a {
                width: 100%;
                display: block;
            }
            
            .user-welcome {
                margin-right: 0;
            }
            
            .logout-btn {
                width: 100%;
                justify-content: center;
            }
            
            .user-menu-dropdown {
                position: static;
                box-shadow: none;
                width: 100%;
                margin-top: 10px;
                border-radius: 5px;
                transition: none;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
            
            .tab-btn {
                padding: 8px 15px;
                font-size: 14px;
            }
            
            .match-details {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            
            .match-button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body x-data="{
    mobileMenuOpen: false,
    userMenuOpen: false,
    activeTab: 'upcoming',
    notificationCount: 5,
    toggleMobileMenu() {
        this.mobileMenuOpen = !this.mobileMenuOpen;
        this.userMenuOpen = false;
    },
    toggleUserMenu() {
        this.userMenuOpen = !this.userMenuOpen;
    },
    setActiveTab(tab) {
        this.activeTab = tab;
    }
}">
    <nav class="navbar">
        <div class="logo">
            <img src="./images/Logo.png" alt="CUSTECH Logo">
            <div class="logo-text">
                <i class="fas fa-running"></i>
                <span>CUSTECH Sports</span>
            </div>
        </div>
        
        <button class="menu-toggle" @click="toggleMobileMenu">
            <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>
        
        <ul class="nav-list" :class="{'active': mobileMenuOpen}">
            <li>
                <a href="userhome.php" class="active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-calendar-alt"></i> Schedule
                </a>
            </li>
            <li class="notification-badge">
                <a href="#">
                    <i class="fas fa-bell"></i> Notifications
                    <span class="badge">5</span>
                </a>
            </li>
            <li class="user-menu" :class="{'active': userMenuOpen}">
                <button class="user-menu-button" @click="toggleUserMenu">
                    <img src="./images/Logo.png" alt="User" class="user-avatar">
                    <span>Abdulwahid</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu-dropdown">
                    <a href="#">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                    <a href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <div class="user-menu-divider"></div>
                    <a href="login.php" class="text-red-500">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <section class="welcome-banner">
        <h1>Welcome to CUSTECH Sport Team Management</h1>
        <p>Track your favorite teams, players, and matches all in one place</p>
    </section>

    <div class="container">
        <!-- Live scores ticker -->
        <div class="live-scores">
            <div class="score-ticker">
                <div class="score-item">
                    <span class="live-badge
                    <span class="live-badge">LIVE</span>
                    <span>Red Dragons 2 - 1 Blue Eagles</span>
                </div>
                <div class="score-item">
                    <span class="live-badge">LIVE</span>
                    <span>Green Tigers 0 - 0 Yellow Lions</span>
                </div>
                <div class="score-item">
                    <span class="live-badge">LIVE</span>
                    <span>Purple Hawks 3 - 2 Orange Stars</span>
                </div>
                <div class="score-item">
                    <span class="live-badge">LIVE</span>
                    <span>Black Panthers 1 - 1 White Wolves</span>
                </div>
                <div class="score-item">
                    <span class="live-badge">LIVE</span>
                    <span>Silver Knights 2 - 0 Golden Eagles</span>
                </div>
            </div>
        </div>

        <!-- Stats summary -->
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

        <!-- Main dashboard tiles -->
        <div class="dashboard-tiles">
            <div class="tile">
                <div class="tile-image">
                    <img src="./images/players/player-1.png" alt="Players">
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
                    <img src="./images/match.png" alt="Matches">
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
                    <img src="./images/Logo.png" alt="Teams">
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

    
        </div>

        <!-- Tab system for matches and news -->
        <div class="tabs">
            <button class="tab-btn" :class="{'active': activeTab === 'upcoming'}" @click="setActiveTab('upcoming')">
                <i class="fas fa-calendar-alt"></i> Upcoming Matches
            </button>
            <button class="tab-btn" :class="{'active': activeTab === 'recent'}" @click="setActiveTab('recent')">
                <i class="fas fa-history"></i> Recent Results
            </button>
            <button class="tab-btn" :class="{'active': activeTab === 'news'}" @click="setActiveTab('news')">
                <i class="fas fa-newspaper"></i> Latest News
            </button>
        </div>

        <!-- Upcoming Matches Tab Content -->
        <div class="tab-content" :class="{'active': activeTab === 'upcoming'}">
            <div class="match-cards">
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
                                <img src="./images/Logo.png" alt="Red Dragons" class="team-logo">
                                <span class="team-name">Red Dragons</span>
                            </div>
                            <div class="match-vs">VS</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="Blue Eagles" class="team-logo">
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
                                <img src="./images/Logo.png" alt="Green Tigers" class="team-logo">
                                <span class="team-name">Green Tigers</span>
                            </div>
                            <div class="match-vs">VS</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="Yellow Lions" class="team-logo">
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
                                <img src="./images/Logo.png" alt="Purple Hawks" class="team-logo">
                                <span class="team-name">Purple Hawks</span>
                            </div>
                            <div class="match-vs">VS</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="Orange Stars" class="team-logo">
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
        </div>

        <!-- Recent Results Tab Content -->
        <div class="tab-content" :class="{'active': activeTab === 'recent'}">
            <div class="match-cards">
                <div class="match-card">
                    <div class="match-header">
                        <h3 class="match-title">Premier League - Round 23</h3>
                        <div class="match-date">
                            <i class="far fa-calendar-alt"></i> April 12, 2025 • 15:00
                        </div>
                    </div>
                    <div class="match-content">
                        <div class="match-teams">
                            <div class="team">
                                <img src="./images/Logo.png" alt="Black Panthers" class="team-logo">
                                <span class="team-name">Black Panthers</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">3</div>
                            </div>
                            <div class="match-vs">-</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="White Wolves" class="team-logo">
                                <span class="team-name">White Wolves</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">1</div>
                            </div>
                        </div>
                    </div>
                    <div class="match-details">
                        <div class="match-venue">
                            <i class="fas fa-map-marker-alt"></i> North Campus Field
                        </div>
                        <a href="#" class="match-button">
                            <i class="fas fa-chart-bar"></i> Match Stats
                        </a>
                    </div>
                </div>
                
                <div class="match-card">
                    <div class="match-header">
                        <h3 class="match-title">Cup Round of 16</h3>
                        <div class="match-date">
                            <i class="far fa-calendar-alt"></i> April 10, 2025 • 19:30
                        </div>
                    </div>
                    <div class="match-content">
                        <div class="match-teams">
                            <div class="team">
                                <img src="./images/Logo.png" alt="Silver Knights" class="team-logo">
                                <span class="team-name">Silver Knights</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">2</div>
                            </div>
                            <div class="match-vs">-</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="Golden Eagles" class="team-logo">
                                <span class="team-name">Golden Eagles</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">2</div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 10px; font-size: 14px; color: #666;">
                            Silver Knights won 5-4 on penalties
                        </div>
                    </div>
                    <div class="match-details">
                        <div class="match-venue">
                            <i class="fas fa-map-marker-alt"></i> CUSTECH Main Stadium
                        </div>
                        <a href="#" class="match-button">
                            <i class="fas fa-chart-bar"></i> Match Stats
                        </a>
                    </div>
                </div>
                
                <div class="match-card">
                    <div class="match-header">
                        <h3 class="match-title">Premier League - Round 22</h3>
                        <div class="match-date">
                            <i class="far fa-calendar-alt"></i> April 5, 2025 • 16:30
                        </div>
                    </div>
                    <div class="match-content">
                        <div class="match-teams">
                            <div class="team">
                                <img src="./images/Logo.png" alt="Red Dragons" class="team-logo">
                                <span class="team-name">Red Dragons</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">2</div>
                            </div>
                            <div class="match-vs">-</div>
                            <div class="team">
                                <img src="./images/Logo.png" alt="Purple Hawks" class="team-logo">
                                <span class="team-name">Purple Hawks</span>
                                <div style="font-size: 20px; font-weight: bold; color: var(--accent-color);">0</div>
                            </div>
                        </div>
                    </div>
                    <div class="match-details">
                        <div class="match-venue">
                            <i class="fas fa-map-marker-alt"></i> East Wing Field
                        </div>
                        <a href="#" class="match-button">
                            <i class="fas fa-chart-bar"></i> Match Stats
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Tab Content -->
        <div class="tab-content" :class="{'active': activeTab === 'news'}">
            <div class="news-list">
                <div class="news-card">
                    <div class="news-image">
                        <img src="./images/Logo.png" alt="News 1">
                    </div>
                    <div class="news-content">
                        <div class="news-date">April 15, 2025</div>
                        <h3 class="news-title">Red Dragons Secure Five New Players in Spring Transfer Window</h3>
                        <p class="news-excerpt">Red Dragons FC have announced the signing of five new players ahead of the crucial final matches of the season, including star midfielder James Rodriguez...</p>
                        <a href="#" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="news-card">
                    <div class="news-image">
                        <img src="./images/Logo.png" alt="News 2">
                    </div>
                    <div class="news-content">
                        <div class="news-date">April 13, 2025</div>
                        <h3 class="news-title">CUSTECH Athletics Tournament Kicks Off Next Month</h3>
                        <p class="news-excerpt">The annual CUSTECH Athletics Tournament is set to begin on May 10th with over 200 student athletes competing in 15 different sports...</p>
                        <a href="#" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="news-card">
                    <div class="news-image">
                        <img src="./images/Logo.png" alt="News 3">
                    </div>
                    <div class="news-content">
                        <div class="news-date">April 11, 2025</div>
                        <h3 class="news-title">Purple Hawks Coach Wins Manager of the Month Award</h3>
                        <p class="news-excerpt">Coach Sarah Williams of the Purple Hawks has been named Manager of the Month after leading her team to five consecutive victories in March...</p>
                        <a href="#" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>Copyright © 2025 CUSTECH Sport Team Management • All Rights Reserved</p>
          
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>