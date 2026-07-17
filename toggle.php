<?php
$servername = "sql305.infinityfree.com";
$username = "if0_42396151";
$password = "Clh3d4ImB64";
$dbname = "if0_42396151_sqlsama";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "UPDATE users
        SET Status = IF(Status = 0, 1, 0)
        WHERE ID = $id";

if ($conn->query($sql) === TRUE) {

    $result = $conn->query(
        "SELECT Status FROM users WHERE ID = $id"
    );

    $row = $result->fetch_assoc();

    echo $row["Status"];

} else {

    echo "Error";

}

$conn->close();

?>