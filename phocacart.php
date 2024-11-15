<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Router\ApiRouter;
use Joomla\Router\Route;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Web Services adapter for com_phocacart.
 *
 * @since  4.0.0
 */
class PlgWebservicesPhocaCart extends CMSPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  4.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Registers com_banners's API's routes in the application
	 *
	 * @param   ApiRouter  &$router  The API Routing object
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function onBeforeApiRoute(&$router)
	{
		$router->addRoutes([
			new Route(['GET'], 'v1/phocacart/status', 'status' . '.displayStatus', [], [
				'component' => 'com_phocacart',
				'public' => false,
			]),
		]);

		$router->createCRUDRoutes(
			'v1/phocacart/products',
			'products',
			['component' => 'com_phocacart']
		);

		$router->addRoutes([
			new Route(['PATCH'], 'v1/phocacart/products', 'products' . '.editMulti', [], [
				'component' => 'com_phocacart',
				'public' => false,
			]),
		]);

		$router->addRoutes([
			new Route(['POST'], 'v1/phocacart/products/stock', 'products' . '.updateStock', [], [
				'component' => 'com_phocacart',
				'public' => false,
			]),
		]);

		$router->createCRUDRoutes(
			'v1/phocacart/products/variants',
			'productsvariants',
			['component' => 'com_phocacart']
		);

		$router->createCRUDRoutes(
			'v1/phocacart/orders',
			'orders',
			['component' => 'com_phocacart']
		);
	}
}
