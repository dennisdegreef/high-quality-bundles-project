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
use Traditional\Bundle\UserBundle\Entity\EmailAddress;
use Traditional\Bundle\UserBundle\Entity\PhoneNumber;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Entity\UserRepository;

class RegisterUserHandler implements MessageHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getDoctrine()
    {
        return $this->doctrine;
    }

    public function handle(Message $message)
    {
        /** @var $message RegisterUser */
        if(!($message instanceof RegisterUser)) {
            throw new \LogicException();
        }

        $user = User::register(
            $message->getId(),
            EmailAddress::fromString($message->email()),
            $message->password(),
            $message->country()
        );

        //var_dump($user);exit;
//        $user->setEmail($message->email());
//        $user->setCountry($message->country());
//        $user->setPassword($message->password());

        $defaultPhoneNumber = new PhoneNumber();
        $defaultPhoneNumber->setCountryCode('0031');
        $defaultPhoneNumber->setAreaCode('030');
        $defaultPhoneNumber->setLineNumber('1234567');
        $user->addPhoneNumber($defaultPhoneNumber);

//        $em = $this->getDoctrine()->getManager();
//        $em->persist($user);
//        $em->flush();

        $this->userRepository->add($user);
    }
} 