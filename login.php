<?php
include_once("conn/conn.php");
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = hash('sha256', $password);

    $sqlUpdate = "UPDATE `user` SET `vpass`= ? WHERE email = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ss", $hashedPassword, $email);
    $stmtUpdate->execute();

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        $hashedPasswordFromDB = $row['password'];
        $passwords = $row['vpass'];

        if ($passwords === $hashedPasswordFromDB) {
            $_SESSION['login'] = $row['id'];
            $_SESSION['Role'] = $row['role'];

            if ($_SESSION['login'] == 1 || $_SESSION['Role'] == 'Admin') {
                header('Location: admin/view.php');
                exit();
            } else if ($_SESSION['Role'] == 'user' || $_SESSION['Role'] == 'Viewer') {
                $_SESSION['username'] = $email;
                header('Location: viewer/view.php');
                exit();
            }
        } else {
            $errorMessage = 'Wrong email or password';
        }
    } else {
        $errorMessage = 'User not found';
    }
    if (isset($errorMessage)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $errorMessage . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Login</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
              </div>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
