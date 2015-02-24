<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Session', 'Form');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	
	//set object model
	var $uses = array('User');
	
	//set layout
	var $layout = 'login';
	
	public function index(){
		$this->set('users', $this->User->find('all'));
	}
	
	public function view($id = null){
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$user = $this->User->findById($id);
		if (!$user) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('user', $user);
	}
	
	public function Login(){
		
		if($this->request->is('post'))
		{
		
		//get data from User table
			$Rows = $this->User->find('count');
			$UserData = $this->User->find('all');
			$Username = $this->request->data['User']['username'];
			$Password = $this->request->data['User']['password'];
			
			//loop check PenName and Password
			for($i=0;$i<$Rows;$i++)
			{
				//match case
				if($UserData[$i]['User']['username']==$Username&&
					$UserData[$i]['User']['password']==$Password)
				{
					if($UserData[$i]['User']['role']=='admin')
					{
						$this->Session->write('user_type','admin');
					}
					else if($UserData[$i]['User']['role']=='author')
					{
						$this->Session->write('user_type','author');
					}
					$this->Session->setFlash("Login success");
					$this->redirect(array(
						'controller' => 'Users',
						'action' => 'index'	
					));
				}
				//mismatch case
				else
				{
					$this->Session->setFlash('Username or Password are incorrect');
				}
			}//end for loop
		}//end if request data 
		
	}
	
	public function Logout(){
		$this->Session->delete('user_type');
		$this->redirect(array(
			'action' => 'login'
		));
	}
	
	public function Add(){
		
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'login'));
			}
			$this->Session->setFlash(
					__('The user could not be saved. Please, try again.')
			);
		}
	}
	
	public function Delete($id = null){
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->User->delete($id)) {
			$this->Session->setFlash(
					__('The post with id: %s has been deleted.', h($id))
			);
		} else {
			$this->Session->setFlash(
					__('The post with id: %s could not be deleted.', h($id))
			);
		}
		
		return $this->redirect(array('action' => 'index'));
	}
	
	public function Edit($id = null){
		
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$user = $this->User->findById($id);
		if (!$user) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your post.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $user;
			$this->set('user',$user);

		}
		
	}
	

}//end class
