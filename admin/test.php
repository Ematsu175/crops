<?php 
    require_once('../sistema.class.php');
    $app = new Sistema;
    $roles = $app->getRol('luislao@itcelaya.edu.mx');
    print_r($roles);
    $privilegios = $app->getPrivilegios('luislao@itcelaya.edu.mx');
    print_r($privilegios);
    
?>