<?php
/*
Plugin Name: Passoca E-mail
Plugin URI: http://www.rafealduim.com.br/
Description: Plugin de suporte ao E-mail desenvolvido por RafaelDuim
Version: 1.0.5
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


register_activation_hook( __FILE__, 'psn_mail_install' );
 
function psn_mail_install() {
   
}
// Registrando a função para remover
register_deactivation_hook( __FILE__, 'psn_mail_remove' );

function psn_mail_remove() {

}


include('incs/class.php');
include('incs/admin.php');

?>