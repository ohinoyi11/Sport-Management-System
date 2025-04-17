<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Events</title>
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

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo img {
            height: 60px;
            border-radius: var(--border-radius);
        }

        /* Navbar */
        nav {
            background: var(--dark-light);
            padding: 12px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            margin: 0 12px;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        nav a:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
        }

        nav i {
            font-size: 14px;
        }

        /* Main container */
        .container {
            width: 95%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 25px;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
            flex: 1;
        }

        /* Table styles */
        .table-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 600;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .styled-table thead tr {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            text-align: left;
            font-weight: 600;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            transition: var(--transition);
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f4f6f9;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid var(--primary);
        }

        .styled-table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        /* Button styles */
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-size: 1rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 6px 12px rgba(46, 204, 113, 0.4);
            transform: translateY(-2px);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin: 20px 0;
        }

        /* No data message */
        .no-data {
            text-align: center;
            padding: 30px;
            color: var(--dark-light);
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        footer .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        footer a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 5px 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        footer a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            .table-title {
                font-size: 1.5rem;
            }
            
            .styled-table {
                display: block;
                overflow-x: auto;
            }

            .btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="match.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Matches
        </a>
  
        <h1>Match Events</h1>
        <p>View all events for this match</p>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="adminhome.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="match.php"><i class="fas fa-futbol"></i> Matches</a>
        <a href="input_timing.html"><i class="fas fa-plus-circle"></i> Add New Event</a>
    </nav>

    <!-- Main content -->
    <div class="container">
        <h2 class="table-title">
            <i class="fas fa-clipboard-list"></i> Match Events
        </h2>
        
        <div class="actions">
            <a href="input_timing.html" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Event
            </a>
        </div>
        
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Match ID</th>
                    <th>Event ID</th>
                    <th>Event</th>
                    <th>Player</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db_host = "localhost";
                $db_username = "root";
                $db_password = "";
                $db_database = "fmdb";

                $db = mysqli_connect($db_host, $db_username, $db_password);
                mysqli_select_db($db, $db_database);

                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $timing = $_POST["timing"];
                } else if(isset($_GET["id"])) {
                    $timing = $_GET["id"];
                } else {
                    echo "<tr><td colspan='6' class='no-data'>No match ID specified</td></tr>";
                    exit;
                }
                    
                $sql = "SELECT * FROM timing WHERE match_id=" . $timing;
                ($result = mysqli_query($db, $sql));

                if(mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>" . $row["match_id"] . "</td>
                                <td>" . $row["event_id"] . "</td>
                                <td>" . $row["event"] . "</td>
                                <td>" . $row["player_name"] . "</td>
                                <td>" . $row["time"] . "</td>
                                <td>
                                    <a href='edit_event.php?id=" . $row["event_id"] . "' title='Edit' style='color: var(--primary); margin-right: 10px;'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                    <a href='delete_event.php?id=" . $row["event_id"] . "' title='Delete' style='color: var(--danger);' 
                                       onclick='return confirm(\"Are you sure you want to delete this event?\");'>
                                        <i class='fas fa-trash-alt'></i>
                                    </a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-data'>No events found for this match</td></tr>";
                }
                
                mysqli_close($db);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="adminhome.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="match.php"><i class="fas fa-futbol"></i> Matches</a>
            <a href="input_timing.html"><i class="fas fa-plus-circle"></i> Add New Event</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>
</body>
</html>