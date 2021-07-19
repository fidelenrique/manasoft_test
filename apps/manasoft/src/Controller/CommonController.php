<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Service\InfoCodes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @codeCoverageIgnore
 */
class CommonController extends AbstractController
{
    protected function getJsonContent($message): array
    {
        $data = [];
        if (is_array($message)) {
            $data['messages'] = (object) $message;
        } else {
            $data['messages'] = ['info' => [$message]];
        }

        return $data;
    }

    /**
     * @param ServiceEntityRepository $repository
     * @param $param
     * @return object
     * @throws Exception
     */
    protected function findObject(ServiceEntityRepository $repository, $param): object
    {
        if (!is_array($param)) {
            $entity = $repository->find((int) $param);
        } else {
            $entity = $repository->findOneBy($param);
        }
        $className = $repository->getClassName();
        if (!$entity instanceof $className) {
            switch ($className) {
                case Equipment::class:
                    $message = InfoCodes::EQUIPMENT_NOT_FOUND;
                    break;
                default:
                    $message = InfoCodes::RES_NOT_FOUND;
                    break;
            }
            throw new Exception($message, Response::HTTP_BAD_REQUEST);
        }

        return $entity;
    }
}
