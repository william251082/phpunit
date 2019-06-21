<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testEnclosuresAreShownOnTheHomepage()
    {
        $client = $this->makeClient();

        $client->request('GET', '/');

        $this->assertStatusCode(200, $client);
    }
}
