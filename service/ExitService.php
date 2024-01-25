<?php
require_once '../data/config.php';
    session_destroy();
    header('Location:'.VIEW_PATH.'index.php');


