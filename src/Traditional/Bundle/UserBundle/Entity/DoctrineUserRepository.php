<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 16:24
 */

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }
}