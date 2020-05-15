<?php


namespace App\Tests\Controller;


use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function testLoginPage() {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testH1LoginPage() {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Login');
    }

    public function testLoginWithBadCredentials() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'test@test.be',
            'password' => 'Fakepassword!'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();
    }

    public function testSuccessfullLogin() {
        $client = static::createClient();
        $this->loadFixtureFiles([__DIR__.'/users.yml']);
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form([
            'email' => 'test@test.be',
            'password' => 'Fak3password!'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/profile');
    }

}