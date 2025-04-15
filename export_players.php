<?php
session_start();

// Database connection details
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "fmdb";

// Connect to the database
$db = mysqli_connect($db_host, $db_username, $db_password, $db_database);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize output for CSV
function cleanData($str) {
    // Replace double quotes with two double quotes to escape them
    $str = str_replace('"', '""', $str);
    // If the string contains commas, new lines, or double quotes, enclose it in double quotes
    if (preg_match('/[\,\"\n\r]/', $str)) {
        $str = '"' . $str . '"';
    }
    return $str;
}

// Handle export request
if (isset($_POST['export']) && isset($_POST['format'])) {
    $format = $_POST['format'];
    $team_filter = isset($_POST['team_filter']) ? $_POST['team_filter'] : '';
    $position_filter = isset($_POST['position_filter']) ? $_POST['position_filter'] : '';
    $include_amateurs = isset($_POST['include_amateurs']) ? 1 : 0;
    $include_professionals = isset($_POST['include_professionals']) ? 1 : 0;
    
    // Build the query based on filters
    $sql = "SELECT * FROM players WHERE 1=1";
    
    if (!empty($team_filter)) {
        $sql .= " AND team_id = " . mysqli_real_escape_string($db, $team_filter);
    }
    
    if (!empty($position_filter)) {
        $sql .= " AND (position_1 = '" . mysqli_real_escape_string($db, $position_filter) . "' OR position_2 = '" . mysqli_real_escape_string($db, $position_filter) . "')";
    }
    
    // Handle amateur/professional filter
    if ($include_amateurs && !$include_professionals) {
        $sql .= " AND amateur = 1";
    } elseif (!$include_amateurs && $include_professionals) {
        $sql .= " AND amateur = 0";
    } elseif (!$include_amateurs && !$include_professionals) {
        // If neither is selected, return no results
        $sql .= " AND 1=0";
    }
    
    // Execute the query
    $result = mysqli_query($db, $sql);
    
    if (!$result) {
        $_SESSION['export_error'] = "Error executing query: " . mysqli_error($db);
        header("Location: export_players.php");
        exit;
    }
    
    // Get column names
    $fields = mysqli_fetch_fields($result);
    $columns = array();
    foreach ($fields as $field) {
        $columns[] = $field->name;
    }
    
    // Export based on format
    switch ($format) {
        case 'csv':
            // Set headers for CSV download
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=players_export_' . date('Y-m-d') . '.csv');
            
            // Create output stream
            $output = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add column headers
            fputcsv($output, $columns);
            
            // Add data rows
            while ($row = mysqli_fetch_assoc($result)) {
                // Clean the data
                $clean_row = array_map('cleanData', $row);
                fputcsv($output, $clean_row);
            }
            
            fclose($output);
            exit;
            break;
            
        case 'json':
            // Set headers for JSON download
            header('Content-Type: application/json; charset=utf-8');
            header('Content-Disposition: attachment; filename=players_export_' . date('Y-m-d') . '.json');
            
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
            break;
            
        case 'xml':
            // Set headers for XML download
            header('Content-Type: application/xml; charset=utf-8');
            header('Content-Disposition: attachment; filename=players_export_' . date('Y-m-d') . '.xml');
            
            // Create XML document
            $xml = new DOMDocument('1.0', 'UTF-8');
            $xml->formatOutput = true;
            
            $root = $xml->createElement('players');
            $xml->appendChild($root);
            
            while ($row = mysqli_fetch_assoc($result)) {
                $player = $xml->createElement('player');
                
                foreach ($row as $key => $value) {
                    $element = $xml->createElement($key, htmlspecialchars($value, ENT_XML1));
                    $player->appendChild($element);
                }
                
                $root->appendChild($player);
            }
            
            echo $xml->saveXML();
            exit;
            break;
            
        case 'excel':
            // For Excel, we'll use a CSV with specific headers
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename=players_export_' . date('Y-m-d') . '.xls');
            
            echo "<table border='1'>";
            
            // Header row
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>" . htmlspecialchars($column) . "</th>";
            }
            echo "</tr>";
            
            // Data rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            
            echo "</table>";
            exit;
            break;
            
        default:
            $_SESSION['export_error'] = "Invalid export format selected";
            header("Location: export_players.php");
            exit;
    }
}

