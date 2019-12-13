<?php
session_start();
include 'conf/koneksi.php';
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id_pengelola = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $result = mysqli_query($koneksi,"SELECT username_investor FROM investor WHERE id_investor = $id_investor");
  $row = mysqli_fetch_assoc($result);

  if ($key === hash('sha256',$row['username_investor'])) {
    $_SESSION['login_investor'] = true;
  }
}

if (isset($_POST['login_investor'])) {
  $username_investor = $_POST["username_investor"];
  $password_investor = $_POST["password_investor"];

  $result = mysqli_query($koneksi, "SELECT * FROM investor WHERE username_investor = '$username_investor'");
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password_investor, $row["password_investor"])) {
      $_SESSION['login_investor'] = true;
      if (isset($_POST['remember'])) {
        setcookie('id',$row['id_investor'], time() + 3600*24*30*12);
        setcookie('key', hash('sha256',$row['username_investor']), time() + 3600*24*30*12);
      }
      header('location: index.php');
      exit;
    }
  }
  $error = true;
}
include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin">
        <div class="card-body">
          <h5 class="card-title text-center">Login</h5>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
              Username atau password salah!
            </div>
          <?php endif; ?>

          <form class="form-signin" method="POST">
            <div class="form-group">
              <label for="username_investor">Username</label>
              <input type="text" class="form-control" id="username_investor" name="username_investor" placeholder="Enter username" autofocus required>
            </div>
            <div class="form-group">
              <label for="password_investor">Password</label>
              <input type="password" class="form-control" id="password_investor" name="password_investor" placeholder="Enter password" required>
            </div>
            <div class="custom-control custom-checkbox mb-3" hidden>
              <input type="checkbox" class="custom-control-input" name="remember" id="remember" checked>
              <label class="custom-control-label" for="remember">Remember me</label>
            </div>
            <button name="login_investor" type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
