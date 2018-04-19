<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;


class TaskController extends Controller
{
    /**
     * @Route("/taskManage/{idTask}", name="Task_managetk")
     */
    public function indexAction($idTask)
    {
        $em = $this->getDoctrine()->getEntityManager();
		$tmpTask = $em->getRepository('AppBundle:Task')->find($idTask);
		
        return $this->render('default/task.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'task' => $tmpTask
        ]);
    }
	
	 /**
     * 
	 *	 
	 *@Route("/taskManage/remove/{idTask}",requirements={"idTask" = "\d+"} ,name="remove_tasktm")
	 * 
     */
    public function RemoveAction($idTask)
    {
		echo $idTask;
        $em = $this->getDoctrine()->getEntityManager();
		$tmpTask = $em->getRepository('AppBundle:Task')->find($idTask);
		$em->remove($tmpTask);
		$em->flush();
		
		$this->addFlash(
			'notice',
			'Task '. $tmpTask->getLabel().' has been updated correctly'
		);
		
		return $this->redirect( $this->generateUrl('homepage') );
    }
	
	/**
     * 
	 *	 
	 *@Route("/taskManage/completeTask/{idTask}",requirements={"idTask" = "\d+"} ,name="complete_tasktm")
	 * 
     */
    public function completeAction($idTask)
    {
		echo $idTask;
        $em = $this->getDoctrine()->getEntityManager();
		$tmpTask = $em->getRepository('AppBundle:Task')->find($idTask);
		$tmpTask->setComplete(true);
		$em->flush();
		
		$this->addFlash(
			'notice',
			'Task '. $tmpTask->getLabel().' has been updated correctly'
		);
		return $this->redirect( $this->generateUrl('homepage') );
    }
}