// Get teams for dropdown
$teams_query = "SELECT DISTINCT team_id FROM players ORDER BY team_id";
$teams_result = mysqli_query($db, $teams_query);

// Get positions for dropdown
$positions_query = "SELECT DISTINCT position_1 FROM players WHERE position_1 IS NOT NULL AND position_1 != '' 
                   UNION 
                   SELECT DISTINCT position_2 FROM players WHERE position_2 IS NOT NULL AND position_2 != ''
                   ORDER BY position_1";
$positions_result = mysqli_query($db, $positions_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Players Data</title>
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
        }

        /* Card style */
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 0 20px var(--shadow);
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .card-header i {
            font-size: 1.8rem;
            color: var(--primary);
            margin-right: 12px;
        }

        .card-title {
            margin: 0;
            font-size: 1.5rem;
            color: var(--dark);
            font-weight: 600;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-check-input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }

        /* Format selection buttons */
        .format-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .format-option {
            flex: 1;
            min-width: 120px;
            border: 2px solid #ddd;
            border-radius: var(--border-radius);
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .format-option:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .format-option.selected {
            border-color: var(--primary);
            background-color: rgba(52, 152, 219, 0.05);
        }

        .format-option i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }

        .format-csv i { color: var(--secondary); }
        .format-excel i { color: #107C41; }
        .format-json i { color: #F5A623; }
        .format-xml i { color: #8E44AD; }

        .format-name {
            font-weight: 600;
            display: block;
            margin-bottom: 3px;
        }

        .format-desc {
            font-size: 0.8rem;
            color: #777;
        }

        /* Button styling */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Alert messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            color: white;
        }

        .alert-danger {
            background-color: var(--danger);
        }

        .alert-success {
            background-color: var(--secondary);
        }

        /* Preview table */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 0 15px var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        table th, table td {
            padding: 10px 15px;
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

        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
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

        /* Features list */
        .features-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
        }

        .feature-item {
            flex: 1;
            min-width: 250px;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 15px;
            display: flex;
            align-items: flex-start;
        }

        .feature-icon {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .feature-content h3 {
            margin: 0 0 5px 0;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .feature-content p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Two column layout for filters and formats */
        .grid-cols-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            .container {
                width: 100%;
            }
            
            .card {
                padding: 20px;
            }
            
            .format-container {
                gap: 10px;
            }
            
            .format-option {
                padding: 10px;
                min-width: calc(50% - 5px);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="player.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Players
        </a>
        <h1>Player Management</h1>
        <p>Export player data in various formats</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <!-- Export Form Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-file-export"></i>
                <h2 class="card-title">Export Players Data</h2>
            </div>

            <?php if (isset($_SESSION['export_error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['export_error']; unset($_SESSION['export_error']); ?>
                </div>
            <?php endif; ?>

            <!-- Features list -->
            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Flexible Filtering</h3>
                        <p>Filter by team, position, and player status before exporting</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Multiple Formats</h3>
                        <p>Export as CSV, Excel, JSON or XML to suit your needs</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Secure Export</h3>
                        <p>Data is processed securely with proper encoding</p>
                    </div>
                </div>
            </div>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="grid-cols-2">
                    <!-- Filters Section -->
                    <div>
                        <h3><i class="fas fa-filter"></i> Data Filters</h3>
                        <p class="mb-4">Select what data you want to include in the export</p>

                        <div class="form-group">
                            <label for="team_filter">Team</label>
                            <select name="team_filter" id="team_filter" class="form-control">
                                <option value="">All Teams</option>
                                <?php while ($team = mysqli_fetch_assoc($teams_result)): ?>
                                    <option value="<?php echo $team['team_id']; ?>">
                                        Team <?php echo $team['team_id']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="position_filter">Position</label>
                            <select name="position_filter" id="position_filter" class="form-control">
                                <option value="">All Positions</option>
                                <?php while ($position = mysqli_fetch_assoc($positions_result)): ?>
                                    <?php if (!empty($position['position_1'])): ?>
                                        <option value="<?php echo $position['position_1']; ?>">
                                            <?php echo $position['position_1']; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Player Status</label>
                            <div class="form-check">
                                <input type="checkbox" name="include_amateurs" id="include_amateurs" class="form-check-input" checked>
                                <label for="include_amateurs">Include Amateurs</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="include_professionals" id="include_professionals" class="form-check-input" checked>
                                <label for="include_professionals">Include Professionals</label>
                            </div>
                        </div>
                    </div>

                    <!-- Format Selection Section -->
                    <div>
                        <h3><i class="fas fa-file-alt"></i> Export Format</h3>
                        <p class="mb-4">Choose your preferred export format</p>

                        <div class="format-container">
                            <div class="format-option format-csv selected" onclick="selectFormat('csv', this)">
                                <i class="fas fa-file-csv"></i>
                                <span class="format-name">CSV</span>
                                <span class="format-desc">Compatible with most spreadsheet applications</span>
                            </div>
                            <div class="format-option format-excel" onclick="selectFormat('excel', this)">
                                <i class="fas fa-file-excel"></i>
                                <span class="format-name">Excel</span>
                                <span class="format-desc">Direct import into Microsoft Excel</span>
                            </div>
                            <div class="format-option format-json" onclick="selectFormat('json', this)">
                                <i class="fas fa-file-code"></i>
                                <span class="format-name">JSON</span>
                                <span class="format-desc">For application development</span>
                            </div>
                            <div class="format-option format-xml" onclick="selectFormat('xml', this)">
                                <i class="fas fa-file-code"></i>
                                <span class="format-name">XML</span>
                                <span class="format-desc">For data exchange</span>
                            </div>
                        </div>
                        <input type="hidden" name="format" id="format_input" value="csv">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="export" class="btn btn-primary btn-block">
                    <i class="fas fa-download"></i> Export Players Data
                </button>
            </form>
        </div>

        <!-- Preview Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i>
                <h2 class="card-title">Data Preview</h2>
            </div>
            
            <p>Below is a preview of the data that will be exported (showing first 10 records)</p>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Team</th>
                            <th>Position</th>
                            <th>Date of Birth</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get first 10 players for preview
                        $preview_query = "SELECT player_id, player_name, team_id, position_1, date_of_birth, amateur FROM players LIMIT 10";
                        $preview_result = mysqli_query($db, $preview_query);
                        
                        if ($preview_result && mysqli_num_rows($preview_result) > 0) {
                            while ($row = mysqli_fetch_assoc($preview_result)) {
                                echo "<tr>";
                                echo "<td>" . $row['player_id'] . "</td>";
                                echo "<td>" . $row['player_name'] . "</td>";
                                echo "<td>" . $row['team_id'] . "</td>";
                                echo "<td>" . $row['position_1'] . "</td>";
                                echo "<td>" . $row['date_of_birth'] . "</td>";
                                echo "<td>" . ($row['amateur'] == 1 ? 'Amateur' : 'Professional') . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No player data available</td></tr>";
                        }
                        
                        mysqli_close($db);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Function to handle format selection
        function selectFormat(format, element) {
            // Remove 'selected' class from all format options
            document.querySelectorAll('.format-option').forEach(item => {
                item.classList.remove('selected');
            });
            
            // Add 'selected' class to clicked element
            element.classList.add('selected');
            
            // Update hidden input value
            document.getElementById('format_input').value = format;
        }
        
        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const includeAmateurs = document.getElementById('include_amateurs').checked;
            const includeProfessionals = document.getElementById('include_professionals').checked;
            
            if (!includeAmateurs && !includeProfessionals) {
                e.preventDefault();
                alert('Please select at least one player status (Amateur or Professional)');
            }
        });
    </script>
</body>
</html>