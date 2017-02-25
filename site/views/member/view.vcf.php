<?php
/**
 * View for VCF
 *
 * @package    ChurchDirectory.Site
 * @copyright  2007 - 2016 (C) Joomla Bible Study Team All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Class for Member VCF
 *
 * @package  ChurchDirectory.Site
 * @since    1.7.0
 */
class ChurchDirectoryViewMember extends JViewLegacy
{
	/**
	 * Protected
	 *
	 * @var array
	 * @since       1.7.2
	 */
	protected $state;

	/**
	 * Protected
	 *
	 * @var array
	 * @since       1.7.2
	 */
	protected $item;

	/**
	 * Display
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return bool
	 *
	 * @throws \Exception
	 * @since       1.7.2
	 */
	public function display($tpl = null)
	{
		// Get model data.
		$item = $this->get('Item');

		$middlename = null;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			Throw new Exception(implode("\n", $errors));
		}

		JFactory::getDocument()->setMetaData('Content-Type', 'text/directory', true);

		// Compute lastname, firstname and middlename
		$item->name = trim($item->name);

		// "Lastname, Firstname Midlename" format support
		// e.g. "de Gaulle, Charles"
		$namearray = explode(',', $item->name);

		if (count($namearray) > 1)
		{
			$lastname         = $namearray[0];
			$card_name        = $lastname;
			$name_and_midname = trim($namearray[1]);

			$firstname = '';

			if (!empty($name_and_midname))
			{
				$namearray = explode(' ', $name_and_midname);

				$firstname  = $namearray[0];
				$middlename = (count($namearray) > 1) ? $namearray[1] : '';
				$card_name  = $firstname . ' ' . ($middlename ? $middlename . ' ' : '') . $card_name;
			}
		}
		// "Firstname Middlename Lastname" format support
		else
		{
			$namearray = explode(' ', $item->name);

			$middlename = (count($namearray) > 2) ? $namearray[1] : '';
			$firstname  = array_shift($namearray);
			$lastname   = count($namearray) ? end($namearray) : '';
			$card_name  = $firstname . ($middlename ? ' ' . $middlename : '') . ($lastname ? ' ' . $lastname : '');
		}

		$rev = date('c', strtotime($item->modified));

		JFactory::getApplication()->setHeader('Content-disposition', 'attachment; filename="' . $card_name . '.vcf"', true);

		$vcard = [];
		$vcard[] .= 'BEGIN:VCARD';
		$vcard[] .= 'VERSION:3.0';
		$vcard[] = 'N:' . $lastname . ';' . $firstname . ';' . $middlename;
		$vcard[] = 'FN:' . $item->name;
		$vcard[] = 'TITLE:' . $item->con_position;
		$vcard[] = 'TEL;TYPE=WORK,VOICE:' . $item->telephone;
		$vcard[] = 'TEL;TYPE=WORK,FAX:' . $item->fax;
		$vcard[] = 'TEL;TYPE=WORK,MOBILE:' . $item->mobile;
		$vcard[] = 'ADR;TYPE=WORK:;;' . $item->address . ';' . $item->suburb . ';' . $item->state . ';' . $item->postcode . ';' . $item->country;
		$vcard[] = 'LABEL;TYPE=WORK:' . $item->address . "\n" . $item->suburb . "\n" . $item->state . "\n" . $item->postcode . "\n" . $item->country;
		$vcard[] = 'EMAIL;TYPE=PREF,INTERNET:' . $item->email_to;
		$vcard[] = 'URL:' . $item->webpage;
		$vcard[] = 'REV:' . $rev . 'Z';
		$vcard[] = 'END:VCARD';

		echo implode("\n", $vcard);

		return true;
	}
}
