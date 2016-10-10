<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LocationControllerTest extends WebTestCase
{
    public function testGym()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gym');
    }

}
