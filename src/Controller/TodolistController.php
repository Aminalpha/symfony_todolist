<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Todolist;
use App\Form\TodolistType;
use App\Repository\AuthorsRepository;
use App\Repository\TodolistRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodolistController extends AbstractController
{

    public function __construct(AuthorsRepository $authorRepository, TodolistRepository $todolistRepository, ObjectManager $em)
    {
        $this->authorRepository = $authorRepository;
        $this->todolistRepository = $todolistRepository;
        $this->em = $em;
    }

    public function index():Response
    {
        $todolistRepository = $this->todolistRepository;
        $todolists = $todolistRepository->findAll();
        return $this->render('home.html.twig', compact('todolists'));
    }
    /**
     * @Route("create/new", name="create.new")
     */

    public function new(Request $request)
    {
        $todolist = new Todolist();
        $form = $this->createForm(TodolistType::class, $todolist, 
        ["authorRepository"=> $this->authorRepository]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($todolist);
            $this->em->flush();
            return $this->redirectToroute('home');
        }
        
        return $this->render('create.html.twig', [
            'todolist' => $todolist,
            'form' => $form->createView()
        ]);
    }

}