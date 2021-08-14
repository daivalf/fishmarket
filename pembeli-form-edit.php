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
        Edit Data Pembeli
    </title>
</head>
<body>
    <h1>Edit Data Pembeli</h1>
    <?php
        if (isset($_GET["IdPembeli"])) 
        {
            $db = dbConnect();
            $IdPembeli = $db->escape_string($_GET["IdPembeli"]);
            if ($datapembeli = getDataPembeli($IdPembeli)) 
            {
                // cari data pembeli, jika ada simpan di $datapembeli
    ?>
                <a href="pembeli.php"><button>View Data Pembeli</button></a>
                <br><br>
                <form method="post" name="frm" action="pembeli-update.php">
                <table border="1">
                    <tr>
                        <td>Id Pembeli</td>
                        <td><input type="text" name="IdPembeli" size="6" maxlength="5"
                             value="<?php echo $datapembeli["IdPembeli"]; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nama Pembeli</td>
                        <td><input type="text" name="NamaPembeli" size="51" maxlength="50"
                             value="<?php echo $datapembeli["NamaPembeli"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td><input type="text" name="NoTelp" size="16" maxlength="15"
                             value="<?php echo $datapembeli["NoTelp"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat Pembeli</td>
                        <td><textarea style="resize: none; align-content: left;" name="AlamatPembeli" cols="80" rows="8"><?php echo $datapembeli["AlamatPembeli"]; ?></textarea></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Nomor Rekening</td>
                        <td><input type="text" name="NoRek" size="21" maxlength="20"
                             value="<?php echo $datapembeli["NoRek"]; ?>"></td>
                    </tr>
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
                echo "Pembeli dengan Id : $IdPembeli tidak ada. Pengeditan dibatalkan";
            }
        }
        else 
        {
            echo "Id Pembeli tidak ada. Pengeditan dibatalkan.";
        }
    ?>
</body>