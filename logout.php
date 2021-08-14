<?php
    session_start();
    session_destroy();
    echo "<script>
    alert('Anda telah logout. Silahkan login kembali untuk mengakses halaman!');
    document.location.href = 'index.php';
    </script>";
?>