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
    <title>Tambah Data Transaksi</title>
</head>
<body>
    <h1>Tambah Data Transaksi</h1>
    <a href="transaksi.php"><button>View Daftar Transaksi</button></a>
    <a href="pembeli.php" target="_blank"><button>View Daftar Pembeli</button></a>
    <br><br>
    <form method="post" name="frm" action="transaksi-simpan.php">
    <table border="1">
    <tr>
        <td>Id Transaksi</td>
        <td><input type="text" name="IdTransaksi" size="10" maxlength="9" placeholder="ddmmyy###"></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td><input type="date" name="Tanggal" size="11" maxlength="10"></td>
    </tr>
    <tr>
        <td>Id Pembeli</td>
        <td><input type="text" name="IdPembeli" size="6" maxlength="5"></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td>
            <select name="IdBarang">
                <option>Pilih Barang</option>
                <?php
                    $databarang = getListBarang();
                    foreach ($databarang as $data)
                    {
                        echo "<option value=\"" . $data["IdBarang"] . "\">" . $data["NamaBarang"] . "</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
    <tr>
        <td>Jumlah Barang</td>
        <td><input type="text" name="JumlahBarang" size="4" maxlength="3"></td>
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