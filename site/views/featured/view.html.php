<?php
/**
 * @package    ChurchDirectory.Site
 * @copyright  2007 - 2014 (C) Joomla Bible Study Team All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


jimport('joomla.mail.helper');

/**
 * Frontpage View class
 *
 * @property mixed document
 * @package  ChurchDirectory.Site
 * @since    1.7.0
 */
class ChurchDirectoryViewFeatured extends JViewLegacy
{

	/** Protected  @var array */
	protected $state;

	/**  Protected @var array */
	protected $items;

	/** Protected  @var array */
	protected $category;

	/** Protected @var array */
	protected $categories;

	/** Protected @var array */
	protected $pagination;

	protected $pageclass_sfx;

	protected $maxLevel;

	protected $children;

	protected $params;

	protected $parent;

	/**
	 * Display the view
	 *
	 * @param string $tpl
	 *
	 * @return    mixed    False on error, null otherwise.
	 */
	public function display($tpl = null)
	{
		$params = JComponentHelper::getParams('com_churchdirectory');

		// Get some data from the models
		$state      = $this->get('State');
		$items      = $this->get('Items');
		$category   = $this->get('Category');
		$children   = $this->get('Children');
		$parent     = $this->get('Parent');
		$pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		// Prepare the data.
		// Compute the churchdirectory slug.
		for ($i = 0, $n = count($items); $i < $n; $i++)
		{
			$item       = & $items[$i];
			$item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
			$temp       = new JRegistry;
			$temp->loadString($item->params);
			$item->params = clone($params);
			$item->params->merge($temp);

			if ($item->params->get('show_email', 0) == 1)
			{
				$item->email_to = trim($item->email_to);

				if (!empty($item->email_to) && JMailHelper::isEmailAddress($item->email_to))
				{
					$item->email_to = JHtml::_('email.cloak', $item->email_to);
				}
				else
				{
					$item->email_to = '';
				}
			}
		}

		// Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$maxLevel         = $params->get('maxLevel', -1);
		$this->maxLevel   = & $maxLevel;
		$this->state      = & $state;
		$this->items      = & $items;
		$this->category   = & $category;
		$this->children   = & $children;
		$this->params     = & $params;
		$this->parent     = & $parent;
		$this->pagination = & $pagination;

		$this->_prepareDocument();

		return parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app   = JFactory::getApplication();
		$menus = $app->getMenu();
		$title = null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();

		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', JText::_('COM_CONTACT_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');

		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}

}
