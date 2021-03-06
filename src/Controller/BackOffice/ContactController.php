<?php

namespace App\Controller\BackOffice;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * Class Controller
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("contact/liste", name="contact_liste")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('App:Contact')->listeContact();

        $contacts = $paginator->paginate($query, $request->query->get('page', 1), 12);

        return $this->render('backOffice/contact/liste.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @Route("contact/voir-message/{id}", name="voir_message")
     */
    public function voir($id)
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('App:Contact')->find($id);

        return $this->render('backOffice/contact/voir_message.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @Route("contact/ajouter", name="contact_ajouter")
     */
    public function ajouter(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact->setDateMessage(new \dateTime());
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');

            return $this->redirectToRoute('contact_ajouter');
        }
        return $this->render('frontOffice/user/registre.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}


