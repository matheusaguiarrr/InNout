<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'pt_BR.utf-8', 'portuguese');
//Constantes gerais
define('DAILY_TIME', 60 * 60 * 8);
define('ONE_HOURS', 60 * 60);
//Pastas do projeto
//Constantes com os caminhos de pastas do projeto
define('CONTROLLERS_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('VIEWS_PATH', realpath(dirname(__FILE__) . '/../views'));
define('TEMPLATES_PATH', realpath(dirname(__FILE__) . '/../views/template'));
define('MODELS_PATH', realpath(dirname(__FILE__) . '/../models'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));
//Arquivos de configuração
//Carregando o arquivo de configuração do banco
require_once(realpath(dirname(__FILE__) . '/database.php'));
require_once(realpath(dirname(__FILE__) . '/loader.php'));
require_once(realpath(dirname(__FILE__) . '/session.php'));
require_once(realpath(dirname(__FILE__) . '/date_utils.php'));
require_once(realpath(dirname(__FILE__) . '/utils.php'));
require_once(MODELS_PATH . '/Model.php');
require_once(MODELS_PATH . '/User.php');
require_once(MODELS_PATH . '/WorkingHours.php');
require_once(EXCEPTION_PATH . '/AppException.php');
require_once(EXCEPTION_PATH . '/ValidationException.php');