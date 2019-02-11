<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 25.04.2018
 * Time: 18:46
 */

$informations = $data['stuff'];

?>

<div class="container-fluid bg-light">
    <div class="row m-5">
        <div class="col-9 mx-auto border border-success bg-white rounded p-4">
            <div class="w-50 mx-auto text-center">
                <img class="card-img-top bg-white rounded-circle border border-success w-50"
                     src="/content/logo512.png" alt="Twoje logo">
                <h5 class="text-nowrap mt-2 p-2 border rounded card-title bg-success text-white font-weight-bold "><?= $informations['firstname'] . ' ' . $informations['lastname'] ?></h5>
            </div>

            <div class="card-body">
                <form id="userInformations">
                    <div class="form-group row">
                        <label for="login" class="col-sm-3 col-form-label">Login</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="login" id="login"
                                   value="<?= $informations['login'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email"
                                   value="<?= $informations['email'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-sm-3 col-form-label">Imię</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" id="firstname"
                                   value="<?= $informations['firstname'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label">Nazwisko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                   value="<?= $informations['lastname'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Numer telefonu</label>
                        <div class="col-sm-9">
                            <input type="number" minlength="9" maxlength="12" class="form-control" name="phone" id="phone"
                                   value="<?= $informations['phone'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-3 col-form-label">Miejscowość</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="city" id="city"
                                   value="<?= $informations['city'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-3 col-form-label">Data urodzenia</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="birthday" id="birthday"
                                   value="<?= $informations['birthday'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sex" class="col-sm-3 col-form-label">Płeć</label>
                        <div class="col-sm-9">
                            <?php $sex = $informations['sex']; ?>
                            <select class="custom-select" name="sex">
                                <option value="male" <?php if ($sex == 'male') {
                                    echo("selected");
                                } ?>>Mężczyzna
                                </option>
                                <option value="female" <?php if ($sex == 'female') {
                                    echo("selected");
                                } ?>>Kobieta
                                </option>
                                <option value="null" <?php if ($sex == 'null') {
                                    echo("selected");
                                } ?>>Wolę nie wprowadzać
                                </option>
                            </select>
                        </div>
                    </div>

                    <!--                    TODO Google: dynamic option creation select -->
                    <div class="form-group row">
                        <label for="yourSport" class="col-sm-3 col-form-label">Twoje preferencje sportowe</label>
                        <div class="col-sm-9">
                            <?php $yourSport = $informations['yourSport']; ?>
                            <select class="custom-select" multiple="multiple" name="yourSport">
                                <option value="football" <?php if ($yourSport == 'football') {
                                    echo("selected");
                                } ?>>Piłka nożna
                                </option>
                                <option value="pingpong" <?php if ($yourSport == 'pingpong') {
                                    echo("selected");
                                } ?>>Ping-Pong
                                </option>
                                <option value="volleyball" <?php if ($yourSport == 'volleyball') {
                                    echo("selected");
                                } ?>>Piłka siatkowa
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-3 col-form-label">Zdjęcie profilowe</label>
                        <div class="col-sm-9">
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="avatar"
                                   value="<?= $informations['avatar'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-3 col-form-label">Hasło</label>
                        <div class="col-sm-9">
                            <p><a href='http://zagralbym.pl/User/passwordChangeView?email=<?= $informations['email'] ?>'>Zmień hasło</a></p>
                        </div>
                    </div>
                    <button id="user_additional_informations_submit"
                            class="btn btn-success btn-block btn-lg mt-3 mb-3">Zapisz zmiany
                    </button>
                    <div hidden id="succesAlert" class="alert alert-success alert-dismissible animated regular fadeIn">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Sukces!</strong> Pomyślnie wprowadzono zmiany
                    </div>
                    <div hidden id="failAlert" class="alert alert-danger alert-dismissible animated regular fadeIn ">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Uwaga!</strong> Coś poszło nie tak
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#user_additional_informations_submit').on('click', function() {
        const $btn = $(this);
        $btn.addClass('animated regular shake');
        $btn.prop('disabled', 1);

        $('#succesAlert').prop('hidden',1);
        $('#failAlert').prop('hidden',1);

        $.ajax({
            url : '/User/setAdditionalInformations',
            dataType : 'text',
            type : 'post',
            data: $('form').serialize()
        })
            .done(function(){
//                if done
                $('#succesAlert').prop('hidden',0);
            })

            .fail(function () {
//                if fail
                $('#failAlert').prop('hidden',0);
            })

            .always(function() {
                setTimeout(function(){
                    $btn.removeClass('animated regular shake');
                    $btn.prop('disabled', 0);
                }, 789);

            })
    });
</script>
