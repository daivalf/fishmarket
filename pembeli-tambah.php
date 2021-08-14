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
    <title>Tambah Data Pembeli</title>
</head>
<body>
    <h1>Tambah Data Pembeli</h1>
    <a href="pembeli.php"><button>View Daftar Pembeli</button></a>
    <br><br>
    <form method="post" name="frm" action="pembeli-simpan.php">
    <table border="1">
    <tr>
        <td>Id Pembeli</td>
        <td><input type="text" name="IdPembeli" size="6" maxlength="5"></td>
    </tr>
    <tr>
        <td>Nama Pembeli</td>
        <td><input type="text" name="NamaPembeli" size="51" maxlength="50"></td>
    </tr>
    <tr>
        <td>Nomor Telepon</td>
        <td><input type="text" name="NoTelp" size="16" maxlength="15"></td>
    </tr>
    <tr>
        <td>Alamat Pembeli</td>
        <td><textarea style="resize: none;" name="AlamatPembeli" cols="80" rows="8"></textarea></td>
    </tr>
    <tr>
        <td>Nomor Rekening</td>
        <td><input type="text" name="NoRek" size="21" maxlength="20"></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <input type="submit" name="TblSimpan" value="Simpan">
        <input type="Reset">
        </td>
    </tr>
    </table>
    </form>
</body>
</html>