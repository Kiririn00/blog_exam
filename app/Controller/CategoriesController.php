<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

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
	var $uses = array('Category');
	
	public function index(){
		$this->set('categories', $this->Category->find('all'));
	}
	
	public function view($id = null){
		if (!$id) {
			throw new NotFoundException(__('Invalid Category'));
		}
	
		$Category = $this->Category->findById($id);
		if (!$Category) {
			throw new NotFoundException(__('Invalid Category'));
		}
		$this->set('category', $Category);
	}
	
	
	
	public function Add(){
	
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The Category has been saved'));
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
	
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(
					__('The Category with id: %s has been deleted.', h($id))
			);
		}
		else {
			$this->Session->setFlash(
					__('The Category with id: %s could not be deleted.', h($id))
			);
		}
	
		return $this->redirect(array('action' => 'index'));
	}
	
	public function Edit($id = null){
	
		if (!$id) {
			throw new NotFoundException(__('Invalid Category'));
		}
	
		$Category = $this->Category->findById($id);
		if (!$Category) {
			throw new NotFoundException(__('Invalid Category'));
		}
	
		if ($this->request->is(array('post', 'put'))) {
			$this->Category->id = $id;
				
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Your Category has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
				
			$this->Session->setFlash(__('Unable to update your Category.'));
		}
	
		if (!$this->request->data) {
			$this->request->data = $Category;
			$this->set('Category',$Category);
	
		}
	
	}
	
	
	
	
	
}
