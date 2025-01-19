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
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use ConseilGouz\Module\CGClean\Administrator\Helper\CgCleanHelper;

$hide = "";
if (!CgCleanHelper::check_need_button()) {
    return;
}

$modulefield	= 'media/mod_cg_clean/';
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('cgclean', $modulefield.'css/cg_clean.css');
if ((bool)Factory::getApplication()->getConfig()->get('debug')) { // Mode debug
    Factory::getApplication()->getDocument()->addScript(''.URI::base(true).'/../'.$modulefield.'js/cg_clean.js');
} else {
    $wa->registerAndUseScript('cgclean', $modulefield.'js/cg_clean.js');
}

// Texte du bouton
$btntext = $params->get('btn_text', 'Clean');
$btncolor = $params->get('btn_color', '#dc143c');
$btnbgcolor = $params->get('btn_bgcolor', '#ffe030');
$btncss = trim($params->get('btn_css', ''));

if ($btncss) {
    $wa->addInlineStyle($btncss);
}

Factory::getApplication()->getDocument()->addScriptOptions(
    'cgclean',
    array('id' => $module->id,'btntext' => $btntext , 'btncolor' => $btncolor,
    'btnbgcolor' => $btnbgcolor)
);
?>

<span id="clean_btn<?php echo $module->id; ?>" <?php echo $hide;?>><?php echo $btntext; ?></span>

