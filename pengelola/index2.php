<?php
session_start();
include 'conf/koneksi.php';
include 'function.php';
include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success" role="alert">
        <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
          $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
          $data = mysqli_fetch_array($sql);
          ?>
          [Sharing Profit] - <?=date("l, d M Y",strtotime($data['sharing_pengelola']))?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info" role="alert">
        <?php foreach ($ambil2 as $row):?>
          <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
            $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
            $data = mysqli_fetch_array($sql);
            $profit = $row['total_profit']*$data['nisbah_pengelola'];
            ?>

            <div><strong>Hi <?=$data['nama_pengelola'];?>, Fitur ini sedang dalam pengembangan.</strong></div>
            <br>
            <div>Namun kami akan menyampaikan, bahwa pendapatan kamu saat ini adalah
            <strong>Rp. <?=number_format($profit);?></strong></div>

          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
