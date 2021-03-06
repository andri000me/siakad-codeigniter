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
		$id = $data['sess'][0]['id_guru'];
		$data['guru'] = $this->Models->id_guru($id);
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/dasboard',$data);
		$this->load->view('guru/template/footer');
	}

	public function nilai()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$id = $data['sess'][0]['id_guru'];
		$data['nilai'] = $this->Models->show_nilai($id);
		$id = $data['sess'][0]['id_kelas'];
		$data['siswa'] = $this->Models->get_siswa_nilai($id);
		$data['no'] = 1;
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
			'id_guru' => $id_dosen,
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

	public function edit_nilai($id)
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$data['siswa'] = $this->Models->show_nilai_id($id);
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/edit_nilai',$data);
		$this->load->view('guru/template/footer');
	}

	public function do_ubah_nilai()
	{
		$id = $this->input->post('id');
		$data = [
			'nilai' => $this->input->post('nilai')
		];

		$query = $this->Models->ubah_nilai($id,$data);
		if ($query) {
			$this->session->set_flashdata('success','Input Data Berhasil Dilakukan');
			redirect('GuruController/nilai');
		} else {
			$this->session->set_flashdata('success','Input Data Filed Dilakukan');
			redirect('GuruController/nilai');
		}

	}

	public function hapus_nilai($id)
	{
		$query = $this->Models->hapus_nilai($id);
		if ($query) {
			$this->session->set_flashdata('success','Hapus Data Berhasil Dilakukan');
			redirect('GuruController/nilai');
		} else {
			$this->session->set_flashdata('success','Hapus Data Filed Dilakukan');
			redirect('GuruController/nilai');
		}
	}

	public function cari_nilai()
	{
		$cari = $this->input->post('cari');
		$data['sess'] = $this->session->userdata('isGuru');
		$data['nilai'] = $this->Models->show_nilai_ids($cari);
		$id = $data['sess'][0]['id_kelas'];
		$data['siswa'] = $this->Models->get_siswa_nilai($id);
		$data['no'] = 1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/nilai',$data);
		$this->load->view('guru/template/footer');
	}

	public function materi()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$data['materi'] = $this->Models->get_materi();
		$data['no']=1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/materi',$data);
		$this->load->view('guru/template/footer');
	}

	public function post_materi()
	{
		$file = $_FILES['file']['name'];
		if ($file == "") {
			$this->session->set_flashdata('success','Image wajib diisi');
			redirect('GuruController/materi');
		} else {
			$config['upload_path'] = "./asset/file";
			$config['allowed_types'] ="pdf|doc|txt|xls|xlsx|docx|pptx";
			$up = $this->load->library('upload',$config);
			var_dump($up);
			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('success','Upload file failed');
				redirect('GuruController/materi');
			} else {
				$data = [
					'nama_materi' => $this->input->post('nama'),
					'desk_materi' => $this->input->post('desk'),
					'file'	=>  $this->upload->data('file_name'),
					'status' => 'aktif'
				];
				$query = $this->Models->post_materi($data);
				if ($query) {
					$this->session->set_flashdata('success','tambah data berhasil dilakukan');
					redirect('GuruController/materi');
				} else {
					$this->session->set_flashdata('success','tambah data gagall dilakukan');
					redirect('GuruController/materi');
				}
			}
		}
	}

	public function hapus_materi($id)
	{
		$query = $this->Models->hapus_materi($id);
		if ($query) {
			$this->session->set_flashdata('success','hapus data berhasil dilakukan');
			redirect('GuruController/materi');
		} else {
			$this->session->set_flashdata('success','hapus data gagall dilakukan');
			redirect('GuruController/materi');
		}
	}

	public function cari_materi()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$cari = $this->input->post('cari');
		$data['materi'] = $this->Models->cari_materi($cari);
		$data['no']=1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/materi',$data);
		$this->load->view('guru/template/footer');
	}

	public function pengumuman()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$data['pengumuman'] = $this->Models->pengumuman_guru();
		$data['no']=1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/pengumuman',$data);
		$this->load->view('guru/template/footer');
	}

	public function cari_pengumuman()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$cari = $this->input->post('cari');
		$data['pengumuman'] = $this->Models->cari_pengumumanguru($cari);
		$data['no']=1;
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/pengumuman',$data);
		$this->load->view('guru/template/footer');
	}

	public function edit_user()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$id = $data['sess'][0]['id_guru'];
		$data['guru'] = $this->Models->id_guru($id);
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/edit_user',$data);
		$this->load->view('guru/template/footer');
	}

	public function do_edit_user()
	{
		$gambar = $_FILES['foto']['name'];
		if ($gambar == "") {
			$data['sess'] = $this->session->userdata('isGuru');
			$id = $data['sess'][0]['id_guru'];
			$data = [
				'nama_guru' => $this->input->post('nama'),
				'alamat_guru' => $this->input->post('alamat'),
			];
			$query = $this->Models->edit_guru($id,$data);
			if ($query) {
				$this->session->set_flashdata('success','update data berhasil dilakukan');
				redirect('GuruController/index');
			} else {
				$this->session->set_flashdata('success','update data gagall dilakukan');
				redirect('GuruController/index');
			}

		} else {
			$config['upload_path'] = './asset/image';
			$config['allowed_types'] = 'png|jpg';
			$this->load->library('upload',$config);
			if (!$this->upload->do_upload('foto')) {
				echo "Gga";
			} else {
				$data['sess'] = $this->session->userdata('isGuru');
				$id = $data['sess'][0]['id_guru'];
				$data = [
					'nama_guru' => $this->input->post('nama'),
					'alamat_guru' => $this->input->post('alamat'),
					'foto_guru' => $this->upload->data('file_name')
				];
				$query = $this->Models->edit_guru($id,$data);
				if ($query) {
					$this->session->set_flashdata('success','update data berhasil dilakukan');
					redirect('GuruController/index');
				} else {
					$this->session->set_flashdata('success','update data gagall dilakukan');
					redirect('GuruController/index');
				}
			}
		}
	}


	public function password()
	{
		$data['sess'] = $this->session->userdata('isGuru');
		$this->load->view('guru/template/header');
		$this->load->view('guru/template/menu',$data);
		$this->load->view('guru/password',$data);
		$this->load->view('guru/template/footer');
	}

	public function ubah_password()
	{
		$pas1 = $this->input->post('pas1');
		$pas2 = $this->input->post('pas2');
		if ($pas1 == $pas2) {
			$data['sess'] = $this->session->userdata('isGuru');
			$id = $data['sess'][0]['id_guru'];
			$data = [
				'password_guru' => $this->input->post('pas2'),
			];
			$query = $this->Models->edit_guru($id,$data);
			if ($query) {
				$this->session->set_flashdata('success','update data berhasil dilakukan');
				redirect('GuruController/index');
			} else {
				$this->session->set_flashdata('success','update data gagall dilakukan');
				redirect('GuruController/index');
			}
		} else {
			$this->session->set_flashdata('success','Password is wrong');
			redirect('GuruController/password');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('isGuru');
		redirect('LoginController/index');
	}
}