<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Records</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>User Records</h1>
<?php
$servername = "sql305.infinityfree.com";
$username = "if0_42396151";
$password = "Clh3d4ImB64";
$dbname = "if0_42396151_sqlsama";
$name = $_GET['name'];
$age = $_GET['age'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check coif0_42396151_sqlsamannection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO users (Name, age, Status)
VALUES ('$name', '$age', 0)";

if ($conn->query($sql) === TRUE) {
 echo "<div class='success-message'>New record created successfully</div>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


/* SELECT DATA */
$sql_select = "SELECT * FROM users";
$result = $conn->query($sql_select);

echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Status</th>
        <th>Action</th>
      </tr>";
	  

while ($row = $result->fetch_assoc()) {

    $id = $row["ID"];

    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["age"] . "</td>";

    echo "<td id='status-$id'>" . $row["Status"] . "</td>";

    echo "<td>
            <button onclick='toggleStatus($id)'>Toggle</button>
          </td>";

    echo "</tr>";
}

echo "</table>";

$conn->close();


?>

<script>
function toggleStatus(id) {

    fetch("toggle.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + id
    })
    .then(response => response.text())
    .then(newStatus => {

        document.getElementById("status-" + id).innerText = newStatus;

    })
    .catch(error => {
        console.error("Error:", error);
    });
}
</script>

</div>

</body>
</html>