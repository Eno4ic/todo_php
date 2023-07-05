<style>
    .header{
        width: auto;
        display: flex;
        height: 80px;
        background-color: #cc8fff;
    }
    .logo{
        font-family: Arial;
        font-size: 40px;
        margin-top: 15px;
        margin-left: 20px;
    }
    .main{
        margin-right: auto;
        margin-left: 40px;
        font-family: Arial;
        font-size: 20px;
        margin-top: 30px;
    }
    .right{
        margin-right: auto;
        margin-right: 20px;
        font-family: Arial;
        font-size: 20px;
        margin-top: 30px;
    }
    a {
        text-decoration: none;
        color: black;
        transition: all 0.3s ease;
    }
    a:hover{
        text-decoration: underline;
    }
</style>
<div class="header">
    <div class="logo">ToDoSite</div>
    <div class="main"><a href="/main">Главная</a></div>
    <?php
    session_start();
    if(!empty($_SESSION))
        echo '<div class="right"><a href="/account">Профиль</a></div>';
    else
        echo '<div class="right"><a href="/login">Войти</a></div>';
    ?>
</div>