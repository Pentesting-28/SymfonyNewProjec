<?php
namespace App\Dao;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


/**
 * UserDao
 */
class UserDao
{


	private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }






    public function save($user_request)
    {
        $user = new User();

        $user->setName($user_request->get('name'));
        $user->setLastName($user_request->get('last_name'));
        $user->setEmail($user_request->get('email'));
        $user->setDocument($user_request->get('document'));
        $user->setPassword($user_request->get('password'));

        $this->em->persist($user);

        $this->em->flush();

        return $user;
    }






    public function edit($id)
    {
        $user = $this->em->getRepository(User::class)
                         ->find($id);
        return $user;
    }





    
    public function update($user_request, $id)
    {
        $user = $this->em->getRepository(User::class)
                         ->find($id);

        $user->setName($user_request->get('name'));
        $user->setLastName($user_request->get('last_name'));
        $user->setEmail($user_request->get('email'));
        $user->setDocument($user_request->get('document'));

        $this->em->persist($user);

        $this->em->flush();

        return $user;
    }





    public function show($id)
    {
        $user = $this->em->getRepository(User::class)
                         ->find($id);
        return $user;
    }





    public function destroy($id)
    {
        $user = $this->em->getRepository(User::class)
                         ->find($id);
                         
        $this->em->remove($user);
        
        $this->em->flush();

        return $user;
    }
}
?>