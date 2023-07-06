<?php
session_start();
include 'base.php';
include 'views/templates/header.php';
$BASE = new TodoBase();

if(!empty($_SESSION) and ($_SERVER["REQUEST_METHOD"] == "POST")){
    switch ($_POST['action']){
        case "delete":
            $BASE->delete_task($_SESSION['user_id'], $_POST['task_id']);
            break;
        case "complite":
            $BASE->update_task($_SESSION['user_id'], $_POST['task_id'], TRUE);
    }
}



?>
<style>
    body{
        margin: 0px;
    }
    .main_container{
        display: flex;
        flex-wrap: wrap;
    }
    .container{
        display: block;
        width: 282px;
        height: 260px;
        background-color:#110df14a;
        margin-top: 40px;
        margin-left: 20px;
        padding: 25px;
        border-radius: 25px;
    }
    .container_not_auth{
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
        margin-top: 20px;
    }
    .add{
        margin-left: 40%;
        margin-right: 40%;
        text-align: center;
        padding: 15px;
        border-radius: 20px;
        border:solid 1px black;
        margin-top: 20px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .add:hover{
        background-color: #cc8fff;
        text-decoration: none;
    }
    .addd:hover{
        background-color: #cc8fff;
        text-decoration: none;
    }
    .buttons{
        display: flex;
        margin-top: 5px;
        margin-left: 4px;
    }
    .button{
        width: 85px;
        height: 40px;
        border-radius: 15px;
        background-color: #cc8fff;
        border: solid 0px;
        margin-right: 10px;
        font-size: 12px;
        transition: all 0.3s ease;
    }
    .a{
        padding: 11px;
        width: 68px;
        height: 19px;
        border-radius: 15px;
        background-color: #cc8fff;
        border: solid 0px;
        margin-right: 10px;
        transition: all 0.3s ease;
    }
    .a:hover{
        text-decoration: none;
        background-color: #b150fc;
    }
    .button:hover{
        background-color: #b150fc;
    }
    .task{
        width: auto;
        height: 205px;
    }
</style>
<?php
    if(!empty($_SESSION)){
        $tasks = $BASE->get_tasks($_SESSION['user_id']);
?>
        <a class="addd" href="/create"><div class="add">Добавить задачу</div></a>
        <div class="text">Задачи <?echo $_SESSION['user_name'];?></div>
        <div class="main_container">
        <?php
            foreach ($tasks as $task){
        ?>
                <div class="container">
                    <div class="task"><?echo $task[1];?></div>
                    <div class="status">Статус: <? echo $status = $task[2]? "Выполнено":"Не выполнено";?></div>
                    <div class="buttons">
                        <form action=" " method="POST">
                            <input type="hidden" name="task_id" value="<?echo $task[0]?>">
                            <input type="hidden" name="action" value="complite">
                            <input class="button" type="submit" value="Выполнено">
                        </form>
                        <a class="a" href="/update/?task=<?echo $task[0];?>">Изменить</a>
                        <form action=" " method="POST">
                            <input type="hidden" name="task_id" value="<?echo $task[0]?>">
                            <input type="hidden" name="action" value="delete">
                            <input class="button" type="submit" value="Удалить">
                        </form>
                    </div>
                </div>
        <?php }?>
        </div>
<?php }else{?>
        <div class="container_not_auth">
            <div class="text">Что бы пользоваться сайтом - <a href="/login">Авторизуйтесь</a></div>
        </div>
<?php }?>
