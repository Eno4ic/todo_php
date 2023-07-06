<?php
session_start();
include 'base.php';
include 'templates/header.php';
$BASE = new TodoBase();
$error = null;


if(!empty($_SESSION)){
    if(($_SERVER['REQUEST_METHOD'] == 'POST')){
        $result = $BASE->create_task($_SESSION['user_id'], $_POST['task']);
        if($result == null)
            header("Location: /");
        else
            $error = $result;
    }
}else{
    header("Location: /login");
}




?>
<style>
    body{
        margin: 0px;
    }
    .container{
        display: block;
        width: 300px;
        height: 310px;
        background-color:#110df14a;
        margin-top: 150px;
        margin-left: 40%;
        padding: 25px;
        border-radius: 25px;
    }
    .text{
        width: 300px;
        height: 200px;
        border-radius: 5px;
        border: solid 0px;
        font-size: 18px;
    }
    .submit{
        margin-top: 15px;
        width: 300px;
        height: 50px;
        border-radius: 15px;
        border: 1px;
        font-size:18px;
        transition: all 0.3s ease;
    }
    .submit:hover{
        background-color: #cc8fff;
    }
    .main_text{
        text-align: center;
        font-size: 25px;
        font-family: Arial;
        font-weight: bold;
        margin-bottom: 2px;
    }
    .error{
        color: #e00000;
        text-align: center;
        height: 18px;
        margin-bottom: 4px;
    }
</style>
<div class="container">
    <div class="main_text">Добавление задачи</div>
    <div class="error"><?echo "$error";?></div>
    <form action=" " method="POST">
        <textarea class="text" placeholder="Введите задачу..." name="task"></textarea>
        <input class="submit" type="submit" value="Добавить задачу">
    </form>
</div>
