<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 22.05.2018
 * Time: 10:33
 */
$orders = $data;
?>

<div class="container col-11 mx-auto bg-light border border-success rounded m-5 pl-0 pr-0 pb-0">
    <!-- Navigation -->
    <nav class="navbar navbar-dark navbar-expand-md font-weight-bold bg-success">
        <a href="#" class="col-xs-4 navbar-brand">Moje mecze</a>
        <ul class=" col-xs-4 mx-auto text-center  nav  bg-transparent">
            <li class="nav-item"><a data-toggle="tab" href="#incomingTerms" class="nav-link text-white">Terminy
                    nadchodzące</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#inviteTerms" class="nav-link text-white">Zaproszenia</a>
            </li>
            <li class="nav-item"><a data-toggle="tab" href="#historyTerms" class="nav-link text-white">Historia</a></li>
        </ul>
    </nav>
    <div class="tab-content bg-white mx-auto text-center">
        <div class="tab-pane active" id="incomingTerms">
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
                <?php
                for ($i = 0; $i < count($orders); $i++) {
                    if (substr($orders[$i]["date"], 6, 2) >= date('y') and
                        substr($orders[$i]["date"], 3, 2) >= date('m') and
                        substr($orders[$i]["date"], 0, 2) >= date('d')
                    ) {
                        echo ' <tr data-toggle="collapse" id="' . $orders[$i]["date"] . '" data-target="#' . $orders[$i]['id_orders'] . '" class="accordion-toggle">';
                        echo '<th>' . $orders[$i]['id_orders'] . '</th>';
                        echo '<th>' . $orders[$i]['date'] . '</th>';
                        echo '<th>' . $orders[$i]['hour'] . ':00</th>';
//                        user id to nie cza
                        echo '<th>' . $orders[$i]['user_id'] . '</th>';
//                        to cza przemienić na tekst
                        echo '<th>' . $orders[$i]['id_status'] . '</th>';
                        echo '</tr>';
                    }
                }
                ?>
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
            </table>
        </div>


        <!--            Zaproszenaia-->
        <div class="tab-pane" id="inviteTerms">
                Tu bedom zaproszenia od innych graczy do gry
        </div>


        <!--            Historia-->
        <div class="tab-pane" id="historyTerms">
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
                <?php
                for ($i = 0; $i < count($orders); $i++) {
                    if (substr($orders[$i]["date"], 6, 2) <= date('y') and
                        substr($orders[$i]["date"], 3, 2) <= date('m') and
                        substr($orders[$i]["date"], 0, 2) <= date('d')
                    ) {
                        echo ' <tr data-toggle="collapse" id="' . $orders[$i]["date"] . '" data-target="#' . $orders[$i]['id_orders'] . '" class="accordion-toggle">';
                        echo '<th>' . $orders[$i]['id_orders'] . '</th>';
                        echo '<th>' . $orders[$i]['date'] . '</th>';
                        echo '<th>' . $orders[$i]['hour'] . ':00</th>';
//                        user id to nie cza
                        echo '<th>' . $orders[$i]['user_id'] . '</th>';
//                        to cza przemienić na tekst
                        echo '<th>' . $orders[$i]['id_status'] . '</th>';
                        echo '</tr>';
                    }
                }
                ?>
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
            </table>
        </div>
    </div>
</div>


