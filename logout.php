<?php

ERROR_REPORTING(0);

setcookie("token", "", time()-3600, "/");

header("Location: index.php");
die();

?>