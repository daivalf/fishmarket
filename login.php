<?php
    include_once("functions.php");
?>
<?php
    $db = dbConnect();
    if (isset($_POST["TblLogin"])) 
    {
        $IdUser = $db->escape_string($_POST["IdUser"]);
        $password = $db->escape_string($_POST["Password"]);
        $sql = "SELECT IdUser, NamaUser
                FROM user
                WHERE IdUser = '$IdUser' and Password = '$password'";
        $res = $db->query($sql);
        if ($res) 
        {
            if ($res->num_rows == 1) 
            {
                $data = $res->fetch_assoc();
                session_start();
                $_SESSION["IdUser"] = $data["IdUser"];
                $_SESSION["NamaUser"] = $data["NamaUser"];
                header("Location: transaksi.php");
            }
            else 
            {
                header("Location: index.php?error=1");
            }
        }
        else 
        {
            header("Location: index.php?error=2");
        }
    }
    else {
        header("Location: index.php?error=3");
    }
?>