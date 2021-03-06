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

if(!__INICROND_INCLUDED__)
{
    exit();
}
/**
* return infos on a session
*
* @param        integer  $session_id    the id of the session
* @version      1.0.0
*/
function session_id_to_usr($session_id)
{
    global $_OPTIONS;
    global $_RUN_TIME, $inicrond_db;

    $query = "
    SELECT
    usr_id
    FROM
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time']."
    WHERE
    session_id=".$session_id."
    ";

    $rs = $inicrond_db->Execute($query);
    $r = $rs->FetchRow();

    return $r['usr_id'];
}

?>