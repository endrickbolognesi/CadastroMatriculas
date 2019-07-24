<?php
 
require_once 'init.php';
 
if (!isLoggedIn())
{
    header('Location: login.html');
}
if ($login == 1) {
		
}