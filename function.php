<?php
include_once("conn/conn.php");

?>
<?php
if (isset($_POST['submit'])) {
    $userID = $_GET['userID'];
    $cname = $_POST['cname'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];

    $sqlUpdate = "UPDATE `cart` SET `cname`='$cname',`number`='$number',`address`='$address',`city`='$city',`province`='$province',`zipcode`='$zipcode' WHERE `userID`='$userID'";
    
       if ($conn->query($sqlUpdate) === TRUE) {
     
     $sqlSelect = "SELECT * FROM `cart` WHERE `userID`='$userID'";
        $result = $conn->query($sqlSelect);

        if ($result && $result->num_rows > 0) {
            // Fetch and display the updated data
            while ($row = $result->fetch_assoc()) {

              $id = $row['id'];
              $product = $row['name'];
              $price = $row['price'];
              $userID = $row['userID'];
              $quantity = $row['quantity'];
              $tp = $row['tp'];
              $cname = $row['cname'];
              $number = $row['number'];
              $address = $row['address'];
              $city = $row['city'];
              $province = $row['province'];
              $zipcode = $row['zipcode'];


              $insertOrderSQL = "INSERT INTO `order` (userID, product, price, name, number, quantity, tp, brgy, city, province, zipcode)
                    VALUES ('$userID', '$product', '$price', '$cname', '$number', '$quantity', '$tp', '$address', '$city', '$province', '$zipcode')";

if ($conn->query($insertOrderSQL) === TRUE) {

            $deleteCartEntrySQL = "DELETE FROM cart WHERE id = '$id'";

            if ($conn->query($deleteCartEntrySQL) === TRUE) {
                echo "Order inserted and cart entry deleted successfully!";
            } else {
                echo "Error deleting cart entry: " . $conn->error;
            }
        } else {
            echo "Error: " . $insertOrderSQL . "<br>" . $conn->error;
        }
            }
        } else {
            echo "No data found after update.";
        }

        header('Location: form.php?userID='.$userID);
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
