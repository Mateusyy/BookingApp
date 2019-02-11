<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 23.04.2018
 * Time: 23:06
 */
$myDBController = new DBController();
$siteTitle = $myDBController->getDBValue('settings','siteTitle');
$daysAhead = $myDBController->getDBvalue('settings','daysAhead');
$startHour = $myDBController->getDBvalue('settings','startHour');
$endHour = $myDBController->getDBvalue('settings','endHour');
$graduation = $myDBController->getDBvalue('settings','graduation');
?>

<div class="container-fluid" style="margin-bottom: 80px;">
    <form id="calendarForm" method="post" action="/User/reservationComplete" class="form-group">
        <div id="horizontalContainer" class="row flex-row flex-nowrap"
             style="display: flex; flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <?php
            for ($daysOffset = 0; $daysOffset < $daysAhead; $daysOffset++) {
                echo '<div class="col-10 col-sm-5 col-md-4 col-lg-2 p-0">';
                    echo "<div class=\"card bg-transparent border-0 w-100 \">";
                        echo '<div class="card-body">';
                            echo '<h5 class="card-title text-center">';
                                if($daysOffset==0)echo 'Dzisiaj';
                                else if($daysOffset==1)echo 'Jutro';
                                else{
                                    echo getWeekDayName($daysOffset);
                                    echo ' ';
                                    echo getNiceDate($daysOffset);
                                }
                            echo '</h5>';
                            if (getDayNumber($daysOffset) == 0 || getDayNumber($daysOffset) == 6) {
                                require "view/partial/calendar/calendarClosed.php";
                            } else {
                                getOneDayTerms($startHour, $endHour, $graduation, $daysOffset);
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </form>
</div>

    <script>

        var horz = document.querySelector("#horizontalContainer");
        isHover = true;

        function preventDefault (event) {
            event = event || window.event;
            if (event.preventDefault) {
                event.preventDefault();
            }
            event.returnValue = false;
        }

        function displaywheel(e){
            var evt=window.event || e
            var delta=evt.detail? evt.detail*(-120) : evt.wheelDelta;
            if(delta<0 && isHover) {
                horz.scrollLeft += 100;
                preventDefault(evt);
            } else if(isHover) {
                horz.scrollLeft -= 100;
                preventDefault(evt);
            }
        }

        var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel"

        if (document.attachEvent) {
            document.attachEvent("on"+mousewheelevt, displaywheel)
        } else if (document.addEventListener){
            document.addEventListener(mousewheelevt, displaywheel, false)
        }
    </script>