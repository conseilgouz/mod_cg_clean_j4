<?php
/* 
 * @module		CG_Clean for Joomla 4.0
 * @author		ConseilGouz
 * @license		GNU General Public License version 2 or later
 * Suite aux discussions https://forum.joomla.fr/node/1970249
 * logique reprise depuis lm_memo https://lomart.fr/extensions/lm-memo
 * version       2.0.1
 */ 
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;
use ConseilGouz\Module\CGClean\Administrator\Helper\CgCleanHelper;

$id = $module->id;
$doc = Factory::getDocument();
$doc->addStyleSheet('../media/mod_cg_clean/css/cg_clean.css');

HTMLHelper::_('jquery.framework',true);

// Texte du bouton
$btntext = $params->get('btn_text','Clean');
$btncolor = $params->get('btn_color','#dc143c');
$btnbgcolor = $params->get('btn_bgcolor','#ffe030');
$btncss = trim($params->get('btn_css',''));

$style = <<<CSS
#clean_btn$id {
	color:$btncolor; 
	background-color:$btnbgcolor;
	$btncss
}
CSS;
$doc->addStyleDeclaration($style);

// JQuery
$js = <<<JS
jQuery(function ($) {
	var btn = $('#clean_btn'+$id);
	btn.click (function() {
		request = {
			'option' : 'com_ajax',
			'module' : 'cg_clean',
			'data'   : 'cg_clean',
			'format' : 'raw'
			};
			$.ajax({
				type   : 'POST',
				data   : request,
				success: function (response) {
					alert(response); 
					$('#clean_btn'+$id).css("display","none");
				}
			});
	});
	return false;
})
JS;

$doc->addScriptDeclaration($js);

require ModuleHelper::getLayoutPath('mod_cg_clean');