<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benched Players</title>
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
            max-width: 1400px;
            margin: 30px auto;
            padding: 25px;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
        }

        /* Search Forms */
        .search-forms {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-form input[type="number"] {
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            font-size: 0.95rem;
            width: 200px;
            transition: var(--transition);
        }

        .search-form input[type="number"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-size: 0.95rem;
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

        /* Table styles */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 0 15px var(--shadow);
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
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        table th:first-child, table td:first-child {
            padding-left: 20px;
        }

        table th:last-child, table td:last-child {
            padding-right: 20px;
        }

        table tbody tr {
            transition: var(--transition);
        }

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #e9f5fe;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
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

        /* Logo */
        .logo {
            margin-bottom: 10px;
            text-align: left;
        }
        
        .logo img {
            height: 50px;
            border-radius: var(--border-radius);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 25px;
            gap: 5px;
        }

        .pagination button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background-color: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .pagination button.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination button:hover:not(.active) {
            background-color: #f8f9fa;
            border-color: #ccc;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .search-forms {
                flex-direction: column;
            }
            
            .search-form {
                width: 100%;
            }

            table {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            .container {
                padding: 15px;
                width: 100%;
            }
            
            .search-form input {
                width: 100%;
            }
            
            .btn {
                padding: 8px 12px;
                font-size: 0.85rem;
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
        <h1>Benched Players</h1>
        <p>View and manage benched players information</p>
    </header>

    <!-- Main content -->
    <div class="container">
       
        <!-- Search Form -->
        <div class="search-forms">
            <form action="benched_player.php" method="POST" class="search-form">
                <input type="number" name="benchedplayer" placeholder="Match ID" required>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search Benched Players
                </button>
            </form>
        </div>

        <!-- Table with benched players -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Player ID</th>
                        <th>Player Name</th>
                        <th>Team ID</th>
                        <th>Match ID</th>
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
                    $benchedplayer=$_POST["benchedplayer"];
                    $sql = "SELECT * FROM active_player where match_id=".$benchedplayer."";
                } else {
                    $sql = "SELECT * FROM benched_player";
                }

                $result = mysqli_query($db, $sql);

                while($row = $result->fetch_assoc()){
                    echo "<tr>
                          <td>" . $row["player_id"] . "</td>
                          <td>" . $row["player_name"] . "</td>
                          <td>" . $row["team_id"] . "</td>
                          <td>" . $row["match_id"] . "</td>
                          </tr>";
                }

                mysqli_close($db);
                ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button><i class="fas fa-angle-double-left"></i></button>
            <button><i class="fas fa-angle-left"></i></button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button><i class="fas fa-angle-right"></i></button>
            <button><i class="fas fa-angle-double-right"></i></button>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="input_benched_player.html"><i class="fas fa-plus-circle"></i> Add New Benched Player</a>
            <a href="match.php"><i class="fas fa-arrow-left"></i> Back to Matches</a>
            <a href="adminhome.php"><i class="fas fa-home"></i> Dashboard</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Pagination configuration
        const rowsPerPage = 10; // Number of players to show per page
        let currentPage = 1;
        let filteredRows = [];

        // Function to initialize pagination
        function initPagination() {
            // Get all table rows (excluding any header rows)
            const tableRows = Array.from(document.querySelectorAll('tbody tr'));
            filteredRows = tableRows; // Initially, all rows are included
            
            // Show the first page
            updatePagination();
        }

        // Function to update pagination display and page content
        function updatePagination() {
            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            const paginationContainer = document.querySelector('.pagination');
            
            // Clear existing pagination buttons
            paginationContainer.innerHTML = '';
            
            // First page button
            const firstBtn = document.createElement('button');
            firstBtn.innerHTML = '<i class="fas fa-angle-double-left"></i>';
            firstBtn.addEventListener('click', () => goToPage(1));
            firstBtn.disabled = currentPage === 1;
            paginationContainer.appendChild(firstBtn);
            
            // Previous page button
            const prevBtn = document.createElement('button');
            prevBtn.innerHTML = '<i class="fas fa-angle-left"></i>';
            prevBtn.addEventListener('click', () => goToPage(currentPage - 1));
            prevBtn.disabled = currentPage === 1;
            paginationContainer.appendChild(prevBtn);
            
            // Page number buttons
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);
            
            // Always show at least 5 pages if available
            if (endPage - startPage < 4 && totalPages > 4) {
                if (currentPage < 3) {
                    endPage = Math.min(5, totalPages);
                } else if (currentPage > totalPages - 2) {
                    startPage = Math.max(1, totalPages - 4);
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                if (i === currentPage) {
                    pageBtn.classList.add('active');
                }
                pageBtn.addEventListener('click', () => goToPage(i));
                paginationContainer.appendChild(pageBtn);
            }
            
            // Next page button
            const nextBtn = document.createElement('button');
            nextBtn.innerHTML = '<i class="fas fa-angle-right"></i>';
            nextBtn.addEventListener('click', () => goToPage(currentPage + 1));
            nextBtn.disabled = currentPage === totalPages || totalPages === 0;
            paginationContainer.appendChild(nextBtn);
            
            // Last page button
            const lastBtn = document.createElement('button');
            lastBtn.innerHTML = '<i class="fas fa-angle-double-right"></i>';
            lastBtn.addEventListener('click', () => goToPage(totalPages));
            lastBtn.disabled = currentPage === totalPages || totalPages === 0;
            paginationContainer.appendChild(lastBtn);
            
            // Show appropriate page content
            showPageContent();
        }

        // Go to specific page
        function goToPage(pageNumber) {
            if (pageNumber < 1 || pageNumber > Math.ceil(filteredRows.length / rowsPerPage)) {
                return;
            }
            
            currentPage = pageNumber;
            updatePagination();
        }

        // Show appropriate content for current page
        function showPageContent() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            
            // Hide all rows first
            filteredRows.forEach(row => {
                row.style.display = 'none';
            });
            
            // Show only rows for current page
            filteredRows.slice(start, end).forEach(row => {
                row.style.display = '';
            });
        }

        // Initialize pagination when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            initPagination();
        });
    </script>
</body>
</html>