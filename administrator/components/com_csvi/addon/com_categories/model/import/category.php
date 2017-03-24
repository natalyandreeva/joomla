<?php
/**
 * @package     CSVI
 * @subpackage  JoomlaCategory
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Categories import.
 *
 * @package     CSVI
 * @subpackage  JoomlaCategory
 * @since       6.0
 */
class Com_CategoriesModelImportCategory extends RantaiImportEngine
{
	/**
	 * Category table
	 *
	 * @var    CategoriesTableCategory
	 * @since  6.0
	 */
	private $category;

	/**
	 * The addon helper
	 *
	 * @var    Com_CategoriesHelperCom_Categories
	 * @since  6.0
	 */
	protected $helper;

	/**
	 * Category separator
	 *
	 * @var    string
	 * @since  6.0
	 */
	private $categorySeparator;

	/**
	 * Start the product import process.
	 *
	 * @return  bool  True on success | false on failure.
	 *
	 * @since   6.0
	 *
	 * @throws  RuntimeException
	 * @throws  InvalidArgumentException
	 * @throws  UnexpectedValueException
	 */
	public function getStart()
	{
		// Process data
		foreach ($this->fields->getData() as $fields)
		{
			foreach ($fields as $name => $details)
			{
				$value = $details->value;

				switch ($name)
				{
					case 'category_path':
						$this->setState('path', $value);
						break;
					default:
						$this->setState($name, $value);
						break;
				}
			}
		}

		// There must be an alias and catid or category_path
		if ($this->getState('extension', false) && ($this->getState('id', false) || $this->getState('path', false)))
		{
			$this->loaded = true;

			if (!$this->getState('id', false))
			{
				$this->setState('id', $this->helper->getCategoryId($this->getState('path'), $this->getState('extension')));
			}

			// Load the current category data
			if (!$this->template->get('overwrite_existing_data') && $this->category->load($this->getState('id', 0)))
			{
				$this->log->add(JText::sprintf('COM_CSVI_DATA_EXISTS_PRODUCT_SKU', $this->getState('path', '')));
				$this->loaded = false;
			}
		}
		else
		{
			// We must have the required fields otherwise category cannot be created
			$this->loaded = false;

			$this->log->addStats('skipped', JText::_('COM_CSVI_MISSING_REQUIRED_FIELDS'));
		}

		return true;
	}

