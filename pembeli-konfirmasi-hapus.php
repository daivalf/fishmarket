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
    <title>Hapus Data Pembeli</title>
</head>
<body>
    <h1>Hapus Data Pembeli</h1>
    <?php
        if (isset($_GET["IdPembeli"])) 
        {
            $db = dbConnect();
            $IdPembeli = $db->escape_string($_GET["IdPembeli"]);
            if ($datapembeli = getDataPembeli($IdPembeli)) 
            {
    ?>
                <a href="pembeli.php"><button>View Data Pembeli</button></a>
                <br><br>
                <form method="post" name="frm" action="pembeli-hapus.php">
                    <input type="hidden" name="IdPembeli" value="<?php echo $datapembeli["IdPembeli"];?>">
                    <table border="1">
                        <tr>
                            <td>Id Pembeli</td>
                            <td><?php echo $datapembeli["IdPembeli"]; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pembeli</td>
                            <td><?php echo $datapembeli["NamaPembeli"]; ?></td>
                            <tr>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td><?php echo $datapembeli["NoTelp"]; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Pembeli</td>
                            <td><textarea style="resize: none; align-content: left;" name="AlamatPembeli" cols="80" rows="8" readonly><?php echo $datapembeli["AlamatPembeli"]; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td><?php echo $datapembeli["NoRek"]; ?></td>
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
                echo "Pembeli dengan Id : $IdPembeli tidak ada.";
            }
        }
        else 
        {
            echo "IdPembeli tidak ada.";
        }
    ?>
</body>
</html>