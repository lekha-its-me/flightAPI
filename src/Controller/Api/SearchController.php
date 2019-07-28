<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 27.07.2019
 * Time: 19:25
 */

namespace App\Controller\Api;

use App\Exceptions\NotFoundException;
use App\Exceptions\WrongDateException;
use App\Mappers\ShedulesMapper;
use App\Validators\DateValidator;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ShedulesRepository;


class SearchController
{
    public function __construct(ShedulesRepository $shedulesRepository, ShedulesMapper $shedulesMapper)
    {
        $this->shedulesRepository = $shedulesRepository;
        $this->shedulesMapper = $shedulesMapper;
    }

    /**
     * @Rest\Post("/search")
     */
    public function search(Request $request)
    {
        $data = $request->request->get('searchQuery');
        $data = json_decode($data);
        $dateValidator = new DateValidator();
        if(!$dateValidator->validate($data->departureDate)) {
            throw new WrongDateException('Неверное указана дата', 400);
        }
        try {
            $result = $this->shedulesRepository->findRoute($data->departureAirport, $data->arrivalAirport, $data->departureDate);
        }
        catch (NotFoundException $exception) {
            return new Response($exception->getMessage(), $exception->getCode());
        }


        $mappedData = [];
        foreach($result as $value)
        {
            $mappedData[] = $this->shedulesMapper->shedulesEntityToResponse($value);
        }

        return new Response(json_encode($mappedData), 200);
    }
}
