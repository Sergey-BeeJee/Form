<?php 
//Connecting the RedBeanPHP library and config file
require 'libs/rb.php';
require 'config.php';
//Connecting DataBase
R::setup( 'mysql:host='.$config['DataHost'].';dbname='.$config['DataName'],$config['DataUser'], $config['DataPassword'] ); 

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}
//Start session
session_start();
?>