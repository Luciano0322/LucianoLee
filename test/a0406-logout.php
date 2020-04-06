<?php
session_start();
unset($_SESSION['loginUser']);
header('Location: a0406-login.php');