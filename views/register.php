<?php
include 'base.php';
session_start();
$BASE = new TodoBase;


// Если авторизированный пытаешься зайти на эту страницу
if(!empty($_SESSION))
    header("Location: /account");

// Код выполняемый при регистрации
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['name']))) {
    $request = $BASE->create_user($_POST['name'], $_POST['password'], $_POST['password_repeat']);
    if($request == null){
        header("Location: /login");
    }else
        $error = $request;
}
?>
<style>
    body{
        margin: 0px;
    }
    .container{
        display: block;
        width: 300px;
        height: 325px;
        background-color:#110df14a;
        margin-top: 150px;
        margin-left: 40%;
        padding: 25px;
        border-radius: 25px;
    }
    .labels{
        margin-top: 15px;
        border-radius: 15px;
        border: 0px;
        width: 200px;
        height: 50px;
        text-align: center;
        font-size:18px ;
        width: 300px;
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
    .text{
        text-align: center;
        font-size:30px;
        font-weight: bold;
        font-family: Arial;
    }
    .error{
        color: #e00000;
        text-align: center;
        height: 15px;
    }
    form{
        margin: 0px;
    }
    .reg{
        margin-top: 14px;
        font-size: 13px;
        text-align: center;
        transition: all 0.3s ease;
        color: black;
    }
    .submit:hover{
        background-color: #cc8fff;
    }
    .reg:hover{
        text-decoration: underline;
    }
</style>
<?php include 'templates/header.php'; ?>
<div class="container">
    <div class="text">Регистрация</div>
    <div class="error">
        <?php
        if(!empty($error))
            echo $error;
        ?>
    </div>
    <form class="form" action=" " method="POST">
        <input class="labels" type="text" name="name" placeholder="Логин">
        <input class="labels" type="password" name="password" placeholder="Пароль">
        <input class="labels" type="password" name="password_repeat" placeholder="Повторите пароль">
        <input class="submit" type="submit" value="Зарегистрироваться">
    </form>
    <div class="reg"><a href="/login">Есть аккаунт? Вход</a> </div>
</div>
