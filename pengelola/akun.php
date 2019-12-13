<?php
session_start();
include 'function.php';
include 'conf/koneksi.php';
include 'header.php';

if (isset($_POST["pengelola"])) {
  if (tambahpengelola($_POST) > 0) {
    echo "<script>
            alert('Pengelola baru berhasil ditambahkan!');
            document.location.href = 'akun.php';
          </script>
          ";
  }else {
    echo mysqli_error($koneksi);
  }
}

if (isset($_POST["investor"])) {
  if (tambahinvestor($_POST) > 0) {
    echo "<script>
            alert('Investor baru berhasil ditambahkan!');
            document.location.href = 'akun.php';
          </script>
          ";
  }else {
    echo mysqli_error($koneksi);
  }
}
?>
<div class="col-md-12">
  <div class="row">

    <div class="col-md-6">
      <form role="form" method="POST">

        <h5>Pengelola</h5>

        <div class="form-group">
          <label for="nama_pengelola">Nama Pengelola</label>
          <input name="nama_pengelola" id="nama_pengelola" type="text" class="form-control" placeholder="Nama Pengelola" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username_pengelola">Username Pengelola</label>
              <input name="username_pengelola" id="username_pengelola" type="text" class="form-control" placeholder="Username Pengelola" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="password_pengelola">Password Pengelola</label>
              <input name="password_pengelola" id="password_pengelola" type="password" class="form-control" placeholder="Password Pengelola" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nisbah_pengelola">Nisbah Pengelola</label>
              <input name="nisbah_pengelola" id="nisbah_pengelola" type="text" class="form-control" placeholder="Nisbah Pengelola" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="sharing_pengelola">Sharing Pengelola</label>
              <input name="sharing_pengelola" id="sharing_pengelola" type="date" class="form-control" placeholder="Sharing Pengelola" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="link_pengelola">Link Pengelola</label>
          <textarea style="resize:none;" name="link_pengelola" id="link_pengelola" type="text" class="form-control" placeholder="Link Pengelola" required></textarea>
        </div>

        <button type="submit" name="pengelola" class="btn btn-primary btn-sm">Submit</button>
      </form>
    </div>

    <div class="col-md-6">
      <form role="form" method="POST">

        <h5>Investor</h5>

        <div class="form-group">
          <label for="nama_investor">Nama Investor</label>
          <input name="nama_investor" id="nama_investor" type="text" class="form-control" placeholder="Nama Investor" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username_investor">Username Investor</label>
              <input name="username_investor" id="username_investor" type="text" class="form-control" placeholder="Username Investor" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="password_investor">Password Investor</label>
              <input name="password_investor" id="password_investor" type="password" class="form-control" placeholder="Password Investor" required>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="uang_investor">Uang Investor</label>
              <input name="uang_investor" id="uang_investor" type="text" class="form-control" placeholder="Uang Investor" required>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="nisbah_investor">Nisbah Investor</label>
              <input name="nisbah_investor" id="nisbah_investor" type="text" class="form-control" placeholder="Nisbah Investor" required>
            </div>
          </div>

          <div class="col-md-4">
            <label for="id_pengelola">Nama Pengelola</label>
            <select name="id_pengelola" id="id_pengelola" class="form-control">
              <?php
              include "conf/koneksi.php";
              $sql = "SELECT * FROM pengelola ORDER BY nama_pengelola ASC";
              $hasil = $koneksi->query($sql);
              if ($hasil->num_rows) {
                while ($cetak = $hasil->fetch_assoc()) {
                  extract($cetak);?>
                  <option value=<?=$id_pengelola;?>><?=$nama_pengelola;?></option>;
                  <?php
                }
              }
              ?>
            </select>
          </div>

        </div>


        <button type="submit" name="investor" class="btn btn-primary btn-sm">Submit</button>
      </form>
    </div>

  </div>
</div>
<hr>
<div class="col-md-12">
  <div class="row">

    <div class="col-md-6">
      <table class="table table-borderless">
        <thead>
          <tr class="table-info">
            <th>#</th>
            <th>Pengelola</th>
            <th>Nisbah</th>
            <th>Sharing</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($pengelola as $row): ?>
            <tr>
              <td><?=$row['id_pengelola'];?></td>
              <td><?=$row['nama_pengelola']?></td>
              <td><?=$row['nisbah_pengelola']?></td>
              <td><?=date("l, d M Y", strtotime($row['sharing_pengelola']));?></td>
              <?php if ($row['id_pengelola'] == 1): ?>
              <td>
                <a class="text-secondary">HAPUS</a>
              </td>
              <?php else: ?>
                <td>
                  <a class="text-danger" onclick="return confirm('Apakah anda yakin?')" href="hapuspengelola.php?id_pengelola=<?=$row["id_pengelola"];?>">HAPUS</a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>


    <div class="col-md-6">
      <table class="table table-borderless">
        <thead>
          <tr class="table-info">
            <th>#</th>
            <th>Investor</th>
            <th>Jumlah</th>
            <th>Nisbah</th>
            <th>ID</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1;?>
          <?php foreach ($investor as $row): ?>
            <tr>
              <td><?=$no;?></td>
              <td><?=$row['nama_investor']?></td>
              <td><?=number_format($row['uang_investor'])?></td>
              <td><?=$row['nisbah_investor']?></td>
              <td><?=$row['id_pengelola']?></td>

              <td>
                <a class="text-danger" onclick="return confirm('Apakah anda yakin?')" href="hapusinvestor.php?id_investor=<?=$row["id_investor"];?>">HAPUS</a>
              </td>


            </tr>
          <?php $no++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>




    <div class="col-md-6">

    </div>

  </div>

</div>
<?php include 'footer.php'; ?>
