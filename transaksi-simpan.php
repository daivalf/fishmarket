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
    <title>Penyimpanan Data Transaksi</title>
</head>
<body>
    <h1>Penyimpanan Data Transaksi</h1>
    <?php
        if (isset($_POST["TblSimpan"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                $IdTransaksi =$db->escape_string($_POST["IdTransaksi"]);
                $Tanggal =$db->escape_string($_POST["Tanggal"]);
                $IdPembeli =$db->escape_string($_POST["IdPembeli"]);
                $IdBarang =$db->escape_string($_POST["IdBarang"]);
                $JumlahBarang =$db->escape_string($_POST["JumlahBarang"]);

                if ($IdTransaksi == '' ||
                    $Tanggal == '' ||
                    $IdPembeli == '' ||
                    $IdBarang == '' ||
                    $JumlahBarang == '') 
                {
                    echo "Mohon isi dulu semua data!" . "<br><br>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                if (strlen($Tanggal)!=10)
                {
                    echo "Penulisan tanggal salah. Silahkan isi kembali!" . "<br><br>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                if (cekIsiTgl($Tanggal)==false || cekTgl($Tanggal)==false)
                {
                    echo "Penulisan tanggal salah. Silahkan diisi dengan YYYY-MM-DD!" . "<br><br>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                {
                $sql = "INSERT INTO transaksi(IdTransaksi, Tanggal,
                                              IdPembeli, IdBarang, JumlahBarang)
                        VALUES ('$IdTransaksi', '$Tanggal',
                                '$IdPembeli', '$IdBarang', '$JumlahBarang')";
                
                $res = $db->query($sql);
                if ($res) 
                {
                    if ($db->affected_rows > 0) 
                    {
    ?>
                        Data berhasil disimpan <br><br>
                        <a href="transaksi.php"><button>View Data Transaksi</button></a>
    <?php
                    }
                    else 
                    {
                        echo "Data gagal disimpan karena tidak lengkap" . "<br><br>";
                        ?>
                        <a href="javascript:history.back()"><button>Kembali</button></a>
                        <?php
                    }
                }
                else 
                {
    ?>
                    Data gagal disimpan karena Id Transaksi atau Id Pembeli mungkin sudah ada<br>
                    Silahkan lihat Id Pembeli terlebih dahulu<br><br>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <a href="pembeli.php" target="_blank"><button>View Data Pembeli</button></a>
    <?php
                }
                }
            }
            else 
            {
                echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
            }
        }
    ?>
</body>
</html>