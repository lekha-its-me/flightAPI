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
use App\Repository\UsersRepository;
use App\Validators\DateValidator;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ShedulesRepository;
use App\Auth\AuthenticationHelper;
use App\Exceptions\AuthException;


class SearchController
{
    public function __construct(ShedulesRepository $shedulesRepository, ShedulesMapper $shedulesMapper, UsersRepository $usersRepository)
    {
        $this->shedulesRepository = $shedulesRepository;
        $this->shedulesMapper = $shedulesMapper;
        $this->shedulesMapper = $shedulesMapper;
        $this->usersRepository = $usersRepository;
    }

    /**
     * @Rest\Post("/search")
     */
    public function search(Request $request)
    {
        $authenticationHelper = new AuthenticationHelper($this->usersRepository, $request);

        $credentials['login'] = $request->headers->get('login');
        $credentials['password'] = $request->headers->get('password');

        if(!$authenticationHelper->authenticate($credentials)){
            return new Response('Неверные логин или пароль', 401);
        }

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
