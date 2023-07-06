<?php
session_start();
include 'base.php';
include 'views/templates/header.php';
$BASE = new TodoBase();

if(empty($_SESSION))
    header("Location: /login");
else{
    $task = $BASE->get_one_task($_SESSION["user_id"], $_GET['task']);
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $BASE->update_task($_SESSION["user_id"], $task[0][0],$_POST['complite'], $_POST['task'] );
        header("Location: /");
    }
}



?>
<style>
    body{
        margin: 0px;
    }
    .container{
        display: block;
        width: 300px;
        height: 300px;
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
    .change{
        margin-top: 15px;
        width: 300px;
        height: 30px;
        border-radius: 15px;
        border: 1px;
        font-size:18px;
        transition: all 0.3s ease;
    }
</style>
<div class="container">
    <form action=" " method="POST">
        <textarea class="text" name="task" placeholder="<?echo $task[0][1];?>"></textarea>
        <select class="change" name="complite">
            <option value="TRUE" <?echo $selected = (bool)$task[0][2] ? "selected" : null;?>>Выполнено</option>
            <option value="FALSE" <?echo $selected = (bool)$task[0][2] ? null : "selected";?>>не выполнено</option>
        </select>
        <input class="submit" type="submit" value="Изменить">
    </form>
</div>
