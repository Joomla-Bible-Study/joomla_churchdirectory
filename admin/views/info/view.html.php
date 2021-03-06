<?php
/**
 * @package    ChurchDirectory.Admin
 * @copyright  2007 - 2016 (C) Joomla Bible Study Team All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Class for Info
 *
 * @package  ChurchDirectory.Admin
 * @since    1.7.0
 */
class ChurchDirectoryViewInfo extends JViewLegacy
{
	/**
	 * Protect Items
	 *
	 * @var array
	 * @since    1.7.0
	 */
	protected $items;

	/**
	 * Protect Pagination
	 *
	 * @var array
	 * @since    1.7.0
	 */
	protected $pagination;

	/**
	 * Protect State
	 *
	 * @var array
	 * @since    1.7.0
	 */
	protected $state;

	protected $sidebar;

	/**
	 * Display function
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 * @since    1.7.0
	 */
	public function display($tpl = null)
	{
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state      = $this->get('State');

		ChurchDirectoryHelper::addSubmenu('info');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JFactory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');

			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();

		// Display the template
		return parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.7.0
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		JToolbarHelper::title(JText::_('COM_CHURCHDIRECTORY_MANAGER_INFO'), 'info');
		JToolbarHelper::help('churchdirectory', true);
	}
}
