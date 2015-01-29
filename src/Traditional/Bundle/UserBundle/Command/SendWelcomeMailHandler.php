<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 10:46
 */

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Swift_Mailer;

class SendWelcomeMailHandler implements MessageHandler
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(Message $message)
    {
        /** @var $message SendWelcomeMail */
        if(!($message instanceof SendWelcomeMail)) {
            throw new \LogicException();
        }


        $mail = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mail->setTo( (string) $message->getEmailAddress() );
        $this->mailer->send($mail);

        //$event = new UserRegistered($user);
        //$this->eventRecorder->record($event);
    }
}