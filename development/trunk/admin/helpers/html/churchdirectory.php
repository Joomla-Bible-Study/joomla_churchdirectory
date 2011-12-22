<?php

/**
 * @version		$Id: churchdirectory.php 1.7.0 $
 * @package             com_churchdirectory
 * @copyright           Copyright (C) 2005 - 2011 All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

/**
 * @package	com_churchdirectory
 * @since       1.7.0
 */
abstract class JHtmlChurchdirectory {

    /**
     * @param	int $value	The featured value
     * @param	int $i
     * @param	bool $canChange Whether the value can be changed or not
     *
     * @return	string	The anchor tag to toggle featured/unfeatured contacts.
     * @since	1.7.0
     */
    static function featured($value = 0, $i, $canChange = true) {
        // Array of image, task, title, action
        $states = array(
            0 => array('disabled.png', 'churchdirectories.featured', 'COM_CHURCHDIRECTORY_UNFEATURED', 'COM_CHURCHDIRECTORY_TOGGLE_TO_FEATURE'),
            1 => array('featured.png', 'churchdirectories.unfeatured', 'JFEATURED', 'COM_CHURCHDIRECTORY_TOGGLE_TO_UNFEATURE'),
        );
        $state = JArrayHelper::getValue($states, (int) $value, $states[1]);
        $html = JHtml::_('image', 'admin/' . $state[0], JText::_($state[2]), NULL, true);
        if ($canChange) {
            $html = '<a href="#" onclick="return listItemTask(\'cb' . $i . '\',\'' . $state[1] . '\')" title="' . JText::_($state[3]) . '">'
                    . $html . '</a>';
        }

        return $html;
    }

}
