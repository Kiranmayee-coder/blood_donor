<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$blood_group = $state = "";
$results = [];
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group = $_POST['blood_group'];
    $state = $_POST['state'];

    if (!empty($blood_group) && !empty($state)) {
        // SQL query to fetch matching rows
        $sql = "SELECT name, blood_group, age, contact, email, state FROM donors WHERE blood_group = ? AND state = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $blood_group, $state);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch rows into an array
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            $stmt->close();
        } else {
            $error = "Failed to prepare SQL query.";
        }
    } else {
        $error = "Please select both blood group and state.";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        header {
            text-align: center;
            padding: 10px 0;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .results table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .results th, .results td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .results th {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Blood Donor Search</h1>
    </header>
    <div class="form-container">
        <form method="POST" action="">
            <label for="blood_group">Select Blood Group:</label>
            <select name="blood_group" id="blood_group">
                <option value="">--Select--</option>
                <option value="A+" <?= $blood_group == "A+" ? "selected" : "" ?>>A+</option>
                <option value="B+" <?= $blood_group == "B+" ? "selected" : "" ?>>B+</option>
                <option value="O-" <?= $blood_group == "O-" ? "selected" : "" ?>>O-</option>
                <option value="AB-" <?= $blood_group == "AB-" ? "selected" : "" ?>>AB-</option>
                <option value="O+" <?= $blood_group == "O+" ? "selected" : "" ?>>O+</option>
                <option value="A-" <?= $blood_group == "A-" ? "selected" : "" ?>>A-</option>
                <option value="B-" <?= $blood_group == "B-" ? "selected" : "" ?>>B-</option>
                <option value="AB+" <?= $blood_group == "AB+" ? "selected" : "" ?>>AB+</option>
            </select>

            <label for="state">Select State:</label>
            <select name="state" id="state">
                <option value="">--Select--</option>
                <option value="Andhra Pradesh" <?= $state == "Andhra Pradesh" ? "selected" : "" ?>>Andhra Pradesh</option>
                <option value="Arunachal Pradesh" <?= $state == "Arunachal Pradesh" ? "selected" : "" ?>>Arunachal Pradesh</option>
                <option value="Assam" <?= $state == "Assam" ? "selected" : "" ?>>Assam</option>
                <!-- Add more states as needed -->
            </select>

            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <div class="results">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Blood Group</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['blood_group']) ?></td>
                            <td><?= htmlspecialchars($row['age']) ?></td>
                            <td><?= htmlspecialchars($row['contact']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['state']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($results)): ?>
        <p class="error">No donors found for the selected criteria.</p>
    <?php endif; ?>
</body>
</html>
