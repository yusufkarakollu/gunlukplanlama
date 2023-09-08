<?php
include("./includes/baglanti.php");
include("./includes/bootstrap.php");

$name_err = "";
$surname_err = "";
$email_err = "";
$parola_err = "";
$parolatekrar_err="";

if (isset($_POST["kaydol"])) {
    //ad sorgulama
    if (empty($_POST["ad"])) {
        $name_err = "Ad Boş Bırakılamaz!";
    } else if (strlen($_POST["ad"]) > 15) {
        $name_err = "Ad en fazla 15 harf uzunluğunda olabilir!";
    } else if (!preg_match('/^[a-zA-Z]{5,20}$/', $_POST["ad"])) {
        $name_err = "Ad sadece harf karakterlerinden oluşabilir!";
    } else {
        $name = $_POST["ad"];
    }

    //soyad sorgulama

    if (empty($_POST["soyad"])) {
        $surname_err = "Soyad Boş Bırakılamaz!";
    } else if (strlen($_POST["soyad"]) > 15) {
        $surname_err = "Soyad en fazla 15 harf uzunluğunda olabilir!";
    } else if (!preg_match('/^[a-zA-Z]{5,20}$/', $_POST["soyad"])) {
        $surname_err = "Soyad sadece harf karakterlerinden oluşabilir!";
    } else {
        $surname = $_POST["soyad"];
    }

    //Email sorgulama

    if (empty($_POST["email"])) {
        $email_err = "Email alanı boş bırakılamaz.";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçersiz Karakter Kullanımı!";
    } else {
        $email = $_POST["email"];
    }

    //parola sorgulama
    if (empty($_POST["parola"])) {
        $parola_err = "Parola boş bırakılamaz!";
    } else if (strlen($_POST["parola"]) > 15) {
        $parola_err = "Parola en fazla 15 karakter uzunluğunda olabilir!";
    }
    else{
        $parola=password_hash($_POST["parola"], PASSWORD_DEFAULT);
    }

    //parola tekrar
    if(empty($_POST["parolatekrar"]))
    {
        $parolatekrar_err="Parola tekrarlama boş bırakılamaz!";
    }
    else if($_POST["parola"]!=$_POST["parolatekrar"])
    {
        $parolatekrar_err="Parolalar eşleşmiyor!";
    }
    else {
        $parolatekrar=$_POST["parolatekrar"];
    }


    $ekle = "INSERT INTO kullanicilar (ad, soyad, email, parola) VALUES ('$name','$surname','$email','$parola')";
    $calistirekle = mysqli_query($baglanti, $ekle);
    if ($calistirekle) {
        echo '<div class="alert alert-success" role="alert">
        Kayıt Başarılı!
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Kayıt Başarısız!!!
      </div>';
    }

    mysqli_close($baglanti);
}

?>
<div class="position-absolute top-50 start-50 translate-middle">
    <form action="./kayit.php" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ad</label>
            <input type="text" class="form-control
            <?php
            if(!empty($name_err))
            {
                echo "is-invalid";
            }
            ?>
            
            " name="ad" id="exampleInputEmail1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $name_err;
                ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Soyad</label>
            <input type="text" class="form-control <?php
            if(!empty($surname_err))
            {
                echo "is-invalid";
            }
            ?>" name="soyad" id="exampleInputEmail1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $surname_err;
                ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control <?php
            if(!empty($email_err))
            {
                echo "is-invalid";
            }
            ?>" name="email" id="exampleInputEmail1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $email_err;
                ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parola</label>
            <input type="password" class="form-control <?php
            if(!empty($parola_err))
            {
                echo "is-invalid";
            }
            ?>" name="parola" id="exampleInputPassword1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $parola_err;
                ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parola Tekrar</label>
            <input type="password" class="form-control <?php
            if(!empty($parolatekrar_err))
            {
                echo "is-invalid";
            }
            ?>" name="parolatekrar" id="exampleInputPassword1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $parolatekrar_err;
                ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="kaydol">Kaydol</button>
    </form>
</div>