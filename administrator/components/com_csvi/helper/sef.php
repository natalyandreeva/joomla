<?php
/**
 * @package     CSVI
 * @subpackage  SEF
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

/**
 * SEF helper class for the component.
 *
 * @package     CSVI
 * @subpackage  SEF
 * @since       4.0
 */
class CsviHelperSef
{
	/**
	 * The domain name to use for URLs
	 *
	 * @var    string
	 * @since  4.0
	 */
	private $domainname = null;

	/**
	 * An instance of the CsviHelperTemplate.
	 *
	 * @var    CsviHelperTemplate
	 * @since  6.0
	 */
	private $template = null;

	/**
	 * An instance of the CsviHelperLog.
	 *
	 * @var    CsviHelperLog
	 * @since  6.0
	 */
	private $log = null;

	/**
	 * Constructor.
	 *
	 * @param   CsviHelperSettings  $settings  An instance of CsviHelperSettings.
	 * @param   CsviHelperTemplate  $template  An instance of CsviHelperTemplate.
	 * @param   CsviHelperLog       $log       An instance of CsviHelperLog.
	 *
	 * @since   4.0
	 *
	 * @throws  CsviException
	 */
	public function __construct(CsviHelperSettings $settings, CsviHelperTemplate $template, CsviHelperLog $log)
	{
		$this->domainname = $settings->get('hostname');

		// Make sure we have a valid domain name
		if (filter_var($this->domainname, FILTER_VALIDATE_URL) === false)
		{
			throw new CsviException(JText::_('COM_CSVI_NO_VALID_DOMAIN_NAME_SET'));
		}

		$this->template   = $template;
		$this->log        = $log;
	}

	/**
	 * Create a SEF URL by querying the URL.
	 *
	 * @param   string  $url  The URL to change to SEF.
	 *
	 * @return  string  The SEF URL.
	 *
	 * @since   6.0
	 */
	public function getSefUrl($url)
	{
		if ($this->template->get('exportsef', false))
		{
			$parseUrl = base64_encode($url);
			$language = substr($this->template->get('language'), 0, 2);
			$language = $language ? '&lang=' . $language : '';
			$http     = JHttpFactory::getHttp(null, array('curl', 'stream'));
			$result   = $http->get($this->domainname . '/index.php?option=com_csvi&task=sefs.getsef&parseurl=' . $parseUrl . '&format=json' . $language);
			$output   = json_decode($result->body);

			if (is_object($output) && $output->success)
			{
				return $output->data;
			}
		}

		// Get position of the forward slash
		$slashPosition = strpos($url, '/');

		if ($slashPosition > 0 || $slashPosition === false)
		{
			$url = '/' . $url;
		}

		return $this->domainname . $url;
	}
}
