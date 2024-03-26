<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(HttpFoundationRequest $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $success = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $adresse = $data['email'];
            $lastName = $data['nom'];
            $fisrtName = $data['prenom'];
            $phone = $data['telephone'];
            $object = $data['object'];
            $confidencionality = $data['confidencionality'];
            $messageContent = '<p> Nouveau message recu de ' . $fisrtName . ' ' . $lastName . ' <br> message: <br> ' . $data['message'] . ' <br> tel:' . $phone . ' </p>';

            $email = (new Email())
                ->from($adresse)
                ->to('sg.jiri@gmail.com')
                ->subject($object)
                ->html($messageContent);

            $mailer->send($email);
            $success = "Votre email a été bien envoyé";
        }

        return $this->renderForm('page/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form, 'success' => $success
        ]);
    }
}
