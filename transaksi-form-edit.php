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
<head>
    <title>
        Edit Data Transaksi
    </title>
</head>
<body>
    <h1>Edit Data Transaksi</h1>
    <?php
        if (isset($_GET["IdTransaksi"])) 
        {
            $db = dbConnect();
            $IdTransaksi = $db->escape_string($_GET["IdTransaksi"]);
            if ($datatransaksi = getDataTransaksi($IdTransaksi)) 
            {
                // cari data tramsaksi, jika ada simpan di $datatransaksi
    ?>
                <a href="transaksi.php"><button>View Data Transaksi</button></a>
                <br><br>
                <form method="post" name="frm" action="transaksi-update.php">
                <table border="1">
                    <tr>
                        <td>Id Transaksi</td>
                        <td><input type="text" name="IdTransaksi" size="10" maxlength="9"
                             value="<?php echo $datatransaksi["IdTransaksi"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nama Pembeli</td>
                        <td><input type="text" name="NamaPembeli" size="51" maxlength="50"
                             value="<?php echo $datatransaksi["NamaPembeli"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td><input type="text" name="NamaBarang" size="31" maxlength="30"
                             value="<?php echo $datatransaksi["NamaBarang"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><input type="date" name="Tanggal" size="11" maxlength="10"
                             value="<?php echo $datatransaksi["Tanggal"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                        <td><input type="text" name="JumlahBarang" size="4" maxlength="3"
                             value="<?php echo $datatransaksi["JumlahBarang"]; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">Hanya edit Tanggal dan Jumlah Barang</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input type="submit" name="TblUpdate" value="Update">
                        <input type="Reset"></td>
                    </tr>
                </table>
                </form>
    <?php            
            }
            else 
            {
                echo "Transaksi dengan Id : $IdTransaksi tidak ada. Pengeditan dibatalkan";
            }
        }
        else 
        {
            echo "Id Transaksi tidak ada. Pengeditan dibatalkan.";
        }
    ?>
</body>