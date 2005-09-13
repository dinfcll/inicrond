<?php
/*---------------------------------------------------------------------

$Id$

sebastien boisvert <sebhtml at yahoo dot ca> <http://inicrond.sourceforge.net/>

inicrond Copyright (C) 2004-2005  Sebastien Boisvert

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
-----------------------------------------------------------------------*/
/**
* 
*
* @param        integer  $file_id       
* @author       Sebastien Boisvert sebhtml@users.sourceforge.net
* @version      1.0.0
*/
function img_id_2_cours_id($img_id)

{
        global $_OPTIONS, $inicrond_db;
        $query = "
        SELECT 
        cours_id
        FROM
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inicrond_images']."
        WHERE
        img_id=$img_id
        
        ";
        
        $rs = $inicrond_db->Execute($query);
        $fetch_result = $rs->FetchRow();
        
        return $fetch_result['cours_id'];
        
}

?>