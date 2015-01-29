<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 14:06
 */

namespace Traditional\Bundle\UserBundle\Command;


use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Type\Command;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;

class SendWelcomeMail implements Command, NamedMessage {

    /**
     * @var EmailAddress $emailAddress
     */
    private $emailAddress;

    /**
     * @param EmailAddress $emailAddress
     */
    public function __construct(EmailAddress $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return EmailAddress
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * The name of this particular type of message.
     *
     * @return string
     */
    public static function messageName()
    {
        return 'send_welcome_mail';
    }
}