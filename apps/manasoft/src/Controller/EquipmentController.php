<?php

namespace App\Controller;

use App\Repository\EquipmentRepository;
use App\Service\Equipment\EquipmentProviderInterface;
use Doctrine\DBAL\Exception;
use App\Entity\Equipment;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EquipmentController extends CommonController
{
    protected EquipmentProviderInterface $equipmentProvider;

    /**
     * EquipmentController constructor.
     * @param EquipmentProviderInterface $eqt
     */
    public function __construct(EquipmentProviderInterface $eqt)
    {
        $this->equipmentProvider = $eqt;
    }

    /**
     * Show Equipment
     * @Route("/api/equipment/{id}", name="app.equipment.show", methods={"GET"}, requirements={"id"="\d+"})
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function showEquipment(Equipment $equipment): JsonResponse
    {
        $data = $this->equipmentProvider->getEquipment($equipment);

        return $this->json($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/equipments", name="app.equipments", methods={"GET"})
     * @param Request $request
     * @param EquipmentRepository $equipmentRepository
     * @return JsonResponse
     * @throws Exception
     */
    public function showAll(Request $request, EquipmentRepository $equipmentRepository): JsonResponse
    {
        /* Validate request query params and get values */
        $params = $this->equipmentProvider->getQueryParams($request->query->all());
        $equipment = $equipmentRepository->findEquipments($params);

        $response = new JsonResponse();
        $response->setContent(json_encode($equipment));

        return $response;
    }

    /**
     * Delete a Equipment.
     *
     * @Route("/api/equipment/{id}", name="app.equipment.delete", methods={"DELETE"}, requirements={"id"="\d+"})
     * @param Equipment $equipment
     * @return JsonResponse
     *
     */
    public function delete(Equipment $equipment): JsonResponse
    {
        /* Delete Equipment inside database */
        $this->equipmentProvider->deleteEquipment($equipment);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Create a Equipment.
     *
     * @Route("/api/equipments", name="app.equipment.edit", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $this->equipmentProvider->createEquipment($request);

        return $this->json($data, Response::HTTP_OK, [], ['groups' => ['equipments']]);
    }

    /**
     * Update a Equipment.
     *
     * @Route("/api/equipment/{id}", name="app.equipment.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     * @param Equipment $equipment
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Equipment $equipment, Request $request)
    {
        $data = $this->equipmentProvider->updateEquipment($equipment, $request);

        return $this->json($data, Response::HTTP_OK, [], ['groups' => ['equipments']]);
    }
}
