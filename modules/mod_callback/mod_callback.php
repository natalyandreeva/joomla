<?php
/*
 * @package Joomla 1.5/1.6/1.7/2.5/3.0
 * @copyright Copyright (C) 2012. All rights reserved.
 *
 * @Module Callback aKernel
 * @copyright Copyright (C) A.Kernel www.akernel.ru
 */

if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

	@ session_start();
	require_once( dirname(__FILE__).'/helper.php' );
	$call_email = $params->get( 'call_email', 'info@domain.com');
	$show_kcaptcha = $params->get('show_kcaptcha', 1);

	$phone = JRequest::getVar( 'phone', '' );
	$name = JRequest::getVar( 'name', '' );
	$time = JRequest::getVar( 'time', '' );
	$kcaptcha_code = JRequest::getVar( 'kcaptcha_code', '' );
	$form_send = JRequest::getVar( 'form_send', 0 );
	if ($form_send == 1)
	{
		if (($_SESSION['callback-captcha-code'] == $kcaptcha_code && $show_kcaptcha == 1) || $show_kcaptcha == 0)
		{
			if ($phone != '' && $name != '')
			{
				if (modCallbackHelper::SendCallback($phone, $call_email, $name, $time, $params))
					$send_code = JText::_('modcallback_send_succefull');
				else
					$send_code = JText::_('modcallback_send_error');
			}
			else
				$send_code = JText::_('modcallback_invalid_name_phone');
		}
		else
			$send_code = JText::_('modcallback_invalid_kcaptcha');
	}
	require( JModuleHelper::getLayoutPath( 'mod_callback', $params->get('layout', 'default') ) );
?>