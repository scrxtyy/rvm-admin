<?php
session_start();

// Initialize the options array if it doesn't exist in the session
if (!isset($_SESSION['options'])) {
    $_SESSION['options'] = array(
        'Aplaya' => 'Aplaya',
        'Balibago' => 'Balibago',
        'Caingin' => 'Caingin',
        'Dila' => 'Dila',
        'Dita' => 'Dita',
        'Don Jose' => 'Don Jose',
        'Ibaba' => 'Ibaba',
        'Kanluran' => 'Kanluran',
        'Labas' => 'Labas',
        'Macabling' => 'Macabling',
        'Malitlit' => 'Malitlit',
        'Malusak' => 'Malusak',
        'Market Area' => 'Market Area',
        'Pooc' => 'Pooc',
        'Pulong Santa Cruz' => 'Pulong Santa Cruz',
        'Santo Domingo' => 'Santo Domingo',
        'Sinalhan' => 'Sinalhan',
        'Tagapo' => 'Tagapo'
    );
}

// Initialize the history array if it doesn't exist in the session
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = array();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['selectOption'])) {
        $selectedOption = $_GET['selectOption'];
        $selectedDateTime = date('Y-m-d H:i:s'); // Get the current date and time

        // Remove the selected option from the options array
        unset($_SESSION['options'][$selectedOption]);

        // Add the selected option and date/time to the history array
        $_SESSION['history'][] = array(
            'option' => $selectedOption,
            'datetime' => $selectedDateTime
        );

        // Do something with the selected option and the selectedDateTime
        echo "Selected option: " . $selectedOption . "<br>";
        echo "Selected date and time: " . $selectedDateTime;
    } elseif (isset($_GET['resetOptions'])) {
        // Reset the options array
        $_SESSION['options'] = array(
            'Aplaya' => 'Aplaya',
            'Balibago' => 'Balibago',
            'Caingin' => 'Caingin',
            'Dila' => 'Dila',
            'Dita' => 'Dita',
            'Don Jose' => 'Don Jose',
            'Ibaba' => 'Ibaba',
            'Kanluran' => 'Kanluran',
            'Labas' => 'Labas',
            'Macabling' => 'Macabling',
            'Malitlit' => 'Malitlit',
            'Malusak' => 'Malusak',
            'Market Area' => 'Market Area',
            'Pooc' => 'Pooc',
            'Pulong Santa Cruz' => 'Pulong Santa Cruz',
            'Santo Domingo' => 'Santo Domingo',
            'Sinalhan' => 'Sinalhan',
            'Tagapo' => 'Tagapo'
        );

        // Clear the history array
        $_SESSION['history'] = array();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Option</title>
    <style>
        .custom-select {
            width: 200px;
            padding: 5px;
            font-size: 16px;
            border: 3px solid #000;
            border-radius: 5px;
            background-color: lightgreen;
        }
        .custom-select option {
            background-color: white;
            color: black;
        }
        /* CSS styles for the select history table */
        .history-container {
            margin: 0 auto;
            width: 50%;
            border: 1px solid black;
        }
        .history-table {
            border-collapse: collapse;
            width: 100%;
        }

        .history-table th,
        .history-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .history-table th {
            background-color: #fff;
        }
        .history-table tr:nth-of-type(even){
            background-color: lightcoral;
        }
        .history-table tr:hover {
            background-color: lightgreen;
        }
    </style>
</head>
<body>
    <form method="GET" action="">
        <label for="selectOption">Select an option:</label>
        <select id="selectOption" name="selectOption" class="custom-select">
            <?php
            // Generate the select options dynamically
            foreach ($_SESSION['options'] as $value => $label) {
                echo '<option value="' . $value . '">' . $label . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Submit">
    </form>

    <form method="GET" action="">
        <input type="submit" name="resetOptions" value="Reset Options">
    </form>

    
    <h2 style="text-align:center;">Selected Options History</h2>
    <div class="history-container">
        <table class="history-table">
            <tr>
                <th>Option</th>
                <th>Date and Time</th>
            </tr>
            <?php
            // Display the history of selected options
            foreach ($_SESSION['history'] as $entry) {
                echo '<tr>';
                echo '<td>' . $entry['option'] . '</td>';
                echo '<td>' . $entry['datetime'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

    
</body>
</html>


