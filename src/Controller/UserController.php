<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Model\UserModel as model;

class UserController extends AbstractController
{



    private $model;


    public function __construct(model $model)
    {
        $this->model = $model;
    }






    /**
     * Listar usuario
     * @Route("/user", name="user.index")
     * @return Response
     */
    public function index(): Response
    {
        $data_users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', compact('data_users'));
    }







    /**
     * Crear un usuario
     * @Route("/user/create", name="user.create")
     * @return Response
     */
    public function create(): Response
    {
    	return $this->render('user/create.html.twig');
    }





    /**
    * Guardar un usuario
    * @Route("/user/store", name="user.store")
    * @param Request $request
    * @return Response
    */
    public function store(Request $request): Response
    {
        $user = $this->model->storeUser($request);

        return $this->redirectToRoute('user.index');
    }






    /**
    * Detalles de un usuario
    * @Route("/user/{id}/show", name="user.show")
    * @return Response
    */
    public function show(int $id): Response
    {
        $user = $this->model->showUser($id);

        return $this->render('user/show.html.twig', compact('user'));
    }






    /**
    * Edita un usuario
    * @Route("/user/{id}/edit", name="user.edit")
    * @return Response
    */
    public function edit(int $id): Response
    {
        $user = $this->model->editUser($id);

        return $this->render('user/edit.html.twig',compact('user'));
    }






    /**
    * Actualizar un usuario
    * @Route("/user/{id}/update", name="user.update")
    * @param Request $request
    * @return Response
    */
    public function update(Request $request, int $id): Response
    {
        $user = $this->model->updateUser($request, $id);

    	return $this->redirectToRoute('user.index');
    }






    /**
    * Eliminar usuario
    * @Route("/user/{id}/destroy", name="user.destroy")
    * @return Response
    */
    public function destroy(Request $request, int $id): Response
    {
        $submittedToken = $request->request->get('token');
        
        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('delete-user', $submittedToken)) {
            // ... do something, like deleting an object
            $data = $this->model->destroyUser($id);
        }
        else{
             dd('Token invalido');
        }


        return $this->redirectToRoute('user.index');
    }
}
