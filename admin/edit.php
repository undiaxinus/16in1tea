<?php
session_start();
if($_SESSION['Role'] != 'Admin'){
header('Location: ../login.php?error=Access denied'); 


}

?>
<?php
include_once("../conn/conn.php");
    

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    
    $sql = "SELECT * FROM `order` WHERE ID = $ID";
    $order = $conn->query($sql) or die($conn->error);
    $row = $order->fetch_assoc();
} else {
    echo "No order ID specified.";
    exit; // Stop execution if no ID is provided
}

if (isset($_POST['submit'])) {
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];

    $sqlUpdate = "UPDATE `order` SET `userID`='$userID', `name`='$name', `number`='$number', `quantity`='$quantity', `brgy`='$address', `city`='$city', `province`='$province', `zipcode`='$zipcode' WHERE `ID`='$ID'";
    
    if ($conn->query($sqlUpdate) === TRUE) {
       header('location:view.php?Record updated successfully');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
   <a href="logout.php" class="nav-link">
              
              <p>
                Log-out
              </p>
              </a>
              <a href="view.php" class="nav-link">
              <p>HOME</p>
            </a><a href="addproducts.php" class="nav-link">
              <p>ADD PRODUCT</p>
            </a><a href="create account.php" class="nav-link">
              <p>CREATE ACCOUNT</p>
            </a>  <br>

	<center>
<div class="card border-secondary mb-3" style="max-width: 50rem;">
  <div class="card-header">FORM</div>
  <div class="card-body">
   <form action="" method="post">
  <fieldset>
    <div class="form-group">
    	
      <input type="text" class="form-control" name="userID" placeholder="UserID"  value="<?php echo $row['userID'] ?>" readonly><br>
      
      <input type="text" class="form-control" name="Product" placeholder="Product" value="<?php echo $row['product'] ?>" readonly><br>
      <input type="text" class="form-control" name="Price" placeholder="" value="<?php echo $row['price'] ?>" readonly>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $row['name'] ?>" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="number" placeholder="Contact Number" value="<?php echo $row['number'] ?>" required>
    </div><br>
    <div class="form-group" >
      <select class="form-select" name="quantity">
      	<option hidden><?php echo $row['quantity'] ?></option>
        <option>1 - total price: ₱<?php 
        $tp = 1 * $price;
        echo $tp ;?></option>
        <option>2 - total price: ₱<?php 
        $tp1 = 2 * $price;
        echo $tp1 ;?></option>
        <option>3 - total price: ₱<?php 
        $tp2 = 3 * $price;
        echo $tp2 ;?></option>
        <option>5 - total price: ₱<?php 
        $tp3 = 5 * $price;
        echo $tp3 ;?></option>
        <option>10 - total price: ₱<?php 
        $tp4 = 10 * $price;
        echo $tp4 ;?></option>
      </select>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $row['brgy'] ?>" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="city"placeholder="City/Municipality" value="<?php echo $row['city'] ?>" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="province"placeholder="Province" value="<?php echo $row['province'] ?>" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="zipcode"placeholder="Zip code" value="<?php echo $row['zipcode'] ?>" required>
    </div><br>
    <button type="submit" class="btn btn-primary" name="submit">Submit Order</button>
  </fieldset>
</form>
  </div>
</div>
</center>

</body>
</html>

<?php
// Close the connection at the end of the file
$conn->close();
?>