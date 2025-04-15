<?php
// Initialize variables
$message = '';
$error = '';
$fileName = 'matches_export_' . date('Y-m-d');

// Process export request
if(isset($_POST['export'])) {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbdatabase = 'fmdb';
    
    // Connect to database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdatabase);
    
    if(!$conn) {
        $error = "Could not connect to database: " . mysqli_connect_error();
    } else {
        // Get export format
        $format = isset($_POST['format']) ? $_POST['format'] : 'csv';
        
        // Get date range if specified
        $dateFilter = '';
        if(!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
            $startDate = mysqli_real_escape_string($conn, $_POST['start_date']);
            $endDate = mysqli_real_escape_string($conn, $_POST['end_date']);
            $dateFilter = " WHERE match_date BETWEEN '$startDate' AND '$endDate'";
            $fileName = 'matches_' . date('Ymd', strtotime($startDate)) . '_to_' . date('Ymd', strtotime($endDate));
        }
        
        // Build query based on selected fields or get all
        $selectedFields = isset($_POST['fields']) ? $_POST['fields'] : ['*'];
        
        if(in_array('*', $selectedFields)) {
            $fields = '*';
        } else {
            $fields = implode(', ', $selectedFields);
        }
        
        $sql = "SELECT $fields FROM matches" . $dateFilter . " ORDER BY match_date DESC";
        
        // Execute query
        $result = mysqli_query($conn, $sql);
        
        if(!$result) {
            $error = "Query failed: " . mysqli_error($conn);
        } else {
            // Export based on format
            switch($format) {
                case 'csv':
                    exportCSV($result, $fileName);
                    break;
                case 'json':
                    exportJSON($result, $fileName);
                    break;
                case 'excel':
                    exportExcel($result, $fileName);
                    break;
                case 'pdf':
                    exportPDF($result, $fileName);
                    break;
                default:
                    $error = "Invalid export format";
            }
        }
        
        mysqli_close($conn);
    }
}

// Function to export as CSV
function exportCSV($result, $fileName) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Add column headers
    $headerRow = [];
    $fieldInfo = mysqli_fetch_fields($result);
    foreach($fieldInfo as $field) {
        $headerRow[] = $field->name;
    }
    fputcsv($output, $headerRow);
    
    // Add data rows
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    
    fclose($output);
    exit();
}

// Function to export as JSON
function exportJSON($result, $fileName) {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="' . $fileName . '.json"');
    
    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit();
}

// Function to export as Excel
function exportExcel($result, $fileName) {
    // Note: In a real implementation, you'd likely use a library like PhpSpreadsheet
    // For this example, we'll create an HTML table that Excel can open
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '.xls"');
    
    echo '<table border="1">';
    
    // Add header row
    echo '<tr>';
    $fieldInfo = mysqli_fetch_fields($result);
    foreach($fieldInfo as $field) {
        echo '<th>' . $field->name . '</th>';
    }
    echo '</tr>';
    
    // Add data rows
    while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        foreach($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    
    echo '</table>';
    exit();
}

