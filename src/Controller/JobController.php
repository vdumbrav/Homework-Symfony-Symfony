<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/{id}", name="job.show", methods="GET", requirements={"id" = "\d+"})
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', ['job' => $job]);
    }

    /**
     * @Route("/create", name="job.create")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function createAction(Request $request, EntityManagerInterface $em): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job.list');
        }

        return $this->render('job/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
