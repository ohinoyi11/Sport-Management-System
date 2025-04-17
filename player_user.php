<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Management</title>
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
            width: 250px;
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

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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

        /* Card for player details (hidden by default) */
        .player-detail-card {
            display: none;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 25px;
            margin-bottom: 25px;
            position: relative;
        }

        .player-detail-card.active {
            display: block;
        }

        .card-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #777;
            transition: var(--transition);
        }

        .card-close:hover {
            color: var(--danger);
        }

        .player-detail-card h2 {
            margin-bottom: 20px;
            color: var(--dark);
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .player-detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-item .label {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 5px;
        }

        .detail-item .value {
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }

        /* Filter dropdown */
        .filter-dropdown {
            position: relative;
            display: inline-block;
        }

        .filter-btn {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }

        .filter-btn:hover {
            border-color: var(--primary);
        }

        .filter-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            z-index: 100;
            padding: 15px;
            top: 45px;
            right: 0;
        }

        .filter-content label {
            display: block;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .filter-content select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .filter-show {
            display: block;
        }

        .filter-actions {
            display: flex;
            justify-content: space-between;
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
        <a href="userhome.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
        <h1>Player</h1>
        <p>View players information</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <!-- Player detail card (hidden by default) -->
        <div class="player-detail-card" id="playerDetailCard">
            <button class="card-close" onclick="closePlayerDetail()"><i class="fas fa-times"></i></button>
            <h2><i class="fas fa-id-card"></i> Player Details</h2>
            <div class="player-detail-grid" id="playerDetailContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>

        <!-- Controls Section -->
        <div class="controls">
            <!-- Search form -->
            <div class="search-form">
                <input type="text" id="searchInput" placeholder="Search by name, team, position...">
                <input type="number" id="playerid" placeholder="Player ID for contract" min="1">
                <button onclick="viewContract()" class="btn btn-primary">
                    <i class="fas fa-file-contract"></i> View Contract
                </button>
            </div>

            <div class="action-buttons">
                <div class="filter-dropdown">
                    <button class="filter-btn" onclick="toggleFilter()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <div class="filter-content" id="filterDropdown">
                        <label>Team:
                            <select id="teamFilter">
                                <option value="">All Teams</option>
                                <option value="1">Team 1</option>
                                <option value="2">Team 2</option>
                                <!-- More options would be populated from database -->
                            </select>
                        </label>
                        <label>Position:
                            <select id="positionFilter">
                                <option value="">All Positions</option>
                                <option value="Forward">Forward</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Defender">Defender</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                            </select>
                        </label>
                        <div class="filter-actions">
                            <button class="btn btn-secondary" onclick="applyFilters()">Apply</button>
                            <button onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Table with players -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>Date of Birth</th>
                        <th>Nat. Matches</th>
                        <th>Int. Matches</th>
                        <th>Status</th>
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

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $player = $_POST["playerid"];
                        $sql = "SELECT * FROM players WHERE player_id = $player";
                    } else {
                        $sql = "SELECT * FROM players";
                    }

                    $result = mysqli_query($db, $sql);
                    while ($row = $result->fetch_assoc()) {
                        // Create a status indicator based on amateur status
                        $statusClass = $row["amateur"] == 1 ? "Amateur" : "Professional";
                        
                        echo "<tr data-player-id='" . $row["player_id"] . "'>
                                <td>" . $row["player_id"] . "</td>
                                <td>" . $row["player_name"] . "</td>
                                <td>" . $row["team_id"] . "</td>
                                <td>" . $row["position_1"] . "</td>
                                <td>" . $row["date_of_birth"] . "</td>
                                <td>" . $row["num_of_nat_match"] . "</td>
                                <td>" . $row["num_of_int_match"] . "</td>
                                <td>" . $statusClass . "</td>
                                <td class='action-cell'>
                                    <button class='action-btn view-btn' onclick='viewPlayer(" . $row["player_id"] . ")'>
                                        <i class='fas fa-eye'></i>
                                    </button>
            
                                </td>
                              </tr>";
                              
                        // Store full player data in a hidden div for detail view
                        echo "<div id='player-data-" . $row["player_id"] . "' style='display:none;' 
                                data-id='" . $row["player_id"] . "'
                                data-name='" . $row["player_name"] . "'
                                data-team='" . $row["team_id"] . "'
                                data-dob='" . $row["date_of_birth"] . "'
                                data-height='" . $row["height"] . "'
                                data-weight='" . $row["weight"] . "'
                                data-pos1='" . $row["position_1"] . "'
                                data-pos2='" . $row["position_2"] . "'
                                data-nat='" . $row["num_of_nat_match"] . "'
                                data-int='" . $row["num_of_int_match"] . "'
                                data-employment='" . $row["employment"] . "'
                                data-education='" . $row["education"] . "'
                                data-company='" . $row["company"] . "'
                                data-university='" . $row["university"] . "'
                                data-hobbies='" . $row["hobbies"] . "'
                                data-expenses='" . $row["expenses"] . "'
                                data-amateur='" . $row["amateur"] . "'
                              ></div>";
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
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // View contract function
        function viewContract() {
            const playerId = document.getElementById('playerid').value;
            if (playerId) {
                window.location.href = 'contract_user.php?playerid=' + playerId;
            } else {
                alert('Please enter a Player ID to view contract');
            }
        }

        // Toggle filter dropdown
        function toggleFilter() {
            document.getElementById("filterDropdown").classList.toggle("filter-show");
        }

        // Close filter dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.filter-btn') && !event.target.closest('.filter-content')) {
                var dropdowns = document.getElementsByClassName("filter-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('filter-show')) {
                        openDropdown.classList.remove('filter-show');
                    }
                }
            }
        }
