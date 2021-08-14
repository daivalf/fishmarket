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
    <title>Hapus Data Barang</title>
</head>
<body>
    <h1>Hapus Data Barang</h1>
    <?php
        if (isset($_GET["IdBarang"])) 
        {
            $db = dbConnect();
            $IdBarang = $db->escape_string($_GET["IdBarang"]);
            if ($databarang = getDataBarang($IdBarang)) 
            {
    ?>
                <a href="barang.php"><button>View Data Barang</button></a>
                <br><br>
                <form method="post" name="frm" action="barang-hapus.php">
                    <input type="hidden" name="IdBarang" value="<?php echo $databarang["IdBarang"];?>">
                    <table border="1">
                        <tr>
                            <td>Id Barang</td>
                            <td><?php echo $databarang["IdBarang"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><?php echo $databarang["NamaBarang"]; ?></td>
                            <tr>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><?php echo $databarang["Harga"]; ?></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><?php echo $databarang["Stok"]; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><textarea style="resize: none; align-content: left;" name="Keterangan" cols="80" rows="8" readonly><?php echo $databarang["Keterangan"]; ?></textarea></td>
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
                echo "Barang dengan Id : $IdBarang tidak ada.";
            }
        }
        else 
        {
            echo "Id Barang tidak ada.";
        }
    ?>
</body>
</html>