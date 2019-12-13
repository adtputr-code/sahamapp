<?php
include 'conf/koneksi.php';

$id_pengelola=$_COOKIE['id'];

$ambil = query("SELECT * FROM profit WHERE id_pengelola=$id_pengelola ORDER BY tgl_profit DESC");
$ambil3 = query("SELECT * FROM profit WHERE id_pengelola=$id_pengelola ORDER BY tgl_profit DESC LIMIT 7");
$ambil2 = query("SELECT SUM(total_profit) AS total_profit FROM profit WHERE id_pengelola=$id_pengelola");
$pengelola = query("SELECT * FROM pengelola ORDER BY nama_pengelola ASC");
$investor = query("SELECT * FROM investor ORDER BY id_pengelola ASC");


function query($query){
  global $koneksi;
  $ambil = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($ambil)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahpengelola($tambah){
  global $koneksi;
  $nama_pengelola = htmlspecialchars($tambah["nama_pengelola"]);
  $username_pengelola = strtolower(stripslashes($tambah["username_pengelola"]));
  $password_pengelola = mysqli_real_escape_string($koneksi, $tambah["password_pengelola"]);
  $nisbah_pengelola = htmlspecialchars($tambah["nisbah_pengelola"]);
  $sharing_pengelola = $tambah["sharing_pengelola"];
  $link_pengelola = htmlspecialchars($tambah["link_pengelola"]);
  //cek user name sudah ada
  $cek = mysqli_query($koneksi, "SELECT username_pengelola FROM pengelola WHERE username_pengelola = '$username_pengelola'");
  if (mysqli_fetch_assoc($cek)) {
    echo "<script>
            alert('Username pengelola sudah digunakan!');
          </script>";
    return false;
  }

  $password_pengelola = password_hash($password_pengelola, PASSWORD_DEFAULT);
  mysqli_query($koneksi, "INSERT INTO pengelola VALUES('','$nama_pengelola','$username_pengelola','$password_pengelola',
  '$nisbah_pengelola','$sharing_pengelola','$link_pengelola')");
  return mysqli_affected_rows($koneksi);
}

function hapuspengelola($id_pengelola){
  global $koneksi;
  mysqli_query($koneksi,"DELETE FROM pengelola WHERE id_pengelola = $id_pengelola");
  return mysqli_affected_rows($koneksi);
}

function tambahinvestor($tambah){
  global $koneksi;
  $nama_investor = htmlspecialchars($tambah["nama_investor"]);
  $username_investor = strtolower(stripslashes($tambah["username_investor"]));
  $password_investor = mysqli_real_escape_string($koneksi, $tambah["password_investor"]);
  $uang_investor = htmlspecialchars($tambah["uang_investor"]);
  $nisbah_investor = htmlspecialchars($tambah["nisbah_investor"]);
  $id_pengelola = $tambah["id_pengelola"];
  //cek user name sudah ada
  $cek = mysqli_query($koneksi, "SELECT username_investor FROM investor WHERE username_investor = '$username_investor'");
  if (mysqli_fetch_assoc($cek)) {
    echo "<script>
            alert('Username investor sudah digunakan!');
          </script>";
    return false;
  }

  $password_investor = password_hash($password_investor, PASSWORD_DEFAULT);
  mysqli_query($koneksi, "INSERT INTO investor VALUES('','$nama_investor','$username_investor','$password_investor','$uang_investor',
  '$nisbah_investor','$id_pengelola')");
  return mysqli_affected_rows($koneksi);
}

function hapusinvestor($id_investor){
  global $koneksi;
  mysqli_query($koneksi,"DELETE FROM investor WHERE id_investor = $id_investor");
  return mysqli_affected_rows($koneksi);
}


function tambahprofit($tambah){
  global $koneksi;
  $tgl_profit = htmlspecialchars($tambah["tgl_profit"]);
  $total_profit = htmlspecialchars($tambah["total_profit"]);
  $status_profit = htmlspecialchars($tambah["status_profit"]);
  $id_pengelola = $tambah["id_pengelola"];

  $ambil = "INSERT INTO profit VALUES ('','$tgl_profit','','$total_profit','$status_profit',now(),'$id_pengelola')";
  mysqli_query($koneksi, $ambil);
  return mysqli_affected_rows($koneksi);
}

function editsharing($edit){
  global $koneksi;
  $id_pengelola = $edit['id_pengelola'];
  $sharing_pengelola = $edit['sharing_pengelola'];

  $ambil = "UPDATE pengelola SET
            sharing_pengelola = '$sharing_pengelola'
            WHERE id_pengelola = $id_pengelola
            ";
  mysqli_query($koneksi, $ambil);
  return mysqli_affected_rows($koneksi);
}

function editprofit($edit){
  global $koneksi;
  $id_profit = $edit["id_profit"];
  $tgl_profit = htmlspecialchars($edit["tgl_profit"]);
  $total_profit = htmlspecialchars($edit["total_profit"]);
  $status_profit = htmlspecialchars($edit["status_profit"]);
  $id_pengelola = $edit["id_pengelola"];

  $ambil = "UPDATE profit SET
            tgl_profit = '$tgl_profit',
            total_profit = '$total_profit',
            status_profit = '$status_profit',
            id_pengelola = '$id_pengelola'
            WHERE id_profit = $id_profit
            ";
  mysqli_query($koneksi, $ambil);
  return mysqli_affected_rows($koneksi);
}

function hapusprofit($id_profit){
  global $koneksi;
  mysqli_query($koneksi,"DELETE FROM profit WHERE id_profit = $id_profit");
  return mysqli_affected_rows($koneksi);
}

?>
