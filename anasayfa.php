<?php
session_start();
if(isset($_SESSION["ad"]))
{
    include("./includes/uyeliknav.php");
}
else{
    echo "Bu sayfayı görüntüleyemezsin!";
    echo "<a href='./login.php' class='ms-2'>Giriş Yap'a Dön</a>";
    
}
include("./includes/bootstrap.php")
?>
