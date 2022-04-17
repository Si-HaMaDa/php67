<?php

setcookie('login', 'logged', time() - 3600);
setcookie('is_admin', 0, time() - 3600);

header('location: login.php');
