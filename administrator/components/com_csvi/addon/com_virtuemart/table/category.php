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
 * Category table.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class VirtueMartTableCategory extends CsviTableDefault
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
		parent::__construct('#__virtuemart_categories', 'virtuemart_category_id', $db, $config);
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
		$this->virtuemart_category_id = null;

		return true;
	}
}
