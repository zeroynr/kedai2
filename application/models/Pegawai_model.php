
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    public function getAllPegawai()
    {
        $query = $this->db->query("SELECT * FROM pegawai");
        return $query->result_array();
    }

    public function getPegawaiById($id)
    {
        // Gunakan parameter binding untuk mencegah SQL injection
        $query = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = ?", [$id]);
        return $query->row();
    }

    // Selaraskan metode ini dengan getPegawaiById untuk konsistensi
    public function get_pegawai_by_id($id)
    {
        // Gunakan parameter binding untuk mencegah SQL injection
        $query = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = ?", [$id]);
        return $query->row();
    }

    public function tambah_pegawai()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            "password" => htmlspecialchars(MD5($this->input->post('password'))),
            'telepon' => $this->input->post('telepon'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->db->insert('pegawai', $data);
    }

    public function edit_pegawai()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'jabatan' => $this->input->post('jabatan')
        ];

        // Jika password diisi, update password
        if (!empty($this->input->post('password'))) {
            $data['password'] = htmlspecialchars(MD5($this->input->post('password')));
        }

        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update('pegawai', $data);
    }

    public function ubah_password_pegawai()
    {
        $data = [
            'password' => htmlspecialchars(MD5($this->input->post('password')))
        ];
        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update('pegawai', $data);
    }

    public function hapus_pegawai($id)
    {
        // Gunakan query builder dengan parameter binding untuk mencegah SQL injection
        $this->db->where('id_pegawai', $id);
        return $this->db->delete('pegawai');
    }
    public function editMyProfile()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon')
        ];
        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update('pegawai', $data);
    }

    public function ubahPassword()
    {
        // Fitur ubah password pegawai
        $data = [
            "password" => htmlspecialchars(MD5($this->input->post('password')))
        ];
        $this->db->where('id_pegawai', $this->session->userdata('id_pegawai'));
        $this->db->update('pegawai', $data);
    }
}
