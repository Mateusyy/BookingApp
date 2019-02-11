<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-04-03
 * Time: 22:42
 */

$myDBController = new DBController();

$siteTitle = $myDBController->getDBValue('settings', 'siteTitle');
$startHour = $myDBController->getDBvalue('settings', 'startHour');
$endHour = $myDBController->getDBValue('settings', 'endHour');
$graduation = $myDBController->getDBValue('settings', 'graduation');
$daysAhead = $myDBController->getDBValue('settings', 'daysAhead');
$daysBehind = $myDBController->getDBValue('settings', 'daysBehind');
?>


<div class="container" style="padding: 10px; margin-top: 20px">

    <div class="justify-content-center btn-group nav" id="responsive">
        <a class="active btn btn-primary" data-toggle="tab" href="#systemSettings">Ustawienia systemu</a>
        <a class="btn btn-primary" data-toggle="tab" href="#calendarSettings">Ustawienia kalendarza</a>
        <a class="btn btn-primary" data-toggle="tab" href="#personalSettings">Personalizacja</a>
    </div>

    <div class="tab-content" style="padding: 20px">
        <div class="tab-pane active" id="systemSettings">
            <h3>Ustawienia systemu</h3>
            <form class="form-group" id="systemSettingsForm">
                <div class="form-inline">
                    <label style="margin: 15px" for="siteTitle">Tytuł strony </label>
                    <input type="text" class="form-control" name="siteTitle" id="siteTitle"
                           value="<?= $siteTitle ?>">
                </div>
                <div class="form-inline">
                    <label style="margin: 15px" for="daysBehind">Ile dni przechowywać minione terminy </label>
                    <input type="number" min="1" max="1224" class="form-control" name="daysBehind" id="daysBehind"
                           value="<?= $daysBehind ?>">
                </div>
                <button id="systemSettingsSubmit" style="margin-top: 25px" class="btn btn-primary btn-block btn-lg"> Aktualizuj zmiany</button>
            </form>
        </div>

        <div class="tab-pane" id="calendarSettings">
            <h3>Ustawienia kalendarza rezerwacji</h3>
            <form id="calendarSettingsForm" class="form-group">

               <div class="form-inline">
                    <label style="margin: 15px" for="startHour">Początkowa godzina kalendarza rezerwacji </label>
                    <input type="number" min="0" max="23" step="1" class="form-control" name="startHour" id="startHour"
                           value="<?php echo $startHour ?>">
                </div>
                <div class="form-inline">
                    <label style="margin: 15px" for="endHour">Końcowa godzina kalendarza rezerwacji </label>
                    <input on type="number" min="1" max="24" step="1" class="form-control" name="endHour" id="endHour"
                           value="<?php echo $endHour ?>">
                </div>
                <div class="form-inline">
                    <label style="margin: 15px" for="graduation">Czas trwania pojedyńczego terminu [h] </label>
                    <input type="number" min="0" max="6" step="1" class="form-control" name="graduation" id="graduation"
                           value="<?php echo $graduation ?>">
                </div>
                <div class="form-inline">
                    <label style="margin: 15px" for="daysAhead">Ilość dni generowanych w kalendarzu </label>
                    <input type="number" min="1" max="31" step="1" class="form-control" name="daysAhead" id="daysAhead"
                           value="<?php echo $daysAhead ?>">
                </div>
                <button id="calendarSettingsSubmit" style="margin-top: 25px" class="btn btn-primary btn-block btn-lg"> Aktualizuj zmiany
                </button>
            </form>
        </div>

        <div class="tab-pane" id="personalSettings">
            <h3>Yellow</h3>
            <p>yellow yellow yellow yellow yellow</p>
        </div>
        <div hidden id="succesAlert" class="alert alert-success alert-dismissible animated regular fadeIn">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sukces!</strong> Pomyślnie wprowadzono zmiany
        </div>
        <div hidden id="failAlert" class="alert alert-danger alert-dismissible animated regular fadeIn ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Uwaga!</strong> Coś poszło nie tak
        </div>
    </div>
</div>

<script>
    $('#systemSettingsSubmit').on('click', function() {
        const $btn = $(this);

        $btn.addClass('animated regular shake');
        $btn.prop('disabled', 1);

        $('#succesAlert').prop('hidden',1);
        $('#failAlert').prop('hidden',1);

        $.ajax({
            url : '/DB/updateSettings',
            dataType : 'text',
            type : 'post',
            data: $('form').serialize() + "&whichSettings=" + 'systemSettings'
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

    $('#calendarSettingsSubmit').on('click', function() {
        const $btn = $(this);
        $btn.addClass('animated regular shake ');
        $btn.prop('disabled', 1);
        $('#succesAlert').prop('hidden',1);
        $('#failAlert').prop('hidden',1);


        $.ajax({
            url : '/DB/updateSettings',
            dataType : 'text',
            type : 'post',
            data: $('form').serialize() + "&whichSettings=" + 'calendarSettings'
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

