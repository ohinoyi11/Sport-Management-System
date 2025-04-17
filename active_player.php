<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Players</title>
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

        /* Logo */
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo img {
            height: 60px;
            border-radius: var(--border-radius);
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

        /* Controls Section */
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        /* Search form */
        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-form input {
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            font-size: 0.95rem;
            width: 200px;
            transition: var(--transition);
        }

        .search-form input:focus {
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

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 6px 12px rgba(46, 204, 113, 0.4);
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

        table thead tr {
            background-color: var(--primary);
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

        /* Action column */
        .action-cell {
            white-space: nowrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            margin-right: 5px;
            transition: var(--transition);
        }

        .view-btn {
            background-color: var(--info);
            color: white;
        }

        .edit-btn {
            background-color: var(--primary);
            color: white;
        }

        .delete-btn {
            background-color: var(--danger);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
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

        /* Modal for player details */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 700px;
            position: relative;
            animation: modalIn 0.3s ease-out;
        }

        @keyframes modalIn {
            from {opacity: 0; transform: translateY(-30px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 22px;
            color: #777;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--danger);
        }

        .modal-header {
            border-bottom: 2px solid var(--primary);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .controls {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-form, .action-buttons {
                width: 100%;
                justify-content: space-between;
            }

            table {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            nav a {
                margin: 0 5px;
                padding: 6px 10px;
            }
            
            .container {
                padding: 15px;
                width: 100%;
            }
            
            .search-form input {
                width: 100%;
            }
            
            .action-buttons {
                gap: 5px;
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
        <h1>Active Players</h1>
        <p>View and manage player statistics for matches</p>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="input_active_player.html"><i class="fas fa-user-plus"></i> Add Player Stats</a>
        <a href="update_active_player.php"><i class="fas fa-edit"></i> Update Player Stats</a>
        <a href="adminhome.php"><i class="fas fa-home"></i> Dashboard</a>
    </nav>

    <!-- Main content -->
    <div class="container">
        <!-- Controls Section -->
        <div class="controls">
            <!-- Search form -->
            <div class="search-form">
                <form method="POST" action="active_players.php">
                    <input type="number" name="activeplayer" placeholder="Search by Match ID" min="1">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>

            <div class="action-buttons">
                <button class="btn btn-secondary" onclick="window.location.href='input_active_player.html'">
                    <i class="fas fa-plus"></i> Add Player Stats
                </button>
            </div>
        </div>

        <!-- Table with active players -->
        <div class="table-container">
            <table id="activePlayerTable">
                <thead>
                    <tr>
                        <th>Match ID</th>
                        <th>Player ID</th>
                        <th>Team ID</th>
                        <th>Goals</th>
                        <th>Completed Passes</th>
                        <th>Failed Passes</th>
                        <th>Total Attempts</th>
                        <th>Attempts on Target</th>
                        <th>Tackles</th>
                        <th>Yellow Cards</th>
                        <th>Red Card</th>
                        <th>Distance (km)</th>
                        <th>Fouls</th>
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
                        $activeplayer=$_POST["activeplayer"];
                        $sql = "SELECT * FROM active_player where match_id=".$activeplayer."";
                    } else {
                        $sql = "SELECT * FROM active_player";
                    }

                    $result = mysqli_query($db, $sql);

                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <td>" . $row["match_id"] . "</td>
                            <td>" . $row["player_id"] . "</td>
                            <td>" . $row["team_id"] . "</td>
                            <td>" . $row["goals_scored"] . "</td>
                            <td>" . $row["com_passes"] . "</td>
                            <td>" . $row["fail_passes"] . "</td>
                            <td>" . $row["tot_attempts"] . "</td>
                            <td>" . $row["attempts_on_targ"] . "</td>
                            <td>" . $row["tackles"] . "</td>
                            <td>" . $row["yellow_cards"] . "</td>
                            <td>" . $row["red_card"] . "</td>
                            <td>" . $row["distance_ran"] . "</td>
                            <td>" . $row["fouls"] . "</td>
                            <td class='action-cell'>
                                <button class='action-btn view-btn' onclick='viewPlayer(" . $row["match_id"] . ", " . $row["player_id"] . ")'>
                                    <i class='fas fa-eye'></i>
                                </button>
                                <button class='action-btn edit-btn' onclick='editPlayer(" . $row["match_id"] . ", " . $row["player_id"] . ")'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button class='action-btn delete-btn' onclick='deletePlayer(" . $row["match_id"] . ", " . $row["player_id"] . ")'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </td>
                        </tr>";
                        
                        // Store player data in a hidden div for detail view
                        echo "<div id='player-data-" . $row["match_id"] . "-" . $row["player_id"] . "' style='display:none;' 
                            data-match='" . $row["match_id"] . "'
                            data-player='" . $row["player_id"] . "'
                            data-team='" . $row["team_id"] . "'
                            data-goals='" . $row["goals_scored"] . "'
                            data-completed-passes='" . $row["com_passes"] . "'
                            data-failed-passes='" . $row["fail_passes"] . "'
                            data-attempts='" . $row["tot_attempts"] . "'
                            data-on-target='" . $row["attempts_on_targ"] . "'
                            data-tackles='" . $row["tackles"] . "'
                            data-yellows='" . $row["yellow_cards"] . "'
                            data-red='" . $row["red_card"] . "'
                            data-distance='" . $row["distance_ran"] . "'
                            data-fouls='" . $row["fouls"] . "'
                        ></div>";
                    }

                    mysqli_close($db);
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination" id="pagination">
            <!-- Pagination will be populated by JavaScript -->
        </div>
    </div>

    <!-- Player Detail Modal -->
    <div id="playerModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2><i class="fas fa-running"></i> Player Match Statistics</h2>
            </div>
            <div id="modalContent">
                <!-- Player details will be populated here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="input_active_player.html">Add New Player Stats</a>
            <a href="update_active_player.php">Update Player Stats</a>
            <a href="adminhome.php">Dashboard</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Pagination configuration
        const rowsPerPage = 10;
        let currentPage = 1;
        let filteredRows = [];

        // Initialize pagination on document load
        document.addEventListener('DOMContentLoaded', function() {
            initPagination();
        });

        // Function to initialize pagination
        function initPagination() {
            // Get all table rows
            const tableRows = Array.from(document.querySelectorAll('#activePlayerTable tbody tr'));
            filteredRows = tableRows;
            
            // Show the first page
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

        // Function to update pagination display
        function updatePagination() {
            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            const paginationContainer = document.getElementById('pagination');
            
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

        // View player details
        function viewPlayer(matchId, playerId) {
            const playerData = document.getElementById(`player-data-${matchId}-${playerId}`);
            const modalContent = document.getElementById('modalContent');
            
            if (!playerData) {
                console.error(`Player data with Match ID ${matchId} and Player ID ${playerId} not found`);
                return;
            }
            
            // Calculate passing accuracy
            const completedPasses = parseInt(playerData.dataset.completedPasses);
            const failedPasses = parseInt(playerData.dataset.failedPasses);
            const totalPasses = completedPasses + failedPasses;
            const passingAccuracy = totalPasses > 0 ? ((completedPasses / totalPasses) * 100).toFixed(1) : 0;
            
            // Calculate shot accuracy
            const attempts = parseInt(playerData.dataset.attempts);
            const onTarget = parseInt(playerData.dataset.onTarget);
            const shotAccuracy = attempts > 0 ? ((onTarget / attempts) * 100).toFixed(1) : 0;
            
            // Format the content
            modalContent.innerHTML = `
                <div class="form-group">
                    <label>Match ID:</label>
                    <div>${playerData.dataset.match}</div>
                </div>
                <div class="form-group">
                    <label>Player ID:</label>
                    <div>${playerData.dataset.player}</div>
                </div>
                <div class="form-group">
                    <label>Team ID:</label>
                    <div>${playerData.dataset.team}</div>
                </div>
                <div class="form-group">
                    <label>Goals Scored:</label>
                    <div>${playerData.dataset.goals}</div>
                </div>
                <div class="form-group">
                    <label>Passing Statistics:</label>
                    <div>Completed: ${playerData.dataset.completedPasses} | Failed: ${playerData.dataset.failedPasses} | Accuracy: ${passingAccuracy}%</div>
                </div>
                <div class="form-group">
                    <label>Shooting Statistics:</label>
                    <div>Total Attempts: ${playerData.dataset.attempts} | On Target: ${playerData.dataset.onTarget} | Accuracy: ${shotAccuracy}%</div>
                </div>
                <div class="form-group">
                    <label>Defensive Actions:</label>
                    <div>Tackles: ${playerData.dataset.tackles} | Fouls: ${playerData.dataset.fouls}</div>
                </div>
                <div class="form-group">
                    <label>Disciplinary:</label>
                    <div>Yellow Cards: ${playerData.dataset.yellows} | Red Card: ${playerData.dataset.red}</div>
                </div>
                <div class="form-group">
                    <label>Distance Ran:</label>
                    <div>${playerData.dataset.distance} km</div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" onclick="editPlayer(${playerData.dataset.match}, ${playerData.dataset.player})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-secondary" onclick="closeModal()">
                        Close
                    </button>
                </div>
            `;
            
            // Show the modal
            document.getElementById('playerModal').style.display = 'block';
        }

        // Close modal
        function closeModal() {
            document.getElementById('playerModal').style.display = 'none';
        }

        // Edit player stats
        function editPlayer(matchId, playerId) {
            window.location.href = `update_active_player.php?match=${matchId}&player=${playerId}`;
        }

        // Delete player stats
        function deletePlayer(matchId, playerId) {
            if (confirm(`Are you sure you want to delete stats for Player #${playerId} in Match #${matchId}?`)) {
                // In a real implementation, you would send an AJAX request or redirect to a deletion page
                alert(`Stats for Player #${playerId} in Match #${matchId} would be deleted (Note: actual deletion functionality needs to be implemented)`);
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('playerModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>