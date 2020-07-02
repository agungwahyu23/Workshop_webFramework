package com.example.jurnal_guruku.guru.model;

public class PermintaanModel {
    String kode;
    String create_at;
    String nama_mapel;
    String jam_awal;
    String jam_akhir;
    String deskripsi;

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public PermintaanModel() {
        this.kode = kode;
        this.create_at = create_at;
        this.nama_mapel = nama_mapel;
        this.jam_awal = jam_awal;
        this.jam_akhir = jam_akhir;
        this.deskripsi = deskripsi;
        this.status = status;
    }

    String status;

    public String getKode(){
        return kode;
    }

    public void setKode(String kode) {
        this.kode = kode;
    }

    public String getCreate_at() {
        return create_at;
    }

    public void setCreate_at(String create_at) {
        this.create_at = create_at;
    }

    public String getNama_mapel() {
        return nama_mapel;
    }

    public void setNama_mapel(String nama_mapel) {
        this.nama_mapel = nama_mapel;
    }

    public String getJam_awal() {
        return jam_awal;
    }

    public void setJam_awal(String jam_awal) {
        this.jam_awal = jam_awal;
    }

    public String getJam_akhir() {
        return jam_akhir;
    }

    public void setJam_akhir(String jam_akhir) {
        this.jam_akhir = jam_akhir;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public void setDeskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }



}
