<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-03-14
 * Time: 16:14
 */
$informations = $data['stuff'];
$myDBController = new DBController();
$graduation = $myDBController->getDBvalue('settings','graduation');
?>

<div class="container-fluid bg-light">

    <div class="col-9 mx-auto border border-success bg-white rounded p-4 m-5">
        <div class="w-25 mx-auto text-center">
            <img class="card-img-top bg-white rounded-circle border border-success w-50"
                 src="/content/logo512.png" alt="Twoje logo">
            <h5 class="mt-2 p-2 border rounded bg-success text-white font-weight-bold ">Dostosuj rezerwację</h5>
        </div>

        <div class="card-body">
            <form class="form mx-auto" action="/DB/addRowOrders" method="post">

                <h5>Wybrane terminy</h5>
                <div class="form-group form-inline justify-content-center my-1">
                    <?php
                    $var = $_POST['terminy'];
                    $count = count($var);
                    for ($i = 0; $i < $count; $i++) {
                        $term = explode("/", $var[$i]);
                        $lastTerm = explode("/", $var[$i-1]);
//                        This statement check if term have identical year/month/day as term checked before
                        if($term[0]==$lastTerm[0] and $term[1]==$lastTerm[1] and $term[2]==$lastTerm[2]){
//                            Check if terms are neighboring
                            if(($term[3]-$lastTerm[3])==$graduation){
                                echo "<div class='row col-12'>terminy obok siebie' terminy tego samego dnia";
                                echo "<input readonly type='text' class='btn btn-success m-1' 
               value='$term[3]:00 ($term[2]/$term[1]/$term[0])' name='terminyFormated[]'></div>";
                            }else{
                                echo "<div class='row col-12'>terminy NIE obok siebie ale tego samego dnia";
                                echo "<input readonly type='text' class='btn btn-success m-1' 
               value='$term[3]:00 ($term[2]/$term[1]/$term[0])' name='terminyFormated[]'></div>";
                            }
                        }else{
                            if($i==0){
                                echo "<div class='row col-12'>pierwszy termin";
                                echo "<input readonly type='text' class='btn btn-success m-1' 
               value='$term[3]:00 ($term[2]/$term[1]/$term[0])' name='terminyFormated[]'></div>";
                            } else{
                                echo "<div class='row col-12'>teminy nie tego samego dnia";
                                echo "<input readonly type='text' class='btn btn-success m-1' 
               value='$term[3]:00 ($term[2]/$term[1]/$term[0])' name='terminyFormated[]'></div>";
                            }

                        }
                    }
                    ?>
                </div>
        </div>

        <div class="card-body">
            <h5>Wiadomość do moderatora obiektu</h5>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea rows="4" maxlength="250" class="form-control" name="message" id="message"></textarea>
                </div>
            </div>
        </div>

        <div class="card-body">
            <p class="text-center"> Za moment wyślemy do Ciebie maila, w którym znajdują się wszystkie
                wprowadzone dane.<br>
                Jeżeli wszystko się zgadza - potwierdź rezerwację.
            </p>
        </div>

        <div class="card-body">
            <button type="submit" class="btn btn-success btn-block btn-lg" id="sendReservationButton">
                <h5>Potwierdź rezerwacje</h5>
            </button>
            </form>
        </div>

    </div>
</div>

