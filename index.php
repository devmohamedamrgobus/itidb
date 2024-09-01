<?php

include 'vendor/autoload.php';

use Iti\Db\db;

$DB = new db('localhost','root','','iti');
print_r($DB->table('category')->select()->all());
