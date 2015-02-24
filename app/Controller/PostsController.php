<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostsController extends AppController {

	public $helpers = array('Html', 'Session', 'Form');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	//set object model
	var $uses = array('Post','Category');
	
	public function index(){
		$posts = $this->Post->find('all');
		$categories = $this->Category->find('all');
		$this->set('posts', $posts);
		$this->set('categories',$categories);

	}
	
	public function view($id = null){
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
	
		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
	}
	

	
	public function Add(){
	
	$this->set('categories',$this->Category->find('list'),array(
		'fields' => array('Category.names')
	));
		
	if ($this->request->is('post')) {
	$this->Post->create();
	if ($this->Post->save($this->request->data)) {
	$this->Session->setFlash(__('The post has been saved'));
	return $this->redirect(array('action' => 'index'));
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
	
					if ($this->Post->delete($id)) {
					$this->Session->setFlash(
							__('The post with id: %s has been deleted.', h($id))
						);
					} 
					else {
						$this->Session->setFlash(
								__('The post with id: %s could not be deleted.', h($id))
						);
					}
	
		return $this->redirect(array('action' => 'index'));
	}
	
	public function Edit($id = null){
		$this->set('categories',$this->Category->find('list'),array(
				'fields' => array('Category.names')
		));
	
					if (!$id) {
					throw new NotFoundException(__('Invalid post'));
					}
	
					$post = $this->Post->findById($id);
					if (!$post) {
					throw new NotFoundException(__('Invalid post'));
					}
	
					if ($this->request->is(array('post', 'put'))) {
					$this->Post->id = $id;
					
					if ($this->Post->save($this->request->data)) {
					$this->Session->setFlash(__('Your post has been updated.'));
					return $this->redirect(array('action' => 'index'));
					}
					
					$this->Session->setFlash(__('Unable to update your post.'));
		}
	
		if (!$this->request->data) {
				
					$this->request->data = $post;
					$this->set('post',$post);
					$choose_categories = $this->Category->findById($post['Post']['categories_id']);
					$this->set('choose_categories',$choose_categories['Category']['id']);
		}
	
	}
	
	
	
	
}
