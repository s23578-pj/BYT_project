<?php
session_start();

echo ("<b>Wylogowano z systemu.</b> <br> Dziękuję za skorzystanie z naszego portalu ;) <br> Za chwilkę zostaniesz przeniesiony do strony logowania");
header('Refresh: 4; login-1.php');
session_destroy();
exit;