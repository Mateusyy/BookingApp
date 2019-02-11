<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 06.03.2018
 * Time: 11:40
 */?>

<!-- to enable tooltip, popover-->
<script>

        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

    $("#zarezerwujButton").hover(function () {
        $(this).toggleClass("animated pulse regular");
    });
</script>
</body>
</html>
