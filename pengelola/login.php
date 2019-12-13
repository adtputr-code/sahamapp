<?php
session_start();
include 'conf/koneksi.php';
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id_pengelola = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $result = mysqli_query($koneksi,"SELECT username_pengelola FROM pengelola WHERE id_pengelola = $id_pengelola");
  $row = mysqli_fetch_assoc($result);

  if ($key === hash('sha256',$row['username_pengelola'])) {
    $_SESSION['login_pengelola'] = true;
  }
}

if (isset($_POST['login_pengelola'])) {
  $username_pengelola = $_POST["username_pengelola"];
  $password_pengelola = $_POST["password_pengelola"];

  $result = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE username_pengelola = '$username_pengelola'");
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password_pengelola, $row["password_pengelola"])) {
      $_SESSION['login_pengelola'] = true;
      if (isset($_POST['remember'])) {
        setcookie('id',$row['id_pengelola'], time() + 3600*24*30*12);
        setcookie('key', hash('sha256',$row['username_pengelola']), time() + 3600*24*30*12);
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
              <label for="username_pengelola">Username</label>
              <input type="text" class="form-control" id="username_pengelola" name="username_pengelola" placeholder="Enter username" autofocus required>
            </div>
            <div class="form-group">
              <label for="password_pengelola">Password</label>
              <input type="password" class="form-control" id="password_pengelola" name="password_pengelola" placeholder="Enter password" required>
            </div>
            <div class="custom-control custom-checkbox mb-3" hidden>
              <input type="checkbox" class="custom-control-input" name="remember" id="remember" checked>
              <label class="custom-control-label" for="remember">Remember me</label>
            </div>
            <button name="login_pengelola" type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
