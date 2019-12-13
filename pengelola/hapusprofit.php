<?php
require 'function.php';

$id_profit = $_GET["id_profit"];
if (hapusprofit($id_profit) > 0 ) {
  echo "
    <script>
    alert('Data berhasil dihapus!');
      document.location.href = 'input.php';
    </script>
  ";
}else {
  echo "
    <script>
    alert('Data gagal dihapus!');
      document.location.href = 'input.php';
    </script>
  ";
}

?>
