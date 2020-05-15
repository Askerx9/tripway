<?php

namespace App\Services;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private EntityManagerInterface $em;

    function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function UpdateLastLogin (User $user) : void
    {
        $user->setLastSignAt(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();
    }

}