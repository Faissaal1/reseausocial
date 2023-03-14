<?php

namespace App\Controller;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Publication;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PublicationType;
class PublicationController extends AbstractController
{
    #[Route('/publication', name: 'app_publication')]
    public function index(): Response
    {
        return $this->render('publication/index.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }


     /**
    * @Route("/create", name="post_create")
    */
    public function create(Request $request)
    {
        $publication = new Publication();


        $form = $this->createForm(PublicationType::class, $publication);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $file */
            $file = $request->files->get('publication');
            $file = $file['message'];
            if ($file) {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $file->move(
                    $this->getParameter('uploads_dir') ,
                    $filename
                );

                $post->setImage($filename);
            }

            $em -> persist($publication);
            $em -> flush();

            $this->addFlash('success', "post: {$publication->getTitle()}, was created");
            return $this->redirect($this->generateUrl("post_index"));
        }

        return $this->render('publication/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

