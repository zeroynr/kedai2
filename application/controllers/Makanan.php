<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Makanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->model('Makanan_model');
        $this->load->model('Gambarmenu_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Pegawai';
        $data['makanan'] = $this->Makanan_model->getAllMakanan();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/makanan/index');
        $this->load->view('admin/layout/footer');
    }

    public function filter($kategori = null)
    {
        $data['title'] = 'Dashboard Pegawai';

        if ($kategori == 'makanan') {
            $data['makanan'] = $this->Makanan_model->getMakananByKategori('Makanan');
            $data['active_filter'] = 'makanan';
        } elseif ($kategori == 'minuman') {
            $data['makanan'] = $this->Makanan_model->getMakananByKategori('Minuman');
            $data['active_filter'] = 'minuman';
        } elseif ($kategori == 'tersedia') {
            $data['makanan'] = $this->Makanan_model->getMakananTersedia();
            $data['active_filter'] = 'tersedia';
        } else {
            $data['makanan'] = $this->Makanan_model->getAllMakanan();
            $data['active_filter'] = 'semua';
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/makanan/index');
        $this->load->view('admin/layout/footer');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Hasil Pencarian: ' . $keyword;
        $data['makanan'] = $this->Makanan_model->searchMenu($keyword);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/makanan/index');
        $this->load->view('admin/layout/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_menu', 'nama_menu', 'required');
        $this->form_validation->set_rules('detail_menu', 'detail_menu', 'required');
        $this->form_validation->set_rules('kategori', 'kategori', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('makanan');
        } else {
            $id_menu = $this->Makanan_model->tambah();

            // Jika ada upload gambar
            if (!empty($_FILES['gambar_menu']['name'])) {
                // Cek apakah upload single atau multiple
                if (is_array($_FILES['gambar_menu']['name'])) {
                    $result = $this->Gambarmenu_model->tambah_multiple_gambar($id_menu);
                    if ($result['berhasil'] > 0) {
                        $message = 'Sukses Menambah Data Menu dengan ' . $result['berhasil'] . ' gambar. ';
                        if ($result['gagal'] > 0) {
                            if (isset($result['alasan']) && $result['alasan'] == 'MaxLimit') {
                                $message .= 'Beberapa gambar tidak diupload karena telah mencapai batas maksimal 3 gambar.';
                            } else {
                                $message .= $result['gagal'] . ' gambar gagal diupload.';
                            }
                        }
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $message . '</div>');
                    }
                } else {
                    // Single upload
                    $result = $this->upload_gambar($id_menu);
                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Sukses Menambah Data Menu dengan gambar
                        </div>');
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Sukses Menambah Data Menu
                </div>');
            }

            redirect('makanan');
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Menu';
        $data['makanan'] = $this->Makanan_model->getMakananById($id);
        $data['gambar'] = $this->Gambarmenu_model->getGambarById($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/makanan/detail');
        $this->load->view('admin/layout/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Menu';
        $data['makanan'] = $this->Makanan_model->getMakananById($id);
        $data['gambar'] = $this->Gambarmenu_model->getGambarById($id);
        $data['jumlah_gambar'] = $this->Gambarmenu_model->hitungJumlahGambar($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/makanan/edit');
        $this->load->view('admin/layout/footer');
    }

    public function delete($id)
    {
        $this->Makanan_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sukses Menghapus Menu.
            </div>');
        redirect('makanan');
    }

    private function upload_gambar($id_menu)
    {
        // Cek jumlah gambar yang sudah ada
        $jumlah_gambar = $this->Gambarmenu_model->hitungJumlahGambar($id_menu);

        // Jika sudah mencapai batas maksimum
        if ($jumlah_gambar >= 3) {
            $this->session->set_flashdata('error', 'Batas maksimal 3 gambar per menu.');
            return false;
        }

        $file_name = $_FILES['gambar_menu']['name'];
        $newfile_name = str_replace(' ', '', $file_name);
        $config['upload_path'] = './assets/dataresto/menu/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $newName = date('dmYHis') . $newfile_name;
        $config['file_name'] = $newName;
        $config['max_size'] = 5100;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('gambar_menu')) {
            $this->upload->data('file_name');
            $data = [
                "id_menu" => $id_menu,
                "gambar" => $newName,
            ];
            $this->db->insert('gambar_menu', $data);
            return true;
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            return false;
        }
    }

    public function tambah_gambar()
    {
        $id_menu = $this->input->post('id_menu');

        // Cek jumlah gambar yang sudah ada
        $jumlah_gambar = $this->Gambarmenu_model->hitungJumlahGambar($id_menu);

        // Jika sudah mencapai batas maksimum
        if ($jumlah_gambar >= 3) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Tidak dapat menambahkan gambar baru. Batas maksimal 3 gambar per menu.
            </div>');
            redirect('makanan/edit/' . $id_menu);
            return;
        }

        // Cek apakah upload single atau multiple
        if (is_array($_FILES['gambar_menu']['name'])) {
            $result = $this->Gambarmenu_model->tambah_multiple_gambar($id_menu);
            if ($result['berhasil'] > 0) {
                $message = 'Berhasil menambahkan ' . $result['berhasil'] . ' gambar baru. ';
                if ($result['gagal'] > 0) {
                    if (isset($result['alasan']) && $result['alasan'] == 'BatasanMax') {
                        $message .= 'Beberapa gambar tidak diupload karena telah mencapai batas maksimal 3 gambar.';
                    } else {
                        $message .= $result['gagal'] . ' gambar gagal diupload.';
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $message . '</div>');
            } else {
                if (isset($result['alasan']) && $result['alasan'] == 'MaxLimit') {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Tidak dapat menambahkan gambar baru. Batas maksimal 3 gambar per menu.
                    </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal mengupload gambar.
                    </div>');
                }
            }
        } else {
            $result = $this->Gambarmenu_model->tambah_gambar();
            if ($result == "True") {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Sukses Menambahkan Gambar Menu.
                </div>');
            } else if ($result == "MaxLimit") {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Tidak dapat menambahkan gambar baru. Batas maksimal 3 gambar per menu.
                </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Menambahkan Gambar Menu.
                </div>');
            }
        }

        redirect('makanan/edit/' . $id_menu);
    }

    public function hapus_gambar($id_gambar, $id_menu)
    {
        $result = $this->Gambarmenu_model->hapus_gambar($id_gambar);

        // Berikan respons untuk request Ajax
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => $result, 'message' => $result ? 'Gambar berhasil dihapus' : 'Gagal menghapus gambar']);
            exit;
        }

        // Jika bukan Ajax request, gunakan cara tradisional
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Sukses Menghapus Gambar.
                </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Menghapus Gambar.
                </div>');
        }
        redirect('makanan/edit/' . $id_menu);
    }

    public function replace_gambar($id_gambar, $id_menu)
    {
        // Pastikan selalu mengembalikan respons JSON
        header('Content-Type: application/json');

        // Validasi upload
        if (empty($_FILES['gambar_menu']['name'])) {
            echo json_encode(['success' => false, 'message' => 'Tidak ada file yang diupload']);
            exit;
        }

        $result = $this->Gambarmenu_model->replace_gambar($id_gambar);
        $success = ($result === "True");

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Gambar berhasil diganti']);
        } else {
            echo json_encode(['success' => false, 'message' => $result]);
        }
        exit;
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('detail_menu', 'Detail Menu', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        $id_menu = $this->input->post('id_menu');

        if ($this->form_validation->run() == FALSE) {
            // Simpan pesan error validasi
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Mengedit Menu. ' . validation_errors() . '
            </div>');
            redirect('makanan/edit/' . $id_menu);
        } else {
            // Flag untuk melacak perubahan
            $menu_changes = false;
            $gambar_changes = false;

            // Proses edit data menu
            $result = $this->Makanan_model->edit();

            if ($result) {
                // Jika edit menu berhasil
                $menu_changes = true;

                // Jika ada upload gambar baru
                if (!empty($_FILES['gambar_menu']['name'])) {
                    // Cek jumlah gambar yang sudah ada
                    $jumlah_gambar = $this->Gambarmenu_model->hitungJumlahGambar($id_menu);

                    // Jika sudah mencapai batas maksimum
                    if ($jumlah_gambar >= 3) {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                        Data menu berhasil diubah, tetapi gambar baru tidak ditambahkan karena telah mencapai batas maksimal 3 gambar.
                        </div>');
                        redirect('makanan/detail/' . $id_menu);
                        return;
                    }

                    // Cek apakah upload single atau multiple
                    if (is_array($_FILES['gambar_menu']['name'])) {
                        $result_gambar = $this->Gambarmenu_model->tambah_multiple_gambar($id_menu);
                        if ($result_gambar['berhasil'] > 0) {
                            $gambar_changes = true;
                        }
                    } else {
                        // Single upload
                        $result_gambar = $this->upload_gambar($id_menu);
                        if ($result_gambar) {
                            $gambar_changes = true;
                        }
                    }
                }

                // Sesuaikan pesan berdasarkan apa yang berubah
                if ($menu_changes && $gambar_changes) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Sukses mengedit data menu dan mengubah gambar.
                    </div>');
                } else if ($menu_changes) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Sukses mengedit data menu.
                    </div>');
                } else if ($gambar_changes) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Sukses mengubah gambar menu.
                    </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">
                    Tidak ada perubahan yang dilakukan.
                    </div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Mengedit Menu. Terjadi kesalahan saat menyimpan data.
                </div>');
            }

            redirect('makanan/detail/' . $id_menu);
        }
    }
}
