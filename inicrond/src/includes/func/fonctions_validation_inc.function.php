<?php
//$Id$


if(!isset($_OPTIONS["INCLUDED"]))
{
die("hacking attempt!!");
}

/*
//---------------------------------------------------------------------
//
//
//Fonction du fichier : filtrer les donnes fournie par l'utilisateur
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
//fonction qui filtre les entrée de l'utilisateur (saut de ligne et tabulation et html entities)
function filter($string)
{
//html entities
$string = htmlEntities($string) ;

	if(!get_magic_quotes_gpc())//MAGIC QUOTES
	{
	
	$string = addSlashes($string);
	}

return $string ;
}


?>