 <?php
session_start();
if($_SESSION['Role'] != 'Admin'){
header('Location: ../login.php?error=Access denied'); 


}

?>
 <?php
include_once("../conn/conn.php");


$sql = "SELECT * FROM user";
$employees = $conn->query($sql) or die($conn->error);
$row = $employees->fetch_assoc();

if(isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $pass = $_POST['password'];

    $hashedPassword = hash('sha256', $pass);

    $checkEmailQuery = "SELECT * FROM `user` WHERE `email`='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        header('Location: create account.php?error=Email already exists');
        exit(); 
    }

    $sql = "INSERT INTO `user`(`name`, `username`, `email`, `contact`, `password`, `role`) VALUES ('$name','$uname','$email','$contact','$hashedPassword','$role')";
    $conn->query($sql) or die ($conn->error);

    header('Location: create account.php?success=Record added');
}

?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Registration</h3>
            </div>
            <div class="card-body">
             <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" required="">
                  </div>
                   <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="uname" required="">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                      <option hidden></option>
                      <option>Admin</option>
                      <option>Viewer</option>
                    </select>
                  </div>
                   <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="email" name="email" required="">
                  </div>
                   <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="text" name="password" required="">
                  </div>
                   <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                </div>
                    </div>

                  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
  </html>
