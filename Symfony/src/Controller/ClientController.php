<?php

namespace App\Controller;

use App\Form\ClientFilterType;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Client;
use App\Form\ClientForm;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/clients')]
final class ClientController extends AbstractController
{
    #[Route(name: 'app_client_index', methods: ['GET'])]
    public function index(Request $r, PaginatorInterface $p, ClientRepository $repo)
    {
        $qb = $repo->createQueryBuilder('c');

        $f=$this->createForm(ClientFilterType::class);
        $f->handleRequest($r);
        if($f->isSubmitted()&&$f->isValid()){
            $d=$f->getData();
            if($d['fullName'])
                $qb->andWhere('c.fullName LIKE :n')->setParameter('n','%'.$d['fullName'].'%');
            if($d['phone'])
                $qb->andWhere('c.phone LIKE :p')->setParameter('p','%'.$d['phone'].'%');
            if($d['email'])
                $qb->andWhere('c.email LIKE :e')->setParameter('e','%'.$d['email'].'%');
        }

        $per=max(1,(int)$r->query->get('itemsPerPage',10));
        $pg=$p->paginate($qb,$r->query->getInt('page',1),$per);

        return $this->render('clients/index.html.twig',[
            'filterForm'=>$f->createView(),
            'pagination'=>$pg
        ]);
    }


    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('clients/show.html.twig', [
            'clients' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientForm::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('clients/edit.html.twig', [
            'clients' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
