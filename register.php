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

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$bloodGroup = $_POST['bloodGroup'];
$aadhaar = $_POST['aadhaar'];
$country = $_POST['country'];
$state = $_POST['state'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];

$sql = "INSERT INTO users (firstName, lastName, dob, gender, bloodGroup, aadhaar, country, state, address, email, password, mobile)
VALUES ('$firstName', '$lastName', '$dob', '$gender', '$bloodGroup', '$aadhaar', '$country', '$state', '$address', '$email', '$password', '$mobile')";

if ($conn->query($sql) === TRUE) {
    header('Location: profile.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
