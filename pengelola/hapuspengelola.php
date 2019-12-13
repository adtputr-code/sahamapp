<?php
require 'function.php';

$id_pengelola = $_GET["id_pengelola"];
if (hapuspengelola($id_pengelola) > 0 ) {
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
