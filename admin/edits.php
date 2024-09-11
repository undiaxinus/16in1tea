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
    
    $sql = "SELECT * FROM `product` WHERE ID = $ID";
    $order = $conn->query($sql) or die($conn->error);
    $row = $order->fetch_assoc();
} else {
    echo "No order ID specified.";
    exit; // Stop execution if no ID is provided
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $picture = $_FILES['picture']['name'];

    // Ensure a file is uploaded
    if(!empty($picture)){
        // Move uploaded file to a directory (make sure 'img' directory exists)
        move_uploaded_file($_FILES['picture']['tmp_name'], '../img/'.$picture); 
    }

    // Using prepared statements to prevent SQL injection
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE `product` SET `name` = ?, `price` = ?, `description` = ?, `picture` = ? WHERE `ID` = ?");
    $stmt->bind_param("ssssi", $name, $price, $description, $picture, $ID);

    
    if ($stmt->execute()) {
        header('Location: addproducts.php?success=Record added');
        exit();
    } else {
        // Redirect with an error message if insertion fails
        header('Location: addproducts.php?error=Failed to add record');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

</head>
<body>
  <a href="logout.php" class="nav-link">
              
              <p>
                Log-out
              </p></a>
             <a href="view.php" class="nav-link">
              <p>HOME</p>
            </a><a href="addproducts.php" class="nav-link">
              <p>ADD PRODUCT</p>
            </a><a href="create account.php" class="nav-link">
              <p>CREATE ACCOUNT</p>
            </a>  <br>

    <div class="container mt-4">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo  $row['name'] ?>" required>
            </div><br>
            <div class="form-group">
                <input type="text" name="price" class="form-control" placeholder="Price" value="<?php echo  $row['price'] ?>" required>
            </div><br>
            <div class="form-group">
                <input type="file" name="picture" class="form-control-file" value="<?php echo  $row['price'] ?>" required>
            </div><br>
            <div class="form-group">
                <textarea class="form-control" placeholder="Leave a description here" name="description" value="<?php echo  $row['description'] ?>" id="message" style="height: 200px"></textarea>
            </div><br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Save">&nbsp;
                <input type="reset" class="btn btn-secondary" value="Cancel">
            </div><br>
        </form>
    </div>

    <!-- Your existing product display table and other content here -->
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="container">
    <div class="card border-secondary mb-3">
      <div class="table-responsive">
    <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">name </th>
              <th scope="col">price</th>
              <th scope="col">picture</th>
              <th scope="col">description</th>
              <th scope="col" colspan="2"><center>ACTION</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `product`"; // Use backticks for table names
            $order = $conn->query($sql) or die($conn->error);

            while ($row = $order->fetch_assoc()) {
            ?>
              <tr class="table-active">
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['picture']; ?></td>
                <td><?php echo $row['description']; ?></td>
<td>
  <a href="edit.php?ID=<?php echo $row['id']; ?>" class="btn btn-primary" style="width: 77px;">Edit</a>
</td>
<td><form action="delete.php" method="post">
    <button name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            DELETE
                        </button>
                            </form>
</td>              </tr>
            <?php } ?>
          </tbody>
        </table>
    </div></div></div>
</body>
</html>
