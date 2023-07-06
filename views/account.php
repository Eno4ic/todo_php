<?php
session_start();
include 'base.php';
include 'views/templates/header.php';
$BASE = new TodoBase();

if(!empty($_SESSION)){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['user_id'])) {
            $BASE->delete_user($_POST['user_id']);
            session_unset();
            header("Location: /login");
        }else {
            session_unset();
            header("Location: /login");
        }
    }
}else
    header("Location: /login");


?>
<style>
    body{
        margin: 0px;
    }
    .container{
        display: block;
        width: 300px;
        height: 260px;
        background-color:#110df14a;
        margin-top: 150px;
        margin-left: 40%;
        padding: 25px;
        border-radius: 25px;
    }
    .text{
        text-align: center;
        font-size:30px;
        font-weight: bold;
        font-family: Arial;
    }
    .name{
        margin-top: 25px;
        border-radius: 15px;
        border: 0px;
        width: 200px;
        height: 50px;
        text-align: left;
        font-size:30px ;
        width: 300px;
    }
    .submit{
        margin-top: 14px;
        width: 300px;
        height: 50px;
        border-radius: 15px;
        border: 1px;
        font-size:18px;
        transition: all 0.3s ease;
    }
    .submit:hover{
        background-color: #ff3c3c;
    }
</style>
<div class="container">
    <div class="text">Профиль</div>
    <div class="name">Логин: <?echo $_SESSION['user_name'];?></div>
    <form action=" " method="POST">
        <input class="submit" type="submit" value="Выйти">
    </form>
    <form action=" " method="POST">
        <input type="hidden" name="user_id" value="<?echo $_SESSION['user_id'];?>">
        <input class="submit" type="submit" value="Удалить аккаунт">
    </form>
</div>
