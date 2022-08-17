<?php

namespace Tests\Unit\Requests;

use CTApi\CTClient;
use CTApi\Models\Person;
use CTApi\Requests\PersonRequestBuilder;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class PersonRequestBuilderTest extends TestCase
{
    public function testUpdate(): void
    {
        // Setup test data
        $client = $this->createMock(CTClient::class);
        $client->expects($this->once())
            ->method('patch')
            ->with(
                '/api/persons/777',
                ['json' => array_merge($this->getNulledPersonDataArray(), [
                    'firstName' => 'Jane',
                    'lastName' => 'Mustermann',
                    'birthName' => 'Doe',
                ])]
            )
            ->willReturn(new Response(200))
        ;

        CTClient::setClient($client); // This has to be reverted at the end of the test!

        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
        ]);

        // Action
        $builder = new PersonRequestBuilder();
        $builder->update($person);

        // Cleanup
        CTClient::createClient();
    }

    public function testUpdateWithReducedAttributes(): void
    {
        // Setup test data
        $client = $this->createMock(CTClient::class);
        $client->expects($this->once())
            ->method('patch')
            ->with(
                '/api/persons/777',
                ['json' => [
                    'firstName' => 'Jane',
                ]]
            )
            ->willReturn(new Response(200))
        ;

        CTClient::setClient($client); // This has to be reverted at the end of the test!

        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
            'lastName' => 'Mustermann',
            'birthName' => 'Doe',
        ]);

        // Action
        $builder = new PersonRequestBuilder();
        $builder->update($person, ['firstName']);

        // Cleanup
        CTClient::createClient();
    }

    public function testUpdateWithRequestError(): void
    {
        // Setup test data
        $client = $this->createMock(CTClient::class);
        $client->expects($this->once())
            ->method('patch')
            ->withAnyParameters()
            ->willReturn(new Response(400))
        ;

        CTClient::setClient($client); // This has to be reverted at the end of the test!

        $person = Person::createModelFromData([
            'id' => '777',
            'firstName' => 'Jane',
        ]);

        // Assertions
        $this->expectException(\CTApi\Exceptions\CTRequestException::class);

        // Action
        $builder = new PersonRequestBuilder();
        $builder->update($person, ['firstName']);

        // Cleanup
        CTClient::createClient();
    }

    private static function getNulledPersonDataArray(): array
    {
        return array_map(
            function ($val) {
                return null;
            },
            array_flip(Person::MODIFIABLE_ATTRIBUTES)
        );
    }
}
