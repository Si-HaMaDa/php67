<?php

setcookie('login', 'logged', time() - 3600);

header('location: login.php');
