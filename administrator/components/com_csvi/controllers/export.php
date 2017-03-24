<?php
/**
 * @package     CSVI
 * @subpackage  Export
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * Export Controller.
 *
 * @package     CSVI
 * @subpackage  Export
 * @since       6.0
 */
class CsviControllerExport extends JControllerLegacy
{
	/**
	 * Load the import page and start the import.
	 *
	 * @return  boolean  Always returns true.
	 *
	 * @since   6.0
	 */
	public function start()
	{
		// Load the model
		/** @var CsviModelExports $model */
		$model = $this->getModel('Exports', 'CsviModel');

		// Get the template ID
		$template_id = $this->input->get('csvi_template_id', false);

		if (!$template_id)
		{
			// Redirect to the template view
			$this->setRedirect('index.php?option=com_csvi&view=exports', JText::_('COM_CSVI_NO_TEMPLATE_ID_FOUND'), 'error');
			$this->redirect();
		}

		// Initialise
		$model->initialise($template_id);

		// Get the run ID
		$runId = $model->getRunId();

		// Make the template available
		$view = $this->getView('Export', 'html');

		$view->set('template', $model->getTemplate());
		$view->set('runId', $runId);

		$view->display();
	}

	/**
	 * Export the requested data.
	 *
	 * @return  void.
	 *
	 * @since   3.0
	 */
	public function export()
	{
		// Get the run ID
		$runId = $this->input->getInt('runId', false);

		// Get the model
		/** @var CsviModelExports $model */
		$model = $this->getModel('Exports', 'CsviModel');

		try
		{
			if ($runId)
			{
				// Load the template
				$templateId = $model->getTemplateId($runId);

				if ($templateId)
				{
					$model->loadTemplate($templateId);

					// Load the template
					$template = $model->getTemplate();

					// Get the component and operation
					$component = $template->get('component');
					$operation = $template->get('operation');
					$override = $template->get('override');
					$adminTemplate = JFactory::getApplication()->getTemplate();

					if ($component && $operation)
					{
						if ($override
							&& file_exists(JPATH_ADMINISTRATOR . '/templates/' . $adminTemplate . '/html/com_csvi/' . $component . '/model/export/' . $override . '.php'))
						{
							JLoader::registerPrefix(ucfirst($component), JPATH_ADMINISTRATOR . '/templates/' . $adminTemplate . '/html/com_csvi/' . $component);
							$classname = ucwords($component) . 'ModelExport' . ucwords($override);
						}

						// If the addon is not installed show message to install it
						if (!file_exists(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/' . $component))
						{
							throw new CsviException(JText::sprintf('COM_CSVI_NO_ADDON_INSTALLED', $component));
						}

						// Setup the component autoloader
						JLoader::registerPrefix(ucfirst($component), JPATH_ADMINISTRATOR . '/components/com_csvi/addon/' . $component);

						if (empty($classname))
						{
							// Load the export routine
							$classname = ucwords($component) . 'ModelExport' . ucwords($operation);
						}

						/** @var CsviModelExports $routine */
						$routine = new $classname;

						// Prepare for export
						$routine->initialiseExport($runId);
						$routine->onBeforeExport($component);

						if ($override)
						{
							// Set the override for the operation model if exists
							$overridefile = JPATH_ADMINISTRATOR . '/templates/' . $adminTemplate . '/html/com_csvi/' . $component . '/model/export/' . $override . '.php';

							if (file_exists($overridefile))
							{
								$this->addModelPath(JPATH_ADMINISTRATOR . '/templates/' . $adminTemplate . '/html/com_csvi/' . $component . 'model/export');
							}
							else
							{
								$this->addModelPath(JPATH_ADMINISTRATOR . '/components/com_csvi/addon/' . $component . '/model/export');
							}
						}

						// Start the export
						try
						{
							$routine->runExport();
							$result['process'] = false;
							$result['records'] = $routine->getRecords();
							$result['downloadurl'] = $routine->getDownloadUrl();
							$returnUrl = JUri::root() . 'administrator/index.php?option=com_csvi&view=exports';
							$result['url'] = JUri::root() . 'administrator/index.php?option=com_csvi&view=logdetails&run_id=' . $routine->getLogId() . '&return=' . base64_encode($returnUrl);

							// Output the results in JSON
							echo json_encode($result);

							JFactory::getApplication()->close();
						}
						catch (Exception $e)
						{
							// Finalize the export
							$routine->setEndTimestamp($runId);

							// Enqueue the message
							$helper = new CsviHelperCsvi;
							$helper->enqueueMessage($e->getMessage(), 'error');

							// Send the user to the log details
							$result['process'] = false;
							$result['url'] = JUri::root() . 'administrator/index.php?option=com_csvi&view=logdetails&run_id=' . $routine->getLogId();

							// Output the results in JSON
							echo json_encode($result);
						}
					}
					else
					{
						throw new CsviException(JText::_('COM_CSVI_EXPORT_NO_COMPONENT_NO_OPERATION'), 514);
					}
				}
				else
				{
					throw new CsviException(JText::_('COM_CSVI_NO_TEMPLATEID_FOUND'), 509);
				}
			}
			else
			{
				throw new CsviException(JText::_('COM_CSVI_NO_VALID_RUNID_FOUND'), 506);
			}
		}
		catch (Exception $e)
		{
			// Finalize the export
			$model->setEndTimestamp($runId);

			// Enqueue the message
			$helper = new CsviHelperCsvi;
			$helper->enqueueMessage($e->getMessage(), 'error');

			// Send the user to the log details
			$result['process'] = false;
			$result['url'] = JUri::root() . 'administrator/index.php?option=com_csvi&view=logs';

			// Output the results in JSON
			echo json_encode($result);
		}
	}

	/**
	 * Cancel the export and return to the export page.
	 *
	 * @return  void.
	 *
	 * @since   6.0
	 */
	public function cancel()
	{
		// Set the end timestamp
		/** @var CsviModelExports $model */
		$model = $this->getModel('Exports', 'CsviModel');
		$model->setEndTimestamp($this->input->getInt('runId', 0));

		$this->setRedirect('index.php?option=com_csvi&view=exports', JText::_('COM_CSVI_EXPORT_CANCELED'), 'notice');
		$this->redirect();
	}
}
