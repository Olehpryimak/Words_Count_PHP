<?php session_start();
require_once 'rb.php';
R::setup('mysql:host=127.0.0.1;port=localhost;dbname=counter','root','');
date_default_timezone_set("UTC");