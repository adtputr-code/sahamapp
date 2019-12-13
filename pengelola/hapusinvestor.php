<?php
require 'function.php';

$id_investor = $_GET["id_investor"];
if (hapusinvestor($id_investor) > 0 ) {
  echo "
    <script>
    alert('Data berhasil dihapus!');
      document.location.href = 'akun.php';
    </script>
  ";
}else {
  echo "
    <script>
    alert('Data gagal dihapus!');
      document.location.href = 'akun.php';
    </script>
  ";
}

?>
