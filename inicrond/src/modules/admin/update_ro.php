<?php
//$Id$

/*
//---------------------------------------------------------------------
//
//

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
inicrond
Copyright (C) 2004  Sebastien Boisvert

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

define('__INICROND_INCLUDED__', TRUE);
define('__INICROND_INCLUDE_PATH__', '../../');
include __INICROND_INCLUDE_PATH__.'includes/kernel/pre_modulation.php';
include 'includes/languages/'.$_SESSION['language'].'/lang.php';

if($_SESSION['SUID']
)
{
        
        $module_content .= "<h2><a href=\"admin_menu.php\">".$_LANG['admin']."</a></h2>";
	//-----------------------
	// titre
	//---------------------
        $module_title =  $_LANG['update_read_only_files'];
        
        include "includes/kernel/update_config.php";//cr�er les fichiers.
        //echo "bobu";
        
}

include __INICROND_INCLUDE_PATH__.'includes/kernel/post_modulation.php';

?>