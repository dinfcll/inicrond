<?php
//$Id$



/*
//---------------------------------------------------------------------
//
//
//Fonction du fichier : classe de connexion database
//
//
//Auteur : sebastien boisvert
//email : sebhtml@users.sourceforge.net
//site web : http://inicrond.sourceforge.net/
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

if(__INICROND_INCLUDED__)
{
        /**
        * add a option in the select
        *
        * @param        object  $option  an option for the select
        * @author       Sebastien Boisvert sebhtml@users.sourceforge.net
        * @version      1.0.0
        */	
	class Radio extends Base
	{
                
                
                var $checked;
                /**
                * constructor
                *
                * @author       Sebastien Boisvert sebhtml@users.sourceforge.net
                * @version      1.0.0
                */		
		function Radio()
		{
                        
		}
                /**
                * check the checkbox
                *
                * @author       Sebastien Boisvert sebhtml@users.sourceforge.net
                * @version      1.0.0
                */			
		function checked()
		{
                        $this->checked = "checked";
		}
                /**
                * validate the form object
                *
                * @author       Sebastien Boisvert sebhtml@users.sourceforge.net
                * @version      1.0.0
                */			
		function validate()
		{
                        $this->form_o = 
                        "<input type=\"radio\" ".$this->checked." name=\"".$this->name."\" value=\"".$this->value."\" />";
		}
		
                
	}
}

?>
