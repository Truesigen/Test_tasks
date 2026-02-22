<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShippingControllerTest extends WebTestCase
{
    public function testCalculateEndpointReturnsPrice(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/shipping/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'packgroup',
                'weight' => 1000
            ])
        );


        $this->assertResponseIsSuccessful();


        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('price', $data);
        $this->assertArrayHasKey('carrier', $data);
        $this->assertArrayHasKey('weight', $data);
        $this->assertArrayHasKey('currency', $data);


        $this->assertEquals('packgroup', $data['carrier']);
        $this->assertEquals(1000, $data['weight']);
        $this->assertEquals('EUR', $data['currency']);
        $this->assertEquals(1000, $data['price']);
    }

    public function testCalculateEndpointValidationError(): void
    {
        $client = static::createClient();


        $client->request(
            'POST',
            '/api/shipping/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([])
        );


        $this->assertResponseStatusCodeSame(422);

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('errors', $data);
        $this->assertNotEmpty($data['errors']);
    }
}
