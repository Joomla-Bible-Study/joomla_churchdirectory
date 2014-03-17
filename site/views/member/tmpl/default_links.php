<?php
/**
 * Sub view member for links
 *
 * @package             ChurchDirectory.Site
 * @copyright           2007 - 2014 (C) Joomla Bible Study Team All rights reserved.
 * @license             GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
?>

<div class="churchdirectory-links">
	<ul>
		<?php
		foreach (range('a', 'e') as $char) : // letters 'a' to 'e'
			$link  = $this->member->params->get('link' . $char);
			$label = $this->member->params->get('link' . $char . '_name');

			if (!$link) :
				continue;
			endif;

			// Add 'http://' if not present
			$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

			// If no label is present, take the link
			$label = ($label) ? $label : $link;
			?>
			<li>
				<a href="<?php echo $link; ?>">
					<?php echo $label; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
