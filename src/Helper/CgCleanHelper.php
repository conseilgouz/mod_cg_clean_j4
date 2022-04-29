<?php
/* 
 * @module		CG_Clean for Joomla 4.0
 * @author		ConseilGouz
 * @license		GNU General Public License version 2 or later
 * Suite aux discussions https://forum.joomla.fr/node/1970249
 * logique reprise depuis lm_memo https://lomart.fr/extensions/lm-memo
 * version       2.0.1
 */ 
namespace ConseilGouz\Module\CGClean\Administrator\Helper;
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Language\Text;

class CgCleanHelper
{
	public static function getAjax()
    {
		$module = ModuleHelper::getModule('mod_cg_clean');
		$params = new Registry($module->params);  		
        $input = Factory::getApplication()->input;
        $output = '';
        if (($params->get('remove_beez') > 0) && (Folder::exists(JPATH_ROOT . '/templates/beez3'))) {
            if (self::check_template_in_use('beez3') ) {
				$output .= Text::_("IN_USED_BEEZ3");
			} else {
				$output .= Text::_("REMOVED_BEEZ3");
				Folder::delete(JPATH_ROOT . '/templates/beez3');        
			}
		}
		if (($params->get('remove_protostar') > 0) && (Folder::exists(JPATH_ROOT . '/templates/protostar'))) {
			if ($output != "") $output .= ", ";
            if (self::check_template_in_use('protostar') ) {
				$output .= Text::_("IN_USED_PROTOSTAR");
			} else {
				$output .= Text::_("REMOVED_PROTOSTAR");	
				Folder::delete(JPATH_ROOT . '/templates/protostar');        
			}
		}
	    $str = "";
		$arr_lst = array();
		if ($params->get('remove_txt') > 0) {
			$arr_lst= array(".htaccess"=>"htaccess.txt",
							"web.config"=>"web.config.txt",
							"README.TXT"=>"README.TXT",
							"robots.txt"=>"robots.txt.dist",
							"LICENSE.txt"=>"LICENSE.txt");
		}
		$list = $params->get('remove_file_list',array());
		foreach ($list as $val) {
			if (!in_array($val,$arr_lst)) {
				$arr_lst[$val] = $val;
			}
		}
		foreach ($arr_lst as $key => $val) {
			if ((File::exists(JPATH_ROOT . '/'.$key)) && (File::exists(JPATH_ROOT . '/'.$val))) {
				if (File::delete(JPATH_ROOT . '/'.$val)) {
					if ($str != "") $str .= ", ";
					$str .= $val;
				}
			}
		}
		if ($str != "") {
			if ($output != "") $output .= "\n"; 
			$output .= Text::_("REMOVED_FILES").$str;
		}
        if ($output == '') $output = Text::_("REMOVED_NOTHING");
		return $output;
    }
	// Check if button is needed
    public static function check_need_button() {
		$res = false;
		$module = ModuleHelper::getModule('mod_cg_clean');
		$params = new Registry($module->params);  		

        if ((($params->get('remove_beez') > 0) && (Folder::exists(JPATH_ROOT . '/templates/beez3')) && (!self::check_template_in_use('beez3') ))  || (($params->get('remove_protostar') > 0) && (Folder::exists(JPATH_ROOT . '/templates/protostar')) && (!self::check_template_in_use('protostar') ) ) ) {
				$res = true;
		}
		$arr_lst = array();
		if ($params->get('remove_txt') > 0) {
			$arr_lst= array(".htaccess"=>"htaccess.txt",
							"web.config"=>"web.config.txt",
							"README.TXT"=>"README.TXT",
							"robots.txt"=>"robots.txt.dist",
							"LICENSE.txt"=>"LICENSE.txt");
		}
		$list = $params->get('remove_file_list',array());
		foreach ($list as $val) {
			if (!in_array($val,$arr_lst)) {
				$arr_lst[$val] = $val;
			}
		}

		foreach ($arr_lst as $key => $val) {
			if ((File::exists(JPATH_ROOT . '/'.$key)) && (File::exists(JPATH_ROOT . '/'.$val))) {
					$res = true;
				}
			}
		return $res;
	}
	private static function check_template_in_use($template) {
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->select('COUNT(*)')
			->from('#__template_styles')
			->where(' template like "'.$template.'"');
		$db->setQuery($query);
		return ($db->loadResult() > 0) ;

	}
}


