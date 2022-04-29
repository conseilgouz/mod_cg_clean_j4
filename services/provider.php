<?php
/* 
 * @module		CG_Clean 
 * @author		ConseilGouz
 * @license		GNU General Public License version 2 or later
 * Suite aux discussions https://forum.joomla.fr/node/1970249
 * logique reprise depuis lm_memo https://lomart.fr/extensions/lm-memo
 * version       2.0.1
 */ 
defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The quickicon module service provider.
 *
 * @since  4.0.0
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function register(Container $container)
	{
		$container->registerServiceProvider(new ModuleDispatcherFactory(''));
		$container->registerServiceProvider(new HelperFactory('\\ConseilGouz\\Module\\CGClean\\Administrator\\Helper'));

		$container->registerServiceProvider(new Module);
	}
};
