<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gambarmenu_model extends CI_Model
{
    public function getGambarById($id)
    {
        $this->db->select('gambar_menu.*, menu.nama_menu');
        $this->db->from('gambar_menu');
        $this->db->join('menu', 'gambar_menu.id_menu = menu.id_menu');
        $this->db->where('menu.id_menu', $id);
        $this->db->order_by('gambar_menu.id_gambar', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllGambar()
    {
        $this->db->select('gambar_menu.*, menu.nama_menu');
        $this->db->from('gambar_menu');
        $this->db->join('menu', 'gambar_menu.id_menu = menu.id_menu');
        $this->db->order_by('menu.nama_menu', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah_gambar()
    {
        // Cek jumlah gambar yang sudah ada
        $id_menu = $this->input->post('id_menu');
        $jumlah_gambar = $this->hitungJumlahGambar($id_menu);

        // Jika sudah mencapai batas maksimum
        if ($jumlah_gambar >= 3) {
            return "MaxLimit";
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
            return "True";
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $this->session->set_flashdata('error', $error['error']);
        }
    }

    public function tambah_multiple_gambar($id_menu)
    {
        // Cek jumlah gambar yang sudah ada
        $jumlah_gambar_saat_ini = $this->hitungJumlahGambar($id_menu);
        $jumlah_gambar_baru = count($_FILES['gambar_menu']['name']);

        // Jika total akan melebihi batas maksimum
        if ($jumlah_gambar_saat_ini + $jumlah_gambar_baru > 3) {
            $jumlah_yang_diizinkan = 3 - $jumlah_gambar_saat_ini;
            if ($jumlah_yang_diizinkan <= 0) {
                return [
                    'berhasil' => 0,
                    'gagal' => $jumlah_gambar_baru,
                    'alasan' => 'MaxLimit'
                ];
            }
            // Batasi jumlah gambar yang akan diupload
            $jumlah_gambar_baru = $jumlah_yang_diizinkan;
        }

        $berhasil = 0;
        $gagal = 0;

        for ($i = 0; $i < $jumlah_gambar_baru; $i++) {
            if (!empty($_FILES['gambar_menu']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_menu']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_menu']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_menu']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_menu']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_menu']['size'][$i];

                $file_name = $_FILES['file']['name'];
                $newfile_name = str_replace(' ', '', $file_name);
                $config['upload_path'] = './assets/dataresto/menu/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $newName = date('dmYHis') . $i . $newfile_name;
                $config['file_name'] = $newName;
                $config['max_size'] = 5100;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $data = [
                        "id_menu" => $id_menu,
                        "gambar" => $newName,
                    ];
                    $this->db->insert('gambar_menu', $data);
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
        }

        return [
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'alasan' => ($jumlah_gambar_saat_ini + $jumlah_gambar_baru > 3) ? 'BatasanMax' : null
        ];
    }

    public function hitungJumlahGambar($id_menu)
    {
        $query = $this->db->query("SELECT COUNT(*) as jumlah FROM gambar_menu WHERE id_menu = $id_menu");
        return $query->row()->jumlah;
    }

    public function update_urutan_gambar($id_gambar, $urutan)
    {
        $data = [
            "urutan" => $urutan
        ];
        $this->db->where('id_gambar', $id_gambar);
        $this->db->update('gambar_menu', $data);
    }

    public function getGambarMenuUtama($id_menu)
    {
        $this->db->select('*');
        $this->db->from('gambar_menu');
        $this->db->where('id_menu', $id_menu);
        $this->db->order_by('id_gambar', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array()['gambar'];
        } else {
            return null;
        }
    }

    public function hapus_gambar($id_gambar)
    {
        $pathGambarMenu = "assets/dataresto/menu/";
        $getDataGambar = $this->db->query("SELECT * FROM gambar_menu WHERE id_gambar = $id_gambar");

        // Cek apakah data gambar ditemukan
        if ($getDataGambar->num_rows() == 0) {
            return false;
        }

        foreach ($getDataGambar->result_array() as $gambar) {
            $gambar_menu = $gambar['gambar'];
            if (file_exists($pathGambarMenu . $gambar_menu)) {
                try {
                    unlink($pathGambarMenu . $gambar_menu);
                } catch (Exception $e) {
                    // Log error jika gagal menghapus file
                    log_message('error', 'Gagal menghapus file gambar: ' . $e->getMessage());
                }
            }
        }

        $this->db->where('id_gambar', $id_gambar);
        $result = $this->db->delete('gambar_menu');

        return $result;
    }

    public function replace_gambar($id_gambar)
    {
        // Dapatkan data gambar lama
        $this->db->where('id_gambar', $id_gambar);
        $query = $this->db->get('gambar_menu');

        if ($query->num_rows() == 0) {
            return "Data gambar tidak ditemukan";
        }

        $data_gambar = $query->row_array();

        // Hapus file lama
        $pathGambarMenu = "assets/dataresto/menu/";
        $gambar_menu = $data_gambar['gambar'];
        if (file_exists($pathGambarMenu . $gambar_menu)) {
            try {
                unlink($pathGambarMenu . $gambar_menu);
            } catch (Exception $e) {
                // Log error jika gagal menghapus file
                log_message('error', 'Gagal menghapus file gambar lama: ' . $e->getMessage());
            }
        }

        // Upload file baru
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
                "gambar" => $newName,
            ];
            $this->db->where('id_gambar', $id_gambar);
            $result = $this->db->update('gambar_menu', $data);

            if ($result) {
                return "True";
            } else {
                return "Gagal mengupdate data gambar dalam database";
            }
        } else {
            $error = $this->upload->display_errors();
            return $error;
        }
    }
}
