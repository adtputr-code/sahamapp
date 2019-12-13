<?php
session_start();
if (isset($_COOKIE["key"])) {
  $_SESSION['login_pengelola'] = true;
}
if (!isset($_SESSION["login_pengelola"])) {
  header("Location: login.php");
  exit;
}
include 'conf/koneksi.php';
include 'function.php';

include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info" role="alert">
        <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
          $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
          $data = mysqli_fetch_array($sql);
          ?>
          [Sharing Profit] - <?=date("l, d M Y",strtotime($data['sharing_pengelola']))?>
        <?php endif; ?>

        <?php foreach ($ambil2 as $row):?>
          <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
            $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
            $data = mysqli_fetch_array($sql);
            $profit = $row['total_profit']*$data['nisbah_pengelola'];
            ?>
            <strong class="float-right">Rp. <?=number_format($profit);?></strong></div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <canvas id="chartperhari"></canvas>
        </div>
      </div>
    </div>
   </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-borderless">
        <thead>
          <tr class="table-info">
            <th>#</th>
            <th>Tanggal</th>
            <th>Profit</th>
            <th>Update</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1;?>
          <?php foreach ($ambil3 as $row): ?>
            <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
              $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
              $data = mysqli_fetch_array($sql);
              $profit = $row['total_profit']*$data['nisbah_pengelola'];
              ?>
              <tr>
                <td><?=$no;?></td>
                <td><?=date("d-M",strtotime($row["tgl_profit"]));?></td>
                <td><?=number_format($profit);?></td>
                <td><?=date("d-M (H:i)",strtotime($row["time_profit"]));?></td>
                <?php if ($row["status_profit"] == "Proses"): ?>
                  <td class="text-warning"><?=$row["status_profit"];?></td>
                <?php else: ?>
                  <td class="text-success"><?=$row["status_profit"];?></td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
          <?php $no++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
