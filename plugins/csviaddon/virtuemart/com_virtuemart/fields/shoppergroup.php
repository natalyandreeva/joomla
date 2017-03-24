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
 * Select list form field with shopper groups.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class CsvivirtuemartFormFieldShoppergroup extends JFormFieldCsviForm
{
	/**
	 * Type of field
	 *
	 * @var    string
	 * @since  4.0
	 */
	protected $type = 'Shoppergroup';

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
			->select($this->db->quoteName('virtuemart_shoppergroup_id', 'value') . ',' . $this->db->quoteName('shopper_group_name', 'text'))
			->from($this->db->quoteName('#__virtuemart_shoppergroups'));
		$this->db->setQuery($query);
		$options = $this->db->loadObjectList();

		if (empty($options))
		{
			$options = array();
		}

		return array_merge(parent::getOptions(), $options);
	}
}
