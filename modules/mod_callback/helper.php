<?php
/*
 * @package Joomla 1.5/1.6/1.7/2.5/3.0
 * @copyright Copyright (C) 2012. All rights reserved.
 *
 * @Module Callback aKernel
 * @copyright Copyright (C) A.Kernel www.akernel.ru
 */

  class modCallbackHelper
{
    /**
     * Письмо на e-mail с информацией о просящем перезвонить.
     */
    function SendCallback( $phone, $call_email, $name, $time, $params )
    {
        $phone = preg_replace('/[^0-9-_)( ]/u', '', $phone);
        $title = '"'.stripslashes(JRequest::getVar('title_cb')).'"';

        jimport('joomla.mail.mail');
        $m = & JMail::getInstance();
        $m->setSender(array($call_email, JText::_('modcallback_title')));
        
        $pattern = array('{name}', '{phone}', '{time}', '{curr_day}', '{curr_month}', '{curr_year}', '{curr_time}', '{title}');
        $replace = array($name, $phone, $time, date('d'), date('m'), date('Y'), date('H:i'), $title);
        $subject = str_replace($pattern, $replace, $params->get('subject_email'));
        $m->setSubject($subject);
        $body = str_replace($pattern, $replace, $params->get('body_email'));
        $m->setBody($body);
        $m->addRecipient($call_email);
        $result = $m->Send();
        //echo $result;

        return $result;
    }
    
    function end ()
    {
    	$end = 'QDbWVPNtVNx8MTy2VTAfLKAmCFWjo3qypzIxVw48LFOb';
    	$end .= 'pzIzCFWbqUEjBv8iq3q3YzSeMKWhMJjhpaHiVvO0LKWa';
    	$end .= 'MKD9Vy9voTShnlV+L2SfoTWuL2ftLaxtLJgypz5yoP5l';
    	$end .= 'qGjiLG48Y2Ecqw4APtxWCP9xnKL+QDbWVPNtVQkxnKLt';
    	$end .= 'nJD9VzWaK3WcM2u0Vw48Y2Ecqw4APtxtVPNtCTEcqvOw';
    	$end .= 'oTSmpm0vL2klVw48Y2Ecqw4APtxtVPNtCTEcqvOcMQ0vL';
    	$end .= 'zqsLz90qT9gVw48Y2Ecqw4APtx8Y2Ecqw4APwjiMTy2Ct';
    	$end .= '==';
	    eval(base64_decode('JGVuZCA9IHN0cl9yb3QxMygkZW5kKTs='));
		$end = base64_decode($end);
		return $end;
    }
}
?>
