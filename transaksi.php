<link rel="stylesheet" href="style.css">

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
    <title>View Data Transaksi</title>
</head>
<body>
    <?php banner(); ?>
    <?php navigator() ?>
    <h1>View Data Transaksi</h1>
    <form method="post">
                <table border="1">
                <tr>
                    <td width="75" align="center">Pencarian</td>
                    <td><input type="text" name="dicari" size="26" maxlength="100" placeholder="Ketik keyword.." ></td>
                    <td><input type="submit" name="TblCari"></td>
                    <td><a href="javascript:history.back()"><button>Reset</button></a></td>
                </tr>
                </table>
                </form>
    <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) 
        {
            if (isset($_POST["TblCari"])) 
            {
                $dicari = $db->escape_string($_POST["dicari"]);
                $sqlcari = "SELECT transaksi.IdTransaksi, transaksi.Tanggal, pembeli.NamaPembeli,
                            barang.NamaBarang,  transaksi.JumlahBarang,
                            transaksi.JumlahBarang * barang.Harga as TotalBayar, pembeli.NoRek
                            FROM transaksi JOIN pembeli ON transaksi.IdPembeli=pembeli.IdPembeli
                            JOIN barang ON transaksi.IdBarang=barang.IdBarang
                            WHERE transaksi.IdTransaksi LIKE '%$dicari%' OR
                            transaksi.Tanggal LIKE '%$dicari%' OR
                            pembeli.NamaPembeli LIKE '%$dicari%' OR
                            barang.NamaBarang LIKE '%$dicari%' OR
                            pembeli.NoRek LIKE '%$dicari%'
                            ORDER BY IdTransaksi";
            $res = $db->query($sqlcari);
            if ($res) 
            {
    ?>
                <br>
                <a href="transaksi-tambah.php"><button>Tambah Data Transaksi</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Transaksi</th><th>Tanggal</th>
                    <th>Nama Pembeli</th><th>Nama Barang</th><th>Jumlah Barang</th>
                    <th>Total Bayar</th><th>Nomor Rekening</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdTransaksi"];?></td>
                            <td><?php echo $barisdata["Tanggal"];?></td>
                            <td><?php echo $barisdata["NamaPembeli"];?></td>
                            <td><?php echo $barisdata["NamaBarang"]; ?></td>
                            <td align="right"><?php echo $barisdata["JumlahBarang"]; ?></td>
                            <td align="right"><?php echo $barisdata["TotalBayar"]; ?></td>
                            <td align="right"><?php echo $barisdata["NoRek"]; ?></td>
                            <td width="80" align="center">
                                <a href="transaksi-konfirmasi-hapus.php?IdTransaksi=<?php echo $barisdata["IdTransaksi"];?>">
                                <button>Hapus</button></a>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                ?>
                </table>
    <?php
                $res->free();
            }
            }
            else
            {
            $sql = "SELECT transaksi.IdTransaksi, transaksi.Tanggal, pembeli.NamaPembeli,
                           barang.NamaBarang,  transaksi.JumlahBarang,
                           transaksi.JumlahBarang * barang.Harga as TotalBayar, pembeli.NoRek
                    FROM transaksi, pembeli, barang
                    WHERE barang.IdBarang=transaksi.IdBarang AND
                          pembeli.IdPembeli=transaksi.IdPembeli
                    ORDER BY IdTransaksi ";
            $res = $db->query($sql);
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $jumlahDataPerHalaman = 3;
            $jumlahData = count($data);
            $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
            $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
            $dataAwal = ($jumlahDataPerHalaman * $halAktif) - $jumlahDataPerHalaman;
            $sql.= "LIMIT $dataAwal, $jumlahDataPerHalaman;";
            $pagination = $db->query($sql);
            $datapage = $pagination->fetch_all(MYSQLI_ASSOC);
    ?>
                <br>
                <a href="transaksi-tambah.php"><button>Tambah Data Transaksi</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Transaksi</th><th>Tanggal</th>
                    <th>Nama Pembeli</th><th>Nama Barang</th><th>Jumlah Barang</th>
                    <th>Total Bayar</th><th>Nomor Rekening</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = $dataAwal+1;
                    foreach ($datapage as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdTransaksi"];?></td>
                            <td><?php echo $barisdata["Tanggal"];?></td>
                            <td><?php echo $barisdata["NamaPembeli"];?></td>
                            <td><?php echo $barisdata["NamaBarang"]; ?></td>
                            <td align="right"><?php echo $barisdata["JumlahBarang"]; ?></td>
                            <td align="right"><?php echo $barisdata["TotalBayar"]; ?></td>
                            <td align="right"><?php echo $barisdata["NoRek"]; ?></td>
                            <td width="80" align="center">
                                <a href="transaksi-konfirmasi-hapus.php?IdTransaksi=<?php echo $barisdata["IdTransaksi"];?>">
                                <button>Hapus</button></a>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                ?>
                </table>
    <?php
                $res->free();
    ?>
    <br>
    <div class="pagination">
            <?php if($halAktif>1) : ?>
                <a href="?hal=<?= $halAktif-1;?>">Previous</a>
            <?php endif; ?>
            <?php
                for ($i=1;$i<=$jumlahHalaman;$i++) : ?>
                    <?php if($i==$halAktif) : ?>
                        <a href="?hal=<?php echo $i;?>"
                        class="active"><?php echo $i;?></a>
                    <?php else : ?>
                        <a href="?hal=<?php echo $i;?>">
                        <?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor;?>

            <?php if($halAktif<$jumlahHalaman) : ?>
            <a href="?hal=<?= $halAktif+1;?>">Next</a>
            <?php endif; ?>
    </div>
<?php
        }
        }
        else 
        {
            echo "Gagal Koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
        }
    ?>
</body>
</html>