<?php
function addSuccessMensage($mensage){
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => $mensage
    ];
}
function addErrorMensage($mensage){
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $mensage
    ];
}