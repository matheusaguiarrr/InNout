<?php
/*
$wh = WorkingHours::loadFromUserAndDate(1, date('Y-m-d'));
$workedintervalString = $wh->getWorkedInterval()->format('%H:%I:%S');
echo 'Horas trabalhadas:';
print_r($workedintervalString);
echo '<br>';
echo "Deveria ser 04:13:29";
echo '<br>';
$lunchIntervalString = $wh->getlaunchInterval()->format('%H:%I:%S');
echo 'Intervalo de almoço:';
print_r($lunchIntervalString);
echo '<br>';
$exitTime = $wh->getExitTime()->format('%H:%I:%S');
print_r($exitTime);
print_r(getLastDayOfMonth('2020-02'));
echo User::getCount(['raw' => 'id % 2 = 0']);
*/
$user = User::getOne(['email' => 'admin@cod3r.com.br']);
var_dump($user);
if(password_verify('a', $user->password)){
    echo 'Senha válida!';
}