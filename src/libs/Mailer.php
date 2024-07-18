<?php

namespace App\Library;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    /**
     * @var PHPMailer\PHPMailer\PHPMailer
     */
    private $mailer = null;

    /**
     * Subject of the email
     */
    public $subject = '';

    /**
     * Body of the email
     */
    public $body = '';

    /**
     * Email address of the recipent
     */
    public $recipent = '';

    /**
     * Name of the recipent
     */
    public $recipent_name = '';

    
    
    public function __construct(string $subject = '', string $body = '', string $recipent = '', string $recipent_name = '')
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->recipent = $recipent;
        $this->recipent_name = $recipent_name;

        $this->boot();
    }

    public function send()
    {
        $this->addRecipent();
        $this->addContent();

        if ($this->mailer->send()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Boots PHPMailer\PHPMailer\PHPMailer;
     */
    private function boot()
    {
        $mailer = new PHPMailer(true);
        $mailer->SMTPDebug = getenv('SMTP_DEBUG');
        $mailer->isSMTP();
        $mailer->Host       = getenv('SMTP_HOST');
        $mailer->SMTPAuth   = true;
        $mailer->Username   = getenv('USER_EMAIL');
        $mailer->Password   = getenv('EMAIL_PWD');
        $mailer->SMTPSecure = 'tls';
        $mailer->Port       = 587;

        $mailer->setFrom(getenv('USER_EMAIL'), 'Synchlab');
        $this->mailer = $mailer;

    }

    /**
     * Add recipent to PHPMailer\PHPMailer\PHPMailer
     */
    private function addRecipent()
    {
        if (!$this->recipent) {
            throw new \Exception('mail recipent is missing');
        }

        if (!$this->recipent_name) {
            throw new \Exception('recipent name missing');
        }

        $this->mailer->addAddress($this->recipent, $this->recipent_name);
    }

    /**
     * Add email contents to PHPMailer\PHPMailer\PHPMailer;
     */
    private function addContent()
    {
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $this->subject;
        $this->mailer->Body    = $this->body;
        $this->mailer->AltBody = strip_tags($this->body);
    }
}
