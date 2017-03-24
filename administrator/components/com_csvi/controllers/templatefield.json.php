<?php
/**
 * @package     CSVI
 * @subpackage  Templatefields
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Template fields Controller.
 *
 * @package     CSVI
 * @subpackage  Templatefields
 * @since       6.0
 */
class CsviControllerTemplatefield extends JControllerForm
{
	/**
	 * Process the Quick Add fields.
	 *
	 * @return  mixed  True if template field is stored | Error message in case of a problem.
	 *
	 * @since   4.2
     *
     * @throws  Exception
	 */
	public function storeTemplateField()
	{
		$error = false;

		try
		{
			/** @var CsviModelTemplatefield $model */
			$model = $this->getModel();

			$result = $model->storeTemplateField();

		}
		catch (Exception $e)
		{
			$result = $e->getMessage();
			$error = true;
		}

		echo new JResponseJson(null, $result, $error);

		JFactory::getApplication()->close();
	}
}
