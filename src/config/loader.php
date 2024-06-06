<?php
function loadModel($modelName){
    require_once(MODELS_PATH . "/{$modelName}.php");
}
function loadView($viewName, $params = []){
    if(count($params) > 0){
        foreach($params as $key => $value){
            //Criando uma variável dinâmica, com nome e valor passados no array
            ${$key} = $value;
        }

    }
    require_once(VIEWS_PATH . "/{$viewName}.php");
}
function loadTemplateView($viewName, $params = []){
    if(count($params) > 0){
        foreach($params as $key => $value){
            ${$key} = $value;
        }
    }
    $user = $_SESSION['user'];
    $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
    $workedInterval = $workingHours->getWorkedInterval()->format('%H:%I:%S');
    $exitTime = $workingHours->getExitTime()->format('H:i:s');
    $activeClock = $workingHours->getActiveClock();
    require_once(TEMPLATES_PATH . "/header.php");
    require_once(TEMPLATES_PATH . "/menu.php");
    require_once(VIEWS_PATH . "/{$viewName}.php");
    require_once(TEMPLATES_PATH . "/footer.php");
}
function loadTitle($title, $subtitle, $icon = null){
    require_once(TEMPLATES_PATH . "/title.php");
}