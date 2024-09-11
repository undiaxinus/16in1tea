<?php
include_once("conn/conn.php");
$conn = connection();

// Assuming your table structure has columns `name`, `price`, `quantity`, `userID`, and `picture`

$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$userID = $_POST['userID'];
$picture = $_POST['picture'];

$tp = $price * $quantity;
// Prepare the SQL statement
$sql = "INSERT INTO cart (name, price, quantity, userID, picture,tp) VALUES (?, ?, ?, ?, ?,?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameters with the values
$stmt->bind_param("ssssss", $name, $price, $quantity, $userID, $picture,$tp);

// Execute the statement
if ($stmt->execute()) {
    // Data inserted successfully
    header('Location: product.php?userID=' . $userID);
} else {
    // Failed to insert data
    header('Location: product.php?userID=' . $userID);
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>