<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-03-13
 * Time: 01:08
 */
?>

<!-- The logowanie Modal -->
<div class="modal fade" id="logowanieModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
            <!-- Modal Header -->
            <div class="card-header bg-transparent text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="/content/logo.png" class="img-thumbnail rounded-circle border-success" alt="Zagrałbym.pl">
                <h4 class="modal-title">Zaloguj się by w pełni korzystać</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="/Guest/login">
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input required type="text" class="form-control" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło:</label>
                        <input required type="password" class="form-control" name="password">
                        <input type="hidden" name="anythingCheck" id="anythingCheck" value="">
                    </div>

                    <!--                    //===============================-->
                    <!--                    //to do sprawdzania przy logowaniu czy jakis element na kalendarzu jest zanaczony-->
                    <!--                    //potrzebne bo logowanie rozstrzyga gdzie idziemy pozniej - czy wracamy na kalendarz-->
                    <!--                    //czy przenosi nas do reservation complete-->
                    <script>
                        $("#loginButton").click(function () {
                            alert("asd");
                            $("#anythingCheck").setAttribute('value', '0');

                        });

                        // function checkAnything() {
                        //     var elements = document.getElementsByName('terminy[]');
                        //     var anythingChecked = false;
                        //     for(i = 0; i < elements.length; i++)
                        //     {
                        //         if (elements[i].checked == true)
                        //         {
                        //             anythingChecked = true;
                        //         }
                        //     }
                        //
                        //
                        //
                        // }

                        // else if(anythingChecked == false)
                        //     document.getElementsByName('anythingCheck').value = 'false';
                    </script>
                    <!--                    //==========================-->
                    <?php
                    if (($_SESSION['blad'])) {
                        echo "<script type=\"text/javascript\">
                        $('#logowanieModal').modal('show');
                        </script>";
//                        Pokazales raz blad to nie swiruj = tylko raz pokaz modal ze zle haslo lub login
                        unset($_SESSION['blad']);
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                          <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                          <strong>Smutek!</strong> Wprowadzono zły login lub hasło. <br>
                                Jeżeli jeszcze tego nie zrobiłeś aktywuj konto!
                          </div>";
                    }
                    ?>
                    <p class="text-center text-info font-weight-light">
                        <a class="text-dark" href="/Guest/remindPasswordView">Nie pamiętam hasła <i
                                    class="material-icons align-middle">contact_mail</i></a></p>
                    <p class="text-center text-dark font-weight-light">Jeżeli jeszcze się nie zarejestrowałeś utwórz
                        nowe konto <i class="material-icons align-middle">person_add</i></p>

            </div>
            <div class="modal-footer">
                <a href="/Guest/register_page" class="btn btn-success float-left">Utwórz nowe konto</a>
                <button type="submit" id="loginButton" class="btn btn-success float-right">Zaloguj</button>
                <br>
                </form>
            </div>
        </div>
    </div>
</div>

