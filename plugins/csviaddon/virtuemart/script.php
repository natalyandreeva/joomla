<?php
/**
 * @package     CSVI
 * @subpackage  VirtueMart
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * VirtueMart addon installer.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class PlgcsviaddonvirtuemartInstallerScript
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
		$db = JFactory::getDbo();

		// Create the folder in the addons location
		$folder = JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_virtuemart';

		if (JFolder::create($folder))
		{
			// Copy the folder to the correct location
			$src = JPATH_SITE . '/plugins/csviaddon/virtuemart/com_virtuemart';

			try
			{
				// Copy the plugin data to the CSVI folder
				JFolder::copy($src, $folder, '', true);

				// Load the tasks
				$queries = $db->splitSql(file_get_contents($folder . '/install/tasks.sql'));

				foreach ($queries as $query)
				{
					$query = trim($query);

					if (!empty($query))
					{
						$db->setQuery($query)->execute();
					}
				}

				// Define the tmp folder
				$config = JFactory::getConfig();

				if (!defined('CSVIPATH_DEBUG'))
				{
					define('CSVIPATH_DEBUG', JPath::clean($config->get('log_path'), '/'));
				}

				// Enable the plugin
				$query = $db->getQuery(true)
					->update($db->quoteName("#__extensions"))
					->set($db->quoteName("enabled") . ' =  1')
					->where($db->quoteName("type") . ' = ' . $db->quote('plugin'))
					->where($db->quoteName("element") . ' = ' . $db->quote('virtuemart'))
					->where($db->quoteName("folder") . ' = ' . $db->quote('csviaddon'));

				$db->setQuery($query)->execute();
				$app->enqueueMessage(JText::_('PLG_CSVIADDON_PLUGIN_ENABLED'));
			}
			catch (Exception $e)
			{
				$app->enqueueMessage($e->getMessage());

				return false;
			}
		}
		else
		{
			$app->enqueueMessage(JText::sprintf('PLG_CSVIADDON_FOLDER_NOT_CREATED', $folder), 'error');

			return false;
		}

		return true;
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
		if (file_exists(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_virtuemart'))
		{
			JFolder::delete(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_virtuemart');
		}
	}
}
