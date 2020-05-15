<?php


namespace App\Tests\Entity;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class UserTest extends KernelTestCase
{
    public function getEntity() {
        return (new User())
            ->setEmail('test@email.com')
            ->setFirstname('Jimmy')
            ->setLastname('Morrens')
            ->setPassword('Test8_Test')
            ->setConfirmPassword('Test8_Test');
    }

    public function assertHasErrors(User $user, int $number) {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($user);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath(). ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(',', $messages));
    }

    public function testValidEntity () {
        $user = $this->getEntity();
        $this->assertHasErrors($user, 0);
    }

    public function testInvalidUserEntity () {
        $user = $this->getEntity()->setEmail('jimmy');
        $this->assertHasErrors($user, 1);
    }

    public function testInvalidUserPasswordLength () {
        $password = "Te_8";
        $user = $this->getEntity()->setPassword($password)->setConfirmPassword($password);
        $this->assertHasErrors($user, 1);
    }

    public function testInvalidUserPasswordDigit () {
        $password = "Testtest_";
        $user = $this->getEntity()->setPassword($password)->setConfirmPassword($password);
        $this->assertHasErrors($user, 1);
    }

    public function testInvalidUserPasswordConfirm () {
        $user = $this->getEntity()->setPassword('Passw8rd!')->setConfirmPassword("PAssw8rd!");
        $this->assertHasErrors($user, 1);
    }

//    public function testInvalidUsedEmail () {
//        $user = $this->getEntity()->setEmail('morrensj@gmail.com');
//        $this->assertHasErrors($user, 1);
//    }

}