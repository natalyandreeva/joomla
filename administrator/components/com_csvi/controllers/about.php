<?php
/**
 * @package     CSVI
 * @subpackage  About
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * The about controller.
 *
 * @package     CSVI
 * @subpackage  About
 * @since       6.0
 */
class CsviControllerAbout extends JControllerLegacy
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModel  Object of a database model.
	 *
	 * @since   1.0
	 */
	public function getModel($name = 'About', $prefix = 'CsviModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	/**
	 * Tries to fix missing database updates.
	 *
	 * @return  void.
	 *
	 * @since   5.7
	 */
	public function fix()
	{
		/** @var CsviModelAbout $model */
		$model = $this->getModel();
		$model->fix();
		$this->setRedirect(JRoute::_('index.php?option=com_csvi&view=about', false));
	}

	/**
	 * Tries to fix missing database updates.
	 *
	 * @return  void.
	 *
	 * @since   5.7
	 */
	public function fixMenu()
	{
		/** @var CsviModelAbouts $model */
		$model = $this->getModel();
		$message = '';
		$type = '';

		try
		{
			$model->fixMenu();
		}
		catch (Exception $e)
		{
			$message = $e->getMessage();
			$type = 'error';
		}

		$this->setRedirect(JRoute::_('index.php?option=com_csvi&view=about', false), $message, $type);
	}
}
