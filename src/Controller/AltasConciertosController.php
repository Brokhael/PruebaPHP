<?php

namespace App\Controller;

use App\Entity\Conciertos;
use App\Entity\Grupos;
use App\Entity\GruposConciertos;
use App\Entity\GruposMedios;
use App\Entity\Medios;
use App\Entity\Promotores;
use App\Entity\Recintos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AltasConciertosController
 *
 * @Route("/altas_conciertos")
 */
class AltasConciertosController extends AbstractController
{
    /**
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Exception
     *
     * @Route("/", name="altasa_conciertos")
     */
    public function altaConciertoAction(Request $request, \Swift_Mailer $mailer): Response
    {
        $manager = $this->getDoctrine()->getManager();

        /** @var Recintos $recinto */
        $recinto = $manager->getRepository(Recintos::class)->find($request->get('id_recinto'));
        /** @var Promotores $promotor */
        $promotor = $manager->getRepository(Promotores::class)->find($request->get('id_promotor'));
        $fecha = new \DateTime($request->get('fecha'));
        $mediosConcierto = $request->get('medios_concierto');
        $gruposConcierto = $request->get('grupos_concierto');
        $numeroEspectadores = (int) $request->get('numero_espectadores');
        $nombre = $request->get('nombre');

        $concierto = new Conciertos();
        $concierto->setFecha($fecha);
        $concierto->setNombre($nombre);
        $concierto->setIdRecinto($recinto);
        $concierto->setIdPromotor($promotor);
        $concierto->setNumeroEspectadores($numeroEspectadores);
        $concierto->setRentabilidad(0);

        $manager->persist($concierto);

        $rentabilidad = $this->calculoBeneficios($gruposConcierto, $recinto, $concierto);
        $concierto->setRentabilidad($rentabilidad);

        $manager->persist($concierto);
        $manager->flush();

        $this->guardarMediosConcierto($mediosConcierto, $concierto);
        $this->guardarGruposConcierto($gruposConcierto, $concierto);

        $this->enviarCorreo($mailer, $concierto);

        return $this->json(
            [
                'message' => "Concierto guardado con éxito",
                'concierto' => $concierto,
            ]
        );
    }

    /**
     * @param array $gruposConcierto
     * @param Conciertos $concierto
     */
    private function guardarGruposConcierto(array $gruposConcierto, Conciertos $concierto): void
    {
        $manager = $this->getDoctrine()->getManager();
        foreach ($gruposConcierto as $item) {
            /** @var Grupos $grupo */
            $grupo = $manager->getRepository(Grupos::class)->find($item);
            $grupos = new GruposConciertos();
            $grupos->setIdConcierto($concierto);
            $grupos->setIdGrupo($grupo);
            $manager->persist($grupos);
            $manager->flush();
        }
    }

    /**
     * @param int[] $mediosConcierto
     * @param Conciertos $concierto
     */
    private function guardarMediosConcierto(array $mediosConcierto, Conciertos $concierto): void
    {
        $manager = $this->getDoctrine()->getManager();
        foreach ($mediosConcierto as $item) {
            /** @var Medios $medio */
            $medio = $manager->getRepository(Medios::class)->find($item);
            $medios = new GruposMedios();
            $medios->setIdConcierto($concierto);
            $medios->setIdMedio($medio);
            $manager->persist($medios);
            $manager->flush();
        }
    }


    /**
     * @param int[] $gruposConcierto
     * @param Recintos $recinto
     * @param Conciertos $concierto
     *
     * @return int
     */
    private function calculoBeneficios(array $gruposConcierto, Recintos $recintos, Conciertos $concierto): int
    {
        $manager = $this->getDoctrine()->getManager();

        $cachetotal = 0;
        foreach ($gruposConcierto as $item) {
            /** @var Grupos $grupo */
            $grupo = $manager->getRepository(Grupos::class)->find($item);
            $cachetotal += $grupo->getCache();
        }

        $costeAlquiler = $recintos->getCosteAlquiler();
        $precioEntrada = $recintos->getPrecioEntrada();
        $numeroEspectadores = $concierto->getNumeroEspectadores();

        $entradas = $precioEntrada * $numeroEspectadores;
        $entradasGrupo = $entradas * 0.1;
        $beneficios = $entradas - $entradasGrupo;
        $gastos = $cachetotal + $costeAlquiler + $entradasGrupo;
        $resultado = $beneficios - $gastos;

        /**
         * Los fuerzo a ser INT porque en el diagrama ER el campo es un entero.
         */
        return (int) $resultado;
    }

    /**
     * @param \Swift_Mailer $mailer
     * @param Conciertos $concierto
     */
    private function enviarCorreo(\Swift_Mailer $mailer, Conciertos $concierto)
    {
        $message = (new \Swift_Message('Email confiración concierto'))
            ->setFrom('pavlobod91@gmail.com.com')
            ->setTo('recipient@example.com')
            ->setSubject('Confirmación de concierto')
            ->setBody(
                $this->renderView(
                // Aquí se puede poner una plantilla html para el correo
                    'emails/registration.html.twig',
                    [
                        'body' => 'Aquí habría el contendio del mensaje',
                        'rentabilidad' => $concierto->getRentabilidad(),
                    ]
                ),
                'text/html'
            );

        $mailer->send($message);
    }
}