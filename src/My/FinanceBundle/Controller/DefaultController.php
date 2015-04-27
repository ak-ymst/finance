<?php

namespace My\FinanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyFinanceBundle:Default:index.html.twig', array('name' => 'MyFinance'));
    }
}
