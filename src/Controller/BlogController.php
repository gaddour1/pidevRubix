<?php

namespace App\Controller;
use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {$blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findAll();
        return $this->render('blog/index.html.twig', [
            'b'=>$blogs
        ]);
    }



    #[Route('/addb', name: 'add_blog')]
    public function addblog(Request $request): Response
    {
   
        $blog=new Blog() ;
    $form = $this->createForm(BlogType::class,$blog);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);//Add
            $em->flush();

            return $this->redirectToRoute('app_blog');
        }
        return $this->render('blog/createBlog.html.twig',['f'=>$form->createView()]);

    }


    #[Route('/removeBlog/{id}', name: 'supp_blog')]
    public function suppressionBlog(Blog  $blog): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($blog);
        $em->flush();

        return $this->redirectToRoute('app_blog');

    }

    #[Route('/modifBmog/{id}', name: 'modif_blog')]
    public function modifBlog(Request $request,$id): Response
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->find($id);

        $form = $this->createForm(BlogType::class,$blog);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_blog');
        }
        return $this->render('blog/updateBlog.html.twig',['f'=>$form->createView()]);

    
    }


    #[Route('/admin', name: 'display_blog')]
    
    public function indexAdmin(): Response
    {

        return $this->render('Admin/index.html.twig');
    }


    #[Route('/video', name: 'display_video')]
    
    public function video(): Response
    {

        return $this->render('blog/video.html.twig');
    }







    
}

