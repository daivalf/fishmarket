<?php
    session_start();
    if (!isset($_SESSION["IdUser"])) 
    {
        header("Location: index.php?error=4");
    }
?>
<?php
    include_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data Transaksi</title>
</head>
<body>
    <h1>Hapus Data Transaksi</h1>
    <?php
        if (isset($_GET["IdTransaksi"])) 
        {
            $db = dbConnect();
            $IdTransaksi = $db->escape_string($_GET["IdTransaksi"]);
            if ($datatransaksi = getDataTransaksi($IdTransaksi)) 
            {
    ?>
                <a href="transaksi.php"><button>View Data Transaksi</button></a>
                <br><br>
                <form method="post" name="frm" action="transaksi-hapus.php">
                    <input type="hidden" name="IdTransaksi" value="<?php echo $datatransaksi["IdTransaksi"];?>">
                    <table border="1">
                        <tr>
                            <td>Id Transaksi</td>
                            <td><?php echo $datatransaksi["IdTransaksi"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><?php echo $datatransaksi["Tanggal"]; ?></td>
                            <tr>
                        </tr>
                        <tr>
                            <td>Nama Pembeli</td>
                            <td><?php echo $datatransaksi["NamaPembeli"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><?php echo $datatransaksi["NamaBarang"]; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Barang</td>
                            <td><?php echo $datatransaksi["JumlahBarang"]; ?></td>
                        </tr>
                        <tr>
                            <td>Total Bayar</td>
                            <td><?php echo $datatransaksi["TotalBayar"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td><?php echo $datatransaksi["NoRek"]; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="TblHapus" value="Hapus"></td>
                        </tr>
                    </table>
                </form>
    <?php
            }
            else 
            {
                echo "Transaksi dengan Id : $IdTransaksi tidak ada.";
            }
        }
        else 
        {
            echo "Id Transaksi tidak ada.";
        }
    ?>
</body>
</html>