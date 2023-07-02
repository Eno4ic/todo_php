<?php
include 'base.php';

$BASE = new TodoBase();
$tasks = $BASE->get_tasks(1);
print_r($tasks);
//$BASE->create_task('do some think with site pls!', 1);

/*
$pdo = new PDO('sqlite:db.sqlite3');
$request = $pdo->query("CREATE TABLE tasks(id INT PRIMARY KEY , task VARCHAR NOT NULL, complite VARCHAR NOT NULL , user INT NOT NULL )");
$request->execute();
*/

//"INSERT INTO users (name, password) VALUES ('admin', 'admin')"