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
    <title>Tambah Data Barang</title>
</head>
<body>
    <h1>Tambah Data Barang</h1>
    <a href="barang.php"><button>View Daftar Barang</button></a>
    <br><br>
    <form method="post" name="frm" action="barang-simpan.php">
    <table border="1">
    <tr>
        <td>Id Barang</td>
        <td><input type="text" name="IdBarang" size="6" maxlength="5"></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td><input type="text" name="NamaBarang" size="31" maxlength="30"></td>
    </tr>
    <tr>
        <td>Harga</td>
        <td><input type="text" name="Harga" size="11" maxlength="10"></td>
    </tr>
    <tr>
        <td>Stok</td>
        <td><input type="text" name="Stok" size="6" maxlength="5"></td>
    </tr>
    <tr>
    <tr>
        <td>Keterangan</td>
        <td><textarea style="resize: none;" name="Keterangan" cols="80" rows="8"></textarea></td>
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