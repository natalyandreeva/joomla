<?php
/**
 * @package     CSVI
 * @subpackage  JoomlaCategories
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - [year] RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Joomla! Categories addon installer.
 *
 * @package     CSVI
 * @subpackage  JoomlaCategories
 * @since       6.0
 */
class PlgcsviaddoncategoriesInstallerScript
{
	/**
	 * Actions to perform before installation.
	 *
	 * @param   string  $route   The type of installation being run.
	 * @param   object  $parent  The parent object.
	 *
	 * @return  bool  True on success | False on failure.
	 *
	 * @since   6.0
	 */
	public function preflight($route, $parent)
	{
		if ($route == 'install')
		{
			// Check if CSVI Pro is installed
			if (!file_exists(JPATH_ADMINISTRATOR . '/components/com_csvi/'))
			{
				JFactory::getApplication()->enqueueMessage(JText::_('PLG_CSVIADDON_CSVI_NOT_INSTALLED'), 'error');

				return false;
			}
		}

		return true;
	}

	/**
	 * Actions to perform after installation.
	 *
	 * @param   object  $parent  The parent object.
	 *
	 * @return  bool  True on success | False on failure.
	 *
	 * @since   6.0
	 */
	public function postflight($parent)
	{
		// Load the application
		$app = JFactory::getApplication();

		// Create the folder in the addons location
		$folder = JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_categories';

		if (JFolder::create($folder))
		{
			// Copy the folder to the correct location
			$src = JPATH_SITE . '/plugins/csviaddon/categories/com_categories';
			JFolder::copy($src, $folder, '', true);

			// Enable the plugin
			$db = JFactory::getDbo();
			$query = $db->getQuery(true)
						->update($db->quoteName("#__extensions"))
						->set($db->quoteName("enabled") . ' =  1')
						->where($db->quoteName("type") . ' = ' . $db->quote('plugin'))
						->where($db->quoteName("element") . ' = ' . $db->quote('categories'))
						->where($db->quoteName("folder") . ' = ' . $db->quote('csviaddon'));

			$db->setQuery($query);

			if ($db->execute())
			{
				$app->enqueueMessage(JText::_('PLG_CSVIADDON_PLUGIN_ENABLED'));

				return true;
			}
			else
			{
				$app->enqueueMessage(JText::sprintf('PLG_CSVIADDON_PLUGIN_NOT_ENABLED', $db->getErrorMsg()), 'error');

				return false;
			}
		}
		else
		{
			$app->enqueueMessage(JText::sprintf('PLG_CSVIADDON_FOLDER_NOT_CREATED', $folder), 'error');

			return false;
		}
	}

	/**
	 * Actions to perform after un-installation.
	 *
	 * @param   object  $parent  The parent object.
	 *
	 * @return  bool  True on success | False on failure.
	 *
	 * @since   6.0
	 */
	public function uninstall($parent)
	{
		// Remove the files
		if (file_exists(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_categories'))
		{
			JFolder::delete(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_categories');
		}
	}
}
