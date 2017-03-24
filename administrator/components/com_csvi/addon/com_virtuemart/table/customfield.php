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
 * Custom fields table.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class VirtueMartTableCustomfield extends CsviTableDefault
{
	/**
	 * Table constructor.
	 *
	 * @param   string     $table   Name of the database table to model.
	 * @param   string     $key     Name of the primary key field in the table.
	 * @param   JDatabase  &$db     Database driver
	 * @param   array      $config  The configuration parameters array
	 *
	 * @since   4.0
	 */
	public function __construct($table, $key, &$db, $config)
	{
		parent::__construct('#__virtuemart_customs', 'virtuemart_custom_id', $db, $config);
	}

	/**
	 * Check if there is already a waiting list entry.
	 *
	 * @return  bool  True if custom field exists | False otherwise.
	 *
	 * @since   3.1
	 */
	public function check()
	{
		if (isset($this->virtuemart_coupon_id))
		{
			return true;
		}
		else
		{
			$query = $this->db->getQuery(true)
				->select($this->db->quoteName($this->_tbl_key))
				->from($this->db->quoteName($this->_tbl))
				->where($this->db->quoteName('custom_element') . ' = ' . $this->db->quote($this->custom_element))
				->where($this->db->quoteName('custom_title') . ' = ' . $this->db->quote($this->custom_title));
			$this->db->setQuery($query);

			if ($this->db->getAffectedRows() > 0)
			{
				$this->virtuemart_custom_id = $this->db->loadResult();

				return true;
			}
			else
			{
				return false;
			}
		}
	}

	/**
	 * Reset the primary key.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   6.0
	 */
	public function reset()
	{
		parent::reset();

		// Empty the primary key
		$this->virtuemart_custom_id = null;

		return true;
	}
}
