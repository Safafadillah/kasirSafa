<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .cetak {
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #000;
            font-family: Arial, sans-serif;
        }
        .cetak h2, .cetak p {
            text-align: center;
        }
        .cetak p {
            margin: 5px 0;
        }
        .cetak .line {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }
        .cetak .total, .cetak .change {
            font-weight: bold;
        }
        .cetak .right {
            text-align: right;
        }
        .cetak .center {
            text-align: center;
        }
        .btn-print {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 2px;
            text-align: center;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<button type="submit" name="kembali"><a href="session2.php">Kembali</a></button>
<?php
session_start();
$totalHarga = 0;
$amountGiven = isset($_POST['amountGiven']) ? $_POST['amountGiven'] : 0;
$change = 0;

foreach ($_SESSION['kasir'] as $value) {
    $total = $value['jumlah'] * $value['harga'];
    $totalHarga += $total;
}

if ($amountGiven >= $totalHarga) {
    $change = $amountGiven - $totalHarga;
} else {
    echo "<h1><bold>Maaf, Uang Anda Tidak Cukup</bold></h1>";
    exit;
}
?>

<div class="cetak">
    <h2>Struk Pembayaran</h2>
    <p><strong>Date:</strong> <?php echo date('Y-m-d'); ?></p>
    <div class="line"></div>
    <p><strong>Product</strong> | <strong>Qty</strong> | <strong>Price</strong> | <strong>Total</strong></p>
    <div class="line"></div>
    <?php foreach($_SESSION['kasir'] as $value) { ?>
    <p><?php echo $value['produk']; ?> | <?php echo $value['jumlah']; ?> | <?php echo $value['harga']; ?> | <?php echo $value['jumlah'] * $value['harga']; ?></p>
    <?php } ?>
    <div class="line"></div>
    <p class="total">Total: <span class="right"><?php echo $totalHarga; ?></span></p>
    <p>Yang Dibayarkan: <span class="right"><?php echo $amountGiven; ?></span></p>
    <p class="change">Kembalian: <span class="right"><?php echo $change; ?></span></p>
    <a href="javascript:window.print()" class="btn-print">Print</a>
</div>

<?php
// Clear the session data
unset($_SESSION['kasir']);
?>

</body>
</html>
