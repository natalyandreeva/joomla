<?php
/**
 * @package     CSVI
 * @subpackage  Templatefields
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Template fields view.
 *
 * @package     CSVI
 * @subpackage  Templatefields
 * @since       6.0
 */
class CsviViewTemplatefields extends JViewLegacy
{
	/**
	 * The items to display.
	 *
	 * @var    array
	 * @since  6.6.0
	 */
	protected $items;

	/**
	 * The pagination object
	 *
	 * @var    JPagination
	 * @since  6.6.0
	 */
	protected $pagination;

	/**
	 * The user state.
	 *
	 * @var    JObject
	 * @since  6.6.0
	 */
	protected $state;

	/**
	 * Form with filters
	 *
	 * @var    array
	 * @since  6.6.0
	 */
	public $filterForm = array();

	/**
	 * List of active filters
	 *
	 * @var    array
	 * @since  6.6.0
	 */
	public $activeFilters = array();

	/**
	 * Access rights of a user
	 *
	 * @var    JObject
	 * @since  6.6.0
	 */
	protected $canDo;

	/**
	 * An instance of JDatabaseDriver.
	 *
	 * @var    JDatabaseDriver
	 * @since  6.6.0
	 */
	protected $db;

	/**
	 * The sidebar to show
	 *
	 * @var    string
	 * @since  2.0
	 */
	protected $sidebar = '';

	/**
	 * CSVI Helper file.
	 *
	 * @var    CsviHelperCsvi
	 * @since  6.6.0
	 */
	protected $csviHelper;

	/**
	 * The type of action for the selected template
	 *
	 * @var    string
	 * @since  6.6.0
	 */
	protected $action = 'import';

	/**
	 * An instance of CsviHelperTemplate
	 *
	 * @var    CsviHelperTemplate
	 * @since  6.6.0
	 */
	protected $template;

	/**
	 * List of available fields
	 *
	 * @var    array
	 * @since  6.6.0
	 */
	protected $availableFields;

	/**
	 * Executes before rendering the page for the Browse task.
	 *
	 * @param   string  $tpl  Subtemplate to use
	 *
	 * @return  boolean  Return true to allow rendering of the page
	 *
	 * @throws  Exception
	 */
	public function display($tpl = null)
	{
		// Load the state
		$this->state         = $this->get('State');
		$this->db            = JFactory::getDbo();

		// Load the template
		$this->loadSelectedTemplate();

		// Load the data
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		$this->canDo         = JHelperContent::getActions('com_csvi');


		// Set the action
		$this->action = $this->template->get('action');

		// Set the source
		$this->source = $this->template->get('source');

		// Load the available fields
		$this->loadAvailableFields();

		// Show the toolbar
		$this->toolbar();

		// Render the sidebar
		$this->csviHelper = new CsviHelperCsvi;
		$this->csviHelper->addSubmenu('templatefields');
		$this->sidebar = JHtmlSidebar::render();

		// Display it all
		parent::display($tpl);
	}

	/**
	 * Load the selected template.
	 *
	 * @return  void.
	 *
	 * @since   6.6.0
	 *
	 * @throws  Exception
	 */
	private function loadSelectedTemplate()
	{
		/** @var CsviModelTemplates $templateModel */
		$templateModel = JModelLegacy::getInstance('Templates', 'CsviModel');

		$templates = $templateModel->getItems();

		// Load a chosen template ID
		$csvi_template_id = $this->state->get('filter.csvi_template_id', 0);

		// Check if we have a template ID, if not take the first one
		if ($csvi_template_id < 1 && $templates)
		{
			$template = reset($templates);
			$csvi_template_id = $template->csvi_template_id;
		}

		// Save the state
		$this->state->set('filter.csvi_template_id', $csvi_template_id);

		// Load the selected template
		$helper = new CsviHelperCsvi;
		$this->template = new CsviHelperTemplate($csvi_template_id, $helper);
	}

	/**
	 * Load the list of available fields.
	 *
	 * @return  void.
	 *
	 * @since   6.6.0
	 */
	private function loadAvailableFields()
	{
		// Load the available fields
		$component = $this->template->get('component');
		$operation = $this->template->get('operation');
		$action    = $this->template->get('action');

		// Call the Availablefields model
		$model = JModelLegacy::getInstance('Availablefields', 'CsviModel', array('ignore_request' => true));

		// Set a default filters
		$model->setState('filter_order', 'csvi_name');
		$model->setState('filter_order_Dir', 'DESC');
		$model->setState('filter.component', $component);
		$model->setState('filter.operation', $operation);
		$model->setState('filter.action', $action);
		$model->setState('filter.idfields', 1);
		$this->availableFields = $model->getItems();
	}

	/**
	 * Displays a toolbar for a specific page.
	 *
	 * @return  void.
	 *
	 * @since   6.6.0
	 */
	private function toolbar()
	{
		JToolbarHelper::title(JText::_('COM_CSVI') . ' - ' . JText::_('COM_CSVI_TITLE_TEMPLATEFIELDS'), 'list');

		if ($this->canDo->get('core.create'))
		{
			JToolbarHelper::addNew('templatefield.add');
		}

		if ($this->canDo->get('core.edit') || $this->canDo->get('core.edit.own'))
		{
			JToolbarHelper::editList('templatefield.edit');
		}

		if ($this->action === 'export' && $this->canDo->get('core.edit.state'))
		{
			JToolbarHelper::publishList('templatefields.publish');
			JToolbarHelper::unpublishList('templatefields.unpublish');
		}

		if ($this->canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'templatefields.delete');
		}

		if ($this->canDo->get('core.create'))
		{
			JToolbarHelper::custom('quickadd', 'list', 'list', JText::_('COM_CSVI_QUICKADD'), false);
		}
	}
}
