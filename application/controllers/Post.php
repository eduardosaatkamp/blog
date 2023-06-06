<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Post Controller
 * Acessa por meio de http://localhost/blog/index.php/Post
 */
class Post extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('crud');
		// pré carregar o model
	}

	// Página inicial do controlador a partir da function index
	public function index()
	{
		$data['data'] = $this->crud->get_records('posts');
		$this->load->view('posts/list', $data);
		// exemplo de uso do var_dump($data) a partir do xdebug ;
		// segue pasta/view
	}


	public function create()
	{
		$this->load->view('posts/create');
		
		// para acessar http://localhost/blog/index.php/post/create
		// note que segue controlador + função
		// funcionando
	}

	// resolver aqui
	public function store()
	{
		$data['title'] = $this->input->post('title');

		if (empty($data['title'])) {
			echo 'Por favor, insira um dado.';
		}
		
		$data['description'] = $this->input->post('description');

		// verificar model
		$this->crud->insert('posts', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been saved successfully.</div>');

		redirect('http://localhost/blog/index.php/Post');
	}

	// 
	public function edit($id)
	{
		$data['data'] = $this->crud->find_record_by_id('posts', $id);
		$this->load->view('posts/edit', $data);
	}

	public function update($id)
	{
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		$this->crud->update('posts', $data, $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been updated successfully.</div>');
		redirect('http://localhost/blog/index.php/Post');
	}

	// 
		public function delete($id)
	{
		$this->crud->delete('posts', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been deleted successfully.</div>');
		redirect('http://localhost/blog/index.php/Post');
	}
}