<?php

namespace Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AltasConciertosControllerTest extends WebTestCase
{

    public function testAltasConciertosAction()
    {
        $client = static::createClient();
        $datosDummy = [
            'id_recinto'         => 1,
            'id_promotor'        => 2,
            'fecha'              => '2021-02-20',
            'medios_concierto'   => [1,2,4],
            'grupos_concierto'   => [7,10,25],
            'numero_espectadores'=> 2500,
            'nombre'             => 'Concierto test',
        ];

        $client->request('POST', '/altas_conciertos', $datosDummy);

        self::assertTrue(200 === $client->getResponse()->getStatusCode());
        self::assertStringContainsStringIgnoringCase('Concierto guardado con éxito', $client->getResponse()->getContent());
    }
}