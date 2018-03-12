<?php
session_start();
if ($_SESSION['user_role'] == 'admin'){
    echo 'modification des billets par l\'admin';


}