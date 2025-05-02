<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Payment;
use App\Form\PaymentForm;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/payment')]
final class PaymentController extends AbstractController
{
    #[Route(name: 'app_payment_index', methods: ['GET'])]
    public function index(Request $r,PaginatorInterface $p)
    {
        $qb=$this->getDoctrine()->getRepo(Payment::class)
            ->createQueryBuilder('p')
            ->join('p.rental','r');

        $f=$this->createForm(PaymentFilterType::class);
        $f->handleRequest($r);
        if($f->isSubmitted()&&$f->isValid()){
            $d=$f->getData();
            if($d['amount'])
                $qb->andWhere('p.amount=:a')->setParameter('a',$d['amount']);
            if($d['paidAt'])
                $qb->andWhere('p.paidAt=:d')->setParameter('d',$d['paidAt']);
            if($d['method'])
                $qb->andWhere('p.method LIKE :m')->setParameter('m','%'.$d['method'].'%');
            if($f->get('rental')->getData())
                $qb->andWhere('r.id=:rid')->setParameter('rid',$f->get('rental')->getData());
        }

        $per=max(1,(int)$r->query->get('itemsPerPage',10));
        $pg=$p->paginate($qb,$r->query->getInt('page',1),$per);

        return $this->render('payments/index.html.twig',[
            'filterForm'=>$f->createView(),'pagination'=>$pg
        ]);
    }


    #[Route('/new', name: 'app_payment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentForm::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($payment);
            $entityManager->flush();

            return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payment/new.html.twig', [
            'payment' => $payment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payment_show', methods: ['GET'])]
    public function show(Payment $payment): Response
    {
        return $this->render('payment/show.html.twig', [
            'payment' => $payment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_payment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Payment $payment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaymentForm::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payment/edit.html.twig', [
            'payment' => $payment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payment_delete', methods: ['POST'])]
    public function delete(Request $request, Payment $payment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($payment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
    }
}
