<?php
/**
 * @package    ChurchDirectory.Site
 * @copyright  2007 - 2014 (C) Joomla Bible Study Team All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('behavior.framework');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

// Create a shortcut for params.
$params = & $this->item->params;
$this->loadHelper('render');
$renderHelper = new renderHelper();
?>

<?php if (empty($this->items)) : ?>
<p> <?php echo JText::_('COM_CHURCHDIRECTORY_NO_MEMBERS'); ?>     </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm"
      id="adminForm">
    <fieldset class="filters">
        <legend class="hidelabeltxt"><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
        <div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
        </div>
		<?php endif; ?>
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    </fieldset>

    <table class="category">
		<?php if ($this->params->get('show_headings')) : ?>
        <thead>
        <tr>
            <th class="item-num">
				<?php echo JText::_('JGLOBAL_NUM'); ?>
            </th>
            <th class="item-title">
				<?php echo JHtml::_('grid.sort', 'COM_CHURCHDIRECTORY_MEMBER_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
            </th>
			<?php if ($this->params->get('show_position_headings')) : ?>
            <th class="item-position">
				<?php echo JHtml::_('grid.sort', 'COM_CHURCHDIRECTORY_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
            </th>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_headings')) : ?>
            <th class="item-email">
				<?php echo JText::_('JGLOBAL_EMAIL'); ?>
            </th>
			<?php endif; ?>
			<?php if ($this->params->get('show_telephone_headings')) : ?>
            <th class="item-phone">
				<?php echo JText::_('COM_CHURCHDIRECTORY_TELEPHONE'); ?>
            </th>
			<?php endif; ?>

			<?php if ($this->params->get('show_mobile_headings')) : ?>
            <th class="item-phone">
				<?php echo JText::_('COM_CHURCHDIRECTORY_MOBILE'); ?>
            </th>
			<?php endif; ?>

			<?php if ($this->params->get('show_fax_headings')) : ?>
            <th class="item-phone">
				<?php echo JText::_('COM_CHURCHDIRECTORY_FAX'); ?>
            </th>
			<?php endif; ?>

			<?php if ($this->params->get('show_suburb_headings')) : ?>
            <th class="item-suburb">
				<?php echo JHtml::_('grid.sort', 'COM_CHURCHDIRECTORY_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
            </th>
			<?php endif; ?>

			<?php if ($this->params->get('show_state_headings')) : ?>
            <th class="item-state">
				<?php echo JHtml::_('grid.sort', 'COM_CHURCHDIRECTORY_STATE', 'a.state', $listDirn, $listOrder); ?>
            </th>
			<?php endif; ?>

			<?php if ($this->params->get('show_country_headings')) : ?>
            <th class="item-state">
				<?php echo JHtml::_('grid.sort', 'COM_CHURCHDIRECTORY_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
            </th>
			<?php endif; ?>

        </tr>
        </thead>
		<?php endif; ?>

        <tbody>
			<?php foreach ($this->items as $i => $item) : ?>
        <tr class="<?php echo ($i % 2) ? "odd" : "even"; ?>">
            <td class="item-num">
				<?php echo $i; ?>
            </td>

            <td class="item-title">
                <a href="<?php echo JRoute::_(ChurchDirectoryHelperRoute::getMemberRoute($item->slug, $item->catid)); ?>">
					<?php echo $item->name; ?></a>
            </td>

			<?php if ($this->params->get('show_position_headings')) : ?>
            <td class="item-position">
				<?php echo $renderHelper->getPosition($item->con_position); ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_email_headings')) : ?>
            <td class="item-email">
				<?php echo $item->email_to; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_telephone_headings')) : ?>
            <td class="item-phone">
				<?php echo $item->telephone; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_mobile_headings')) : ?>
            <td class="item-phone">
				<?php echo $item->mobile; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_fax_headings')) : ?>
            <td class="item-phone">
				<?php echo $item->fax; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_suburb_headings')) : ?>
            <td class="item-suburb">
				<?php echo $item->suburb; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_state_headings')) : ?>
            <td class="item-state">
				<?php echo $item->state; ?>
            </td>
			<?php endif; ?>

			<?php if ($this->params->get('show_country_headings')) : ?>
            <td class="item-state">
				<?php echo $item->country; ?>
            </td>
			<?php endif; ?>
        </tr>
			<?php endforeach; ?>

        </tbody>
    </table>

	<?php if ($this->params->get('show_pagination')) : ?>
    <div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
        <p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
        </p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
    </div>
	<?php endif; ?>
</form>
<?php endif; ?>

<div class="item-separator"></div>
