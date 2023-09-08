<!-- sil.php -->
<?php
if (isset($_GET['id'])) {
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

    // Silinecek verinin ID'sini al
    $id = $_GET['id'];

    // Veriyi silme sorgusu
    $sql = "DELETE FROM planlar WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: gecmis.php"); // Kullanıcıyı geçmiş sayfasına yönlendir
        exit(); // Skriptin çalışmasını durdur
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
}
?>
