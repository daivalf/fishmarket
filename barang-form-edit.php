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
        Edit Data Barang
    </title>
</head>
<body>
    <h1>Edit Data Barang</h1>
    <?php
        if (isset($_GET["IdBarang"])) 
        {
            $db = dbConnect();
            $IdBarang = $db->escape_string($_GET["IdBarang"]);
            if ($databarang = getDataBarang($IdBarang)) 
            {
                // cari data barang, jika ada simpan di $databarang
    ?>
                <a href="barang.php"><button>View Data Barang</button></a>
                <br><br>
                <form method="post" name="frm" action="barang-update.php">
                <table border="1">
                    <tr>
                        <td>Id Barang</td>
                        <td><input type="text" name="IdBarang" size="6" maxlength="5"
                             value="<?php echo $databarang["IdBarang"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td><input type="text" name="NamaBarang" size="31" maxlength="30"
                             value="<?php echo $databarang["NamaBarang"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="text" name="Harga" size="11" maxlength="10"
                             value="<?php echo $databarang["Harga"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><input type="text" name="Stok" size="6" maxlength="5"
                             value="<?php echo $databarang["Stok"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><textarea style="resize: none; align-content: left;" name="Keterangan" cols="80" rows="8"><?php echo $databarang["Keterangan"]; ?></textarea></td>
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
                echo "Barang dengan Id : $IdBarang tidak ada. Pengeditan dibatalkan";
            }
        }
        else 
        {
            echo "Id Barang tidak ada. Pengeditan dibatalkan.";
        }
    ?>
</body>