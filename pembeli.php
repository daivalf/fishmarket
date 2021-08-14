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
    <title>View Data Pembeli</title>
</head>
<body>
    <?php banner(); ?>
    <?php navigator() ?>
    <h1>View Data Pembeli</h1>
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
                $sqlcari = "SELECT * FROM pembeli
                            WHERE IdPembeli LIKE '%$dicari%' OR NamaPembeli LIKE '%$dicari%'
                            OR NoTelp LIKE '%$dicari%' OR NoRek LIKE '%$dicari%'
                            ORDER BY IdPembeli";
                $res = $db->query($sqlcari);
                if ($res) 
                {
                    ?>
                <a href="pembeli-tambah.php"><button>Tambah Data Pembeli</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Pembeli</th><th>Nama Pembeli</th>
                    <th>Nomor Telepon</th><th>Alamat</th><th>Nomor Rekening</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdPembeli"];?></td>
                            <td width="150"><?php echo $barisdata["NamaPembeli"];?></td>
                            <td align="center"><?php echo $barisdata["NoTelp"];?></td>
                            <td>
                                <textarea style="resize: none;" cols="60" rows="3" readonly><?php echo $barisdata["AlamatPembeli"];?></textarea>
                            </td>
                            <td align="right"><?php echo $barisdata["NoRek"]; ?></td>
                            <td width="60" align="center">
                                <a href="pembeli-form-edit.php?IdPembeli=<?php echo $barisdata["IdPembeli"];?>">
                                <button>Edit</button></a>
                            </td>
                            <td width="80" align="center">
                                <a href="pembeli-konfirmasi-hapus.php?IdPembeli=<?php echo $barisdata["IdPembeli"];?>">
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
            $sql = "SELECT * FROM pembeli
                    WHERE IdPembeli != ''
                    ORDER BY IdPembeli";
            $res = $db->query($sql);
            if ($res) 
            {
    ?>
                <a href="pembeli-tambah.php"><button>Tambah Data Pembeli</button></a>
                <br><br>
                <table border="1">
                <tr>
                    <th>No</th><th>Id Pembeli</th><th>Nama Pembeli</th>
                    <th>Nomor Telepon</th><th>Alamat</th><th>Nomor Rekening</th><th colspan="2">Aksi</th>
                </tr>
                <?php
                    $i = 1;
                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $barisdata) 
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $barisdata["IdPembeli"];?></td>
                            <td width="150"><?php echo $barisdata["NamaPembeli"];?></td>
                            <td align="center"><?php echo $barisdata["NoTelp"];?></td>
                            <td>
                                <textarea style="resize: none;" cols="60" rows="3" readonly><?php echo $barisdata["AlamatPembeli"];?></textarea>
                            </td>
                            <td align="right"><?php echo $barisdata["NoRek"]; ?></td>
                            <td width="60" align="center">
                                <a href="pembeli-form-edit.php?IdPembeli=<?php echo $barisdata["IdPembeli"];?>">
                                <button>Edit</button></a>
                            </td>
                            <td width="80" align="center">
                                <a href="pembeli-konfirmasi-hapus.php?IdPembeli=<?php echo $barisdata["IdPembeli"];?>">
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