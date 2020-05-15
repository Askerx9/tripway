<?php

namespace App\Services;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{

    public function UpdateLastLogin (User $user, EntityManagerInterface $em) : void
    {
        $user->setLastSignAt(new \DateTime());
        $this->$em->persist($user);
        $this->$em->flush();
    }

}