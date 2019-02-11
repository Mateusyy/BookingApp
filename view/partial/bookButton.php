<?php
/**
 * Created by PhpStorm.
 * User: Jakubek
 * Date: 14.03.2018
 * Time: 17:43
 */
?>

<!-- BookButton -->
<nav class="sticky-bottom fixed-bottom bg-success  border-white border-top">
    <button id="zarezerwujButton" type="submit" class="btn btn-success btn-block btn-lg" data-toggle="modal" onclick="
            var elements = document.getElementsByName('terminy[]');
            var anythingChecked = false;
            for(var i = 0; i < elements.length; i++){if (elements[i].checked === true){anythingChecked = true;}}

    <?php if (isset($_SESSION['zalogowany'])) { ?>
            if (anythingChecked === true){
                this.setAttribute('form','calendarForm');
                this.setAttribute('class','animated slow pulse infinite btn btn-success btn-block btn-lg');
            }else{
                this.setAttribute('data-target','#aintChoiceModal');
            }
    <?php } else { ?>
            this.setAttribute('data-target','#logowanieModal');
            $('#logowanieModal').modal('show');
    <?php } ?>
            ">
        <span>Zagrałbym!</span>
    </button>
</nav>
<script>
    $("#zarezerwujButton").hover(function () {
        $(this).toggleClass("animated pulse regular");
    });

</script>