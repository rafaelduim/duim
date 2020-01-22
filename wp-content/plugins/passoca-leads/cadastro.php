<?php
/*
Plugin Name: Passoca Leads
Plugin URI: http://www.rafealduim.com.br/
Description: Plugin de Captura de Leads desenvolvido por RafaelDuim
Version: 2.5.5
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


include './incs/include.php';

register_activation_hook( __FILE__, 'psn_leads_install' );
 
function psn_leads_install() {
    $PsnLead = new PsnLead();
    $createTable = $PsnLead->createTable();   
}
// Registrando a função para remover
register_deactivation_hook( __FILE__, 'psn_leads_remove' );

function psn_leads_remove() {
    $PsnLead = new PsnLead();
    $removeTable = $PsnLead->removeTable();    
}

// $PsnLeadUsers = new PsnLeadUsers();

// $user = $PsnLeadUsers->getUser(1,1);
// print_r($user);

// $PsnLeadInscription = new PsnLeadInscription();
// $PsnCreateUserInscription = $PsnLeadInscription->createUserLead('Rafael Santos','duim@rafaelduim.com.br',1,1,1,'','');

// print_r($PsnCreateUserInscription);

// $createUserInscription = $PsnLeadInscription->createUserInscription($PsnCreateUserInscription['user'],$PsnCreateUserInscription['hash'],1);

// print_r($createUserInscription);

?>