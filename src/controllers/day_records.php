<?php
session_start();
require_once(realpath(dirname(__FILE__) . '/../config/config.php'));
requireValidSession();
//Pegando a data de hoje no padrão 01 mes 2020
$date = (new DateTime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);
loadTemplateView('day_records', ['today' => $today,]);