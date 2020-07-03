package com.example.jurnal_guruku.guru.model;

public class SaldoModel {
    String kode;
    String create_at;
    String keterangan;
    String jumlah;

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

    public String getJumlah() {
        return jumlah;
    }

    public void setJumlah(String jumlah) {
        this.jumlah = jumlah;
    }

    public SaldoModel(){
        this.kode = kode;
        this.create_at = create_at;
        this.keterangan = keterangan;
        this.jumlah = jumlah;
    }
}