// Function to export as PDF
function exportPDF($result, $fileName) {
    // In a real implementation, you'd use a library like FPDF or TCPDF
    // For this example, we'll show a message
    $error = "PDF export requires additional libraries. Please use another format.";
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Match Data</title>
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

        /* Main Container */
        .container {
            width: 95%;
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background-color: white;
            box-shadow: 0 0 20px var(--shadow);
            border-radius: var(--border-radius);
        }

        /* Form Styles */
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
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            font-size: 1rem;
            width: 100%;
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

        /* Cards */
        .card {
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header i {
            color: var(--primary);
        }

        /* Checkbox Group */
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Date Range */
        .date-range {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Radio Group */
        .radio-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .radio-card {
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            padding: 15px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .radio-card:hover {
            border-color: var(--primary);
            background-color: rgba(52, 152, 219, 0.05);
        }

        .radio-card input[type="radio"] {
            margin-right: 10px;
        }

        .radio-card.selected {
            border-color: var(--primary);
            background-color: rgba(52, 152, 219, 0.1);
        }

        .format-icon {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .csv-icon { color: var(--secondary); }
        .json-icon { color: var(--warning); }
        .excel-icon { color: var(--info); }
        .pdf-icon { color: var(--danger); }

        /* Alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid var(--secondary);
            color: #27ae60;
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--danger);
            color: #c0392b;
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }
            
            .container {
                padding: 15px;
                width: 100%;
            }
            
            .radio-group, .date-range {
                grid-template-columns: 1fr;
            }
            
            .checkbox-group {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <a href="match.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1>Export Match Data</h1>
        <p>Export match information in various formats</p>
    </header>

    <!-- Main content -->
    <div class="container">
        <?php if($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div><?php echo $error; ?></div>
            </div>
        <?php endif; ?>

        <?php if($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div><?php echo $message; ?></div>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Export Format -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-file-export"></i> Export Format
                </div>
                <p>Select the format you want to export your match data in:</p>
                
                <div class="radio-group">
                    <label class="radio-card" for="csv">
                        <input type="radio" id="csv" name="format" value="csv" checked>
                        <i class="fas fa-file-csv format-icon csv-icon"></i>
                        <div>CSV Format</div>
                        <small>Compatible with most spreadsheet applications</small>
                    </label>
                    
                    <label class="radio-card" for="json">
                        <input type="radio" id="json" name="format" value="json">
                        <i class="fas fa-file-code format-icon json-icon"></i>
                        <div>JSON Format</div>
                        <small>For developers or data processing</small>
                    </label>
                    
                    <label class="radio-card" for="excel">
                        <input type="radio" id="excel" name="format" value="excel">
                        <i class="fas fa-file-excel format-icon excel-icon"></i>
                        <div>Excel Format</div>
                        <small>Direct import into Microsoft Excel</small>
                    </label>
                    
                    <label class="radio-card" for="pdf">
                        <input type="radio" id="pdf" name="format" value="pdf">
                        <i class="fas fa-file-pdf format-icon pdf-icon"></i>
                        <div>PDF Format</div>
                        <small>For printing or sharing reports</small>
                    </label>
                </div>
            </div>
            
            <!-- Date Range -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt"></i> Date Range (Optional)
                </div>
                <p>Select a date range to filter matches, or leave blank to export all:</p>
                
                <div class="date-range">
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                    </div>
                </div>
            </div>
            
            <!-- Field Selection -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-columns"></i> Fields to Export
                </div>
                <p>Select which fields to include in your export, or check "All Fields" to include everything:</p>
                
                <div class="form-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="all_fields" name="fields[]" value="*" checked>
                        <label for="all_fields">All Fields</label>
                    </div>
                    
                    <div class="checkbox-group" id="field_checkboxes">
                        <div class="checkbox-item">
                            <input type="checkbox" id="match_id" name="fields[]" value="match_id" disabled>
                            <label for="match_id">Match ID</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="match_date" name="fields[]" value="match_date" disabled>
                            <label for="match_date">Match Date</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="team_id_home" name="fields[]" value="team_id_home" disabled>
                            <label for="team_id_home">Home Team</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="team_id_away" name="fields[]" value="team_id_away" disabled>
                            <label for="team_id_away">Away Team</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="score_home" name="fields[]" value="score_home" disabled>
                            <label for="score_home">Home Score</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="score_away" name="fields[]" value="score_away" disabled>
                            <label for="score_away">Away Score</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="league_id" name="fields[]" value="league_id" disabled>
                            <label for="league_id">League ID</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="stadium_id" name="fields[]" value="stadium_id" disabled>
                            <label for="stadium_id">Stadium ID</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="match_status" name="fields[]" value="match_status" disabled>
                            <label for="match_status">Match Status</label>
                        </div>
                        <!-- Add additional fields as needed -->
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" name="export" class="btn btn-primary">
                    <i class="fas fa-download"></i> Export Data
                </button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="match.php">Match Management</a>
            <a href="match.php">Dashboard</a>
            <a href="input_match.html">Add New Match</a>
            <a href="update_match.php">Update Match</a>
        </div>
        <p>&copy; 2025 Sports Management System. All rights reserved.</p>
    </footer>

    <script>
        // Toggle field checkboxes based on "All Fields" selection
        document.getElementById('all_fields').addEventListener('change', function() {
            const fieldCheckboxes = document.querySelectorAll('#field_checkboxes input[type="checkbox"]');
            
            fieldCheckboxes.forEach(checkbox => {
                checkbox.disabled = this.checked;
                
                // If "All Fields" is unchecked, enable all other checkboxes and check them by default
                if (!this.checked) {
                    checkbox.checked = true;
                }
            });
        });
        
        // Add visual selection effect to radio cards
        const radioCards = document.querySelectorAll('.radio-card');
        
        radioCards.forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            
            // Set initial selected state
            if (radio.checked) {
                card.classList.add('selected');
            }
            
            // Update on change
            radio.addEventListener('change', function() {
                // Remove selected class from all cards
                radioCards.forEach(c => c.classList.remove('selected'));
                
                // Add selected class to current card if radio is checked
                if (this.checked) {
                    card.classList.add('selected');
                }
            });
        });
        
        // Date range validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            
            // If one date is filled, the other should be too
            if ((startDate && !endDate) || (!startDate && endDate)) {
                e.preventDefault();
                alert('Please provide both start and end dates, or leave both blank to export all matches.');
            }
            
            // End date should not be before start date
            if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
                e.preventDefault();
                alert('End date cannot be before start date.');
            }
        });
    </script>
</body>
</html>