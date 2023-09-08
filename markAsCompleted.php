<?php
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

// AJAX isteği ile gönderilen plan ID'sini alın
if (isset($_POST["id"])) {
    $planId = $_POST["id"];

    // Veritabanında ilgili planın "completed" sütununu güncelleyin
    $sql = "UPDATE planlar SET completed = 1 WHERE id = $planId";

    if ($conn->query($sql) === TRUE) {
        echo "Plan başarıyla tamamlandı";
    } else {
        echo "Plan tamamlanırken bir hata oluştu: " . $conn->error;
    }
} else {
    echo "Plan ID'si alınamadı";
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
