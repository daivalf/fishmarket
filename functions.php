<link rel="stylesheet" href="style.css">

<?php
define("DEVELOPMENT" , TRUE);

function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "dbfishmarket");
    return $db;
}

function cekIsiTgl($data)
{
    if (preg_match("/^[0-9-\-]*$/",$data)) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function cekTgl($data)
{
    $ar = explode("-", $data);
    // cek tahun
    if (strlen($ar[0])<4)
    {
        return false;
    }
    // cek bulan
    else
    if ($ar[1]>12 || strlen($ar[1])<2)
    {
        return false;
    }
    else
    if ($ar[2]>31 || strlen($ar[1])<2)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function cekNoTelp($data)
{
    if (preg_match("/^[1-9]{1}[0-9]+/",$data)) 
    {
        return false;
    }
    else
    {
        return true;
    }
}

function getListBarang()
{
    $db = dbConnect();
        if ($db->connect_errno == 0) 
        {
            $res = $db->query("SELECT * FROM barang ORDER BY IdBarang");
            if ($res) 
            {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            }
            else 
            {
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
}

function getDataPembeli($IdPembeli)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) 
    {
        $res = $db->query("SELECT * FROM pembeli
                           WHERE IdPembeli='$IdPembeli'");
        if ($res) 
        {
            if ($res->num_rows > 0) 
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else 
            {
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
    }
    else 
    {
        return FALSE;
    }
}

function getDataTransaksi($IdTransaksi)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) 
    {
        $res = $db->query("SELECT transaksi.IdTransaksi, transaksi.Tanggal, pembeli.NamaPembeli,
                                  barang.NamaBarang,  transaksi.JumlahBarang,
                                  transaksi.JumlahBarang * barang.Harga as TotalBayar, pembeli.NoRek
                           FROM transaksi, pembeli, barang
                           WHERE barang.IdBarang=transaksi.IdBarang AND
                                 pembeli.IdPembeli=transaksi.IdPembeli AND
                                 Idtransaksi='$IdTransaksi'");
        if ($res) 
        {
            if ($res->num_rows > 0) 
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else 
            {
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
    }
    else 
    {
        return FALSE;
    }
}

function getDataBarang($IdBarang)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) 
    {
        $res = $db->query("SELECT * FROM barang
                           WHERE IdBarang='$IdBarang'");
        if ($res) 
        {
            if ($res->num_rows > 0) 
            {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            }
            else 
            {
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
    }
    else 
    {
        return FALSE;
    }
}

function bannerluar()
{
    ?>
    <div class="header" id="banner" align="center">
        <h1>Fish Market</h1>
    </div>
    <?php
}

function banner()
{
    ?>
    <div class="header" id="banner" align="center">
        <h1>Fish Market</h1>
        <h2>Welcome <?php echo $_SESSION["NamaUser"]; ?></h2>
    </div>
    <?php
}

function navigator()
{
	?>
<div class="navbar">
    <li><a href="transaksi.php">Home</a></li>
    <li><a href="pembeli.php">Pembeli</a></li>
    <li><a href="barang.php">Barang</a></li>
    <li style="float:right;"><a style=" color: red;" href="logout.php">Logout</a></li>
</div>
    <?php
    }

function showError($message)
{
	?>
    <div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
    <?php echo $message;?>
    </div>
	<?php
}

?>