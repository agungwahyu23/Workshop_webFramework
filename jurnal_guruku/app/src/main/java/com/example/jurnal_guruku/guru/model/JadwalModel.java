package com.example.jurnal_guruku.guru.model;

public class JadwalModel {
    String kode;
    String nama_mapel;
    String nama_kelas;
    String nama_guru;
    String jam_mulai;
    String jam_akhir;
    String this_week;

    public String getKode() {
        return kode;
    }

    public void setKode(String kode) {
        this.kode = kode;
    }

    public String getNama_mapel() {
        return nama_mapel;
    }

    public void setNama_mapel(String nama_mapel) {
        this.nama_mapel = nama_mapel;
    }

    public String getNama_kelas() {
        return nama_kelas;
    }

    public void setNama_kelas(String nama_kelas) {
        this.nama_kelas = nama_kelas;
    }

    public String getNama_guru() {
        return nama_guru;
    }

    public void setNama_guru(String nama_guru) {
        this.nama_guru = nama_guru;
    }

    public String getJam_mulai() {
        return jam_mulai;
    }

    public void setJam_mulai(String jam_mulai) {
        this.jam_mulai = jam_mulai;
    }

    public String getJam_akhir() {
        return jam_akhir;
    }

    public void setJam_akhir(String jam_akhir) {
        this.jam_akhir = jam_akhir;
    }

    public String getThis_week() {
        return this_week;
    }

    public void setThis_week(String this_week) {
        this.this_week = this_week;
    }

    public String getHari() {
        return hari;
    }

    public void setHari(String hari) {
        this.hari = hari;
    }

    public JadwalModel() {
        this.kode = kode;
        this.nama_mapel = nama_mapel;
        this.nama_kelas = nama_kelas;
        this.nama_guru = nama_guru;
        this.jam_mulai = jam_mulai;
        this.jam_akhir = jam_akhir;
        this.this_week = this_week;
        this.hari = hari;
    }

    String hari;
}
