<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-04-19
 * Time: 10:13
 */

require_once('controllers/DBController.php');
$myDBController = new DBController();
$daysAhead = $myDBController->getDBvalue('settings', 'daysAhead');
$daysBehind = $myDBController->getDBvalue('settings', 'daysBehind');

function listTerms($termStatus)
{
    $myDBController = new DBController();
    $daysAhead = $myDBController->getDBvalue('settings', 'daysAhead');
    $startHour = $myDBController->getDBvalue('settings', 'startHour');
    $endHour = $myDBController->getDBvalue('settings', 'endHour');
    $graduation = $myDBController->getDBvalue('settings', 'graduation');

    $findSomething = false;

    for ($daysOffset = 0; $daysOffset < $daysAhead; $daysOffset++) {

        for ($x = $startHour; $x <= $endHour; $x = $x + $graduation) {
            $y = $x + $graduation;
            $idForStatus = date('d/m/y', strtotime('+' . $daysOffset . ' days'));

            //!!! tablica tablic !!!
            $myStatus = $myDBController->getStatusFromDB($idForStatus, $x);


            for ($i = 0; $i < count($myStatus); $i++) {
                $row = $myStatus[$i];

                if ($row['id_status'] == $termStatus) {
                    $findSomething = true;
                    switch ($row['id_status']) {
                        case 2: //Zaakceptowane
                            echo '<tr data-toggle="collapse" id="' . $row['id_orders'] . '" data-target="#' . $row['id_orders'] . '" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" id="cancel' . $row['id_orders'] . '"title="Anuluj" class="material-icons" style="color: red; cursor: pointer">close</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 3: //niedostepny
                            echo '<tr data-toggle="collapse" id="' . $row['id_orders'] . '" data-target="#' . $row['id_orders'] . '" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" id="unlock' . $row['id_orders'] . '" title="Odblokuj" class="material-icons pointer_cursor" style="color: green; cursor: pointer">arrow_back</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span><br>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">message</i>' . $row['message'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 4: //oczekujacy
                            echo '<tr data-toggle="collapse" id="' . $row['id_orders'] . '" data-target="#' . $row['id_orders'] . '" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" id="accept' . $row['id_orders'] . '" title="Zaakceptuj" class="material-icons" style="color: green; margin-right: 15px; cursor: pointer">thumb_up</i>
                                        <i data-toggle="tooltip" id="reject' . $row['id_orders'] . '" title="Odrzuć" class="material-icons" style="color: red; margin-left: 15px; cursor: pointer">thumb_down</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 5: //odrzucony
                            echo '<tr data-toggle="collapse" id="' . $row['id_orders'] . '" data-target="#' . $row['id_orders'] . '" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" id="restor' . $row['id_orders'] . '" title="Przywróć" class="material-icons pointer_cursor" style="color: blue; cursor: pointer; margin-right: 15px">arrow_forward</i>
                                        <i data-toggle="tooltip" id="resacc' . $row['id_orders'] . '" title="Przywróć i akceptuj termin" class="material-icons pointer_cursor" style="color: green; cursor: pointer; margin-left: 15px">subdirectory_arrow_left</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span><br>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">message</i>' . $row['message'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        default: //wolny
                            // Do nothing
                            break;
                    }
                }
            }
        }
    }
//    jeżeli nic nie znalazłeś
    if ($findSomething == false) {
        echo '<tr>
                <td colspan="5">
                    <h3 class="h3 text-center">Nic nie znaleziono</h3>
                    <img style="height:200px" src="/content/nothing.gif">
                </td>
             </tr>';

    }
}

function listTermsFromPast()
{
    $myDBController = new DBController();
    $startHour = $myDBController->getDBvalue('settings', 'startHour');
    $endHour = $myDBController->getDBvalue('settings', 'endHour');
    $graduation = $myDBController->getDBvalue('settings', 'graduation');
    $daysBehind = $myDBController->getDBvalue('settings', 'daysBehind');

    $findSomething = false;

    for ($daysOffset = 1; $daysOffset < $daysBehind; $daysOffset++) {

        for ($x = $startHour; $x <= $endHour; $x = $x + $graduation) {
            $y = $x + $graduation;
            $idForStatus = date('d/m/y', strtotime('-' . $daysOffset . ' days'));

            //!!! tablica tablic !!!
            $myStatus = $myDBController->getStatusFromDB($idForStatus, $x);


            for ($i = 0; $i < count($myStatus); $i++) {
                $row = $myStatus[$i];

                if ($row['id_status']) {
                    $findSomething = true;
                    switch ($row['id_status']) {
                        case 2: //Zaakceptowane
                            echo '<tr data-toggle="collapse" data-target="#' . $row['id_orders'] .'past'.'" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" id="delete' . $row['id_orders'] . '" title="Usuń termin" class="material-icons" style="cursor: pointer">delete</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '2' .'" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 3: //niedostepny
                            echo '<tr data-toggle="collapse" data-target="#' . $row['id_orders'] . '2' .'" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" title="Usuń termin" class="material-icons" style="cursor: pointer">delete</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '2' .'" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span><br>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">message</i>' . $row['message'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 4: //oczekujacy
                            echo '<tr data-toggle="collapse" data-target="#' . $row['id_orders'] . '2' .'" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" title="Usuń termin" class="material-icons" style="margin-right: 15px; cursor: pointer">delete</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '2' .'" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        case 5: //odrzucony
                            echo '<tr data-toggle="collapse" data-target="#' . $row['id_orders'] . '2' .'" class="accordion-toggle">
                                  <th>' . $row['id_orders'] . '</th>
                                  <td>' . $row['date'] . '</td>
                                  <td>' . $x . '<sup>00</sup>-' . $y . '<sup>00</sup></td>
                                  <td>' . $row['name'] . '</td>
                                  <td>
                                        <i data-toggle="tooltip" title="Usuń termin" class="material-icons" style="cursor: pointer">delete</i>
                                  </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding: 0 8px">
                                        <div id="' . $row['id_orders'] . '2' .'" class="accordian-body collapse">
                                            <span><i class="align-middle material-icons" style="cursor: pointer">face</i>' . $row['name'] . ' ' . $row['surname'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">phone</i>' . $row['tel'] . '</span>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">email</i>' . $row['email'] . '</span><br>
                                            <span><i class="align-middle material-icons" style="cursor: pointer">message</i>' . $row['message'] . '</span>
                                        </div>
                                </td>
                            </tr>';
                            break;

                        default: //wolny
                            // Do nothing
                            break;
                    }
                }
            }
        }
    }
//    jeżeli nic nie znalazłeś
    if ($findSomething == false) {
        echo '<tr>
                <td colspan="5">
                    <h3 class="h3 text-center">Nic nie znaleziono</h3>
                    <img style="height:200px" src="/content/nothing.gif">
                </td>
             </tr>';

    }
}

?>

<div class="container" style="padding: 10px; margin-top: 20px">

    <div class=" btn-group justify-content-center nav">
        <a class="active btn btn-primary" data-toggle="tab" href="#waitingTerms">Terminy oczekujące</a>
        <a class="btn btn-primary" data-toggle="tab" href="#acceptedTerms">Terminy zaakceptowane</a>
        <a class="btn btn-primary" data-toggle="tab" href="#rejectedTerms">Terminy odrzucone</a>
        <a class="btn btn-primary" data-toggle="tab" href="#inaccessibleTerms">Terminy niedostępne</a>
        <a class="btn btn-primary" data-toggle="tab" href="#pastTerms">Terminy minione</a>
    </div>




    <div class="tab-content" style="padding: 20px">

        <div class="tab-pane active" id="waitingTerms">
            <h3>Terminy oczekujące na potwierdzenie</h3>
            <label data-toggle="tooltip" title="Parametr można zmienić w ustawieniach systemowych">
                Zostaną wygenerowane terminy na <?= $daysAhead ?> dni wstecz</label>
            <table class="table table-sm table-responsive-sm table-bordered table-hover text-center">
                <thead>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Zaakceptuj/Odrzuć" class="material-icons"
                                       style="cursor: pointer">thumbs_up_down</i></th>
                </tr>
                </thead>
                <?php listTerms(4); ?>
                <tfoot>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Zaakceptuj/Odrzuć" class="material-icons"
                                       style="cursor: pointer">thumbs_up_down</i></th>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="acceptedTerms">
            <h3>Terminy zaakceptowane</h3>
            <table class="table table-sm table-responsive-sm table-bordered table-hover text-center">
                <thead>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Anuluj termin" class="material-icons"
                                       style="cursor: pointer">thumb_down</i></th>
                </tr>
                </thead>
                <?php listTerms(2); ?>
                <tfoot>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Anuluj termin" class="material-icons"
                                       style="cursor: pointer">thumb_down</i></th>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="rejectedTerms">
            <h3>Terminy odrzucone</h3>
            <table class="table table-sm table-responsive-sm table-bordered table-hover text-center">
                <thead>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Przywróć/zaakceptuj" class="material-icons"
                                       style="cursor: pointer">subdirectory_arrow_left</i></th>

                </tr>
                </thead>
                <?php listTerms(5); ?>
                <tfoot>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Przywróć/zaakceptuj" class="material-icons"
                                       style="cursor: pointer">subdirectory_arrow_left</i></th>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="inaccessibleTerms">
            <h3>Terminy niedostępne</h3>
            <table class="table table-sm table-responsive-sm table-bordered table-hover text-center">
                <thead>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Odblokuj termin" class="material-icons"
                                       style="cursor: pointer">arrow_back</i></th>
                </tr>
                </thead>
                <?php listTerms(3); ?>
                <tfoot>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Odblokuj termin" class="material-icons"
                                       style="cursor: pointer">arrow_back</i></th>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="pastTerms">
            <h3>Terminy minione</h3>
            <label data-toggle="tooltip" title="Parametr można zmienić w ustawieniach systemowych">
                                Zostaną wygenerowane terminy na <?= $daysBehind ?> dni wstecz</label>
            <table class="table table-sm table-responsive-sm table-bordered table-hover text-center">
                <thead>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Usuń termin" class="material-icons"
                                       style="cursor: pointer">delete</i></th>
                </tr>
                </thead>
                <?php listTermsFromPast(); ?>
                <tfoot>
                <tr class="bg-white">
                    <th scope="col"><i class="material-icons" style="cursor: pointer">format_list_numbered</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">date_range</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">schedule</i></th>
                    <th scope="col"><i class="material-icons" style="cursor: pointer">face</i></th>
                    <th scope="col"><i data-toggle="tooltip" title="Usuń termin" class="material-icons"
                                       style="cursor: pointer">delete</i></th>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $('i').on('click', function() {
        const $icon = $(this);
        var role = $icon.attr('id').substring(0, 6);
        var id = $icon.attr('id').substring(6);

        switch (role) {
            case 'accept':
                setOrderStatus(id, 2);
                break;
            case 'reject':
                setOrderStatus(id, 5);
                break;
            case 'unlock':
                setOrderStatus(id, 1);
                break;
            case 'cancel':
                setOrderStatus(id, 5);
                break;
            case 'restor':
                setOrderStatus(id, 4);
                break;
            case 'resacc':
                setOrderStatus(id, 2);
                break;
            default:
                alert('errr!');
                break;
        }
    });

    function setOrderStatus(id, status) {
        $.ajax({
            url : '/DB/setOrderStatus',
            dataType : 'text',
            type : 'post',
            data : {
                orderID : id,
                id_status : status
            }
        })
            .done(function(){
//                if done
                $("#"+id).remove();

            })

            .fail(function () {
//                if fail
                alert("errr!");
            })

            .always(function() {
                $(".container").reload();
            })
    }

</script>