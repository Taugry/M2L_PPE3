<?php
session_unset();
session_destroy();
setcookie(session_name(),'',-3600,'/');
header('Location: index.php');
exit();
?>