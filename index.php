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
        <a class="add" href="add.php">Add New Person</a>
    </form>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["sex"] . "</td>
                        <td>
                            <form method='POST' action='delete.php' style='display:inline;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' onclick=\"return confirm('Are you sure you want to delete this person?')\">Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

</body>
</html>

