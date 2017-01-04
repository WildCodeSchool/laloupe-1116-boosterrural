<?php
/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BoosterBundle\Controller;

use BoosterBundle\Entity\User;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use BoosterBundle\Form\MayorRegistrationType;
use BoosterBundle\Form\CitizenRegistrationType;

class RegistrationController extends BaseController
{
    public function mayorRegisterAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_MAYOR');
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $formFactory->create(new MayorRegistrationType($this->container->getParameter("fos_user.model.user.class")));
        $form->setData($user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);


                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
            }
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);
            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('BoosterBundle:Registration:formMayor.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function citizenRegisterAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_CITIZEN');
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $formFactory->create(new CitizenRegistrationType($this->container->getParameter("fos_user.model.user.class")));
        $form->setData($user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
            }
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);
            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('BoosterBundle:Registration:formCitizen.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     *
     * We use this API to recover latitude and longitude.
     *
     * */
    public function geocode($address, $cp, $town){
        $user = new User();
        // Récupération de l'adresse totale
        $plainAddress= str_replace(' ', '%20', $address). '%20' . $cp . '%20' . $town;
        $url = "https://maps.google.com/maps/api/geocode/json?address=". $plainAddress ."&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";
// get the json response
        $resp_json = file_get_contents($url);
// decode the json
        $resp = json_decode($resp_json, true);
// response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {
            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            // verify if data is complete
            if ($lati && $longi) {
                $user->setLat($lati);
                $user->setLgt($longi);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush($user);
            }
        }
    }

    public function checkEmailAction()
    {
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');

        if (empty($email)) {
            return new RedirectResponse($this->get('router')->generate('fos_user_registration_register'));
        }

        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }

        return $this->render('BoosterBundle::home_page_no_connect.html.twig', array(
            'user' => $user,
        ));
    }
}