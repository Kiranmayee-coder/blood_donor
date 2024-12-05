<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstName, lastName, dob, gender, bloodGroup, aadhaar, country, state, address, email, mobile FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        header {
            background: maroon;
            color: white;
            text-align: center;
            padding: 5px 0;
        }
        header h1 {
            margin: 0;
            padding: 5px 0;
            font-size: 1.5em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: maroon;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Registered Users</h1>
    </header>
    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Aadhaar</th>
                <th>Country</th>
                <th>State</th>
                <th>Address</th>
                <th>Email</th>
                <th>Mobile</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"]. "</td>";
                    echo "<td>" . $row["firstName"]. "</td>";
                    echo "<td>" . $row["lastName"]. "</td>";
                    echo "<td>" . $row["dob"]. "</td>";
                    echo "<td>" . $row["gender"]. "</td>";
                    echo "<td>" . $row["bloodGroup"]. "</td>";
                    echo "<td>" . $row["aadhaar"]. "</td>";
                    echo "<td>" . $row["country"]. "</td>";
                    echo "<td>" . $row["state"]. "</td>";
                    echo "<td>" . $row["address"]. "</td>";
                    echo "<td>" . $row["email"]. "</td>";
                    echo "<td>" . $row["mobile"]. "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No registered users found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
