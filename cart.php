<?php
include_once("conn/conn.php");


?>
<?php
$userID = $_POST['userID'];
$picture = $_POST['picture'];
$product = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

$tp = $quantity * $price;

// Prepare SQL query to insert values into the `order` table
$sql = "INSERT INTO `cart`(`name`, `price`, `picture`, `userID`, `quantity`, `tp`) VALUES ('$product', '$price', '$picture', '$userID', '$quantity', '$tp')";

if ($conn->query($sql) === TRUE) {
header('Location: product.php?userID=' . $userID);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>


