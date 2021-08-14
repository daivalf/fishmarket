<link rel="stylesheet" href="style.css">

<?php
    include_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php bannerluar(); ?>
    <div class="loginbox">
    <h1>Login</h1>
    <form method="post" name="f" action="login.php">
        <div class="textbox">
            <input placeholder="Username" type="text" name="IdUser" maxlength="10"
            value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"admin":"");?>">
        </div>
        <div class="textbox">
            <input placeholder="Password" type="password" name="Password" maxlength="40"
            value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.47"?"password_admin":"");?>">
        </div>
        <br>
            <input class="btnlogin" type="submit" name="TblLogin" value="Login">
    </form>
    </div>

    <?php
        if (isset($_GET["error"]))
         {
            $error = $_GET["error"];
            if ($error ==1) 
            {
                showError("Username dan Password tidak sesuai");
            }
            else 
            if ($error == 2)
            {
                showError("Error database. Silahkan hubungi administrator");
            }
            else 
            if ($error == 3)
            {
                showError("Koneksi ke Database gagal. Autentikasi gagal.");
            }
            else 
            if ($error == 4)
            {
                showError("Anda tidak boleh mengakses halaman karena belum login.
                           Silahkan login.");
            }
            else 
            {
                showError("Unknown Error");
            }
        }
    ?>
</body>
</html>