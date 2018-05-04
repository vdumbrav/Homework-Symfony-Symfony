<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
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
     * @Route("/", name="job_list", methods="GET")
     * @param JobRepository $jobRepository
     * @return Response
     */
    public function list(JobRepository $jobRepository): Response
    {
        return $this->render('job/index.html.twig', ['jobs' => $jobRepository->findAll()]);
    }

    /**
     * @Route("/{id}", name="job_show", methods="GET")
     * @param Job $job
     * @return Response
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', ['job' => $job]);
    }
}
