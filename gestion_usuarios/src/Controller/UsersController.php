<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class UsersController extends AbstractController
{
    #[Route('/', name: 'app_users')]
    public function index(Request $request, UserRepository $userRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $userRepository->paginationQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        // parameters to template
        return $this->render('index.html.twig', ['pagination' => $pagination]);
    }

    #[Route('/create', name: 'create_user')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setNombre($request->request->get('nombre'));
            $user->setApellidos($request->request->get('apellidos'));
            $user->setFecnac(new \DateTime($request->request->get('fecnac')));
            $user->setSexo($request->request->get('sexo'));
            $user->setEstado(1);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_users');
        }

        return $this->render('create.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit_user')]
    public function edit(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if ($request->isMethod('POST')) {
            $user->setNombre($request->request->get('nombre'));
            $user->setApellidos($request->request->get('apellidos'));
            $user->setFecnac(new \DateTime($request->request->get('fecnac')));
            $user->setSexo($request->request->get('sexo'));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_users');
        }

        return $this->render('edit.html.twig', ['user' => $user]);
    }

    #[Route('/delete/{id}', name: 'delete_user')]
    public function delete(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_users');
    }

    #[Route('/baja/{id}', name: 'baja_user')]
    public function baja(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $user->setEstado(0);
        $entityManager->flush();

        return $this->redirectToRoute('app_users');
    }

    #[Route('/alta/{id}', name: 'alta_user')]
    public function alta(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $user->setEstado(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_users');
    }
}
