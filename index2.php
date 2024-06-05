<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="style1.css">
    <script>
        function calculateChange() {
            const totalAmount = parseFloat(document.getElementById('totalAmount').innerText);
            const amountGiven = parseFloat(document.getElementById('amountGiven').value);
            const change = amountGiven - totalAmount;

            document.getElementById('change').innerText = change >= 0 ? change.toFixed(0) : "Maaf, Uang Anda Tidak Cukup";
        }
    </script>
</head>
<body>

<div class="receipt">
    <h2>Pembayaran</h2>
    <div class="receipt-details">
        <p><strong>Date:</strong> <?php echo date('Y-m-d'); ?></p>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            session_start();
            $totalHarga = 0;
            if(isset($_SESSION['kasir'])){
                foreach ($_SESSION['kasir'] as $value) {
                    $total = $value['jumlah'] * $value['harga'];
                    $totalHarga += $total;
            ?>
            <tr>
                <td><?php echo $value['produk']; ?></td>
                <td><?php echo $value['jumlah']; ?></td>
                <td><?php echo $value['harga']; ?></td>
                <td><?php echo $total; ?></td>
            </tr>
            <?php 
                }
            }
            ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td id="totalAmount"><?php echo $totalHarga; ?></td>
            </tr>
        </table>
    </div>
    <div class="receipt-actions">
        <form action="index3.php" method="post">
            <label for="amountGiven">Yang Dibayarkan:</label>
            <input type="number" id="amountGiven" name="amountGiven" step="0.01">
            <button type="submit" name="bayar" onclick="calculateChange()">Bayar</button>
            <button type="submit" name="kembali"> <a href="index.php">Kembali</a></button>
        </form>

    </div>
</div>

</body>
</html>
