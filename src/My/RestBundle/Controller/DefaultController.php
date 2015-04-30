<?php

namespace My\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\FinanceBundle\Entity\Dealing;
use \DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyFinanceBundle:Dealing')->findByDateBetween('2015-04-28', '2015-04-30');

        $serializer = $this->container->get('serializer');
        $dealings = $serializer->serialize($entities, 'json');

        var_dump($dealings);die;

        
        
        return $this->render('MyRestBundle:Default:index.html.twig', array('name' => $name));
    }

    
    /**
     * Lists all Dealing entities as JSON
     *
     */
    public function dealingListAction($from, $to)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyFinanceBundle:Dealing')->findByDateBetween(date('Y-m-d', strtotime($from)), date('Y-m-d H:i:s', strtotime($to)));

        $serializer = $this->container->get('serializer');
        $dealings = $serializer->serialize($entities, 'json');
        
        return new JsonResponse(array('dealings'=>$dealings));
    }
    
    /**
     * one Dealing entity as JSON
     *
     */
    public function dealingShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyFinanceBundle:Dealing')->find($id);

        $serializer = $this->container->get('serializer');
        $dealing = $serializer->serialize($entity, 'json');

        return new JsonResponse(array('dealing'=>$dealing));
    }
    
    /**
     * Lists all DealingType entities as JSON
     *
     */
    public function dealingTypeListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyFinanceBundle:DealingType')->findAll();

        $serializer = $this->container->get('serializer');
        $dealingTypes = $serializer->serialize($entities, 'json');

        return new JsonResponse(array('dealingTypes'=>$dealingTypes));
    }
    
    /**
     * regist Dealing entity 
     *
     */
    public function dealingRegistAction(Request $request)
    {
        $logger = $this->get('logger');
        $logger->info('regist');

        $em = $this->getDoctrine()->getManager();
        
        $dealing = $request->request->get('dealing');

        $entity = new Dealing();
        $entity->setDate(new DateTime($dealing['date']));
        $entity->setAmount($dealing['amount']);
        $entity->setClient($dealing['client']);
        if (isset($dealing['description'])) {
            $entity->setDescription($dealing['description']);
        }

        $type = $em->getRepository('MyFinanceBundle:DealingType')->find($dealing['dealing_type_id']);
        $entity->setDealingType($type);
        
        $em->persist($entity);
        $em->flush();
        
        return new JsonResponse(array('id'=>$entity->getId()));
    }
}
