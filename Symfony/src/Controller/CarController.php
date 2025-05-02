<?php

namespace App\Controller;

namespace App\Controller;


use App\Entity\Car;
use App\Repository\CarCategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/car')]
final class CarController extends AbstractController
{
    #[Route('', name: 'app_car_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, CarCategoryRepository $repo): Response
    {
        $qb = $repo->createQueryBuilder('c');

        $f = $this->createForm(CarFilterType::class);
        $f->handleRequest($request);
        if ($f->isSubmitted()&&$f->isValid()){
            $d=$f->getData();
            if($d['brand'])  $qb->andWhere('c.brand LIKE :b')->setParameter('b','%'.$d['brand'].'%');
            if($d['model'])  $qb->andWhere('c.model LIKE :m')->setParameter('m','%'.$d['model'].'%');
            if($d['year'])   $qb->andWhere('c.year=:y')->setParameter('y',$d['year']);
            if($f->get('category')->getData())
                $qb->andWhere('cat.name LIKE :c')->setParameter('c','%'.$f->get('category')->getData().'%');
        }

        $perPage = max(1,(int)$request->query->get('itemsPerPage',10));
        $pagi = $request->paginate($qb,$request->query->getInt('page',1),$perPage);

        return $this->render('cars/index.html.twig',[
            'filterForm'=>$f->createView(),
            'pagination'=>$pagi
        ]);
    }

    #[Route('/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarForm::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_show', methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_car_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarForm::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_delete', methods: ['POST'])]
    public function delete(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_car_index', [], Response::HTTP_SEE_OTHER);
    }
}
