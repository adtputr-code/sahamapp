<?php
include 'conf/koneksi.php';
?>

<?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
  $id_investor = $_COOKIE['id'];
  $sql = mysqli_query($koneksi, "SELECT * FROM investor WHERE id_investor=$id_investor");
  $data = mysqli_fetch_array($sql);
  $id_pengelola=$data['id_pengelola'];

  $ambil = query("SELECT * FROM profit WHERE id_pengelola=$id_pengelola ORDER BY tgl_profit DESC LIMIT 7");
  $ambil2 = query("SELECT SUM(total_profit) AS total_profit FROM profit WHERE id_pengelola=$id_pengelola");
  ?>
<?php endif; ?>

<?php
function query($query){
  global $koneksi;
  $ambil = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($ambil)) {
    $rows[] = $row;
  }
  return $rows;
}
?>
