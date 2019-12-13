<?php include 'header.php'; ?>
<div class="col-md-12">
  <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
    $id_investor = $_COOKIE['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM investor
      JOIN pengelola ON pengelola.id_pengelola = investor.id_pengelola
      WHERE id_investor=$id_investor");
    $data = mysqli_fetch_array($sql);
    ?>
    <div class="col-md-12">
      <iframe frameborder="0" width="100%" height="500" src="<?=$data['link_pengelola']?>"></iframe>
    </div>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
