<?php

namespace Traditional\Bundle\UserBundle\Command;

use \SimpleBus\Message\Name\NamedMessage;
use \SimpleBus\Message\Type\Command;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements Command, NamedMessage
{
    /**
     * @var string
     */
    private $id;

    /**
     * @Assert\NotNull
     * @Assert\Email
     * @var string
     */
    private $email;

    /**
     * @Assert\NotNull
     * @Assert\Length(min=2)
     * @var string
     */
    private $password;

    /**
     * @Assert\Country
     * @var string
     */
    private $country;

    public function __construct($id, $email, $password, $country)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
    }

    public static function messageName()
    {
        return 'register_user';
    }

    /**
     * @return string
     */
    public function country()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}