<?php
include 'base.php';

$BASE = new TodoBase();


//$BASE->delete_task(1, 1);

echo $BASE->create_user('admin1', 'sdf','sdfdf');

//$tasks = $BASE->create_user();
//print_r($tasks);

/*
$pdo = new PDO('sqlite:db.sqlite3');
$request = $pdo->query("CREATE TABLE tasks(id INT PRIMARY KEY , task VARCHAR NOT NULL, complite VARCHAR NOT NULL , user INT NOT NULL )");
$request->execute();
*/

//"INSERT INTO users (name, password) VALUES ('admin', 'admin')"