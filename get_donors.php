<?php
header('Content-Type: application/json'); // Set the content type to JSON

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank"; // Update with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Database connection failed: " . $conn->connect_error)));
}

// Retrieve POST data
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : '';
$state = isset($_POST['state']) ? $_POST['state'] : '';

if ($blood_group && $state) {
    // SQL query to fetch donors based on the blood group and state
    $sql = "SELECT name, blood_group, age, contact, email, state FROM donors WHERE blood_group = ? AND state = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die(json_encode(array("error" => "Failed to prepare the statement: " . $conn->error)));
    }

    // Bind parameters
    $stmt->bind_param("ss", $blood_group, $state);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch all donors and return as JSON
        $donors = array();
        while ($row = $result->fetch_assoc()) {
            $donors[] = $row;
        }
        echo json_encode($donors);
    } else {
        // No donors found for the criteria
        echo json_encode(array("message" => "No donors found for the selected criteria."));
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle missing inputs
    echo json_encode(array("error" => "Please select both blood group and state."));
}

// Close the connection
$conn->close();
?>
