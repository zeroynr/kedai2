<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Makanan_model extends CI_Model
{
    public function getAllMakanan()
    {
        $this->db->select('menu.*, COUNT(gambar_menu.id_gambar) as jumlah_gambar');
        $this->db->from('menu');
        $this->db->join('gambar_menu', 'menu.id_menu = gambar_menu.id_menu', 'left');
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('menu.nama_menu', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMakananByKategori($kategori)
    {
        $this->db->select('menu.*, COUNT(gambar_menu.id_gambar) as jumlah_gambar');
        $this->db->from('menu');
        $this->db->join('gambar_menu', 'menu.id_menu = gambar_menu.id_menu', 'left');
        $this->db->where('menu.kategori', $kategori);
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('menu.nama_menu', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMakananTersedia()
    {
        $this->db->select('menu.*, COUNT(gambar_menu.id_gambar) as jumlah_gambar');
        $this->db->from('menu');
        $this->db->join('gambar_menu', 'menu.id_menu = gambar_menu.id_menu', 'left');
        $this->db->where('menu.stok', 'Tersedia');
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('menu.nama_menu', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMakananById($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_menu', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambah()
    {
        $data = [
            "nama_menu" => $this->input->post('nama_menu'),
            "detail_menu" => $this->input->post('detail_menu'),
            "kategori" => $this->input->post('kategori'),
            "stok" => $this->input->post('stok'),
            "harga" => $this->input->post('harga')
        ];

        $this->db->insert('menu', $data);
        return $this->db->insert_id(); // Mengembalikan ID menu yang baru dibuat
    }

    public function edit()
    {
        $data = [
            "nama_menu" => $this->input->post('nama_menu'),
            "detail_menu" => $this->input->post('detail_menu'),
            "kategori" => $this->input->post('kategori'),
            "stok" => $this->input->post('stok'),
            "harga" => $this->input->post('harga')
        ];

        $this->db->where('id_menu', $this->input->post('id_menu'));
        $result = $this->db->update('menu', $data);

        return $result; // Mengembalikan true/false hasil update
    }

    public function delete($id)
    {
        $pathMenu = "assets/dataresto/menu/";
        $getDataGambar = $this->db->query("SELECT * FROM gambar_menu WHERE id_menu = $id");

        foreach ($getDataGambar->result_array() as $gambar) {
            if (file_exists($pathMenu . $gambar['gambar'])) {
                unlink($pathMenu . $gambar['gambar']);
            }
        }

        // Hapus semua gambar terkait terlebih dahulu
        $this->db->where('id_menu', $id);
        $this->db->delete('gambar_menu');

        // Kemudian hapus menu
        $this->db->where('id_menu', $id);
        $this->db->delete('menu');
    }

    public function getGambarMenuUtama($id_menu)
    {
        $query = $this->db->query("SELECT * FROM gambar_menu WHERE id_menu = $id_menu ORDER BY id_gambar ASC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->row_array()['gambar'];
        } else {
            return null;
        }
    }

    public function searchMenu($keyword)
    {
        $this->db->select('menu.*, COUNT(gambar_menu.id_gambar) as jumlah_gambar');
        $this->db->from('menu');
        $this->db->join('gambar_menu', 'menu.id_menu = gambar_menu.id_menu', 'left');
        $this->db->like('menu.nama_menu', $keyword);
        $this->db->or_like('menu.detail_menu', $keyword);
        $this->db->group_by('menu.id_menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMenuWithImages()
    {
        $this->db->select('menu.*, MIN(gambar_menu.gambar) as gambar_utama');
        $this->db->from('menu');
        $this->db->join('gambar_menu', 'menu.id_menu = gambar_menu.id_menu', 'left');
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('menu.nama_menu', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
