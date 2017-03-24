<?php
/**
 * @package     CSVI
 * @subpackage  Core
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Core controller for CSVI.
 *
 * @package     CSVI
 * @subpackage  Core
 * @since       6.0
 */
class CsviControllerSefs extends JControllerLegacy
{
	/**
	 * Overwrite the Joomla default getModel to make sure the ignore_request is not set to true.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	public function getsef()
	{
		$uri = JUri::getInstance();
		echo new JResponseJson(
			$uri->toString(
				array('scheme', 'user', 'pass', 'host', 'port')
			) . JRoute::_(base64_decode($this->input->getBase64('parseurl')), false)
		);

		JFactory::getApplication()->close();
	}
}
