<?php
/**
 * Form for Database
 * @package ChurchDirectory.Admin
 * @Copyright (C) 2007 - 2011 Joomla Bible Study Team All rights reserved
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.JoomlaBibleStudy.org
 * @since  1.7.0
 * */
// no direct access
defined('_JEXEC') or die;
?>
<div id="installer-database">
    <form action="<?php echo JRoute::_('index.php?option=com_churchdirectory&view=database'); ?>" method="post" name="adminForm" id="adminForm">

        <?php if ($this->errorCount === 0) : ?>
            <p class="nowarning"><?php echo JText::_('COM_INSTALLER_MSG_DATABASE_OK'); ?></p>
            <?php echo JHtml::_('sliders.start', 'database-sliders', array('useCookie' => 1)); ?>

        <?php else : ?>
            <p class="warning"><?php echo JText::_('COM_INSTALLER_MSG_DATABASE_ERRORS'); ?></p>
            <?php echo JHtml::_('sliders.start', 'database-sliders', array('useCookie' => 1)); ?>

            <?php $panelName = JText::plural('COM_INSTALLER_MSG_N_DATABASE_ERROR_PANEL', $this->errorCount); ?>
            <?php echo JHtml::_('sliders.panel', $panelName, 'error-panel'); ?>
            <fieldset class="panelform">
                <ul>
                    <?php if (!$this->filterParams) : ?>
                        <li><?php echo JText::_('COM_INSTALLER_MSG_DATABASE_FILTER_ERROR'); ?>
                        <?php endif; ?>

                        <?php if (!(strncmp($this->schemaVersion, $this->jversion, 5) === 0)) : ?>
                        <li><?php echo JText::sprintf('JBS_INS_DATABASE_SCHEMA_DOES_NOT_MATCH', $this->schemaVersion, $this->jversion); ?></li>
                    <?php endif; ?>

                    <?php if (($this->updateVersion != $this->jversion)) : ?>
                        <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_UPDATEVERSION_ERROR', $this->updateVersion, $this->jversion); ?></li>
                    <?php endif; ?>

                    <?php foreach ($this->errors as $line => $error) : ?>
                        <?php
                        $key = 'COM_INSTALLER_MSG_DATABASE_' . $error->queryType;
                        $msgs = $error->msgElements;
                        $file = basename($error->file);
                        $msg0 = (isset($msgs[0])) ? $msgs[0] : ' ';
                        $msg1 = (isset($msgs[1])) ? $msgs[1] : ' ';
                        $msg2 = (isset($msgs[2])) ? $msgs[2] : ' ';
                        $message = JText::sprintf($key, $file, $msg0, $msg1, $msg2);
                        ?>
                        <li><?php echo $message; ?></li>
                    <?php endforeach; ?>
                </ul>
            </fieldset>
        <?php endif; ?>

        <?php echo JHtml::_('sliders.panel', JText::_('COM_INSTALLER_MSG_DATABASE_INFO'), 'furtherinfo-pane'); ?>
        <fieldset class="panelform">
            <ul>
                <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_SCHEMA_VERSION', $this->schemaVersion); ?></li>
                <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_UPDATE_VERSION', $this->updateVersion); ?></li>
                <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_DRIVER', JFactory::getDbo()->name); ?></li>
                <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_CHECKED_OK', count($this->results['ok'])); ?></li>
                <li><?php echo JText::sprintf('COM_INSTALLER_MSG_DATABASE_SKIPPED', count($this->results['skipped'])); ?></li>
            </ul>
        </fieldset>
        <?php echo JHtml::_('sliders.end'); ?>

        <div class="clr"> </div>
        <div>
            <input type="hidden" name="task" value="database.fix" />
            <input type="hidden" name="boxchecked" value="0" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
