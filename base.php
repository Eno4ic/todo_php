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
        return $request->fetchAll()[0];
    }
    public function create_task($task, $user_id){       // Создать таск для пользователя по id
        $sql = "INSERT INTO tasks (task, complite, user) VALUES(:task, FALSE, :user_id)";
        $request = $this->db->prepare($sql);
        $request->bindValue(':task', $task, PDO::PARAM_STR);
        $request->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $request->execute();
    }

    public function delete_task($user_id){
    }

    public function update_task($user_id){
    }

    public function delete_user($user_id){  // Удаляет юзера с его тасками
    }
}
