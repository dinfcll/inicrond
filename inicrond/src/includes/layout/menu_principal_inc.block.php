<?php
//$Id$

/*
//---------------------------------------------------------------------
//
//
//Fonction du fichier : tout les liens principaux du site
//
//
//Auteur : sebastien boisvert
//email : sebhtml@yahoo.ca
//site web : http://membres.lycos.fr/zs8
//Projet : inicrond
//
//---------------------------------------------------------------------
*/

/*


http://www.gnu.org/copyleft/gpl.html

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


*/

if(isset($_OPTIONS["INCLUDED"]))
{

$tableau = array(
32,//home
37,//wiki
8,//membres
21,//groupes
1,//fichiers
38,//annuaire
10,//images
//36,//stats
44,//clendar
45,//d�pot
23,//forum
35,//recherche
500//sessions
);

	foreach($tableau AS $value)
	{
	$layout_contenu .= retournerHref("?module_id=$value", $_LANG["common"][$value]);
	$layout_contenu .= "<br />";
	}


}
?>
