<?php
session_start();
if (isset($_SESSION["ad"])) {
    include("./includes/eklenav.php");
    include("./includes/ekletablo.php");
    } else {
        echo "Bu sayfayı görüntüleyemezsin!";
        echo "<a href='./login.php' class='ms-2'>Giriş Yap'a Dön</a>";
    }
    include("./includes/bootstrap.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";
    $password = "yusuf205587";
    $dbname = "hedefgelisim";

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Form verilerini al
    $plan = $_POST['plan'];
    $plan_date = $_POST['plan_date'];

    // Veritabanına veriyi ekle
    $sql = "INSERT INTO planlar (plan, plan_date) VALUES ('$plan', '$plan_date')";

    if ($conn->query($sql) === TRUE) {
        echo "İşlem Başarılı, Planlamalarınıza \"Geçmiş\" kısmından bakabilirsiniz";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
}
?>
