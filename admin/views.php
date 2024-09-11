<?php
session_start();
if ($_SESSION['Role'] != 'Admin') {
    header('Location: ../login.php?error=Access denied');
    exit();
}

include_once("../conn/conn.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order List</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">16 in 1 tea</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="view.php">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addproducts.php">Add product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create account.php">Create account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log-out</a>
        </li>
        
      </ul>
      
    </div>
  </div>
</nav>
 <br>
    <div class="container">
        <div class="card border-secondary mb-3">
            <div class="table-responsive">
                <table class="table table-hover">
                      <thead>
            <tr>
              <th colspan="13"><center>ORDERS</center></th>
            </tr>
            <tr>
              <th scope="col">No. </th>
              <th scope="col">ORDER NUMBER</th>
              <th scope="col">PRODUCT</th>
              <th scope="col">PRICE</th>
              <th scope="col">QUANTITY</th>
              <th scope="col">TOTAL AMOUNT</th>
              <th scope="col">CUSTOMER'S NAME</th>
              <th scope="col">NUMBER</th>
              <th scope="col">ADDRESS</th>
              <th scope="col">CITY/MUNICIPALITY</th>
              <th scope="col">PROVINCE</th>
              <th scope="col">ZIP CODE</th>
              <th scope="col" colspan=""><center>ACTION</center></th>
            </tr>
          </thead>
                    <tbody>
                        <?php
                        // Retrieve userID from the URL
                        $userID = isset($_GET['userID']) ? $_GET['userID'] : '';

                        // Check if a valid userID is provided
                        if ($userID !== '') {
                            // Retrieve orders with the same userID
                            $sql = "SELECT * FROM `order` WHERE userID = '$userID'";
                            $order = $conn->query($sql) or die($conn->error);
                            $i = 1;
                            $totalPrice = 0;

                            // Loop through the results and display each order
                            while ($row = $order->fetch_assoc()) {
                                $totalPrice += $row['tp'];
                                ?>
                               <tr class="table-active">
            <td><?php echo $i; ?></td>
            <td><?php echo $row['userID']; ?></td>
            <td><?php echo $row['product']; ?></td>
            <td>₱ <?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>₱ <?php echo $row['tp']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['brgy']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['province']; ?></td>
            <td><?php echo $row['zipcode']; ?></td>
            <td>
                <form action="deletes.php" method="post">
                    <button name="delete" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this data?')">
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                        DONE
                    </button>
                </form>
            </td>
        </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td colspan="2"><b>Shipping fee:</b></td>
                                <td colspan="12"><b>₱ 100</b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>TOTAL PRICE:</b></td>
                                <td colspan="12"><b>₱ <?php echo $totalPrice + 100; ?></b></td>
                            </tr>
                            <?php
                        } else {
                            // Display a message if no valid userID is provided
                            echo "<tr><td colspan='13'>Invalid or missing userID.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
