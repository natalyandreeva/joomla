<?php
/**
 * @package     CSVI
 * @subpackage  Plugin.Skip
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Skip values.
 *
 * @package     CSVI
 * @subpackage  Plugin.Skip
 * @since       7.0
 */
class PlgCsvirulesSkip extends RantaiPluginDispatcher
{
	/**
	 * The unique ID of the plugin
	 *
	 * @var    string
	 * @since  7.0
	 */
	private $id = 'csviskip';

	/**
	 * Return the name of the plugin.
	 *
	 * @return  array  The name and ID of the plugin.
	 *
	 * @since   7.0
	 */
	public function getName()
	{
		return array('value' => $this->id, 'text' => 'CSVI Skip');
	}

	/**
	 * Method to get the name only of the plugin.
	 *
	 * @param   string  $plugin  The ID of the plugin
	 *
	 * @return  string  The name of the plugin.
	 *
	 * @since   7.0
	 */
	public function getSingleName($plugin)
	{
		if ($plugin === $this->id)
		{
			return 'CSVI Skip';
		}

		return '';
	}

	/**
	 * Method to get the field options.
	 *
	 * @param   string  $plugin   The ID of the plugin
	 * @param   array   $options  An array of settings
	 *
	 * @return  string  The rendered form with plugin options.
	 *
	 * @since   7.0
	 * @throws  RuntimeException
	 * @throws  InvalidArgumentException
	 */
	public function getForm($plugin, $options = array())
	{
		if ($plugin === $this->id)
		{
			// Load the language files
			$lang = JFactory::getLanguage();
			$lang->load('plg_csvirules_skip', JPATH_ADMINISTRATOR, 'en-GB', true);
			$lang->load('plg_csvirules_skip', JPATH_ADMINISTRATOR, null, true);

			// Add the form path for this plugin
			JForm::addFormPath(JPATH_PLUGINS . '/csvirules/skip/');

			// Load the helper that renders the form
			$helper = new CsviHelperCsvi;

			// Instantiate the form
			$form = JForm::getInstance('skip', 'form_skip');

			// Bind any existing data
			$form->bind(array('pluginform' => $options));

			// Create some dummies
			$input = new JInput;

			// Render the form
			return $helper->renderCsviForm($form, $input);
		}
	}

	/**
	 * Run the rule.
	 *
	 * @param   string            $plugin    The ID of the plugin
	 * @param   object            $settings  The plugin settings set for the field
	 * @param   object            $field     The field being process
	 * @param   CsviHelperFields  $fields    All fields used for import/export
	 *
	 * @return  void.
	 *
	 * @since   7.0
	 */
	public function runRule($plugin, $settings, $field, $fields)
	{
		if ($plugin === $this->id && !empty($settings))
		{
			// Check if we have a multiple values
			$matchType = $settings->match_regex;
			$matchValues = $settings->match_values;
			$matchMultiValues = explode(',', $matchValues);

			// Set the old value
			$value = $field->value;

			// If the field is empty and applywhenempty setting is no then do nothing
			if ('' !== $value )
			{
				switch ($settings->match_method)
				{
					case 'text':
						foreach ($matchMultiValues as $matchVal)
						{
							if (strpos($value, $matchVal) !== false)
							{
								$fields->setProcessRecord(false);
							}
						}
						break;
					case 'regex':
						if (preg_match($matchType, $value, $matches))
						{
							$fields->setProcessRecord(false);
						}
						break;
				}
			}
		}
	}
}
