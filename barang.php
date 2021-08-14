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
    <title>View Data Barang</title>
</head>
<body>
    <?php banner(); ?>
    <?php navigator() ?>
    <h1>View Data Barang</h1>
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
                <br>
    <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) 
        {
            if (isset($_POST["TblCari"])) 
            {
                $dicari = $db->escape_string($_POST["dicari"]);
                $sqlcari = "SELECT * FROM barang
                            WHERE IdBarang LIKE '%$dicari%' OR NamaBarang LIKE '%$dicari%'
                            ORDER BY IdBarang";
                $res = $db->query($sqlcari);
                if ($res) 
                {
                    ?>
                <a href="barang-tambah.php"><button>Tambah Data Barang</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Barang</th><th>Nama Barang</th>
                    <th>Harga</th><th>Stok</th><th>Keterangan</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdBarang"];?></td>
                            <td><?php echo $barisdata["NamaBarang"];?></td>
                            <td align="center"><?php echo $barisdata["Harga"];?></td>
                            <td align="center"><?php echo $barisdata["Stok"]; ?></td>
                            <td>
                                <textarea style="resize: none;" cols="60" rows="3" readonly><?php echo $barisdata["Keterangan"];?></textarea>
                            </td>
                            <td width="60" align="center">
                                <a href="barang-form-edit.php?IdBarang=<?php echo $barisdata["IdBarang"];?>">
                                <button>Edit</button></a>
                            </td>
                            <td width="80" align="center">
                                <a href="barang-konfirmasi-hapus.php?IdBarang=<?php echo $barisdata["IdBarang"];?>">
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
            $sql = "SELECT * FROM barang
                    WHERE IdBarang != ''
                    ORDER BY IdBarang";
            $res = $db->query($sql);
            if ($res) 
            {
    ?>
                <a href="barang-tambah.php"><button>Tambah Data Barang</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Barang</th><th>Nama Barang</th>
                    <th>Harga</th><th>Stok</th><th>Keterangan</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdBarang"];?></td>
                            <td><?php echo $barisdata["NamaBarang"];?></td>
                            <td align="center"><?php echo $barisdata["Harga"];?></td>
                            <td align="center"><?php echo $barisdata["Stok"]; ?></td>
                            <td>
                                <textarea style="resize: none;" cols="60" rows="3" readonly><?php echo $barisdata["Keterangan"];?></textarea>
                            </td>
                            <td width="60" align="center">
                                <a href="barang-form-edit.php?IdBarang=<?php echo $barisdata["IdBarang"];?>">
                                <button>Edit</button></a>
                            </td>
                            <td width="80" align="center">
                                <a href="barang-konfirmasi-hapus.php?IdBarang=<?php echo $barisdata["IdBarang"];?>">
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
            else
            {
                echo "Gagal SQL" . (DEVELOPMENT ? " : " . $db->error : "") . "<br>";
            }
        }
        }
        else 
        {
            echo "Gagal Koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
        }
    ?>
</body>
</html>