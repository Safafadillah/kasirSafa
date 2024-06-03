<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saga</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

    <form action="" method="post">
    <h1>Toko Saga</h1>
    <label for="produk"> <strong>Nama Barang : </strong></label>
    <input type="text" id="produk" name="produk">
    <label for="nama"><strong>Jumlah :</strong></label>
    <input type="number" id="jumlah" name="jumlah"><br></br>
    <label for="nama"><strong>Harga : </strong></label>
    <input type="number" id="harga" name="harga"><br></br>
    <button type="submit" name="submit" value="kirim"><i class='bx bx-plus'></i>TAMBAH</button>
    <button type="submit" name="bayar" value="cetak"><i class='bx bxs-printer'></i><a href="session2.php">BAYAR</a></button>

  <?php  
    
    session_start();

if(!isset($_SESSION['kasir'])){
    $_SESSION['kasir']= array ();
}

if(isset($_POST['produk']) && isset($_POST['jumlah']) && isset($_POST['harga'])){

    $data = array(
        'produk' => $_POST['produk'],
        'jumlah' => (int)$_POST['jumlah'],
        'harga' => (int)$_POST['harga'],
        'total' => $_POST['jumlah'] * $_POST['harga']
    );
    array_push($_SESSION['kasir'], $data);
};  

if(isset($_GET['hapus'])){
    $index = $_GET['hapus'];
    unset($_SESSION['kasir'][$index]);
    header('Location:http://localhost/function/KASIR/index.php');
    exit;
}
// var_dump($_SESSION['dataSiswa']);

echo '<table border="1">';
echo '<tr>';
echo '<th>PRODUCT</th>';
echo '<th>QUANTITY</th>';
echo '<th>PRICE</th>';
echo '<th>TOTAL</th>';
echo '<th>AKSI</th>';
echo '</tr>';

$totalJumlah = 0;
    $totalHarga = 0;

    foreach($_SESSION['kasir'] as $index => $value){
        echo '<tr>';
        echo '<td>' . $value['produk'] . '</td>';
        echo '<td>' . $value['jumlah'] . '</td>';
        echo '<td>' . $value['harga'] . '</td>';
        echo '<td>' . $value['total'] . '</td>';
        echo '<td> <a href="?hapus='.$index.'" class="btn btn-danger btn-sm">hapus</a></td>';
        echo '</tr>';

        $totalJumlah += $value['total'];
    }


    echo '<tr>';
    echo '<td colspan="3"><strong>Total</strong></td>';
    echo '<td>' . $totalJumlah . '</td>';
    echo '<td></td>'; 
    echo '</tr>';

    echo '</table>';


echo '</table>';

?>
    </form>
   

</body>
</html>