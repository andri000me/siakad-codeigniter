<?php  

/** 
 * 
 */
class GuruController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('MyModel','Models');
		if ($this->session->userdata('isGuru') == "") {
			redirect('LoginController/index');
		}
	}

	public function index()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/dasboard',$data);
		$this->load->view('guru/template/footer');
	}

	public function nilai()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$id = $data['sess'][0]['id_kelas'];
		$data['nilai'] = $this->Models->show_siswa($id);
		$data['kelas'] = $this->Models->kelas_id($id);
		$data['siswa'] = $this->Models->get_siswa_nilai($id);
		$data['no'] =1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/nilai',$data);
		$this->load->view('guru/template/footer');
	}

	public function input_nilai($id)
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$data['siswa'] = $this->Models->id_siswa($id);
		$id = $data['sess'][0]['id_pelajaran'];
		$data['matkul'] = $this->Models->get_pelajaran_id($id);
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/post_nilai',$data);
		$this->load->view('guru/template/footer');
	}

	public function post_nilai()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$id_pelajaran = $data['sess'][0]['id_pelajaran'];
		$id_dosen = $data['sess'][0]['id_guru'];
		$data = [
			'id_siswa' => $this->input->post('siswa'),
			'id_pelajaran' => $id_pelajaran,
			'nilai' => $this->input->post('nilai'),
			'id_dosen' => $id_dosen,
			'tanggal' => date('Y-m-d')
		];
		$query = $this->Models->post_nilai($data);
		if ($query) {
			$this->session->set_flashdata('success','Input Data Berhasil Dilakukan');
			redirect('GuruController/nilai');
		} else {
			$this->session->set_flashdata('success','Input Data Filed Dilakukan');
			redirect('GuruController/nilai');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('isGuru');
		redirect('LoginController/index');
	}
}