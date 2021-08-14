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
    <title>Penyimpanan Data Pembeli</title>
</head>
<body>
    <h1>Penyimpanan Data Pembeli</h1>
    <?php
        if (isset($_POST["TblSimpan"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                $IdPembeli =$db->escape_string($_POST["IdPembeli"]);
                $NamaPembeli =$db->escape_string($_POST["NamaPembeli"]);
                $NoTelp =$db->escape_string($_POST["NoTelp"]);
                $AlamatPembeli =$db->escape_string($_POST["AlamatPembeli"]);
                $Norek = $db->escape_string($_POST["NoRek"]);
                
                if ($IdPembeli == '' ||
                    $NamaPembeli == '' ||
                    $NoTelp == '' ||
                    $AlamatPembeli == '' ||
                    $Norek == '') 
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
                $sql = "INSERT INTO pembeli(IdPembeli, NamaPembeli,
                                            NoTelp, AlamatPembeli, NoRek)
                        VALUES ('$IdPembeli', '$NamaPembeli',
                                '$NoTelp', '$AlamatPembeli', '$Norek')";
                
                $res = $db->query($sql);
                if ($res) 
                {
                    if ($db->affected_rows > 0) 
                    {
    ?>
                        Data berhasil disimpan <br><br>
                        <a href="pembeli.php"><button>View Data Pembeli</button></a>
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
                    Data gagal disimpan karena Id Pembeli mungkin sudah ada <br><br>
                    <a href="javascript:history.back()"><button>Kembali</button></a>
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