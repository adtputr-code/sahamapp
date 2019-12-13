<?php
session_start();
include 'conf/koneksi.php';
include 'function.php';
include 'header.php';

if (isset($_POST["profit"])) {
  if (tambahprofit($_POST) > 0) {
    echo "
      <script>
      alert('Data berhasil ditambahkan!');
        document.location.href = 'input.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'input.php';
      </script>
    ";
  }
}

if (isset($_POST["sharing"])) {
  if (editsharing($_POST) > 0) {
    echo "
      <script>
      alert('Data berhasil diedit!');
        document.location.href = 'input.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data gagal diedit!');
        document.location.href = 'input.php';
      </script>
    ";
  }
}
?>

<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
        $id_pengelola = $_COOKIE['id'];
        $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
        $data = mysqli_fetch_array($sql);
        ?>
        <iframe frameborder="0" width="100%" height="500" src="<?=$data['link_pengelola'];?>"></iframe>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <form role="form" method="POST">
            <h5>Sharing Profit</h5>
            <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
              $id_pengelola = $_COOKIE['id'];
              $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
              $data = mysqli_fetch_array($sql);
              ?>

              <div class="form-group">
                <label for="sharing_pengelola">Tanggal: <?=date("l, d M Y", strtotime($data['sharing_pengelola']));?></label>
                <input value="<?=$data['sharing_pengelola'];?>" name="sharing_pengelola" id="sharing_pengelola" type="date" class="form-control" placeholder="Tanggal" required>
              </div>

              <div class="form-group" hidden>
                <label for="id_pengelola">ID Pengelola</label>
                <input value="<?=$data['id_pengelola'];?>" name="id_pengelola" id="id_pengelola" type="number" class="form-control" placeholder="ID Pengelola" required readonly>
              </div>

            <?php endif; ?>

            <button type="submit" name="sharing" class="btn btn-primary btn-sm">Submit</button>
          </form>
        </div>

        <div class="col-md-6">
          <form role="form" method="POST">
            <h5>Profit/Hari</h5>
            <div class="form-group" hidden>
              <label for="id_pengelola">ID Pengelola</label>
              <input value="<?=$data['id_pengelola']?>" name="id_pengelola" id="id_pengelola" type="number" class="form-control" placeholder="ID Pengelola" readonly required>
            </div>
            <div class="form-group">
              <label for="tgl_profit">Tanggal</label>
              <input name="tgl_profit" id="tgl_profit" type="date" class="form-control" placeholder="Tanggal" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="total_profit">Profit Perhari</label>
                  <input name="total_profit" id="total_profit" type="text" class="form-control" placeholder="Profit" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status_profit">Status</label>
                  <select name="status_profit" id="status_profit" class="form-control">
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                  </select>
                </div>
              </div>
            </div>

            <button type="submit" name="profit" class="btn btn-primary btn-sm">Submit</button>
          </form>
        </div>
      </div>

      <?php endif; ?>

      <br>

      <table class="table table-borderless">
        <thead>
          <tr class="table-info">
            <th>#</th>
            <th>Tanggal</th>
            <th>Profit</th>
            <th>Update</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; ?>
          <?php foreach($ambil as $row) :?>
            <tr>
              <td><?=$no;?></td>
              <td><?=date("d-M",strtotime($row["tgl_profit"]));?></td>
              <td><?=number_format($row["total_profit"]);?></td>
              <td><?=date("d-M (H:i)",strtotime($row["time_profit"]));?></td>
              <?php if ($row["status_profit"] == "Proses"): ?>
                <td class="text-warning"><?=$row["status_profit"];?></td>
              <?php else: ?>
                <td class="text-success"><?=$row["status_profit"];?></td>
              <?php endif; ?>
              <td>
              <a class="text-info" href="editprofit.php?id_profit=<?=$row['id_profit']?>">EDIT</a> |
              <a class="text-danger" onclick="return confirm('Apakah anda yakin?')" href="hapusprofit.php?id_profit=<?=$row['id_profit']?>">HAPUS</a>
            </td>
            </tr>
          <?php $no++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
