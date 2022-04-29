<?php
/* 
 * @module		CG_Clean for Joomla 4.0
 * @author		ConseilGouz
 * @license		GNU General Public License version 2 or later
 * Suite aux discussions https://forum.joomla.fr/node/1970249
 * logique reprise depuis lm_memo https://lomart.fr/extensions/lm-memo
 * version       2.0.1
 */ 

defined("_JEXEC") or die;
use ConseilGouz\Module\CGClean\Administrator\Helper\CgCleanHelper;

	$hide = "";
	if (!CgCleanHelper::check_need_button()) {
		$hide=" style='display:none'";
	}
?>

<span id="clean_btn<?php echo $module->id; ?>" <?php echo $hide;?>><?php echo $btntext; ?></span>

