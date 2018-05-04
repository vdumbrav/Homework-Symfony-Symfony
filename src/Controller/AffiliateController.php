<?php

namespace App\Controller;

use App\Entity\Affiliate;
use App\Form\AffiliateType;
use App\Repository\AffiliateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/affiliate")
 */
class AffiliateController extends Controller
{
    /**
     * @Route("/", name="affiliate_list", methods="GET")
     */
    public function list(AffiliateRepository $affiliateRepository): Response
    {
        return $this->render('affiliate/index.html.twig', ['affiliates' => $affiliateRepository->findAll()]);
    }

    /**
     * @Route("/{id}", name="affiliate_show", methods="GET")
     */
    public function show(Affiliate $affiliate): Response
    {
        return $this->render('affiliate/show.html.twig', ['affiliate' => $affiliate]);
    }

}
