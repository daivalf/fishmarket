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
    <title>Pembaruan Data Pembeli</title>
</head>
<body>
    <h1>Pembaruan Data Pembeli</h1>
    <?php
        if (isset($_POST["TblUpdate"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                // bersihkan data
                $IdPembeli = $db->escape_string($_POST["IdPembeli"]);
                $NamaPembeli = $db->escape_string($_POST["NamaPembeli"]);
                $NoTelp = $db->escape_string($_POST["NoTelp"]);
                $AlamatPembeli = $db->escape_string($_POST["AlamatPembeli"]);
                $NoRek = $db->escape_string($_POST["NoRek"]);
                // susun query update
                $sql = "UPDATE pembeli
                        SET NamaPembeli='$NamaPembeli', NoTelp='$NoTelp',
                            AlamatPembeli='$AlamatPembeli', NoRek='$NoRek'
                        WHERE IdPembeli='$IdPembeli'";
                // eksekusi query
                if ($IdPembeli == '' ||
                $NamaPembeli == '' ||
                $NoTelp == '' ||
                $AlamatPembeli == '' ||
                $NoRek == '') 
                {
                    echo "Semua data harus diisi" . "<br><br>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                if (strlen($NoTelp)<11) 
                {
                    echo "Penulisan Nomor Telepon salah. Silahkan diisi dengan benar!" . "<br><br>";
                    ?>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
                    <?php
                }
                else
                if (cekNoTelp($NoTelp)==false)
                {
                    echo "Penulisan Nomor Telepon salah. Silahkan diisi dengan benar!" . "<br><br>";
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
                        <a href="pembeli.php"><button>View Data Pembeli</button></a>
    <?php               
                    }
                    else
                    { // jika sql sukses tapi tidak ada data berubah
    ?>
                        Data berhasil diupdate tanpa ada perubahan <br><br>
                        <a href="javascript:history.back()"><button>Edit Kembali</button></a>
                        <a href="pembeli.php"><button>View Data Pembeli</button></a>
    <?php
                    }
                }
                else 
                { // gagal query
    ?>
                Data gagal diupdate <br>
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