// Add this to your existing JavaScript section

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
    
    // Page number buttons - show current page and 2 pages before/after when available
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

// Update filter function to work with pagination
function applyFilters() {
    const teamFilter = document.getElementById('teamFilter').value.toLowerCase();
    const positionFilter = document.getElementById('positionFilter').value.toLowerCase();
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    // Get all table rows
    const tableRows = Array.from(document.querySelectorAll('tbody tr'));
    
    // Apply filters
    filteredRows = tableRows.filter(row => {
        const rowText = row.textContent.toLowerCase();
        const teamCell = row.children[2].textContent.toLowerCase();
        const positionCell = row.children[3].textContent.toLowerCase();
        
        const matchesSearch = rowText.includes(searchTerm);
        const matchesTeam = !teamFilter || teamCell === teamFilter;
        const matchesPosition = !positionFilter || positionCell.includes(positionFilter);
        
        return matchesSearch && matchesTeam && matchesPosition;
    });
    
    // Reset to first page when filters change
    currentPage = 1;
    
    // Update pagination with filtered results
    updatePagination();
    
    // Close the dropdown
    document.getElementById("filterDropdown").classList.remove("filter-show");
}

// Update search function to work with pagination
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    
    // Get all table rows
    const tableRows = Array.from(document.querySelectorAll('tbody tr'));
    
    // Filter rows based on search term
    filteredRows = tableRows.filter(row => {
        const rowText = row.textContent.toLowerCase();
        return rowText.includes(searchTerm);
    });
    
    // Reset to first page when search changes
    currentPage = 1;
    
    // Update pagination with filtered results
    updatePagination();
});

// Reset filters function should reset pagination too
function resetFilters() {
    document.getElementById('teamFilter').value = '';
    document.getElementById('positionFilter').value = '';
    document.getElementById('searchInput').value = '';
    
    // Reset to showing all rows
    const tableRows = Array.from(document.querySelectorAll('tbody tr'));
    filteredRows = tableRows;
    
    // Reset to first page
    currentPage = 1;
    
    // Update pagination
    updatePagination();
    
    // Close the dropdown
    document.getElementById("filterDropdown").classList.remove("filter-show");
}

// Initialize pagination when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initPagination();
});
        // Apply filters
        function applyFilters() {
            const teamFilter = document.getElementById('teamFilter').value;
            const positionFilter = document.getElementById('positionFilter').value;
            
            // Table filtering logic would go here
            console.log(`Filtering by team: ${teamFilter}, position: ${positionFilter}`);
            
            // Close the dropdown
            document.getElementById("filterDropdown").classList.remove("filter-show");
            
            // This is where you'd typically make an AJAX call to refresh the table
            // For demo purposes, we'll just show an alert
            alert(`Filters applied! Team: ${teamFilter || 'All'}, Position: ${positionFilter || 'All'}`);
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('teamFilter').value = '';
            document.getElementById('positionFilter').value = '';
            
            // Reset table logic would go here
            console.log('Filters reset');
            
            // Close the dropdown
            document.getElementById("filterDropdown").classList.remove("filter-show");
        }

        // View player details
        function viewPlayer(playerId) {
            // Get the player data from the hidden div
            const playerData = document.getElementById(`player-data-${playerId}`);
            const detailCard = document.getElementById('playerDetailCard');
            const detailContent = document.getElementById('playerDetailContent');
            
            // Clear previous content
            detailContent.innerHTML = '';
            
            // Add player details to the card
            const details = [
                { label: 'Player ID', value: playerData.dataset.id },
                { label: 'Name', value: playerData.dataset.name },
                { label: 'Team', value: playerData.dataset.team },
                { label: 'Date of Birth', value: playerData.dataset.dob },
                { label: 'Height', value: playerData.dataset.height + ' cm' },
                { label: 'Weight', value: playerData.dataset.weight + ' kg' },
                { label: 'Primary Position', value: playerData.dataset.pos1 },
                { label: 'Secondary Position', value: playerData.dataset.pos2 },
                { label: 'National Matches', value: playerData.dataset.nat },
                { label: 'International Matches', value: playerData.dataset.int },
                { label: 'Employment', value: playerData.dataset.employment },
                { label: 'Education', value: playerData.dataset.education },
                { label: 'Company', value: playerData.dataset.company },
                { label: 'University', value: playerData.dataset.university },
                { label: 'Hobbies', value: playerData.dataset.hobbies },
                { label: 'Expenses', value: '$' + playerData.dataset.expenses },
                { label: 'Status', value: playerData.dataset.amateur == '1' ? 'Amateur' : 'Professional' }
            ];
            
            details.forEach(detail => {
                const detailElement = document.createElement('div');
                detailElement.className = 'detail-item';
                
                const labelElement = document.createElement('div');
                labelElement.className = 'label';
                labelElement.textContent = detail.label;
                
                const valueElement = document.createElement('div');
                valueElement.className = 'value';
                valueElement.textContent = detail.value || 'N/A';
                
                detailElement.appendChild(labelElement);
                detailElement.appendChild(valueElement);
                detailContent.appendChild(detailElement);
            });
            
            // Show the card
            detailCard.classList.add('active');
            
            // Scroll to the top of the container
            window.scrollTo({
                top: detailCard.offsetTop - 100,
                behavior: 'smooth'
            });
        }

        // Close player detail
        function closePlayerDetail() {
            document.getElementById('playerDetailCard').classList.remove('active');
        }

        // Edit player function
        function editPlayer(playerId) {
            window.location.href = `update_player.php?id=${playerId}`;
        }

        // Delete player function
        function deletePlayer(playerId) {
            if (confirm(`Are you sure you want to delete player #${playerId}?`)) {
                window.location.href = `delete_player.php?id=${playerId}`;
            }
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>