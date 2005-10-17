<?php
if (!defined('AT_INCLUDE_PATH')) { exit; }

define('AT_PRIV_FAQ', $this->getPrivilege());

// if this module is to be made available to students on the Home or Main Navigation
$_student_tools = 'mods/faq/index.php';


// instructor Manage section:
$_module_pages['mods/faq/index_instructor.php']['title_var'] = 'faq';
$_module_pages['mods/faq/index_instructor.php']['parent']    = 'tools/index.php';
$_module_pages['mods/faq/index_instructor.php']['children']  = array('mods/faq/add_topic.php', 'mods/faq/add_question.php');

	$_module_pages['mods/faq/add_topic.php']['title_var'] = 'add_topic';
	$_module_pages['mods/faq/add_topic.php']['parent']    = 'mods/faq/index_instructor.php';

	$_module_pages['mods/faq/add_question.php']['title_var'] = 'add_question';
	$_module_pages['mods/faq/add_question.php']['parent']    = 'mods/faq/index_instructor.php';

	$_module_pages['mods/faq/delete_question.php']['title_var'] = 'delete_question';
	$_module_pages['mods/faq/delete_question.php']['parent']    = 'mods/faq/index_instructor.php';

	$_module_pages['mods/faq/edit_question.php']['title_var'] = 'edit_question';
	$_module_pages['mods/faq/edit_question.php']['parent']    = 'mods/faq/index_instructor.php';

// student page:
$_module_pages['mods/faq/index.php']['title_var'] = 'faq';
$_module_pages['mods/faq/index.php']['img']       = 'images/home-glossary.gif';

?>