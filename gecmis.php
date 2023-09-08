<style>
    .completed {
        text-decoration: line-through;
        /* Üstü çizgili metin */
    }

    .ustunu-cizgi {
    text-decoration: line-through;
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
session_start();
if (isset($_SESSION["ad"])) {
    include("./includes/eklenav.php");
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

    // Planları çek
    $sql = "SELECT * FROM planlar";
    $result = $conn->query($sql);
?>
    <div class="col-6 offset-3 mt-5">
    <div class="card p-3">
        <h2>Geçmiş Planlamalar</h2>
        <table>
            <tr>
                <th>Planlanan</th>
                <th>Planlandığı Tarih</th>
                <th>İşlemler</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='list-item-".$row["id"]."'>";
                    // Eğer plan tamamlanmışsa metni üst çiz
                    if ($row["completed"] == 1) {
                        echo "<del class='completed'>" . $row["plan"] . "</del>";
                    } else {
                        echo $row["plan"];
                    }
                    echo "</td>";
                    echo "<td>" . $row["plan_date"] . "</td>";
                    // Silme butonu ekleyin
                    echo "<td><a href='sil.php?id=" . $row["id"] . "'>Sil</a></td>";
                    // Tamamlama butonu ekleyin
                    echo "<td>";
                    if ($row["completed"] == 0) {
                        echo "<button onclick='markAsCompleted(" . $row["id"] . ")'>Tamamlandı</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Henüz planlama eklenmemiş.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<script>
    // JavaScript ile planı tamamlama fonksiyonu
    function markAsCompleted(planId) {
        $.ajax({
            url: "markAsCompleted.php",
            method: "POST",
            data: { id: planId },
            success: function(response) {
                $(".list-item-"+planId).addClass("ustunu-cizgi");
                // İşlem başarılı ise, butona tıklanınca üstü çizilmiş metni göster
                var row = $("tr:has(td:contains(" + planId + "))");
                row.find("td:first-child del").addClass("completed");
                row.find("button").remove(); // Tamamlama butonunu kaldır
            },
            error: function() {
                alert("İşaretleme işlemi sırasında bir hata oluştu.");
            }
        });
    }
</script>
<?php
    // Veritabanı bağlantısını kapat
    $conn->close();
} else {
    echo "Bu sayfayı görüntüleyemezsin!";
    echo "<a href='./login.php' class='ms-2'>Giriş Yap'a Dön</a>";
}
include("./includes/bootstrap.php");
?>
