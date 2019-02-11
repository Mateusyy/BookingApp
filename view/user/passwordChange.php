<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 28.05.2018
 * Time: 21:22
 */

$email = $_GET['email'];
$myKey = $_POST['key'];

?>

<div class="container-fluid bg-light">
    <div class="card col-sm-10 col-md-8 col-lg-6 mx-auto border-success my-5">
        <div class="card-header bg-transparent text-center">
            <img src="/content/logo128.png" class="img-thumbnail rounded-circle border-success" alt="Zagrałbym.pl">
            <h4 class="h4">Resetowanie hasła <i class="material-icons align-middle">contact_mail</i></h4>
        </div>
        <div class="card-body bg-transparent">
            <form id="changePasswordForm" action="/User/passwordChangeFunc?email=<?=$email?>&key=<?=$myKey?>" method="post">
                <p class="text-success text-center">Wprowadź i potwierdź nowe hasło</p>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="email"
                               value="<?php echo $email; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass1" class="col-sm-3 col-form-label">Nowe hasło</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="pass1" id="pass1"
                               placeholder="Wprowadź hasło">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass2" class="col-sm-3 col-form-label">Potwierdź hasło</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="pass2" id="pass2"
                               placeholder="Potwierdź wprowadzone hasło">
                    </div>
                </div>
        </div>
        <div class="card-footer bg-transparent">
            <button type="submit" id="changePasswordSubmit" class="btn btn-success float-right">Zmień hasło
            </button>
            </form>
        </div>

        <div hidden id="succesAlert" class="alert alert-success alert-dismissible animated regular fadeIn">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sukces!</strong> Hasło zostało zmienione.
        </div>
        <div hidden id="failAlert" class="alert alert-danger alert-dismissible animated regular fadeIn ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Uwaga!</strong> Coś poszło nie tak. Spróbuj ponownie.
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        var validator = $("#changePasswordForm").validate();

        $.validator.addMethod("passwordB", function (value, element) {
            return this.optional(element) || /^(?=.*\d)[A-Za-z\d]{6,25}$/i.test(value);
        }, "Hasło musi zawierać same litery i minimum jedną cyfrę");

        $("#pass1").rules("add", {
            required: true,
            rangelength: [6, 25],
            passwordB: true
        });

        $("#pass2").rules("add", {
            equalTo: "#pass1"
        });

        $("input").keyup(function () {
            if (validator.element(this)) {
                $(this).addClass("is-valid");
                $(this).removeClass("is-invalid");
            } else {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
            }
        });

        $("#changePasswordSubmit").click(function () {
            validator.validate();
        });
    })
</script>