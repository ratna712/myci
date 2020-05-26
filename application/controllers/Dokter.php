<?php
class Dokter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model');
        $this->load->model('Dashboard_model');
        $this->load->library('template');
    }

    function index()
    {
        $data['jumlahPasien'] = $this->Dashboard_model->getJumlahPasien();
        $data['jumlahDokter'] = $this->Dashboard_model->getJumlahDokter();
        $data['jumlahApoteker'] = $this->Dashboard_model->getJumlahApoteker();
        $data['jumlahKunjunganHari'] = $this->Dashboard_model->getKunjunganHari();
        $data['jumlahAntrian'] = $this->Dashboard_model->getTotalAntrian();
        $data['jumlahAUmum'] = $this->Dashboard_model->getAntrianUmum();
        $data['jumlahAGigi'] = $this->Dashboard_model->getAntrianGigi();
        $this->template->tampil('Dokter/dDashboard_view', $data);
    }
    function antrianUmum()
    {
        $data['antrian'] = $this->Dokter_model->drUmum();
        $this->template->tampil('Dokter/AntrianUmum_view', $data);
    }
    function antrianGigi(){
        $data['antrian'] = $this->Dokter_model->drGigi();
        $this->template->tampil('Dokter/AntrianGigi_view', $data);
    }
    function updatePeriksaUmum(){
        $tensi_darah = $this->input->post('tensi_darah');
        $riwayat_penyakit = $this->input->post('riwayat_penyakit');
        $gejala = $this->input->post('gejala');
        $diagnosa = $this->input->post('diagnosa');
        $tindakan = $this->input->post('tindakan');
        $resep_obat = $this->input->post('resep_obat');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'tensi_darah' => $tensi_darah,
            'riwayat_penyakit' => $riwayat_penyakit,
            'gejala' => $gejala,
            'diagnosa' => $diagnosa,
            'tindakan' => $tindakan,
            'resep_obat' => $resep_obat,
            'keterangan' => $keterangan
        );
        $where = array('id_user' => $id);
        $this->Dokter_model->update_data($where,$data, 'tb_periksa');
        redirect('Dokter/antrianUmum');
    }
}
?>