<?php
/****************************************************************************/
/* ATutor																	*/
/****************************************************************************/
/* Copyright (c) 2002-2004 by Greg Gay, Joel Kronenberg & Heidi Hazelton	*/
/* Adaptive Technology Resource Centre / University of Toronto				*/
/* http://atutor.ca															*/
/*																			*/
/* This program is free software. You can redistribute it and/or			*/
/* modify it under the terms of the GNU General Public License				*/
/* as published by the Free Software Foundation.							*/
/****************************************************************************/

define('AT_INCLUDE_PATH', '../include/');
require(AT_INCLUDE_PATH.'vitals.inc.php');

authenticate(AT_PRIV_POLLS);

$_section[0][0] = _AT('tools');
$_section[0][1] = 'tools/index.php';
$_section[1][0] = _AT('polls');

require(AT_INCLUDE_PATH.'header.inc.php'); 

if ($_GET['col']) {
	$col = addslashes($_GET['col']);
} else {
	$col = 'created_date';
}

if ($_GET['order']) {
	$order = addslashes($_GET['order']);
} else {
	$order = 'asc';
}

${'highlight_'.$col} = ' style="font-size: 1em;"';

$sql	= "SELECT * FROM ".TABLE_PREFIX."polls WHERE course_id=$_SESSION[course_id] ORDER BY $col $order";
$result = mysql_query($sql, $db);

echo '<h3>'._AT('polls').'</h3>';


/* admin editing options: */
unset($editors);
$editors[] = array('priv' => AT_PRIV_POLLS, 'title' => _AT('add_poll'), 'url' => $_base_path.'editor/add_poll.php');
print_editor($editors , $large = true);


if (!($row = mysql_fetch_assoc($result))) {
	echo '<p>'._AT('no_polls_found').'</p>';
} else {
	require(AT_INCLUDE_PATH.'html/feedback.inc.php');

	if (isset($errors)) { print_errors($errors); }
	if(isset($warnings)){ print_warnings($warnings); }

	$num_rows = mysql_num_rows($result);
?>

<table cellspacing="1" cellpadding="0" border="0" class="bodyline" summary="" width="95%" align="center">
<tr>
	<th colspan="8" class="cyan"><?php 
		echo _AT('polls');
	?></th>
</tr>
<tr>
	<th scope="col" class="cat"><small<?php echo $highlight_question; ?>><?php echo _AT('question'); ?> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=question<?php echo SEP; ?>order=asc" title="<?php echo _AT('question_ascending'); ?>"><img src="images/asc.gif" alt="<?php echo _AT('question_ascending'); ?>" style="height:0.50em; width:0.83em" border="0" height="7" width="11" /></a> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=question<?php echo SEP; ?>order=desc" title="<?php echo _AT('question_descending'); ?>"><img src="images/desc.gif" alt="<?php echo _AT('question_descending'); ?>" style="height:0.50em; width:0.83em" border="0" height="7" width="11" /></a></small></th>

	<th scope="col" class="cat"><small<?php echo $highlight_created_date; ?>><?php echo _AT('created_date'); ?> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=created_date<?php echo SEP; ?>order=asc" title="<?php echo _AT('created_date_ascending'); ?>"><img src="images/asc.gif" alt="<?php echo _AT('created_date_ascending'); ?>" style="height:0.50em; width:0.83em" border="0" height="7" width="11" /></a> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=created_date<?php echo SEP; ?>order=desc" title="<?php echo _AT('created_date_descending'); ?>"><img src="images/desc.gif" alt="<?php echo _AT('created_date_descending'); ?>" style="height:0.50em; width:0.83em" border="0" height="7" width="11" /></a></small></th>

	<th class="cat"><small>&nbsp;</small></th>
</tr>
<?php
	do {
		echo '<tr>';
		echo '<td class="row1"><a href="editor/edit_poll.php?poll_id='.$row['poll_id'].'">'.AT_print($row['question'], 'polls.question').'</a></td>';
		echo '<td class="row1">'.$row['created_date'].'</td>';

		echo '<td class="row1"><a href="editor/delete_poll.php?pid='.$row['poll_id'].'"><img src="images/icon_delete.gif" border="0" alt="'._AT('delete').'" title="'._AT('delete').'" width="16" height="18" class="menuimage18" /></a></td>';
		echo '</tr>';

		if ($count < $num_rows-1) {
			echo '<tr><td height="1" class="row2" colspan="3"></td></tr>';
		}
		$count++;
	} while ($row = mysql_fetch_assoc($result));
	echo '</table>';
}

require(AT_INCLUDE_PATH.'footer.inc.php'); 
?>