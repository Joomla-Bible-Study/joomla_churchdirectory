<?php
/**
 * @version		$Id: default_links.php 22338 2011-11-04 17:24:53Z github_bot $
 * @package		Joomla.Site
 * @subpackage	com_churchdirectory
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ('plain' == $this->params->get('presentation_style')) :
	echo '<h3>'.JText::_('COM_CHURCHDIRECTORY_LINKS').'</h3>';
else :
    echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CHURCHDIRECTORY_LINKS'), 'display-links');
endif;
?>

<div class="churchdirectory-links">
	<ul>
		<?php
		    foreach(range('a', 'e') as $char) :// letters 'a' to 'e'
			    $link = $this->churchdirectory->params->get('link'.$char);
			    $label = $this->churchdirectory->params->get('link'.$char.'_name');

			    if( ! $link) :
			        continue;
			    endif;

			    // Add 'http://' if not present
			    $link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

			    // If no label is present, take the link
			    $label = ($label) ? $label : $link;
			    ?>
			<li>
				<a href="<?php echo $link; ?>">
				    <?php echo $label;  ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
