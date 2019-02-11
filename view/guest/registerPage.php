<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 24.04.2018
 * Time: 00:04
 */


?>

<div class="container-fluid bg-light">
    <div class="card col-sm-10 col-md-8 col-lg-6 mx-auto border-success my-5">
        <div class="card-header bg-transparent text-center">
            <img src="/content/logo128.png" class="img-thumbnail rounded-circle border-success" alt="Zagrałbym.pl">
            <h4 class="h4">Utwórz nowe konto <i class="material-icons align-middle">person_add</i></h4>
        </div>
        <div class="card-body bg-transparent">
            <form id="registerForm" method="post" action="/Guest/register">

                <p class="text-success text-center">Wprowadź niezbędne dane.<br>Resztę informacji możesz wprowadzić po
                    utworzeniu konta w profilu użytkownika.</p>

                <div class="form-group row">
                    <label for="login" class="col-sm-3 col-form-label">Login</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="login" id="login" placeholder="Wprowadź login">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Wprowadź adres e-mail">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Imię</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" id="username"
                               placeholder="Wprowadź imię">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-3 col-form-label">Nazwisko</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="surname" id="surname"
                               placeholder="Wprowadź nazwisko">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password1" class="col-sm-3 col-form-label">Hasło</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password1" id="password1"
                               placeholder="Wprowadź hasło">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password2" class="col-sm-3  col-form-label">Powtórz hasło</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password2" id="password2"
                               placeholder="Powtórz hasło">
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6Lc7zlkUAAAAADgUTcCFoduFdqBGGLkKaow2gxoN"></div>
        </div>
        <div class="card-footer bg-transparent">
            <button id="submitButton" type="submit" class="btn btn-success float-right">Rejestruj</button>
            <!--        <input type="submit" class="btn btn-info float-right" value="Zaloguj przez FB">-->
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var validator = $("#registerForm").validate();

        $.validator.addMethod("lettersOnly", function (value, element) {
            return this.optional(element) || /^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/i.test(value);
        }, "Wprowadziłeś niepoprawny znak (wprowadź tylko litery, bez spacji");

        $.validator.addMethod("minOneDigt", function (value, element) {
            return this.optional(element) || /\d+$/i.test(value);
        }, "Hasło powinno zawierać przynajmniej jedną cyfrę");

        $.validator.addMethod("passwordB", function (value, element) {
            return this.optional(element) || /^(?=.*\d)[A-Za-z\d]{6,25}$/i.test(value);
        }, "Hasło musi zawierać same litery i minimum jedną cyfrę");

        $.validator.addMethod("loginB", function (value, element) {
            return this.optional(element) || /^(?=.*[A-Za-z0-9]$)[A-Za-z][A-Za-z\d.-]{0,19}$/i.test(value);
        }, "Login powinien zawierać tylko litery i cyfry");

        $("#login").rules("add", {
            required: true,
            rangelength: [3, 25],
            loginB: true,
            remote: {
                url: "/DB/find_by_login",
                type: "post"
            }
        });

        $("#username").rules("add", {
            required: true,
            rangelength: [3, 25],
            lettersOnly: true
        });

        $("#surname").rules("add", {
            required: true,
            rangelength: [3, 25],
            lettersOnly: true
        });

        $("#email").rules("add", {
            required: true,
            remote: {
                url: "/DB/find_by_email",
                type: "post"
            },
        });

        $("#password1").rules("add", {
            required: true,
            rangelength: [6, 25],
            passwordB: true
        });

        $("#password2").rules("add", {
            equalTo: "#password1"
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

        $("#submitButton").click(function () {
            validator.validate();
        });
    });

</script>