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
    <title>Hapus Data Barang</title>
</head>
<body>
    <h1>Hapus Data Barang</h1>
    <?php
        if (isset($_POST["TblHapus"])) 
        {
            $db = dbConnect();
            if ($db->connect_errno == 0) 
            {
                $IdBarang = $db->escape_string($_POST["IdBarang"]);
                // susun query delete
                $sql = "DELETE FROM barang WHERE IdBarang='$IdBarang'";
                // eksekusi query
                $res = $db->query($sql);
                if ($res) 
                {
                    if ($db->affected_rows > 0) // jika ada data terhapus
                    {
                        echo "Data berhasil dihapus <br><br>";
                    }
                    else // jika sql sukses tapi tidak ada data dihapus
                    {
                        echo "Penghapusan gagal karena data yang dihapus tidak ada <br><br>";
                    }
                }
                else // gagal query
                {
                    echo "Data gagal dihapus <br><br>";
                }
    ?>
                <a href="barang.php"><button>View Data Barang</button></a>
    <?php
            }
            else 
            {
                echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
            }
        }
    ?>
</body>
</html>