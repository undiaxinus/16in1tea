<?php
session_start();
if($_SESSION['Role'] != 'Admin'){
header('Location: ../login.php?error=Access denied'); 


}

?>
<?php
// Check if the form is submitted for order deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    include_once("../conn/conn.php");

    // Sanitize and get the order ID to be deleted
    $order_id = $_POST['userID']; // Make sure to sanitize this input to prevent SQL injection

    // Perform deletion query
    $delete_query = "DELETE FROM `order` WHERE userID = '$userID'";
    if ($conn->query($delete_query) === TRUE) {
        // If deletion is successful, redirect to the order list page
        header('Location: view.php');
        exit();
    } else {
        // If deletion fails, handle the error (you might want to show an error message)
        echo "Error deleting record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
