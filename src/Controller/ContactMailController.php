<?php

namespace App\Controller;

use App\Entity\ContactMail;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactMailController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_form')]
    public function contactForm(Request $request, MailerInterface $mailer): Response
    {
        $contactMail = new ContactMail();
        $form = $this->createForm(ContactFormType::class, $contactMail);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactMail = $form->getData();

            $email = (new Email())
                ->from($contactMail->getEmail())
                ->to('your-email@example.com')
                ->subject($contactMail->getSujet())
                ->text($contactMail->getMessage());

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Redirection ou affichage d'une réponse appropriée
        }

        return $this->render('contact/form.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}