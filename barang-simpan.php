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
    <title>Penyimpanan Data Barang</title>
</head>
<body>
    <h1>Penyimpanan Data Barang</h1>
    <?php
        if (isset($_POST["TblSimpan"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                $IdBarang =$db->escape_string($_POST["IdBarang"]);
                $NamaBarang =$db->escape_string($_POST["NamaBarang"]);
                $Harga =$db->escape_string($_POST["Harga"]);
                $Stok =$db->escape_string($_POST["Stok"]);
                $Keterangan =$db->escape_string($_POST["Keterangan"]);
                
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
                $sql = "INSERT INTO barang(IdBarang, NamaBarang,
                                            Harga, Stok, Keterangan)
                        VALUES ('$IdBarang', '$NamaBarang',
                                '$Harga', '$Stok', '$Keterangan')";
                
                $res = $db->query($sql);
                if ($res) 
                {
                    if ($db->affected_rows > 0) 
                    {
    ?>
                        Data berhasil disimpan <br><br>
                        <a href="barang.php"><button>View Data Barang</button></a>
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
                    Data gagal disimpan karena Id Barang mungkin sudah ada <br><br>
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