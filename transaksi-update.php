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
    <title>Pembaruan Data Transaksi</title>
</head>
<body>
    <h1>Pembaruan Data Transaksi</h1>
    <?php
        if (isset($_POST["TblUpdate"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                // bersihkan data
                $IdTransaksi = $db->escape_string($_POST["IdTransaksi"]);
                $Tanggal = $db->escape_string($_POST["Tanggal"]);
                $JumlahBarang = $db->escape_string($_POST["JumlahBarang"]);
                // susun query update
                $sql = "UPDATE transaksi
                        SET Tanggal='$Tanggal', JumlahBarang='$JumlahBarang'
                        WHERE IdTransaksi='$IdTransaksi'";
                // eksekusi query
                if ($Tanggal == '' ||
                    $JumlahBarang == '') 
                {
                    echo "<script>
                            alert('Mohon isi dahulu semua data!');
                            document.location.href = 'javascript:history.back()';
                          </script>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                {
                $res = $db->query($sql);
                if ($res) 
                {
                    if ($db->affected_rows > 0) // jika ada update 
                    {
    ?>
                        Data berhasil diupdate <br><br>
                        <a href="transaksi.php"><button>View Data Transaksi</button></a>
    <?php               
                    }
                    else
                    { // jika sql sukses tapi tidak ada data berubah
    ?>
                        Data berhasil diupdate tanpa ada perubahan <br><br>
                        <a href="javascript:history.back()"><button>Edit Kembali</button></a>
                        <a href="transaksi.php"><button>View Data Transaksi</button></a>
    <?php
                    }
                }
                else 
                { // gagal query
    ?>
                Data gagal diupdate <br><br>
                <a href="javascript:history.back()"><button>Edit Kembali</button></a>
    <?php
                }
                }
            }
            else 
            {
                echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "");
            }
        }
    ?>
</body>
</html>