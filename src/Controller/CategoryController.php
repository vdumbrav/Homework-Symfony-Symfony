<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Job;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     *
     * @Route("/{slug}/{page}", name="category.show", defaults={"page":1}, requirements={"page" = "\d+"})
     * @Method("GET")
     *
     * @param Category $category
     * @param int $page
     * @param PaginatorInterface $paginator
     *
     * @return Response
     */

    public function show(
        Category $category,
        int $page,
        PaginatorInterface $paginator
    ): Response {
        $activeJobs = $paginator->paginate(
            $this->getDoctrine()
                ->getRepository(Job::class)
                ->getPaginatedActiveJobsByCategoryQuery($category),
            $page,
            $this->getParameter('max_job_on_category')
        );
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'activeJobs' => $activeJobs,
        ]);
    }
}
