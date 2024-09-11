<?php
session_start();
if($_SESSION['Role'] != 'Admin'){
header('Location: ../login.php?error=Access denied'); 


}

?>
<?php
include_once("../conn/conn.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Order List</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">16 in 1 tea</a>
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
              
              <th scope="col" ><center>ACTION</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT DISTINCT userID FROM `order`"; // Use backticks for table names
            $order = $conn->query($sql) or die($conn->error);
            $i = 1;

            while ($row = $order->fetch_assoc()) {
              
            ?>
              <tr class="table-active">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['userID']; ?></td>
                
<td><center>
  <form action="deleteprod.php" method="post">
  <a href="views.php?userID=<?php echo $row['userID']; ?>" class="btn btn-primary" style="width: 120px;">VIEW ORDER</a>

    <button name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')">
                            <input type="hidden" name="id" value="<?php echo $row['userID']; ?>">
                            DELETE
                        </button>
                            </form>
                          </center>
</td>              </tr>
            <?php  $i++;
          } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<!-- Add this line before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
