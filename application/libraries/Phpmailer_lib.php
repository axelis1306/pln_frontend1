<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */

// use third_party\mai\PHPMailer\class.phpmailer;
// use third_party\mai\PHPMailer\class.smtp;
class PHPMailer_Lib
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        // Include PHPMailer library files
        //require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH . 'third_party/mai/PHPMailer/class.phpmailer.php';
        require_once APPPATH . 'third_party/mai/PHPMailer/class.smtp.php';

        $mail = new PHPMailer;
        return $mail;
    }
}
