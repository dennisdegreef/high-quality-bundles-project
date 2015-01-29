<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 13:42
 */

namespace Traditional\Bundle\UserBundle\Event;


use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Type\Event;
use Traditional\Bundle\UserBundle\Entity\User;

class UserRegistered implements Event, NamedMessage
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Traditional\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * The name of this particular type of message.
     *
     * @return string
     */
    public static function messageName()
    {
        return 'user_registered';
    }
}