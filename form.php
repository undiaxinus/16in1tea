<?php
include_once("conn/conn.php");


?>
<?php
$userID = isset($_GET['userID']) ? $_GET['userID'] : '';

// Using prepared statement to prevent SQL injection
$sql = "SELECT * FROM cart WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userID);
$stmt->execute();
$result = $stmt->get_result();


if (isset($_POST['submit'])) {
    $ID = $_GET['id'];
    $quantity = $_POST['quantity'];
    $userID1 = $_POST['userID'];
    

    $sqlUpdate = "UPDATE `cart` SET `quantity`='$quantity' WHERE `id`='$ID'";
    
    if ($conn->query($sqlUpdate) === TRUE) {
      header('Location: form.php?userID=' . $userID1);

    } else {
        echo "Error updating record: " . $conn->error;
    }
}


if (isset($_POST['delete'])) {
    $ID = $_GET['id'];
    $userID2 = $_POST['userID'];
    $sqlDelete = "DELETE FROM cart WHERE id=?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("s", $ID);
    if ($stmt->execute()) {
        header('Location: form.php?userID=' . $userID2);
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<center>
<div class="card border-secondary mb-3" style="max-width: 50rem;">
  <div class="card-header">FORM</div>
  <div class="card-body">
   
  <fieldset>
    <div class="form-group">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ORDER NUMBER</th>
                                        <th scope="col">PRODUCT NAME</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QUANTITY</th>
                                        <th scope="col">TOTAL PRICE</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalSum = 0;
                                     if ($result && mysqli_num_rows($result) > 0) { 
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $formattedPrice = number_format($row['price'], 2, '.', ',');
                                        $formattedTotalPrice = number_format($row['tp'], 2, '.', ',');
                                        $total =  $row['tp'];

        // Add the current total to the overall sum
        $totalSum += $total;
                                    ?>
                                        <tr class="table-active">
                                            <td><?php echo $row['userID']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $formattedPrice; ?></td>
                                            <td>
                                                <form action="form.php?id=<?php echo $row['id']; ?>" method="post">
                                                <select name="quantity" onchange="handleQuantity(this)">
                                                    <option hidden selected disabled><?php echo $row['quantity']; ?></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                                <input type="text" name="custom_quantity" id="customQuantity" placeholder="Enter Quantity" style="display: none;">
                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            </form>

<script>
    function handleQuantity(select) {
        const selectedValue = select.value;
        const customQuantityField = document.getElementById("customQuantity");
        
        // Show the input field if "Other" option is selected, hide it otherwise
        if (selectedValue === "other") {
            customQuantityField.style.display = "block";
        } else {
            customQuantityField.style.display = "none";
        }
    }
</script>
                                            </td>
                                            <td><?php echo $formattedTotalPrice; ?></td>
                                            <td>

                                                <form action="form.php?id=<?php echo $row['id']; ?>" method="post">
                                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>"><button type="submit" name="delete" class="btn btn-danger">DELETE</button></form>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                    <tr>
                                        <td colspan="">Shipping fee: </td>
                                        <td colspan="5">₱ 100.00</td>
                                    </tr>
                                    <tr>
    <td >Total fee:</td>
    <td colspan="5">₱ <?php echo number_format($totalSum + 100, 2, '.', ','); ?></td>
</tr>
                                </tbody>
                            </table>
                        </div><br>
                        
                        <form action="function.php?userID=<?php echo $userID?>" method="post">
    <div class="form-group">
      <input type="text" class="form-control" name="cname" placeholder="Name" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="number" placeholder="Contact Number" required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="address" placeholder="Address"  required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="city" placeholder="City/Municipality"  required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="province" placeholder="Province"required>
    </div><br>
    <div class="form-group">
      <input type="text" class="form-control" name="zipcode"placeholder="Zip code" required>
    </div><br>
    <button type="submit" class="btn btn-primary" name="submit">Submit Order</button>
    <a href="product.php?userID=<?php echo $userID?>" class="btn btn-warning">BACK</a>
  </fieldset>
 
</form>
  </div>
</div>
</center>

</body>
</html>
