<?php

session_start();

$_SESSION = [];

exit('<meta http-equiv="refresh" content="0; url=index.php" />');