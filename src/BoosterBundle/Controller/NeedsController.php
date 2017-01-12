<?php
namespace BoosterBundle\Controller;
use BoosterBundle\Entity\Needs;
use BoosterBundle\Form\NeedsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Need controller.
 *
 */
class NeedsController extends Controller
{
    /**
     * Lists all need entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $needs = $em->getRepository('BoosterBundle:Needs')->findAll();
<<<<<<< HEAD
=======

>>>>>>> 5d6259fe70bb7f350b1e192b133ca18fb233f814
        return $this->render('BoosterBundle:Needs:mayor.index.html.twig', array(
            'needs' => $needs,
        ));
    }
    /**
     * Creates a new need entity.
     *
     */
    public function newAction(Request $request)
    {
        $needs = new Needs();
        $form = $this->createForm('BoosterBundle\Form\NeedsType', $needs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);
            return $this->redirectToRoute('needs_show', array('id' => $needs->getId()));
        }
<<<<<<< HEAD
=======

>>>>>>> 5d6259fe70bb7f350b1e192b133ca18fb233f814
        return $this->render('BoosterBundle:Needs:mayor.new.html.twig', array(
            'need' => $needs,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a need entity.
     *
     */
    public function ShowAction(Needs $need)
    {
        $deleteForm = $this->createDeleteForm($need);
        return $this->render('BoosterBundle:Needs:mayor.show.html.twig', array(
            'need' => $need,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing need entity.
     *
     */
    public function EditAction(Request $request, Needs $need)
    {
        $deleteForm = $this->createDeleteForm($need);
        $editForm = $this->createForm('BoosterBundle\Form\NeedsType', $need);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('needs_edit', array('id' => $need->getId()));
        }
<<<<<<< HEAD
=======

>>>>>>> 5d6259fe70bb7f350b1e192b133ca18fb233f814
        return $this->render('BoosterBundle:Needs:mayor.edit.html.twig', array(
            'need' => $need,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a need entity.
     *
     *
     */
    public function DeleteAction(Request $request, Needs $need)
    {
        $form = $this->createDeleteForm($need);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($need);
            $em->flush($need);
        }
        return $this->redirectToRoute('needs_index');
    }
    /**
     * Creates a form to delete a need entity.
     *
     * @param Needs $need The need entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Needs $need)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('needs_delete', array('id' => $need->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}