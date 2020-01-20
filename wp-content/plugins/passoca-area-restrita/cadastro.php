<?php
/*
Plugin Name: Passoca Área Restrita
Plugin URI: http://www.rafealduim.com.br/
Description: Plugin de Área Restrita
Version: 1.0
Author: RafaelDuim
Author URI: http://www.rafealduim.com.br/
License: GPLv2
*/
/*
 *      Copyright 2013 RafaelDuim <rafael@rafaelduim.com.br>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

// Registamos a função para correr na ativação do plugin


include 'incs/include.php';

register_activation_hook( __FILE__, 'psn_install_restricted_area' );
 
function psn_install_restricted_area() {
    $PsnRestrictedArea = new PsnRestrictedArea();
    $createsTables = $PsnRestrictedArea->createsTables();   
}
// Registrando a função para remover
register_deactivation_hook( __FILE__, 'psn_remove_restricted_area' );

function psn_remove_restricted_area() {
    $PsnRestrictedArea = new PsnRestrictedArea();
    $removeTables = $PsnRestrictedArea->removeTables();    
}

include 'incs/extension/user.php';
// include 'incs/extend/sale-list.php';
include 'incs/admin.php';

?>