<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 12:14
 */

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EmailAddress
 *
 * @package Traditional\Bundle\UserBundle\Entity
 * @ORM\Embeddable
 */
class EmailAddress
{
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    private $emailAddress;

    /**
     * @param string $emailAddress
     */
    private function __construct($emailAddress)
    {
        Assertion::email($emailAddress);
        $this->emailAddress = $emailAddress;
    }

    public static function fromString($emailAddress)
    {
        return new self($emailAddress);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->emailAddress;
    }
} 