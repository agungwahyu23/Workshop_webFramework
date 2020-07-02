package com.example.jurnal_guruku.guru.model;

public class IzinModel {
    String kode;
    String create_at;
    String keterangan;
    String awal;
    String akhir;
    String status;

    public String getKode() {
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

    public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }

    public String getAwal() {
        return awal;
    }

    public void setAwal(String awal) {
        this.awal = awal;
    }

    public String getAkhir() {
        return akhir;
    }

    public void setAkhir(String akhir) {
        this.akhir = akhir;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public IzinModel(){
        this.kode = kode;
        this.create_at = create_at;
        this.keterangan = keterangan;
        this.awal = awal;
        this.akhir = akhir;
        this.status = status;
    }
}
