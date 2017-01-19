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
use BoosterBundle\Form\ActorRegistrationType;
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

                //recupération de l'adresse totale
                $plainAddress = str_replace(' ', '%20', $user->getAddress()) . '%20' . $user->getCp() . '%20' . str_replace(' ', '%20', $user->getTown());

                $result = $this->geocodeAction($plainAddress);
                $lat = $result[0];
                $lgt = $result[1];
                $user->setLat($lat);
                $user->setLgt($lgt);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush($user);


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


    public function actorRegisterAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->addRole('ROLE_ACTOR');
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $formFactory->create(new ActorRegistrationType($this->container->getParameter("fos_user.model.user.class")));
        $form->setData($user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);

                //recupération de l'adresse totale
                $plainAddress = str_replace(' ', '%20', $user->getAddress()) . '%20' . $user->getCp() . '%20' . str_replace(' ', '%20', $user->getTown());
                $result = $this->geocodeAction($plainAddress);
                $lat = $result[0];
                $lgt = $result[1];
                $user->setLat($lat);
                $user->setLgt($lgt);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush($user);

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
        return $this->render('BoosterBundle:Registration:formActor.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     *
     * We use this API to recover latitude and longitude.
     *
     * */
    public function geocodeAction($plainAddress){
        $user = new User();


        $url = "https://maps.google.com/maps/api/geocode/json?address=". $plainAddress ."&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";
// get the json response
        $resp_json = file_get_contents($url);
// decode the json
        $resp = json_decode($resp_json, true);
// response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {
            // get the important data

            //ici il récupére les données du fichier Json générer plus haut
            $lat = $resp['results'][0]['geometry']['location']['lat'];
            $lgt = $resp['results'][0]['geometry']['location']['lng'];
            // verify if data is complete
// je veux retourner la latidude et la longitude a mon mayorController
           return array($lat, $lgt);


            }
        }

}