<?php
/**
 * @version		$Id: controller.php $
 * @copyright           Copyright (C) 2005 - 2011 Nasvhille First SDA Chrch All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_churchdirectory
 */
class ChurchDirectoryController extends JController
{
	/**
	 * @var		string	The default view.
	 * @since	1.6
	 */
	protected $default_view = 'churchdirectories';

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/churchdirectory.php';

		// Load the submenu.
		ChurchDirectoryHelper::addSubmenu(JRequest::getCmd('view', 'churchdirectories'));

		$view	= JRequest::getCmd('view', 'churchdirectories');
		$layout = JRequest::getCmd('layout', 'default');
		$id	= JRequest::getInt('id');

		// Check for edit form.
		if ($view == 'churchdirectory' && $layout == 'edit' && !$this->checkEditId('com_churchdirectory.edit.churchdirectory', $id)) {

			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_churchdirectory&view=churchdirectories', false));

			return false;
		}

		parent::display();

		return $this;
	}
}
