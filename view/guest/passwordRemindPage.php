<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-05-08
 * Time: 19:00
 */
?>

<div class="container-fluid bg-light">
    <div class="card col-sm-10 col-md-8 col-lg-6 mx-auto border-success my-5">
        <div class="card-header bg-transparent text-center">
            <img src="/content/logo128.png" class="img-thumbnail rounded-circle border-success" alt="Zagrałbym.pl">
            <h4 class="h4">Przypomnij mi hasło <i class="material-icons align-middle">contact_mail</i></h4>
        </div>
        <div class="card-body bg-transparent">
            <form action="/Guest/remindPasswordFunc" method="post">
                <p class="text-success text-center">Wprowadź adres email, który jest powiązany z twoim kontem.</p>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                        <input required type="email" class="form-control" name="email" id="email" placeholder="Wprowadź adres e-mail">
                    </div>
                </div>
        </div>
        <div class="card-footer bg-transparent">
            <button type="submit" id="passwordRemiderSubmit" class="btn btn-success float-right">Przypomnij mi hasło</button>
            </form>
        </div>
        <div hidden id="succesAlert" class="alert alert-success alert-dismissible animated regular fadeIn">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sukces!</strong> Wysłaliśmy do ciebie maila z hasłem.
        </div>
        <div hidden id="failAlert" class="alert alert-danger alert-dismissible animated regular fadeIn ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Uwaga!</strong> Coś poszło nie tak. Odśwież stronę i spróbuj ponownie.
        </div>
    </div>
</div>

<!--<script>-->
<!---->
<!--//    FIXME nie działa przypominanie hasła-->
<!--    $('#passwordRemiderSubmit').on('click', function() {-->
<!--        const $btn = $(this);-->
<!--        $btn.addClass('animated regular shake');-->
<!--        $btn.prop('disabled', 1);-->
<!---->
<!--        $('#succesAlert').prop('hidden',1);-->
<!--        $('#failAlert').prop('hidden',1);-->
<!---->
<!--        $.ajax({-->
<!--            url : '/DB/remindPassword',-->
<!--            dataType : 'text',-->
<!--            type : 'post',-->
<!--            data: $('form').serialize(),-->
<!--            success: function (data) {-->
<!--                alert(data);-->
<!--            }-->
<!--        })-->
<!--            .done(function(){-->
<!--//                if done-->
<!--                $('#succesAlert').prop('hidden',0);-->
<!--            })-->
<!---->
<!--            .fail(function () {-->
<!--//                if fail-->
<!--                $('#failAlert').prop('hidden',0);-->
<!--            })-->
<!---->
<!--            .always(function() {-->
<!--                setTimeout(function(){-->
<!--                    $btn.removeClass('animated regular shake');-->
<!--                    $btn.prop('disabled', 0);-->
<!--                }, 789);-->
<!---->
<!--            })-->
<!--    });-->
<!--</script>-->