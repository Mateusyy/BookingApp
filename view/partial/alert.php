<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 2018-05-01
 * Time: 11:57
 */
$receivedMessage = $message;
$receivedType = $type;
?>

<div class="w-50 mx-auto my-4">
    <div class="alert <?=$receivedType?> alert-dismissible text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> <?=$receivedMessage?></strong>
    </div>
</div>

