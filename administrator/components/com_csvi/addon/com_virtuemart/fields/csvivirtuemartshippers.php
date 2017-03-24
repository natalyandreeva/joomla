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

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('CsviForm');

/**
 * Select list form field with shipping plugins.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class JFormFieldCsviVirtuemartShippers extends JFormFieldCsviForm
{
	/**
	 * Type of field
	 *
	 * @var    string
	 * @since  4.0
	 */
	protected $type = 'CsviVirtuemartShippers';

	/**
	 * Get the options.
	 *
	 * @return  array  An array of shopper groups.
	 *
	 * @since   4.0
	 */
	protected function getOptions()
	{
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName('extension_id', 'value') . ',' . $this->db->quoteName('name', 'text'))
			->from($this->db->quoteName('#__extensions'))
			->where($this->db->quoteName('type') . ' = ' . $this->db->quote('plugin'))
			->where($this->db->quoteName('folder') . ' = ' . $this->db->quote('vmshipment'))
			->order($this->db->quoteName('ordering'));
		$this->db->setQuery($query);
		$options = $this->db->loadObjectList();

		if (empty($options))
		{
			$options = array();
		}

		return array_merge(parent::getOptions(), $options);
	}
}
