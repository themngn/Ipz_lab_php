<?php
$servername = "localhost";
$username = "php";  // or your MySQL username
$password = "ipz";      // or your MySQL password
$dbname = "people_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $sex = $_POST['sex'];

    if (!empty($name) && !empty($sex)) {
        $sql = "INSERT INTO people (name, sex) VALUES ('$name', '$sex')";

        if ($conn->query($sql) === TRUE) {
            $message = "New record created successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Please fill in all fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Person</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Person</h1>
    
    <?php if ($message) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="sex">Sex:</label>
        <select name="sex" id="sex" required>
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <br>
	<button type="submit">Add Person</button>
	<br>
	<br>
        <a class="add" href="index.php">Back to People List</a>
    </form>
</body>
</html>

