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

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $adresse = $data['email'];
            $lastname = $data['Nom'];
            $fisrtname = $data['Prenom'];
            $phone = $data['Telephone'];
            $object = $data['Object'];
            $message = $data['Message'];
            $email = (new Email())
                ->from($adresse)
                ->to('sg.jiri@gmail.com')
                ->subject($object)
                ->html('<p> Nouveau message recu de '.$fisrtname.' '.$lastname.' <br> message: <br> '.$message.' <br> tel:'.$phone.' </p>');
            $mailer->send($email);
            // dd($mailer);
        }
        return $this->renderForm('page/contact.html.twig', [
            'controller_name' => 'ContactController', 'formulaire' => $form
        ]);
    }
}
