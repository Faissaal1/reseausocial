<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageTypesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MessagesController extends AbstractController
{
    #[Route('/messages', name: 'messages')]
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(Request $request,  EntityManagerInterface $manager):Response
    {   
        $message = new Messages;
        $form= $this->createForm(MessageTypesType::class, $message); // initilialize le formulaire 

        $form->handleRequest($request); // recuperer formulaire dans l requete et le traiter

        if($form->isSubmitted() && $form->isValid()){ // si le formul eest envoyer et valide
           
            $message->setSender($this->getUser()); // expediteur 
           
            $message = $form->getData(); // recupere donner dans la database
            
            $manager->persist($message); // stocker donner
         
            $manager->flush(); // ecrire base de donner 
      
            
            $this->addFlash("message", "Le message a été envoyé."); 
            return $this->redirectToRoute("messages");
              
        }
        return $this->render("messages/send.html.twig", [
            "form" => $form->createView()
        ]);
    }
       /**
     * @Route("/received", name="received")
     */
    public function received(): Response
    {
        return $this->render('messages/received.html.twig');
    }


    /**
     * @Route("/sent", name="sent")
     */
    public function sent(): Response
    {
        return $this->render('messages/sent.html.twig');

    }

    #[Route('/read/{id}', name: 'read')]
    public function read(Messages $message,EntityManagerInterface $manager): Response
    {
       

   
        $manager->persist($message);
        $manager->flush();  
        return $this->render('messages/lire.html.twig',['message'=>$message]);
    }

    

    /**
     * @Route("/delete{id}", name="delete")
     */
    public function delete(Messages $message,EntityManagerInterface $manager): Response
    {
        
        $manager->remove($message);
        $manager->flush();

        return $this->redirectToRoute("received",['message'=>$message]);
    

    }
}