<?php

namespace App\Controller;

use App\Repository\EquipmentRepository;
use App\Service\Equipment\EquipmentProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Routing\Route;
use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EquipmentController extends AbstractController
{
    protected EntityManagerInterface $em;
    protected EquipmentProviderInterface $equipmentProvider;

    /**
     * EquipmentController constructor.
     * @param EntityManagerInterface $em
     * @param EquipmentProviderInterface $eqt
     */
    public function __construct(EntityManagerInterface $em, EquipmentProviderInterface $eqt)
    {
        $this->em = $em;
        $this->equipmentProvider = $eqt;
    }

    /**
     * @Route("/api/equipment")
     * @return string
     */
    public function show()
    {
        return 'hey';
    }

    /**
     * @Route("/api/equipments", name="app.equipments", methods={"GET"})
     * @param Request $request
     * @param EquipmentRepository $equipmentRepository
     * @throws \Doctrine\DBAL\Exception
     */
    public function showAll(Request $request, EquipmentRepository $equipmentRepository)
    {
        /* Validate request query params and get values */
        $params = $this->equipmentProvider->getQueryParams($request->query->all());

        $equipment = $equipmentRepository->getAll($params);
    }
}