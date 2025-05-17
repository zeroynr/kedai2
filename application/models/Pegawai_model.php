<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    protected $table = 'pegawai';

    // Ambil semua pegawai
    public function getAllPegawai()
    {
        return $this->db->get($this->table)->result_array();
    }

    // Ambil pegawai berdasarkan ID
    public function getPegawaiById($id)
    {
        $query = $this->db->get_where($this->table, ['id_pegawai' => $id]);
        return $query->row();
    }

    // Tambah data pegawai baru
    public function tambah_pegawai()
    {
        $password = $this->input->post('password');
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'email' => htmlspecialchars($this->input->post('email')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'jabatan' => $this->input->post('jabatan'),
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $this->db->insert($this->table, $data);
    }

    // Edit data pegawai
    public function edit_pegawai()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'email' => htmlspecialchars($this->input->post('email')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon')),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'jabatan' => $this->input->post('jabatan')
        ];

        // Jika password diisi, update password dengan hashing baru
        $new_password = $this->input->post('password');
        if (!empty($new_password)) {
            $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
        }

        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update($this->table, $data);
    }

    // Hapus pegawai berdasarkan ID
    public function hapus_pegawai($id)
    {
        return $this->db->delete($this->table, ['id_pegawai' => $id]);
    }

    // Edit profil pribadi (tanpa password)
    public function editMyProfile()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'telepon' => htmlspecialchars($this->input->post('telepon'))
        ];
        $this->db->where('id_pegawai', $this->input->post('id_pegawai'));
        $this->db->update($this->table, $data);
    }

    // Ubah password berdasarkan ID pegawai
    public function ubahPassword($id = null)
    {
        $id_pegawai = $id ?? $this->session->userdata('id_pegawai');
        $password = $this->input->post('password');

        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update($this->table, $data);
    }
}
