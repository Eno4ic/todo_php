<?php
class TodoBase
{
    private $db;

    public function __construct(){
        $this->db = new PDO('sqlite:db.sqlite3');
    }

    public function get_tasks($user_id){     // Получить все таски на одного пользователя по id
        $sql = "SELECT rowid, task, complite, user FROM tasks WHERE user = :user_id";
        $request = $this->db->prepare($sql);
        $request->bindValue(':user_id', $user_id);
        $request->execute();
        return $request->fetchAll();
    }

    public function get_one_task($user_id, $task_id){
        $sql = "SELECT rowid, task, complite, user FROM tasks WHERE user = :user_id and rowid=:task_id";
        $request = $this->db->prepare($sql);
        $request->bindValue(':task_id', $task_id);
        $request->bindValue(':user_id', $user_id);
        $request->execute();
        return $request->fetchAll();
    }

    public function create_task($user_id, $task){       // Создать таск для пользователя по id
        if(empty($task))
            return "Введите задачу!";
        $sql = "INSERT INTO tasks (task, complite, user) VALUES(:task, FALSE, :user_id)";
        $request = $this->db->prepare($sql);
        $request->bindValue(':task', $task, PDO::PARAM_STR);
        $request->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $request->execute();
    }

    public function delete_task($user_id, $task_id){   // $task_id  Это row id
        $sql = "DELETE FROM tasks WHERE user=:user_id and rowid=:task_id";
        $request = $this->db->prepare($sql);
        $request->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $request->bindValue(':task_id', $task_id, PDO::PARAM_INT);
        $request->execute();
    }

    public function update_task($user_id, $task_id, $complite=FALSE, $task=NULL){
        $last_task = $this->db->query("SELECT task FROM tasks WHERE user=$user_id and rowid=$task_id");
        $last_task_result = $last_task->fetchAll()[0];
        if ($task == NULL) {
            $task = $last_task_result[0];
        }
        $sql = "UPDATE tasks SET task=:task, complite=:complite WHERE user=:user_id and rowid=:task_id";
        $request = $this->db->prepare($sql);
        $request->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $request->bindValue(':task_id', $task_id, PDO::PARAM_INT);
        $request->bindValue(':task', $task, PDO::PARAM_STR);
        $request->bindValue(':complite', $complite, PDO::PARAM_BOOL);
        $request->execute();
    }

    public function delete_user($user_id){  // Удаляет юзера с его тасками
        $sql_user = "DELETE FROM users WHERE rowid=$user_id";
        $sql_tasks = "DELETE FROM tasks WHERE user=$user_id";
        foreach (array($sql_tasks, $sql_user) as $sql) {
            $request = $this->db->prepare($sql);
            $request->execute();
        }
    }

    public function get_users(){
        $request = $this->db->query("SELECT name FROM users");
        return $request->fetchAll();
    }

    public function create_user($name, $password, $password_repeat){
        foreach ($this->get_users() as $user){
            if (in_array($name, $user))
                return "Такое имя пользователя уже занято!";
        }
        if (count(str_split($password))<8)
            return "Пароль должен быть не менее 8 символов";
        if ($password != $password_repeat)
            return "Пароли должны совпадать!";
        $sql = "INSERT INTO users(name, password) VALUES (:name, :password)";
        $request = $this->db->prepare($sql);
        $request->bindValue(':name', $name , PDO::PARAM_STR);
        $request->bindValue(':password', md5($password), PDO::PARAM_STR);
        $request->execute();
    }

    public function login($name, $password){          //  Если авторизация успешна - null, если нет то, текст ошибки
        $sql = "SELECT rowid, name, password FROM users WHERE name=:name and password=:password";
        $request = $this->db->query($sql);
        $request->bindValue(":name", $name, PDO::PARAM_STR);
        $request->bindValue(':password', md5($password), PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetchAll();
        if(empty($result))
            return "Неверный логин или пароль!";
        else
            return array($result[0][0], $result[0][1]);
    }
}























