<?php
include("./includes/baglanti.php");
include("./includes/bootstrap.php");


$email_err = "";
$parola_err = "";

if (isset($_POST["giris"])) {

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
    } else {
        $parola = $_POST["parola"];
    } {

        $secim="SELECT * FROM kullanicilar WHERE email = '$email'";
        $calistir=mysqli_query($baglanti, $secim);
        $kayitsayisi = mysqli_num_rows($calistir);

        if($kayitsayisi>0)
        {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $hashlisifre=$ilgilikayit["parola"];

            if(password_verify($parola, $hashlisifre))
            {
                session_start();
                $_SESSION["ad"]=$ilgilikayit["ad"];
                $_SESSION["soyad"]=$ilgilikayit["soyad"];
                $_SESSION["email"]=$ilgilikayit["email"];
                header("location:anasayfa.php");
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
        Parola Yanlış!
      </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
        Email Yanlış!
      </div>';
        }


        mysqli_close($baglanti);
    }
}
?>
<div class="position-absolute top-50 start-50 translate-middle">
    <form action="./login.php" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control <?php
                                                    if (!empty($email_err)) {
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
                                                        if (!empty($parola_err)) {
                                                            echo "is-invalid";
                                                        }
                                                        ?>" name="parola" id="exampleInputPassword1">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php
                echo $parola_err;
                ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="giris">Giriş Yap</button>
    </form>
</div>