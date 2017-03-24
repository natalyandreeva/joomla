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
 * Product media cross reference table.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class VirtueMartTableProductMedia extends CsviTableDefault
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
	public function __construct($table, $key, &$db, $config = array())
	{
		parent::__construct('#__virtuemart_product_medias', 'id', $db, $config);
	}

	/**
	 * Check if a media file reference already exists.
	 *
	 * @return  bool  True if media reference exists | False if media reference does not exist.
	 *
	 * @since   4.0
	 */
	public function check()
	{
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName($this->_tbl_key))
			->from($this->db->quoteName($this->_tbl))
			->where($this->db->quoteName('virtuemart_product_id') . ' = ' . (int) $this->virtuemart_product_id)
			->where($this->db->quoteName('virtuemart_media_id') . ' = ' . (int) $this->virtuemart_media_id);
		$this->db->setQuery($query);
		$id = $this->db->loadResult();

		if ($id > 0)
		{
			$this->set('id', $id);
		}

		return true;
	}

	/**
	 * Reset the primary key.
	 *
	 * @return  boolean  Always returns true.
	 *
	 * @since   6.0
	 */
	public function reset()
	{
		parent::reset();

		// Empty the primary key
		$this->id = null;

		return true;
	}
}
