<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * @Route("/", name="job.list", methods="GET")
     * @return Response
     */
    public function list(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findCategoriesWithActiveJobs();

        return $this->render('job/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/{id}", name="job.show", methods="GET")
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', ['job' => $job]);
    }
}
