<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 14.03.2018
 * Time: 17:47
 */
$receivedHeader = $header;
$receivedMessage = $message;
$receivedAction = $action;
?>

<!-- Mr Pop -->
<div class="modal hide fade" id="pop" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-transparent text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="/content/logo.png" class="img-thumbnail rounded-circle border-success" alt="Zagrałbym.pl">
                <h4 class="modal-title"><?= $receivedHeader ?></h4>
            </div>
            <div class="modal-body">
                <div>
                    <p class="text-center">
                        <?= $receivedMessage ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <?php
                    if ($action != "#") {
                        echo "<a class=\"btn btn-success btn-block text-white\" href=\"$receivedAction\">
                            Rozumiem
                    </a>";
                    } else {
                        echo '<a class="btn btn-success btn-block text-white" data-dismiss="modal">
                            Rozumiem
                    </a>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load', function () {
        $('#pop').modal('show');
    });
</script>