<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Define_enum extends CI_Migration {
	public function up() {
		$this->db->query("create type e_pendidikan as enum('SMA', 'SMK', 'S1', 'S2');");
		$this->db->query("create type e_bayar as enum('BELUM LUNAS', 'VALIDASI', 'LUNAS', 'EXPIRED');");
		$this->db->query("create type e_penerimaan as enum('DITERIMA', 'DIPROSES', 'DITOLAK');");
		$this->db->query("create type e_formulir as enum('AKTIF', 'TIDAK AKTIF');");
		$this->db->query("create type e_kelamin as enum('P', 'L');");
		$this->db->query("create type e_agama as enum('KRISTEN', 'ISLAM', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU', 'LAINNYA');");
		$this->db->query("create type e_sipil as enum('NIKAH', 'BELUM NIKAH', 'JANDA', 'DUDA');");
		$this->db->query("create type e_keuangan as enum('BELUM BAYAR', 'VALIDASI KEUANGAN', 'VALIDASI NIM', 'LUNAS');");
		$this->db->query("create type e_ukuran as enum('S', 'M', 'L');");
		$this->db->query("create type e_prestasi as enum('NASIONAL', 'INTERNASIONAL');");
	}
	public function down() {
	}
}
