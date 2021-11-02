<?php

namespace App\Model;

use App\Dao\UserDao as userDao;
use Symfony\Component\HttpFoundation\Request;

class UserModel
{


	private $userDao;


	function __construct(userDao $userDao)
	{
		$this->userDao = $userDao;
	}






	public function storeUser($request)
	{

		if($request->request->get('password') == $request->request->get('password-confirmation'))
		{
			$user_request = $request;
       		$data = $this->userDao->save($user_request->request);
		}
		else{
			$data = 'Las contraseñas no coinciden.';
		}

		return $data;
	}






	public function editUser($id)
	{

		if (is_numeric($id))
		{
       		$data = $this->userDao->edit($id);
		}
		else{
			$data = ' El id debe ser numerico';
		}

		return $data;
	}






	public function updateUser($request, $id)
	{

		if (is_numeric($id))
		{
       		$user_request = $request;
       		$data = $this->userDao->update($user_request->request, $id);
		}
		else{
			$data = ' El id debe ser numerico';
		}

		return $data;
	}





	public function showUser($id)
	{
		if(is_numeric($id))
		{
			$data = $this->userDao->show($id);
		}
		else{
			$data = 'El id debe ser numerico';
		}

		return $data;
	}





	public function destroyUser($id)
	{
		if(is_numeric($id))
		{	
			$data = $this->userDao->destroy($id);
		}
		else{
			$data = 'El id debe ser numerico';
		}

		return $data;
	}

	// protected function isCsrfTokenValid(string $id, ?string $token): bool
 //    {
 //        if (!$this->container->has('security.csrf.token_manager')) {
 //            throw new \LogicException('CSRF protection is not enabled in your application. Enable it with the "csrf_protection" key in "config/packages/framework.yaml".');
 //        }

 //        return $this->container->get('security.csrf.token_manager')->isTokenValid(new CsrfToken($id, $token));
 //    }
}
?>