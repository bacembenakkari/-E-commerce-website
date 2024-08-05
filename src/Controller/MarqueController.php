<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Marque;
use App\Entity\Voiture;
use App\Form\MarqueType;
use App\Form\VoitureType;
use App\Form\MarqueEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


class MarqueController extends AbstractController
{    /**
    * @Route("/marque", name="show_marques")
    */
   public function showMarques(): Response
   {
       $repository = $this->getDoctrine()->getRepository(Marque::class);
       $marques = $repository->findAll();

       return $this->render('marque/index.html.twig', [
           'marques' => $marques,
       ]);
   }
    #[Route('/marque', name: 'app_marque')]
    public function index(): Response
    {
        return $this->render('marque/index.html.twig', [
            'controller_name' => 'MarqueController',
        ]);
    }
    /**
     * @Route("/marque/add", name="add_marque")
     */
    public function addM(Request $request)
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // Utilisation correcte de getDoctrine()
            $em->persist($marque); // Utilisation de la flèche pour appeler la méthode persist()
            $em->flush(); // Utilisation de la flèche pour appeler la méthode flush()
            return $this->redirectToRoute('app_marque');
        }
        return $this->render('marque/addm.html.twig', ['f' => $form->createView()]);
    }
    
   /**
    
*@Route("/voiture/add", name="add_voiture")
*/
  public function ajouter(Request $request){$voiture = new Voiture();$form = $this->createForm(VoitureType::class, $voiture);$form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // No need to manually handle file upload

        // Persist and flush the entity
        $em = $this->getDoctrine()->getManager();
        $em->persist($voiture);
        $em->flush();

        return $this->redirectToRoute('app_marque');
    }

    return $this->render('voiture/ajouter.html.twig', ['f' => $form->createView()]);
}
      /**
        * @Route("/voitures", name="show_voitures")
        */

    public function showVoitures(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Voiture::class);
        $voitures = $repository->findAll();
        $publicPath = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath().'/images/voiture/';

        return $this->render('voiture/show.html.twig', [
            'voitures' => $voitures,
            'publicPath' => $publicPath, // Utiliser une virgule pour assigner la variable à la clé 'publicPath'
        ]);
    }

    /**
     * @Route("/marque/{id}/edit", name="edit_marque")
     */
    public function editAll(Request $request, Marque $marque)
    {
        $form = $this->createForm(MarqueEditType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_marque');
        }

        return $this->render('marque/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
 * @Route("/supp/{id}", name="marq_delete")
 */
public function delete(Request $request, $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $marqueRepository = $entityManager->getRepository(Marque::class);
    $voitureRepository = $entityManager->getRepository(Voiture::class);

    $marque = $marqueRepository->find($id);

    if (!$marque) {
        throw $this->createNotFoundException('No marque found for id ' . $id);
    }

    $voitures = $voitureRepository->findBy(['marque' => $marque]);

    foreach ($voitures as $voiture) {
        $entityManager->remove($voiture);
    }

    $entityManager->flush(); // Supprime d'abord les voitures

    $entityManager->remove($marque); // Supprime ensuite la marque
    $entityManager->flush();

    return $this->redirectToRoute('app_marque');
}


}