	/**
	 * Process a record.
	 *
	 * @return  bool  Returns true if all is OK | Returns false if no product SKU or product ID can be found.
	 *
	 * @since   6.0
	 *
	 * @throws  RuntimeException
	 * @throws  InvalidArgumentException
	 */
	public function getProcessRecord()
	{
		if ($this->loaded)
		{
			if (!$this->getState('id', false) && $this->template->get('ignore_non_exist'))
			{
				// Do nothing for new categories when user chooses to ignore new categories
				$this->log->addStats('skipped', JText::sprintf('COM_CSVI_DATA_EXISTS_IGNORE_NEW', $this->getState('path', '')));
			}
			else
			{
				$this->log->add('Process category path:' . $this->getState('path'), false);

				// Set some special fields
				$this->setParams();
				$this->setMetadata();

				if (!$this->getState('id', false))
				{
					// Load the category separator
					if (null === $this->categorySeparator)
					{
						$this->categorySeparator = $this->template->get('category_separator', '/');
					}

					$paths     = explode($this->categorySeparator, $this->getState('path'));
					$path      = '';
					$parent_id = false;
					$pathkeys  = array_keys($paths);
					$lastkey   = array_pop($pathkeys);

					foreach ($paths as $key => $category)
					{
						if ($key > 0)
						{
							$path .= $this->categorySeparator . $category;
						}
						else
						{
							$path = $category;
						}

						// Check if the path exists
						$path_id = $this->helper->getCategoryId($path, $this->getState('extension'));

						// Category doesn't exist
						if (!$path_id)
						{
							// Clean the table
							$this->category->reset();

							// Bind the data
							$data              = array();
							$data['alias']     = '';
							$data['published'] = (!$this->getState('published', false)) ? 0 : $this->getState('published');
							$data['access']    = (!$this->getState('access', false)) ? 1 : $this->getState('access');
							$data['params']    = $this->getState('params', '{}');
							$data['metadata']  = $this->getState('metadata', '{}');
							$data['language']  = (!$this->getState('language', false)) ? '*' : $this->getState('language');
							$data['parent_id'] = 1;
							$data['path']      = $path;
							$data['title']     = $category;

							if ($parent_id)
							{
								$data['parent_id'] = $parent_id;
							}

							if ($lastkey === $key)
							{
								$data['title']       = (!$this->getState('title', false)) ? $category : $this->getState('title');
								$data['note']        = $this->getState('note');
								$data['description'] = $this->getState('description');
								$data['alias']       = $this->getState('alias');
							}

							$data['extension'] = $this->getState('extension');

							// Set the category location
							$this->category->setLocation($data['parent_id'], 'last-child');

							// Bind the data
							$this->category->bind($data);

							// Check the data
							if (!$this->category->checkCategory($this->date))
							{
								$errors = $this->category->getErrors();

								foreach ($errors as $error)
								{
									$this->log->add($error);
									$this->log->addStats('incorrect', $error);
								}
							}
							else
							{
								// Store the data
								if ($this->category->storeCategory($this->date, $this->userId))
								{
									$this->category->rebuildPath($this->category->id);
									$this->category->rebuild($this->category->id, $this->category->lft, $this->category->level, $this->category->path);
									$parent_id = $this->category->id;
									$this->log->add('Added category');
									$this->log->addStats('added', 'COM_CSVI_ADD_CATEGORY');
								}
								else
								{
									$errors = $this->category->getErrors();

									foreach ($errors as $error)
									{
										$this->log->add($error, false);
										$this->log->addStats('incorrect', $error);
									}
								}
							}
						}
						else
						{
							$parent_id = $path_id;
						}
					}
				}
				else
				{
					// Category already exist, just update it, first load the existing values
					$this->category->load($this->getState('id'));

					// Remove the alias, so it can be created again
					$this->category->alias = null;

					// Prepare the data
					$data                = array();
					$data['alias']       = $this->getState('alias');
					$data['published']   = $this->getState('published');
					$data['access']      = $this->getState('access');
					$data['params']      = $this->getState('params');
					$data['metadata']    = $this->getState('metadata');
					$data['language']    = $this->getState('language');
					$data['path']        = $this->getState('path');
					$data['title']       = $this->getState('title');
					$data['extension']   = $this->getState('extension');
					$data['note']        = $this->getState('note');
					$data['description'] = $this->getState('description');

					// Bind the data
					$this->category->bind($data);

					// Check the data
					if (!$this->category->checkCategory($this->date))
					{
						$errors = $this->category->getErrors();

						foreach ($errors as $error)
						{
							$this->log->add($error);
							$this->log->addStats('incorrect', $error);
						}
					}
					else
					{
						// Save the data
						if ($this->category->storeCategory($this->date, $this->userId))
						{
							$this->log->add('Updated category');
							$this->log->addStats('updated', 'COM_CSVI_UPDATE_CATEGORY');
						}
						else
						{
							$this->log->add('Unable to update category');
							$this->log->addStats('incorrect', 'COM_CSVI_CATEGORY_NOT_UPDATED');
							$errors = $this->category->getErrors();

							foreach ($errors as $error)
							{
								$this->log->add($error);
								$this->log->addStats('incorrect', $error);
							}
						}
					}
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * Load the necessary tables.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	public function loadTables()
	{
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/com_categories/table');
		$this->category = JTable::getInstance('Category', 'CategoriesTable');

		// Inject the template into the table, needed for transliteration
		$this->category->setTemplate($this->template);
	}

	/**
	 * Clear the loaded tables.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	public function clearTables()
	{
		$this->category->reset();
	}

	/**
	 * Set the attributes field.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	private function setParams()
	{
		// Check for attributes
		if (!$this->getState('params', false))
		{
			$paramFields = array
			(
				'category_layout',
				'image',
			);

			// Get Value from content plugin
			$dispatcher = new RantaiPluginDispatcher;
			$dispatcher->importPlugins('csviext', $this->db);

			// Fire the plugin to get attributes to import
			$pluginFields = $dispatcher->trigger(
				'getAttributes',
				array(
					'extension' => 'joomla',
					'operation' => 'category',
					'log'       => $this->log
				)
			);

			if (!empty($pluginFields[0]))
			{
				$this->log->add('Attributes added for content swmap plugin', false);
				$paramFields = array_merge($paramFields, $pluginFields[0]);
			}

			// Load the current attributes
			$params = json_decode($this->category->get('params'));

			if (!is_object($params))
			{
				$params = new stdClass;
			}

			foreach ($paramFields as $field)
			{
				$params->$field = $this->getState($field, '');
			}

			// Store the new attributes
			$this->setState('params', json_encode($params));
		}
	}

	/**
	 * Set the meta data.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	private function setMetadata()
	{
		if (!$this->getState('metadata', false))
		{
			$metadataFields = array
			(
				'meta_author',
				'meta_robots',
			);

			// Load the current attributes
			$metadata = json_decode($this->category->get('metadata'));

			if (!is_object($metadata))
			{
				$metadata = new stdClass;
			}

			foreach ($metadataFields as $field)
			{
				$newField = str_ireplace('meta_', '', $field);
				$metadata->$newField = $this->getState($field, '');
			}

			// Store the new attributes
			$this->setState('metadata', json_encode($metadata));
		}
	}
}
