<?php
/*
    $Id$

    Inicrond : Network of Interactive Courses Registred On a Net Domain
    Copyright (C) 2004, 2005  Sébastien Boisvert

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/





/**
* return a boolean to know if a usr can see a resultt
*
* @param        integer  $result_id    id of the result
* @param        integer  $usr_id    id of the usr
* @author       Sebastien Boisvert sebhtml@users.sourceforge.net
* @version      1.0.0
*/
function
can_usr_check_result($usr_id, $result_id)
{
    global $_OPTIONS, $_RUN_TIME, $inicrond_db;

    if(!isset($_SESSION['usr_id']))
    {
        return FALSE;
    }
    elseif(!$result_id)
    {
        return FALSE;
    }

    $query = "
    SELECT
    available_results,
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements'].".cours_id as cours_id
    FROM
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].", ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].", ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].", ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements']."
    WHERE
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].".inode_id = ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements'].".inode_id
    and
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".session_id = ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".session_id
    and
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".test_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].".test_id
    AND
    result_id=$result_id
    ";

    $rs = $inicrond_db->Execute($query);
    $fetch_result = $rs->FetchRow();

    //is in charge in course.
    if(is_in_charge_in_course($_SESSION['usr_id'], $fetch_result['cours_id']))
    {
        return TRUE;
    }

    return $fetch_result['available_results'];//TRUE OU FALSE;
}

/**
* return a boolean to know if a usr can see his exam sheet
*
* @param        integer  $result_id    id of the result
* @param        integer  $usr_id    id of the usr
* @author       Sebastien Boisvert sebhtml@users.sourceforge.net
* @version      1.0.0
*/

function
can_usr_check_sheet($usr_id, $result_id)
{
    global $_OPTIONS, $_RUN_TIME, $inicrond_db;

    if(!isset($usr_id) || !$result_id)
    {
        return FALSE;
    }

    if($_SESSION['SUID'] || is_teacher_of_cours($usr_id, result_2_cours($result_id)))
    {
        return TRUE;
    }

    $query = "
    SELECT
    available_sheet
    FROM
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].", ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results']."
    WHERE
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".test_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].".test_id
    AND
    result_id=$result_id
    ";

    $rs = $inicrond_db->Execute($query);
    $fetch_result = $rs->FetchRow();

    return $fetch_result['available_sheet'];//TRUE OU FALSE;
}

?>