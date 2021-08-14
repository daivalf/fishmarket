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
    <title>Pembaruan Data Barang</title>
</head>
<body>
    <h1>Pembaruan Data Barang</h1>
    <?php
        if (isset($_POST["TblUpdate"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                // bersihkan data
                $IdBarang = $db->escape_string($_POST["IdBarang"]);
                $NamaBarang = $db->escape_string($_POST["NamaBarang"]);
                $Harga = $db->escape_string($_POST["Harga"]);
                $Stok = $db->escape_string($_POST["Stok"]);
                $Keterangan = $db->escape_string($_POST["Keterangan"]);
                // susun query update
                
                $sql = "UPDATE barang
                        SET NamaBarang='$NamaBarang', Harga='$Harga',
                            Stok='$Stok', Keterangan='$Keterangan'
                        WHERE IdBarang='$IdBarang'";
                // eksekusi query

                if ($IdBarang == '' ||
                    $NamaBarang == '' ||
                    $Harga == '' ||
                    $Stok == '' ||
                    $Keterangan == '') 
                {
                    echo "Semua data harus diisi" . "<br><br>";
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
                        <a href="barang.php"><button>View Data Barang</button></a>
    <?php               
                    }
                    else
                    { // jika sql sukses tapi tidak ada data berubah
    ?>
                        Data berhasil diupdate tanpa ada perubahan <br><br>
                        <a href="javascript:history.back()"><button>Edit Kembali</button></a>
                        <a href="barang.php"><button>View Data Barang</button></a>
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
            else {
                echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "");
            }
        }
    ?>
</body>
</html>