<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//Your Controller MUST contain these Uses:
//Your Controller MUST contain these Uses:
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormulaireType;
use App\Entity\Formulaire;
use App\Repository\FormulaireRepository;


class FormulaireController extends AbstractController
{
    #[Route('/formulaire', name: 'app_formulaire')]
    public function index(): Response
    {
        return $this->render('book/Affiche.html.twig', [
            'controller_name' => 'FormulaireController',
        ]);
    }

    #[Route('/f', name: 'app_Add')]
    public function addformbook(ManagerRegistry $managerRegistry,Request $req ): Response
    {
        $em=$managerRegistry->getmanager();
        $bookr=new Formulaire();
        $form = $this->createForm(FormulaireType::class, $bookr);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid())
        {
        $em->persist($bookr);
        $em->flush();
        // return $this->redirectToRoute('app_Affiche');
        }
         return $this->renderform('formulaire/Add.html.twig',
         ['f'=>$form]);

        }

    



        #[Route('/A', name: 'app_Affiche')]


    public function Affiche (FormulaireRepository $repository)
        {
            $formulaire=$repository->findAll() ; //select *
            return $this->render('formulaire/Affichage.html.twig',['formulaire'=>$formulaire]);
        }
        



}