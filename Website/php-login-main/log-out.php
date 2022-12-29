<?php
session_start();
session_unset();
echo ("<b>Wylogowano z systemu.</b> <br> Dziękuję za skorzystanie z mojego portalu ;) <br> Za chwilkę zostaniesz przeniesiony do strony logowania");
header('Refresh: 4; login-1.php');
exit;