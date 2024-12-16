<?php

namespace App\Controller;
use App\Repository\CarRepository;
use App\Repository\CreditReqRepository;
use App\Repository\CreditProgrammRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{

    private $carRepository;
    private $creditReqRepository;
    private $programRepository;

    public function __construct(CarRepository $carRepository, CreditReqRepository $creditReqRepository,CreditProgrammRepository $programRepository)
    {
        $this->carRepository = $carRepository;
        $this->creditReqRepository = $creditReqRepository;
        $this->programRepository=$programRepository;
    }
    /**
     * @Route("/api/v1/cars", name="getAllCars", methods = {"GET"})
     */
    public function getAllCars(): JsonResponse
    {
        $entities = $this->carRepository->getAllCars();

        $data = [];
        foreach ($entities as $entity) {
            $data[] = [
                'id' => $entity->getId(),
                'brand' => [
                    'id'=>$entity->getBrand()->getId(),
                    'name'=>$entity->getBrand()->getBrandName()
                ],
                'photo'=>$entity->getPhoto(),
                'price'=>$entity->getPrice()

                
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/api/v1/cars/{id}", name="getCar", methods = {"GET"})
     */
    public function getCar(int $id): JsonResponse
    {
        $car=$this->carRepository->getCarById($id);
        $data = [];
        $data[] = [
            'id' => $car->getId(),
            'brand' => [
                'id'=>$car->getBrand()->getId(),
                'name'=>$car->getBrand()->getBrandName()
            ],
            'model' => [
                'id'=>$car->getModel()->getId(),
                'name'=>$car->getModel()->getModelName()
            ],
            'photo'=>$car->getPhoto(),
            'price'=>$car->getPrice()

            
        ];
        return $this->json($data);
    }
    /**
     * @Route("/api/v1/credit/calculate", name="getCredicCalc", methods = {"GET"})
     */
    public function getCredicCalc(Request $request): JsonResponse
    {   
        $price=$request->request->get("price");
        $initialPayment=$request->request->get("initialPayment");
        $loanTerm=$request->request->get("loanTerm");
        $result=$this->programRepository->getCredicCalc($price, $initialPayment, $loanTerm);



        return $this->json($result);
    }
    /**
     * @Route("/api/v1/request", name="saveReq", methods = {"GET"})
     */
    public function saveReq(Request $request): JsonResponse
    {
        $result=$this->creditReqRepository->save(
            $this->carRepository->getCarById($request->request->get("carId")),
            $this->programRepository->getProgrammById($request->request->get("programId")),
            $request->request->get("initialPayment"),
            $request->request->get("loanTerm")
        );
        $data = [
            "success"=>$result
        ];


        return $this->json($data);
    }

}
