<?php
//$Id$


define('__INICROND_INCLUDED__', TRUE);
define('__INICROND_INCLUDE_PATH__', '../../');
include __INICROND_INCLUDE_PATH__.'includes/kernel/pre_modulation.php';
include __INICROND_INCLUDE_PATH__.'modules/members/includes/functions/access.inc.php';
include 'includes/languages/'.$_SESSION['language'].'/lang.php';
//pear
$_GET['image'] = $_LANG['FILE_session_time_distribution'];

include __INICROND_INCLUDE_PATH__.'modules/groups/includes/functions/access.inc.php';

$query = "SELECT end_gmt_timestamp-start_gmt_timestamp AS value FROM
".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time']."

";

//validation
$ok = FALSE;

if(isset($_GET['usr_id']) AND
$_GET['usr_id'] != "" AND
(int) $_GET['usr_id'] AND
is_in_charge_of_user($_SESSION['usr_id'], $_GET['usr_id'])
)
{
        $query2 = "SELECT
        usr_name
        FROM 
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['usrs']."
        WHERE 
        usr_id=".$_GET['usr_id']."";
        
        $rs = $inicrond_db->Execute($query2);
        $fetch_result = $rs->FetchRow();
        
        $_GET["image"] .= "_".$fetch_result['usr_name'];//the file name...
        
        $ok = TRUE;
        $query .= " WHERE usr_id=".$_GET['usr_id']."";
        
        
}
elseif($_SESSION['SUID'])
{
        $ok = TRUE;
        $_GET["image"] .= "_".$_LANG['all'];//the file name...
        $query .= " WHERE 1";
}

if(
isset($_GET['cours_id']) AND//add cours_id clause.
$_GET['cours_id'] != "" AND
(int) $_GET['cours_id']

)
{
        
        $query .= " AND cours_id=".$_GET['cours_id']."";
}

elseif(is_numeric($_GET['group_id']) AND
is_in_charge_of_group($_SESSION['usr_id'], $_GET['group_id']) 
)
{
        $ok = 1 ;
        //////////////////
        //get the cours id for this group.
        
        
        //define the query in one shot...
        $query = "SELECT 
        end_gmt_timestamp-start_gmt_timestamp AS value
        FROM
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].",
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].",
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups']."
        WHERE
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".cours_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups'].".cours_id
        AND
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].".usr_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['online_time'].".usr_id
        AND
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].".group_id=".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups'].".group_id
        AND
        ".$_OPTIONS['table_prefix'].$_OPTIONS['tables']['groups_usrs'].".group_id = ".$_GET['group_id']."
        
        
        ";
        
}
$_GET["image"].= ".png";

if(!$ok)//access denied
{
        exit();
}

include __INICROND_INCLUDE_PATH__."includes/class/Histogram_graphic.php";
$Histogram_graphic = new Histogram_graphic;
$Histogram_graphic->inicrond_db = &$inicrond_db;
$Histogram_graphic->title = &$_LANG['GD_distribution_of_session_length'];
$Histogram_graphic->query = &$query;
$Histogram_graphic->preprocessor = "format_time_length";
$Histogram_graphic->render();



?>