<?php
class WorkingHours extends Model {
    protected static $tableName = 'working_hours';
    protected static $columns = 
        [
            'id',
            'user_id',
            'work_date',
            'time1',
            'time2',
            'time3',
            'time4',
            'worked_time'
        ];
    public static function loadFromUserAndDate($userId, $workDate){
        $registry = self::getOne(['user_id' => $userId, 'work_date' => $workDate]);
        if(!$registry){
            $registry = new WorkingHours(
                [
                    'user_id' => $userId,
                    'work_date' => $workDate,
                    'worked_time' => 0
                ]);
        }
        return $registry;
    }
    public function getNextTime(){
        if(!$this->time1) return 'time1';
        if(!$this->time2) return 'time2';
        if(!$this->time3) return 'time3';
        if(!$this->time4) return 'time4';
    }
    public function innout($time){
        $timeColumn = $this->getNextTime();
        if(!$timeColumn) {
            throw new AppException('Você já fez os 4 batimentos do dia!');
        }
        $this->$timeColumn = $time;
        $this->worked_time = getSecondsFromDateInterval($this->getWorkedInterval());
        if($this->id){
            $this->update();
        } else {
            $this->insert();
        }
    }
    private function getTimes(){
        $times = [];
        $this->time1 ? array_push($times, getDateAsDateTime($this->time1)) : array_push($times, null);
        $this->time2 ? array_push($times, getDateAsDateTime($this->time2)) : array_push($times, null);
        $this->time3 ? array_push($times, getDateAsDateTime($this->time3)) : array_push($times, null);
        $this->time4 ? array_push($times, getDateAsDateTime($this->time4)) : array_push($times, null);
        return $times;
    }
    static function getMonthlyReport($userId, $date){
        $registries = [];
        $startDate = getFirstDayOfMonth($date)->format('Y-m-d');
        $endDate = getLastDayOfMonth($date)->format('Y-m-d');
        $result = static::getResultSetFromSelect(
            [
                'user_id' => $userId,
                'raw' => "work_date BETWEEN '{$startDate}' AND '{$endDate}'"
            ]);
        if($result){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $registries[$row['work_date']] = new WorkingHours($row);
            }
        }
        return $registries;
    }
    function getActiveClock(){
        $nextTime = $this->getNextTime();
        if($nextTime === 'time1' || $nextTime === 'time3'){
            return 'exitTime';
        } 
        elseif($nextTime === 'time2' || $nextTime === 'time4'){ 
            return 'workedInterval';
        }
    }
    function getWorkedInterval(){
        [$t1, $t2, $t3, $t4] = $this->getTimes();
        //Inicializa as variáveis
        $part1 = new DateInterval('PT0S');
        $part2 = new DateInterval('PT0S');
        //Calcula a primeira parte da jornada
        //Neste caso $part1 recebe a diferença entre o primeiro horário de entrada e o horário atual 
        if($t1) $part1 = $t1->diff(new DateTime());
        //Neste $part1 recebe a diferença entre o primeiro horário de entrada e o segundo horário, pois neste caso ele saiu para o almoço
        if($t2) $part1 = $t1->diff($t2);
        //Calcula a segunda parte da jornada
        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);
        //Retorna a soma das duas partes, ou seja, o total de horas trabalhadas
        return sumIntervals($part1, $part2);
    }
    function getlaunchInterval(){
        [, $t2, $t3,] = $this->getTimes();
        $launchInterval = new DateInterval('PT0S');
        if($t2) $launchInterval = $t2->diff(new DateTime());
        if($t3) $launchInterval = $t2->diff($t3);
        return $launchInterval;
    }
    function getExitTime(){
        [$t1,,, $t4] = $this->getTimes();
        $workday = DateInterval::createFromDateString('8 hours');
        if(!$t1){
            return (new DateTimeImmutable())->add($workday);
        } elseif($t4){
            return $t4;
        } else {
            $total = sumIntervals($workday, $this->getlaunchInterval());
            return $t1->add($total);
        }
    }
    function getBalanceDay(){
        if(!$this->time1 && !isPastWorkDay($this->work_date)) return '---';
        $balance = $this->worked_time - DAILY_TIME;
        $balanceString = getTimeStringFromSeconds(abs($balance));
        if($this->worked_time == DAILY_TIME) return $balanceString;
        $sign = $this->worked_time >= DAILY_TIME ? '+' : '-';
        return "{$sign}{$balanceString}";
    }
    public static function getAbsentUsers(){
        $today = new DateTime();
        $result = Database::getResultFromQuery(
            "
                SELECT name FROM users
                WHERE end_date is NULL 
                AND id NOT IN 
                    (
                        SELECT user_id FROM working_hours
                        WHERE work_date = '{$today->format('Y-m-d')}'
                        AND time1 IS NOT NULL
                    )
            "
        );
        $absentUsers = [];
        if($result->rowCount() > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                array_push($absentUsers, $row['name']);
            }
        }
        return $absentUsers;
    }
    public static function getWorkedTimeInMonth($yearAndMonth){
        $startDate = (new DateTime("{$yearAndMonth}-1"))->format('Y-m-d');
        $endDate = getLastDayOfMonth($yearAndMonth)->format('Y-m-d');
        $result = static::getResultSetFromSelect(
            [
                'raw' => "work_date BETWEEN '{$startDate}' AND '{$endDate}'"
            ],"sum(worked_time) as sum");
        return $result->fetch(PDO::FETCH_ASSOC)['sum'];
    }
}