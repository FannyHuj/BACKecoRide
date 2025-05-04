<?php
namespace App\services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService {

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer=$mailer;
    }

  public function sendEmail(string $content,string $subject, string $to){
     
    $email = (new Email())
    ->from('ecoride@tutamail.com')
    ->to($to)
    ->subject($subject)
    ->text($content);
     $this->mailer->send($email);
   }
}
