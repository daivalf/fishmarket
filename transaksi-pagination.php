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
<?php banner(); ?>
<?php navigator() ?>
<?php
$db = dbConnect();
$sql = "SELECT transaksi.IdTransaksi, transaksi.Tanggal, pembeli.NamaPembeli,
        barang.NamaBarang,  transaksi.JumlahBarang,
        transaksi.JumlahBarang * barang.Harga as TotalBayar, pembeli.NoRek
        FROM transaksi, pembeli, barang
        WHERE barang.IdBarang=transaksi.IdBarang AND
        pembeli.IdPembeli=transaksi.IdPembeli
        ORDER BY IdTransaksi ";
$res=$db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC); //ambil dulu semua data nya buat dihitung
$jumlahDataPerHalaman = 4; //jumlah data yg ditampilkan per halaman
$jumlahData = count($data); //hitung total seluruh data yg udah di fetch_all di atas
$jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman); //hitung jumlah halaman buat pagination
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1; //cari halaman aktif
//halaman = 2 , data awal = 3
$dataAwal = ($jumlahDataPerHalaman * $halAktif) - $jumlahDataPerHalaman; //cari halaman awal
$sql.= "LIMIT $dataAwal,$jumlahDataPerHalaman;"; //sql gabungan dari yang pertama
//kalo dijadiin satu jadi select blablaba limit LIMIT $dataAwal,$jumlahDataPerHalaman 
$pagination = $db->query($sql); //sql baru untuk pagination
$datapage = $pagination->fetch_all(MYSQLI_ASSOC);
?>
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
foreach($datapage as $barisdata)
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
?>
<div class="pagination">
    <li>
        <?php if($halAktif>1) : ?>
        <a href="?hal=<?= $halAktif-1;?>">Previous</a>
        <?php endif; ?> <?php
                            for ($i=1;$i<=$jumlahHalaman;$i++) : ?> <?php 
                                if($i==$halAktif) : ?> <a href="?hal=<?php echo $i;?>"
            class="active"><?php echo $i;?></a>
        <?php else : ?>
        <a href="?hal=<?php echo $i;?>"><?php echo $i; ?></a>
        <?php endif; ?>
        <?php endfor;?>

        <?php if($halAktif<$jumlahHalaman) : ?>
        <a href="?hal=<?= $halAktif+1;?>">Next</a>
        <?php endif; ?>
    </li>
</div>