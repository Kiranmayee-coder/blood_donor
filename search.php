<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Search</title>
</head>
<body>
    <header>
        <h1>Blood Donor Search</h1>
    </header>
    <nav>
        <img src="https://thumbs.dreamstime.com/b/blood-donation-logo-drop-vector-illustration-149924795.jpg" alt="Logo"> <!-- Replace with your actual logo image path -->
        <div>
            <a href="home.html">Home</a>
            <a href="contact.html">Contact</a>
            <a href="about.html">About Us</a>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
            <a href="profile.html">Profile</a>
            <a href="search.php">Search for Donor</a>
        </div>
    </nav>
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
