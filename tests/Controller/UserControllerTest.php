<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{

    public function testRedirectToLogin() {
        $client = static::createClient();
        $client->request('GET', '/profile');
        $this->assertResponseRedirects('/login');
    }

}