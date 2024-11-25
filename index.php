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

$sexFilter = isset($_GET['sex']) ? $_GET['sex'] : '';

$sql = "SELECT id, name, sex FROM people";
if ($sexFilter) {
    $sql .= " WHERE sex = '$sexFilter'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>List of People</h1>

    <form method="GET" action="">
        <label for="sex">Filter by Sex:</label>
        <select name="sex" id="sex">
            <option value="">All</option>
            <option value="male" <?php echo $sexFilter == 'male' ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo $sexFilter == 'female' ? 'selected' : ''; ?>>Female</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Sex</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["sex"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

