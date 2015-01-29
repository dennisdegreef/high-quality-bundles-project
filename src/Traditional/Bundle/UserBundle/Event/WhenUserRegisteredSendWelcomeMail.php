<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 13:45
 */

namespace Traditional\Bundle\UserBundle\Event;


use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\Bundle\UserBundle\Command\SendWelcomeMail;

class WhenUserRegisteredSendWelcomeMail implements MessageSubscriber
{
    private $messageBus;

    /**
     * @param \SimpleBus\Message\Bus\MessageBus $commandBus
     */
    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Provide the given message as a notification to this subscriber
     *
     * @param Message $message
     *
     * @throws \LogicException
     * @return void
     */
    public function notify(Message $message)
    {

        if(!($message instanceof UserRegistered)) {
            throw new \LogicException("");
        }

        $command = new SendWelcomeMail($message->getUser()->getEmail());
        $this->commandBus->handle($command);
    }
}