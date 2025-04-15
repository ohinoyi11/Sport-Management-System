<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams Management</title>
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

        /* Team cards grid */
        .teams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .team-card {
            background-color: white;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: 0 0 15px var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .team-card h2 {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light);
        }

        .team-card p {
            color: #555;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }

        .team-card p strong {
            color: var(--dark);
            font-weight: 500;
        }

        .team-card-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .card-btn {
            padding: 8px 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
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

        .card-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        /* Team detail card */
        .team-detail-card {
            display: none;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 25px;
            margin-bottom: 25px;
            position: relative;
        }

        .team-detail-card.active {
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

        .team-detail-card h2 {
            margin-bottom: 20px;
            color: var(--dark);
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .team-detail-grid {
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
        .footer {
            background: linear-gradient(135deg, var(--dark-light) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 5px 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .footer a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .footer p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 10px;
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

            .teams-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
            
            .teams-grid {
                grid-template-columns: 1fr;
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
        <h1>Teams Management</h1>
        <p>View football teams</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <!-- Team detail card (hidden by default) -->
        <div class="team-detail-card" id="teamDetailCard">
            <button class="card-close" onclick="closeTeamDetail()"><i class="fas fa-times"></i></button>
            <h2><i class="fas fa-shield-alt"></i> Team Details</h2>
            <div class="team-detail-grid" id="teamDetailContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>

        <!-- Controls Section -->
        <div class="controls">
            <!-- Search form -->
            <div class="search-form">
                <input type="text" id="searchInput" placeholder="Search teams by name, manager, location...">
                <input type="number" id="teamId" placeholder="Team ID" min="1">
                <button onclick="searchTeamById()" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>

            <div class="action-buttons">
                <div class="filter-dropdown">
                    <button class="filter-btn" onclick="toggleFilter()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <div class="filter-content" id="filterDropdown">
                        <label>Location:
                            <select id="locationFilter">
                                <option value="">All Locations</option>
                                <option value="Manchester">Manchester</option>
                                <option value="London">London</option>
                                <option value="Liverpool">Liverpool</option>
                                <!-- More options would be populated from database -->
                            </select>
                        </label>
                        <label>Players Count:
                            <select id="playersFilter">
                                <option value="">Any</option>
                                <option value="less20">Less than 20</option>
                                <option value="20to30">20 to 30</option>
                                <option value="more30">More than 30</option>
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

        <!-- Teams Grid -->
        <div class="teams-grid">
            <?php
            $db_host = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_database = "fmdb";

            $db = mysqli_connect($db_host, $db_username, $db_password);
            mysqli_select_db($db, $db_database);

            $sql = "SELECT * FROM team;";
            $result = mysqli_query($db, $sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="team-card" data-team-id="<?php echo $row["team_id"]; ?>" data-team-name="<?php echo $row["team_name"]; ?>" data-location="<?php echo $row["location"]; ?>">
                    <h2><?php echo $row["team_name"]; ?></h2>
                    <p><strong>Team ID:</strong> <span><?php echo $row["team_id"]; ?></span></p>
                    <p><strong>Location:</strong> <span><?php echo $row["location"]; ?></span></p>
                    <p><strong>Total Players:</strong> <span><?php echo $row["tot_players"]; ?></span></p>
                    <p><strong>Manager:</strong> <span><?php echo $row["manager"]; ?></span></p>
                    <p><strong>Coach:</strong> <span><?php echo $row["coach"]; ?></span></p>
                    
                    <div class="team-card-actions">
                        <button class="card-btn view-btn" onclick="viewTeam(<?php echo $row["team_id"]; ?>)">
                            <i class="fas fa-eye"></i> View
                        </button>
                        
                    </div>
                    
                    <!-- Hidden div to store full team data -->
                    <div id="team-data-<?php echo $row["team_id"]; ?>" style="display:none;"
                        data-id="<?php echo $row["team_id"]; ?>"
                        data-name="<?php echo $row["team_name"]; ?>"
                        data-location="<?php echo $row["location"]; ?>"
                        data-players="<?php echo $row["tot_players"]; ?>"
                        data-manager="<?php echo $row["manager"]; ?>"
                        data-coach="<?php echo $row["coach"]; ?>"
                    ></div>
                </div>
            <?php
            }
            mysqli_close($db);
            ?>
        </div>

        <!-- Pagination -->
        <div class="pagination" id="pagination">
            <!-- Will be populated by JavaScript -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Variables for pagination
        const teamsPerPage = 9;
        let currentPage = 1;
        let filteredTeams = [];
        
        // Initialize once DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Get all team cards
            const teamCards = document.querySelectorAll('.team-card');
            filteredTeams = Array.from(teamCards);
            
            // Setup pagination
            updatePagination();
            
            // Setup search functionality
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                filterTeams();
            });
        });
        
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
        
        // Apply filters
        function applyFilters() {
            filterTeams();
            document.getElementById("filterDropdown").classList.remove("filter-show");
        }
        
        // Reset filters
        function resetFilters() {
            document.getElementById('locationFilter').value = '';
            document.getElementById('playersFilter').value = '';
            document.getElementById('searchInput').value = '';
            filterTeams();
            document.getElementById("filterDropdown").classList.remove("filter-show");
        }
        
        // Filter teams based on search and dropdown filters
        function filterTeams() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const locationFilter = document.getElementById('locationFilter').value.toLowerCase();
            const playersFilter = document.getElementById('playersFilter').value;
            
            const teamCards = document.querySelectorAll('.team-card');
            
            filteredTeams = Array.from(teamCards).filter(card => {
                const teamName = card.getAttribute('data-team-name').toLowerCase();
                const location = card.getAttribute('data-location').toLowerCase();
                const players = parseInt(card.querySelector('#team-data-' + card.getAttribute('data-team-id')).getAttribute('data-players'));
                
                // Check search term
                const matchesSearch = teamName.includes(searchTerm) || 
                                     location.includes(searchTerm) ||
                                     card.textContent.toLowerCase().includes(searchTerm);
                
                // Check location filter
                const matchesLocation = !locationFilter || location === locationFilter;
                
                // Check players filter
                let matchesPlayers = true;
                if (playersFilter === 'less20') {
                    matchesPlayers = players < 20;
                } else if (playersFilter === '20to30') {
                    matchesPlayers = players >= 20 && players <= 30;
                } else if (playersFilter === 'more30') {
                    matchesPlayers = players > 30;
                }
                
                return matchesSearch && matchesLocation && matchesPlayers;
            });
            
            // Reset to first page and update pagination
            currentPage = 1;
            updatePagination();
        }
        
        // Search team by ID
        function searchTeamById() {
            const teamId = document.getElementById('teamId').value;
            if (teamId) {
                const teamCards = document.querySelectorAll('.team-card');
                
                filteredTeams = Array.from(teamCards).filter(card => {
                    return card.getAttribute('data-team-id') === teamId;
                });
                
                // Reset to first page and update pagination
                currentPage = 1;
                updatePagination();
                
                // If team found, view its details
                if (filteredTeams.length === 1) {
                    viewTeam(teamId);
                }
            }
        }
        
        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredTeams.length / teamsPerPage);
            const paginationContainer = document.getElementById('pagination');
            
            // Clear existing pagination
            paginationContainer.innerHTML = '';
            
            // Add first and previous buttons
            const firstBtn = document.createElement('button');
            firstBtn.innerHTML = '<i class="fas fa-angle-double-left"></i>';
            firstBtn.disabled = currentPage === 1;
            firstBtn.addEventListener('click', () => goToPage(1));
            paginationContainer.appendChild(firstBtn);
            
            const prevBtn = document.createElement('button');
            prevBtn.innerHTML = '<i class="fas fa-angle-left"></i>';
            prevBtn.disabled = currentPage === 1;
            prevBtn.addEventListener('click', () => goToPage(currentPage - 1));
            paginationContainer.appendChild(prevBtn);
            
            // Add page number buttons
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
            
            // Add next and last buttons
            const nextBtn = document.createElement('button');
            nextBtn.innerHTML = '<i class="fas fa-angle-right"></i>';
            nextBtn.disabled = currentPage === totalPages || totalPages === 0;
            nextBtn.addEventListener('click', () => goToPage(currentPage + 1));
            paginationContainer.appendChild(nextBtn);
            
            const lastBtn = document.createElement('button');
            lastBtn.innerHTML = '<i class="fas fa-angle-double-right"></i>';
            lastBtn.disabled = currentPage === totalPages || totalPages === 0;
            lastBtn.addEventListener('click', () => goToPage(totalPages));
            paginationContainer.appendChild(lastBtn);
            
            // Show teams for current page
            showTeamsForCurrentPage();
        }
        
        // Go to specific page
        function goToPage(page) {
            if (page < 1 || page > Math.ceil(filteredTeams.length / teamsPerPage)) {
                return;
            }
            
            currentPage = page;
            updatePagination();
        }
        
        // Show teams for current page
        function showTeamsForCurrentPage() {
            const start = (currentPage - 1) * teamsPerPage;
            const end = start + teamsPerPage;
            
            // Hide all team cards first
            document.querySelectorAll('.team-card').forEach(card => {
                card.style.display = 'none';
            });
            
            // Show only the filtered teams for current page
            filteredTeams.slice(start, end).forEach(card => {
                card.style.display = 'block';
            });
        }
        
        // View team details
        function viewTeam(teamId) {
            const teamData = document.getElementById('team-data-' + teamId);
            const detailCard = document.getElementById('teamDetailCard');
            const detailContent = document.getElementById('teamDetailContent');
            
            // Clear previous content
            detailContent.innerHTML = '';
            
            // Add team details to the card
            const details = [
                { label: 'Team ID', value: teamData.dataset.id },
                { label: 'Name', value: teamData.dataset.name },
                { label: 'Location', value: teamData.dataset.location },
                { label: 'Total Players', value: teamData.dataset.players },
                { label: 'Manager', value: teamData.dataset.manager },
                { label: 'Coach', value: teamData.dataset.coach }
            ];
            
            details.forEach(detail => {
                const detailElement = document.createElement('div');
                detailElement.className = 'detail-item';
                
                const labelElement = document.createElement('div');
                labelElement.className = 'label';
                labelElement.textContent = detail.label;
                
                const valueElement = document.createElement('div');
                valueElement.className = 'value';
                valueElement.textContent = detail.value|| 'N/A';
                
                detailElement.appendChild(labelElement);
                detailElement.appendChild(valueElement);
                detailContent.appendChild(detailElement);
            });}
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