<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Le contrôleur gère la logique de la page de contact.
 * Il étend AbstractController qui fournit des méthodes de base pour les contrôleurs dans Symfony.
 */
class ContactController extends AbstractController
{
    /**
     * Traite la demande de contact et envoie un email si le formulaire est soumis et valide.
     *
     * @param HttpFoundationRequest $request La requête HTTP.
     * @param MailerInterface $mailer Le service de messagerie pour envoyer des emails.
     * @return Response La réponse HTTP.
     */
    #[Route('/contact', name: 'app_contact')]
    public function index(HttpFoundationRequest $request, MailerInterface $mailer): Response
    {
        // Crée le formulaire de contact et gère la soumission des données.
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // Initialise une variable pour stocker un message de succès.
        $success = "";

        // Vérifie si le formulaire a été soumis et est valide.
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupère les données soumises du formulaire.
            $data = $form->getData();

            // Construction du contenu de l'email.
            $data = $form->getData();
            $adresse = $data['email'];
            $lastName = $data['nom'];
            $fisrtName = $data['prenom'];
            $phone = $data['telephone'];
            $object = $data['object'];
            $confidencionality = $data['confidencionality'];
            $messageContent = '<p> Nouveau message recu de ' . $fisrtName . ' ' . $lastName . ' <br> message: <br> ' . $data['message'] . ' <br> tel:' . $phone . ' </p>';

            // Crée et configure l'objet Email pour l'envoi du message.
            $email = (new Email())
                ->from(sprintf('%s %s <%s>', $fisrtName, $lastName, 'contact@dubainausalon.fischer-j.eu')) // L'adresse email de l'expéditeur (peut être paramétrée).
                ->replyTo($data['email']) // Utilise l'adresse email de l'utilisateur comme adresse de réponse.
                ->to('contact@dubainausalon.fischer-j.eu') // L'adresse email du destinataire (peut être paramétrée).
                ->subject($data['object']) // Le sujet de l'email.
                ->html($messageContent); // Le contenu du message en HTML.

            // Envoie l'email.
            $mailer->send($email);

            // Met à jour le message de succès qui sera affiché à l'utilisateur.
            $success = "Votre email a été bien envoyé";
        }

        // Rend la vue en passant le formulaire et le message de succès.
        return $this->renderForm('page/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form,
            'success' => $success
        ]);
    }
}
