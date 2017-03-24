<?php
/**
 * @package     CSVI
 * @subpackage  Plugin.valuecomparison
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2016 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Compare the input value with field and display new value
 *
 * @package     CSVI
 * @subpackage  Plugin.Valuecomparison
 * @since       6.6.0
 */
class PlgCsvirulesValuecomparison extends RantaiPluginDispatcher
{
	/**
	 * The unique ID of the plugin
	 *
	 * @var    string
	 * @since  6.6.0
	 */
	private $id = 'csvivaluecomparison';

	/**
	 * Return the name of the plugin.
	 *
	 * @return  array  The name and ID of the plugin.
	 *
	 * @since   6.6.0
	 */
	public function getName()
	{
		return array('value' => $this->id, 'text' => 'CSVI Value comparison');
	}

	/**
	 * Method to get the name only of the plugin.
	 *
	 * @param   string  $plugin  The ID of the plugin
	 *
	 * @return  string  The name of the plugin.
	 *
	 * @since   6.6.0
	 */
	public function getSingleName($plugin)
	{
		if ($plugin === $this->id)
		{
			return 'CSVI Value comparison';
		}
	}

	/**
	 * Method to get the field options.
	 *
	 * @param   string  $plugin   The ID of the plugin
	 * @param   array   $options  An array of settings
	 *
	 * @return  string  The rendered form with plugin options.
	 *
	 * @since   6.6.0
	 *
	 * @throws  RuntimeException
	 * @throws  InvalidArgumentException
	 */
	public function getForm($plugin, $options = array())
	{
		if ($plugin === $this->id)
		{
			// Load the language files
			$lang = JFactory::getLanguage();
			$lang->load('plg_csvirules_valuecomparison', JPATH_ADMINISTRATOR, 'en-GB', true);
			$lang->load('plg_csvirules_valuecomparison', JPATH_ADMINISTRATOR, null, true);

			// Add the form path for this plugin
			JForm::addFormPath(JPATH_PLUGINS . '/csvirules/valuecomparison/');

			// Load the helper that renders the form
			$helper = new CsviHelperCsvi;

			// Instantiate the form
			$form = JForm::getInstance('valuecomparison', 'form_valuecomparison');

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
	 * @param   string            $plugin    The ID of the plugin.
	 * @param   array             $settings  The plugin settings set for the field.
	 * @param   array             $field     The field being process.
	 * @param   CsviHelperFields  $fields    A CsviHelperFields object.
	 *
	 * @return  void.
	 *
	 * @since   6.6.0
	 */
	public function runRule($plugin, $settings, $field, CsviHelperFields $fields)
	{
		if ($plugin === $this->id && $settings)
		{
			$return = 0;
			$oldValue = $settings->oldvalue;
			$fieldValue = $field->value;

			switch ($settings->comparison)
			{
				case 'equalto':
					$fieldValue === $oldValue ? $return = 1 : $return = 0;
					break;
				case 'greaterthan':
					$fieldValue > $oldValue ? $return = 1 : $return = 0;
					break;
				case 'greaterthanequalto':
					$fieldValue >= $oldValue ? $return = 1 : $return = 0;
					break;
				case 'lessthan':
					$fieldValue < $oldValue ? $return = 1 : $return = 0;
					break;
				case 'lessthanequalto':
					$fieldValue <= $oldValue ? $return = 1 : $return = 0;
					break;
			}

			if ($return)
			{
				$fields->updateField($field, $settings->newvalue);
			}
		}
	}
}
