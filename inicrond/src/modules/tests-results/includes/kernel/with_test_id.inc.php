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

if(!__INICROND_INCLUDED__)//security...
{
    exit();
}

/////////////////////////////////////////////////

$WHERE_CLAUSE .= "
AND ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".test_id=".$_GET['test_id']."
";

//allons chercher le titre du cours.
//

$query = "
SELECT
test_name,
cours_name,
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['cours'].".cours_id AS  CID
FROM
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['cours'].",
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].",
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements']."
WHERE
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements'].".inode_id = ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['tests'].".inode_id
and
test_id=".$_GET['test_id']."
AND
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['cours'].".cours_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['inode_elements'].".cours_id
";

$rs = $inicrond_db->Execute($query);
$fetch_result = $rs->FetchRow();

$cours_id = $fetch_result["CID"];

$module_title =  $_LANG['tests-results'];

if(isset($_GET['join']))//join the query with a usr or a group...
{
    //all the mark for this   exercice  with a group _id)//for a usr
    if(isset($_GET['usr_id'] ) && $_GET['usr_id'] != "" && (int) $_GET['usr_id'] && $is_in_charge_of_user)
    {
        //the name of the usr that you want...

        $base .= "&join&usr_id=".$_GET['usr_id']."&"."test_id=".$_GET['test_id'];

        $query33 = "
        SELECT
        usr_name
        FROM
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs']."
        WHERE
        usr_id=".$_GET['usr_id']."
        ";

        $module_content .= "<a href=\"".__INICROND_INCLUDE_PATH__."modules/tests-results/correl_time_vs_score.php?usr_id=".$_GET['usr_id']."&test_id=".$_GET['test_id']."\" >".$_LANG['correlation_between_time_and_score']."</a><br />";

        $module_content .= "<a href=\"".__INICROND_INCLUDE_PATH__."modules/tests-results/normal_dist_img.php?usr_id=".$_GET['usr_id']."&test_id=".$_GET['test_id']."\" >".$_LANG['GD_distribution_of_score']."</a><br />";


        $module_content .= "<a href=\"".__INICROND_INCLUDE_PATH__."modules/tests-results/normal_dist_time_img.php?usr_id=".$_GET['usr_id']."&test_id=".$_GET['test_id']."\" >".$_LANG['distribution_of_time']."</a><br />";

        $module_content .= "<a href=\"".__INICROND_INCLUDE_PATH__."modules/tests-results/attempts_graphic.php?usr_id=".$_GET['usr_id']."&test_id=".$_GET['test_id']."\" >".$_LANG['attempts_graphic']."</a><br />";

        $query_result33 = $inicrond_db->Execute($query33);
        $fetch_result33 = $query_result33->FetchRow();

        $module_content .= sprintf(
        $_LANG['test_results_for_a_usr_only'],
        $fetch_result33['usr_name']
        );

        //end of : the name of the usr that you want...

        $WHERE_CLAUSE .= "
        AND ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs'].".usr_id=".$_GET['usr_id']."
        ";
    }
    else if(isset($_GET['group_id']) && $_GET['group_id'] != "" && (int) $_GET['group_id']
    && $is_in_charge_of_group)//for a group...
    {
        $base .= "&join&group_id=".$_GET['group_id']."&"."test_id=".$_GET['test_id'];

        //the name of the groupe that you want...

        $query33 = "
        SELECT
        group_name
        FROM
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups']."
        WHERE
        group_id=".$_GET['group_id']."
        ";

        $query_result33 = $inicrond_db->Execute($query33);
        $fetch_result33 = $query_result33->FetchRow();

        $module_content .= sprintf(
        $_LANG['test_results_for_a_grp_only'],
        $fetch_result33['group_name']
        );

        //end of : the name of the groupe that you want...
        $FROM_WHAT .= ",
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs']."";

        $WHERE_CLAUSE .= "
        AND
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].".group_id=".$_GET['group_id']."
        AND
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].".usr_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".usr_id

        ";
    }
}

else//all marks for this exercice
{
    $module_content .= "<a href=\"tests_marks_graphics.php?test_id=".$_GET['test_id']."\">".$_LANG['tests_marks_graphics']."</a><br />";

    $module_content .= $_LANG['msg_all_result_for_this_test'];//text for the user...

    $base .= "&test_id=".$_GET['test_id']."";
    //
    //Marks by flash and by group at the same time...
    //
    $sql_4_groups = "
    SELECT
    group_name,
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups'].".group_id
    FROM
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups']."
    WHERE
    cours_id=$cours_id
    ";

    $r = $inicrond_db->Execute($sql_4_groups);

    $tableX = array(array($_LANG['groups']));
    $already_there = array();

    while($f = $r->FetchRow($r))
    {
        if(!isset($already_there[$f['group_id']]))
        {
            $tableX []= array(retournerHref(__INICROND_INCLUDE_PATH__."modules/tests-results/results.php?test_id=".$_GET['test_id']."&group_id=".$f['group_id']."&join",
            $f['group_name']));

            $already_there[$f['group_id']] = $f['group_name'] ;//don't put it again later..
        }
    }

    $module_content .= retournerTableauXY($tableX);

    //

    //
    $sql_4_groups = "
    SELECT
    usr_name,
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs'].".usr_id
    FROM
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].",
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs'].",
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time']."
    WHERE
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".session_id = ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".session_id
    and
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['results'].".test_id=".$_GET['test_id']."
    AND
    ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".usr_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs'].".usr_id
    AND
    time_GMT_start<time_GMT_end
    AND
    max_points>0
    ";

    $r = $inicrond_db->Execute($sql_4_groups);

    $tableX = array(array($_LANG['members']));
    $already_there = array();

    while($f = $r->FetchRow($r))
    {
        if(!isset($already_there[$f['usr_id']]))
        {
            $tableX []= array(retournerHref(__INICROND_INCLUDE_PATH__."modules/tests-results/results.php?test_id=".$_GET['test_id']."&usr_id=".$f['usr_id']."&join",
            $f['usr_name']));

            $already_there[$f['usr_id']] = $f['usr_name'] ;//don't put it again later..
        }
    }

    $module_content .= retournerTableauXY($tableX);

    //
    // END OF : Marks by flash and by group at the same time...
    //
}

?>
