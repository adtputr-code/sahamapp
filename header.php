<?php include 'conf/koneksi.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Investor</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  </head>
  <body style="font-size:10px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a style="font-size:14px;" class="navbar-brand" href="index.php">
        <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
          $id_investor = $_COOKIE['id'];
          $sql = mysqli_query($koneksi, "SELECT * FROM investor WHERE id_investor=$id_investor");
          $data = mysqli_fetch_array($sql);
          ?>
          INVESTOR : <?=$data['nama_investor'];?>
        <?php else: ?>
          INVESTOR
        <?php endif; ?>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Profit</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="index2.php">Perbulan</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="detail.php">Detail</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

    <br>
