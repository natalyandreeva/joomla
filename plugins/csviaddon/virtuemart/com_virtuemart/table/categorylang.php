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
 * Category language table.
 *
 * @package     CSVI
 * @subpackage  VirtueMart
 * @since       6.0
 */
class VirtueMartTableCategoryLang extends CsviTableDefault
{
	/**
	 * The VirtueMart helper
	 *
	 * @var    Com_VirtuemartHelperCom_Virtuemart
	 * @since  6.0
	 */
	protected $helper = null;

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
		if (isset($config['template']))
		{
			$this->template = $config['template'];
		}

		if ($this->template->get('operation') == 'category')
		{
			if ($this->template->get('language') == $this->template->get('target_language'))
			{
				$lang = $this->template->get('language');
			}
			else
			{
				$lang = $this->template->get('target_language');
			}
		}
		else
		{
			$lang = $this->template->get('language');
		}

		parent::__construct('#__virtuemart_categories_' . $lang, 'virtuemart_category_id', $db, $config);
	}

	/**
	 * Check if the category ID exists.
	 *
	 * @return  bool  True if ID exists | False if ID is not found.
	 *
	 * @since   4.0
	 */
	public function check()
	{
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName($this->_tbl_key))
			->from($this->db->quoteName($this->_tbl))
			->where($this->db->quoteName($this->_tbl_key) . ' = ' . (int) $this->virtuemart_category_id);
		$this->db->setQuery($query);
		$id = $this->db->loadResult();

		$this->log->add('Check the category language');

		if (!$id)
		{
			if (empty($this->slug))
			{
				$this->createSlug();
			}

			if (!empty($this->slug))
			{
				// Check if the slug exists
				$this->verifySlug();

				// Create a dummy entry for updating
				$query = "INSERT INTO "
					. $this->_tbl
					. " (" . $this->db->quoteName($this->_tbl_key) . ", " . $this->db->quoteName('slug') . ") "
					. "VALUES (" . (int) $this->virtuemart_category_id . ", " . $this->db->quote($this->slug) . ")";
				$this->db->setQuery($query);
				$this->log->add('Add the category language entry');

				if ($this->db->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			// Keep the existing slug if we have one
			$slug = $this->get('slug', false);

			// Load the existing data
			$this->load($this->get('virtuemart_category_id'));

			// Keep the slug user is importing
			if ($slug)
			{
				$this->set('slug', $slug);
			}

			// Verify the slug
			$this->verifySlug();
		}

		return true;
	}

	/**
	 * Create a slug if needed and store the product.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  bool  True on success | Fales on failure.
	 *
	 * @since   4.0
	 */
	public function store($updateNulls = false)
	{
		if (empty($this->slug))
		{
			// Create the slug
			$this->verifySlug();
		}

		return parent::store();
	}

	/**
	 * Create a slug.
	 *
	 * @return  void.
	 *
	 * @since   4.0
	 */
	public function createSlug()
	{
		// Is there a product name
		if (empty($this->category_name))
		{
			$jdate = JFactory::getDate();
			$this->slug = $jdate->format("Y-m-d-h-i-s") . mt_rand();
		}
		else
		{
			// Create the slug
			$this->slug = $this->helper->createSlug($this->category_name);

			// Check if the slug exists
			$this->verifySlug();
		}
	}

	/**
	 * Validate slug.
	 *
	 * @return  void.
	 *
	 * @since   4.0
	 */
	private function verifySlug()
	{
		// Check if the slug exists
		$query = $this->db->getQuery(true)
			->select('COUNT(' . $this->db->quoteName($this->_tbl_key) . ')')
			->from($this->db->quoteName($this->_tbl))
			->where($this->db->quoteName('slug') . ' = ' . $this->db->quote($this->slug))
			->where($this->db->quoteName('virtuemart_category_id') . ' != ' . (int) $this->virtuemart_category_id);
		$this->db->setQuery($query);
		$slugs = $this->db->loadResult();
		$this->log->add('Check the category slug');

		if ($slugs > 0)
		{
			if ($this->get('category_name'))
			{
				// See how many categories we have with the same name
				$query->clear()
					->select(
						'ABS(REPLACE(' . $this->db->quoteName('slug') . ', ' . $this->db->quote($this->slug) . ', ' . $this->db->quote('') . ')) + 1'
					)
					->from($this->_tbl)
					->where(
						'('
						. $this->db->quoteName('slug') . ' = ' . $this->db->quote($this->slug)
						. ' OR '
						. $this->db->quoteName('slug') . ' REGEXP ' . $this->db->quote('^' . $this->slug . '-[[:digit:]]+$')
						. ' AND RIGHT(' . $this->db->quoteName('slug') . ', 1) IN (0,1,2,3,4,5,6,7,8,9)'
						. ')'
					)
					->where($this->db->quoteName($this->_tbl_key) . ' != ' . (int) $this->get('virtuemart_category_id'))
					->order('LENGTH(' . $this->db->quoteName('slug') . '), ' . $this->db->quoteName('slug') . ' ASC');
				$this->db->setQuery($query);
				$items = $this->db->loadColumn();
				$this->log->add('Check how many other categories exist with the same slug');

				if ($items)
				{
					$count = array_pop($items);

					$this->slug .= '-' . $count;
				}
			}
			else
			{
				$jdate = JFactory::getDate();
				$this->slug .= $jdate->format("Y-m-d-h-i-s") . mt_rand();
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
		$this->virtuemart_category_id = null;

		return true;
	}
}
