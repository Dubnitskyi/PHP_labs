<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Rental;
use App\Form\RentalForm;
use App\Repository\RentalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rental')]
final class RentalController extends AbstractController
{
    #[Route(name: 'app_rental_index', methods: ['GET'])]
    public function index(Request $r,PaginatorInterface $p)
    {
        $qb=$this->getDoctrine()->getRepo(Rental::class)
            ->createQueryBuilder('r')
            ->join('r.car','c')
            ->join('r.clients','cli');

        $f=$this->createForm(RentalFilterType::class);
        $f->handleRequest($r);
        if($f->isSubmitted()&&$f->isValid()){
            $d=$f->getData();
            if($d['rentFrom'])
                $qb->andWhere('r.rentFrom>=:f')->setParameter('f',$d['rentFrom']);
            if($d['rentTo'])
                $qb->andWhere('r.rentTo<=:t')->setParameter('t',$d['rentTo']);
            if($f->get('car')->getData())
                $qb->andWhere('c.model LIKE :m')->setParameter('m','%'.$f->get('car')->getData().'%');
            if($f->get('clients')->getData())
                $qb->andWhere('cli.fullName LIKE :n')->setParameter('n','%'.$f->get('clients')->getData().'%');
        }

        $per=max(1,(int)$r->query->get('itemsPerPage',10));
        $pg=$p->paginate($qb,$r->query->getInt('page',1),$per);

        return $this->render('rentals/index.html.twig',[
            'filterForm'=>$f->createView(),'pagination'=>$pg
        ]);
    }


    #[Route('/new', name: 'app_rental_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rental = new Rental();
        $form = $this->createForm(RentalForm::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rental);
            $entityManager->flush();

            return $this->redirectToRoute('app_rental_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rental/new.html.twig', [
            'rental' => $rental,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rental_show', methods: ['GET'])]
    public function show(Rental $rental): Response
    {
        return $this->render('rental/show.html.twig', [
            'rental' => $rental,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rental_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rental $rental, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RentalForm::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rental_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rental/edit.html.twig', [
            'rental' => $rental,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rental_delete', methods: ['POST'])]
    public function delete(Request $request, Rental $rental, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rental->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rental);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rental_index', [], Response::HTTP_SEE_OTHER);
    }
}
