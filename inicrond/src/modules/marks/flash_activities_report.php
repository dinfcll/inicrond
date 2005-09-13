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
define('__INICROND_INCLUDED__', TRUE);
define('__INICROND_INCLUDE_PATH__', '../../');
include __INICROND_INCLUDE_PATH__.'includes/kernel/pre_modulation.php';
include 'includes/languages/'.$_SESSION['language'].'/lang.php';

include __INICROND_INCLUDE_PATH__."modules/courses/includes/functions/transfert_cours.function.php";//transfer IDs
include __INICROND_INCLUDE_PATH__."modules/courses/includes/functions/inode_full_path.php";
include __INICROND_INCLUDE_PATH__."modules/courses/includes/functions/chapitre_media_id_2_inode_id.php";//transfer IDs


$cours_id=chapitre_media_to_cours($_GET['chapitre_media_id']);

$module_title = $_LANG['flash_activities_report'];

$module_content .= inode_full_path(chapitre_media_id_2_inode_id($_GET['chapitre_media_id']));
//do the class here...


include __INICROND_INCLUDE_PATH__."includes/class/Activities_report.php";
$my_Activities_report = new Activities_report;
$my_Activities_report->inicrond_db = &$inicrond_db;
$my_Activities_report->init_report_selection_msg_str='please_choose_a_group_for_the_flash_report';
$my_Activities_report->the_question_str='does_this_members_did_the_swf';
$my_Activities_report->actions_table_name='scores';
$my_Activities_report->elements_table_name='chapitre_media';
$my_Activities_report->field_id_name='chapitre_media_id';
$my_Activities_report->_LANG=$_LANG;
$my_Activities_report->field_name_name='file_name';
$my_Activities_report->script_name="flash_activities_report.php";
$my_Activities_report->report_presentation_msg_str='there_are_the_activities_report';
$my_Activities_report->_RUN_TIME= &$_RUN_TIME;
$my_Activities_report->cours_id=$cours_id;
$my_Activities_report->_OPTIONS=$_OPTIONS;
$my_Activities_report->module_name='flash_activities_report';
$my_Activities_report->detail_php_script_path="../../modules/marks/main.php";
$my_Activities_report->extra_where_clause_for_check=" time_stamp_start < time_stamp_end ";

$module_content .= $my_Activities_report->Execute();







include __INICROND_INCLUDE_PATH__.'includes/kernel/post_modulation.php';

?>