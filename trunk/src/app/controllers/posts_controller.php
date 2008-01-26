<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form', 'Habtm' );

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->Post->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Post.');
			$this->redirect('/posts/index');
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('tags', $this->Post->Tag->generateList());
			$this->set('selectedTags', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect('/posts/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('tags', $this->Post->Tag->generateList());
				if(empty($this->data['Tag']['Tag'])) { $this->data['Tag']['Tag'] = null; }
				$this->set('selectedTags', $this->data['Tag']['Tag']);
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Post');
				$this->redirect('/posts/index');
			}
			$this->data = $this->Post->read(null, $id);
			$this->set('tags', $this->Post->Tag->generateList());
			if(empty($this->data['Tag'])) { $this->data['Tag'] = null; }
			$this->set('selectedTags', $this->_selectedArray($this->data['Tag']));
		} else {
			$this->cleanUpFields();
			if($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect('/posts/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('tags', $this->Post->Tag->generateList());
				if(empty($this->data['Tag']['Tag'])) { $this->data['Tag']['Tag'] = null; }
				$this->set('selectedTags', $this->data['Tag']['Tag']);
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Post');
			$this->redirect('/posts/index');
		}
		if($this->Post->del($id)) {
			$this->Session->setFlash('The Post deleted: id '.$id.'');
			$this->redirect('/posts/index');
		}
	}


	function admin_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->Post->findAll());
	}

	function admin_view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Post.');
			$this->redirect('/admin/posts/index');
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function admin_add() {
		if(empty($this->data)) {
			$this->set('tags', $this->Post->Tag->generateList());
			$this->set('selectedTags', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect('/admin/posts/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('tags', $this->Post->Tag->generateList());
				if(empty($this->data['Tag']['Tag'])) { $this->data['Tag']['Tag'] = null; }
				$this->set('selectedTags', $this->data['Tag']['Tag']);
			}
		}
	}

	function admin_edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Post');
				$this->redirect('/admin/posts/index');
			}
			$this->data = $this->Post->read(null, $id);
			$this->set('tags', $this->Post->Tag->generateList());
			if(empty($this->data['Tag'])) { $this->data['Tag'] = null; }
			$this->set('selectedTags', $this->_selectedArray($this->data['Tag']));
		} else {
			$this->cleanUpFields();
			if($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect('/admin/posts/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('tags', $this->Post->Tag->generateList());
				if(empty($this->data['Tag']['Tag'])) { $this->data['Tag']['Tag'] = null; }
				$this->set('selectedTags', $this->data['Tag']['Tag']);
			}
		}
	}

	function admin_delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Post');
			$this->redirect('/admin/posts/index');
		}
		if($this->Post->del($id)) {
			$this->Session->setFlash('The Post deleted: id '.$id.'');
			$this->redirect('/admin/posts/index');
		}
	}

}
?>