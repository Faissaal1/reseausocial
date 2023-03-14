<?php

namespace App\Controller;

use App\Entity\users;
use App\Entity\Follows;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
class FollowsController extends AbstractController
{
     /**
     * @Route("/follow{id}", name="follow")
     * * @param Request $request
 * @param Users $users
 * @return Response
 */
     
    public function follow(Request $request, Users $user): Response
    {
        // Vérifiez si l'utilisateur connecté suit déjà l'utilisateur 
        $currentUsers = $this->getUser();
        if ($currentUsers->isFollowing($user)) {
            // Si oui, affichez un message d'erreur
            $this->addFlash('danger', 'Vous suivez déjà cet utilisateur.');
            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        // Créez une nouvelle relation de suivi
        $follower = new Follower();
        $follower->setFollower($currentUsers);
        $follower->setFollowing($user);

        // Enregistrez la relation de suivi en base de données
  
        $manager->persist($follower);
        $manager->flush();

        // Affichez un message de succès
        $this->addFlash('success', 'Vous suivez maintenant cet utilis');
        return $this->render('friends/index.html.twig');
    }   
}
