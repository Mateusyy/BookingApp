<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 25.04.2018
 * Time: 18:24
 */?>

<body class="bg-light">
<!-- Navigacja -->
<nav class="navbar navbar-expand-lg sticky-top bg-success border-white border-bottom">
    <a class="navbar-brand text-white" href="/">
        <img class="bg-white rounded-circle" src="/content/logo.png" alt="Zagrałbyś?" style="width:40px; margin-right: 20px">Zagrałbym.pl</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"><i style="color:white; font-size:24px" class="material-icons">menu</i></span>
    </button>
    <div class="collapse navbar-collapse text-center"  id="collapsibleNavbar" >
        <ul class="nav navbar-nav" >
            <?php
            switch ($_SESSION['user_type']) {
                case '1': //admin
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/">Kalendarz rezerwacji</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/Admin/showAdminPanel">Panel administratora</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/Admin/showAdminSettings">Ustawienia systemu</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/Admin/showTodo">TODO</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/User/logout">Wyloguj</a>';
                    echo '</li>';
                    break;
                case '3': //user
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/">Kalendarz</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/User/showMyOrders">Moje mecze</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="">Drużyna</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="">Liga</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/User/showMyProfile">Profil</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo    '<a class="nav-link text-white " href="/User/logout">Wyloguj</a>';
                    echo '</li>';
                    break;
                default: //guest
                    echo '<li class = "nav-item">';
                    echo    '<a class = "nav-link text-white" data-toggle = "modal" data-target = "#logowanieModal" href = "#">Zaloguj</a>';
                    echo '</li>';
                    echo '<li class = "nav-item">';
                    echo    '<a class = "nav-link text-white " href = "/Guest/register_page">Zarejestruj</a>';
                    echo '</li>';
                    echo '<li class = "nav-item">';
                    echo    '<a class = "nav-link text-white" data-toggle = "modal" data-target = "#aboutModal" href = "#">Pomoc</a>';
                    echo '</li>';
                    break;
            }
            ?>
        </ul>
    </div>
</nav>