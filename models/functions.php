<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-03-31
 * Time: 10:30
 */

//    FIXME  to żem sam nasyfił to sam posprzątam Ordnung... Guest Admin User Db

function getWeekDayName($daysOffset)
{
    $dayNumber = date('w', strtotime('+' . $daysOffset . ' days'));
    switch ($dayNumber) {
        case 6:
            echo "Sobota";
            break;
        case 1:
            echo "Poniedziałek";
            break;
        case 2:
            echo "Wtorek";
            break;
        case 3:
            echo "Środa";
            break;
        case 4:
            echo "Czwartek";
            break;
        case 5:
            echo "Piątek";
            break;
        case 0:
            echo "Niedziela";
            break;
        default:
            echo "Err :/";
            break;
    }
}

function getDayNumber($daysOffset)
{
    $dayNumber = date('w', strtotime('+' . $daysOffset . ' days'));
    return $dayNumber;
}

function getNiceDate($daysOffset)
{
    $date = date('d/m', strtotime('+' . $daysOffset . ' days'));
    echo " (" . $date . ") ";
}

function getOneDayTerms($startHour, $endHour, $graduation, $daysOffset)
{
    require_once('controllers/DBController.php');
    $myController = new DBController();

    if ($startHour > $endHour) {
        echo "Sprawdź ustawienia systemu (startHour, endHour)";
        die();
    } else {
        echo '<div class="btn-group-toggle" data-toggle="buttons">';
        for ($x = $startHour; $x <= $endHour; $x = $x + $graduation) {
            $y = $x + $graduation;
            $id = date('y/m/d/', strtotime('+' . $daysOffset . ' days'));
            $idForStatus = date('d/m/y', strtotime('+' . $daysOffset . ' days'));

            $myStatus = $myController->getStatusFromDB($idForStatus,$x);
            $row = $myStatus[0];

            $user_id = $row['user_id'];
            $userData = $myController->getUser($user_id);

            switch ($row['id_status']) {
                case 1: //wolny
                    echo '<label  onclick="{$(this).toggleClass(\'btn-warning animated fast zoomIn\');}" class="btn btn-success btn-calendar">';
                    echo '<input type="checkbox" autocomplete="off" value=' . $id . $x . ' name="terminy[]">';
                    echo "$x<sup>00</sup>-$y<sup>00</sup>";
                    break;
                case 2: //zarezerwowany
                    echo '<label class="btn btn-danger btn-calendar" data-toggle="popover" data-trigger="hover" data-placement="bottom"
                           title="Termin zarezerwowany" data-html="true" data-content="Zarezerwowane przez: <br />'.$userData['firstname'].' '.substr($userData['lastname'],0,1).' ('.$userData['login'].')'. '">';
                    echo $myController->getStatusName(2);
                    break;

                case 3: //niedostepny
                    echo '<label class="btn btn-info btn-calendar" data-toggle="popover" data-trigger="hover" data-placement="bottom"
                           title="Termin niedostępny" data-content="Info: '.$row['message'].'">';
                    echo $myController->getStatusName(3);
                    break;
                case 4: //oczekujacy
                    echo '<label onclick="{$(this).toggleClass(\'btn-warning animated fast zoomIn\');}"  class="btn btn-success btn-calendar"
                            data-toggle="popover"  data-html="true" data-trigger="hover" data-placement="bottom" title="Termin oczekujący" 
                            data-content="Termin oczekuje na potwierdzenie dla: <ul>';
                    for($i=0; $i<count($myStatus); $i++) {
                        $row = $myStatus[$i];
                        $user_id = $row['user_id'];
                        $userData = $myController->getUser($user_id);
                        echo "<li>";
                        echo $userData['firstname'].' '.substr($userData['lastname'],0,1).' ('.$userData['login'].')'. '.';
                        echo "</li>";
                    }
                    echo '</ul>">';

                    echo '<input type="checkbox" autocomplete="off" value=' . $id . $x . ' name="terminy[]">';
                    echo "<img width='20px' src=\"content/waiting.png\" alt=\"\">";
                    echo "$x<sup>00</sup>-$y<sup>00 </sup>";
                    break;
                default: //wolny
                    echo '<label onclick="{$(this).toggleClass(\'btn-warning animated fast zoomIn\');}" class="btn btn-success btn-calendar">';
                    echo '<input type="checkbox" autocomplete="off" value=' . $id . $x . ' name="terminy[]">';
                    echo "$x<sup>00</sup>-$y<sup>00</sup>";
                    break;
            }
            echo '</label>';
        }
        echo '</div>';
    }
}

function getReservationMailTerms($terminy)
{
    $name = $_POST[$terminy];
    $count = 0;
    $ret = "";
    foreach ($name as $terminy) {
//        split date and hour
        $terminArray = explode("(", $terminy);
//        delete ')' char
        $data = substr($terminArray[1], 0, 8);
        $godzina = $terminArray[0];
        $count++;
        $ret .= "
               <tr style='background: #f8f8f8; border: 1px solid #ddd; padding: .35em;'>
               <td style='padding: .625em; text-align: center;' data-label=\"lp\">$count</td>
               <td style='padding: .625em; text-align: center;' data-label=\"Data rezerwacji\">$data</td>
               <td style='padding: .625em; text-align: center;' data-label=\"Godzina rezerwacji\">$godzina</td>
               </tr>";
    }
    return $ret;
}