<?php

function generatenumericotp($n)
{

    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";

    // Iterate for n-times and pick a single character
    // from generator and append it to $result

    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result

    $result = "";

    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand() % (strlen($generator))), 1);
    }

    // Return result
    return $result;
}










if (!function_exists('sendemailusingses')) {

    function sendemailusingses($toemail, $subject, $data)
    {
        $CI = &get_instance();
        $CI->load->library('email');

        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'ssl://email-smtp.eu-west-1.amazonaws.com';
        $config['smtp_port'] = '465';

        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['newline']   = "\r\n";
        $config['mailtype']  = 'html';

        $CI->email->initialize($config);
        $CI->email->from(ADMIN_EMAIL, SITE_NAME);
        $CI->email->to($toemail);
        $CI->email->subject($subject);
        $CI->email->message($data);
        $sendmessage = $CI->email->send();
        return $sendmessage;
    }
}

if (!function_exists('sendemailusingsesattachment')) {

    function sendemailusingsesattachment($toemail, $subject, $data, $attachmentpath, $cc = "")
    {
        $CI = &get_instance();
        $CI->load->library('email');

        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'ssl://email-smtp.us-east-1.amazonaws.com';
        $config['smtp_port'] = '465';

        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['newline']   = "\r\n";
        $config['mailtype']  = 'html';

        $CI->email->initialize($config);
        $CI->email->from(ADMIN_EMAIL, SITE_NAME);
        $CI->email->to($toemail);
        if ($cc != "") {
            $CI->email->cc($cc);
        }
        $CI->email->subject($subject);
        $CI->email->message($data);
        $CI->email->attach($attachmentpath);
        $sendmessage = $CI->email->send();
        return $sendmessage;
    }
}




if (!function_exists('timeSpentCalculation')) {
    function timeSpentCalculation($taskStatus)
    {
        $hours=0;
        $minutes=0;
        foreach ($taskStatus as $time) {
            if ($time->td_hours!='') {
                $hours += $time->td_hours;
            }
            if ($time->td_minutes!='') {
                $minutes += $time->td_minutes;
            }
        }

        $totalHours = floor($minutes / 60).':'.($minutes -   floor($minutes / 60) * 60);
        $hours += floor($minutes / 60);
        $totalMinutes = ($minutes -   floor($minutes / 60) * 60);
        return array('hours'=>$hours,'minutes'=>$totalMinutes);
    }
}




