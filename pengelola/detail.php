<?php include 'header.php'; ?>
<div class="col-md-12">
  <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
    $id_pengelola = $_COOKIE['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
    $data = mysqli_fetch_array($sql);
    ?>
    <iframe frameborder="0" width="100%" height="500" src="<?=$data['link_pengelola'];?>"></iframe>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
