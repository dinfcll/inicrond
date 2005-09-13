<?php
//$Id$




/*
//---------------------------------------------------------------------
//
//
//Fonction du fichier : l'index du site
//
//
//Auteur : sebastien boisvert
//email : sebhtml@users.sourceforge.net
//site web : http://inicrond.sourceforge.net/
//Projet : inicrond

Copyright (C) 2004  Sebastien Boisverthttp://www.gnu.org/copyleft/gpl.html

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

//
//---------------------------------------------------------------------
*/
if(__INICROND_INCLUDED__)
{
	/**
        * return the array with mixed keys.
        *
        * @param        array  $input    array
        * @author       Sebastien Boisvert sebhtml@users.sourceforge.net
        * @version      1.0.0
        */
	function at_random($input)
	{
                
                
                $randoms = array_rand($input, count($input));
                
                //print_r($randoms);
                /*
                echo nl2br(print_r($input, TRUE));
                exit();
                */
                
                $output = array();
                
                foreach($randoms AS $key)
                {
                        $output []= $input[$key];
                }
                /*echo nl2br(print_r($output, TRUE));
                exit();
                */
                
                return $output;
                
	}
}
?>