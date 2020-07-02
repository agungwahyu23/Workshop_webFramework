package com.example.jurnal_guruku.siswa.model;

public class ModelMengajar {
    String kode, tanggal, mapel, guru, jam, rating, status;

    public String getKode() {
        return kode;
    }

    public void setKode(String kode) {
        this.kode = kode;
    }

    public String getTanggal() {
        return tanggal;
    }

    public void setTanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String getMapel() {
        return mapel;
    }

    public void setMapel(String mapel) {
        this.mapel = mapel;
    }

    public String getGuru() {
        return guru;
    }

    public void setGuru(String guru) {
        this.guru = guru;
    }

    public String getJam() {
        return jam;
    }

    public void setJam(String jam) {
        this.jam = jam;
    }

    public String getRating() {
        return rating;
    }

    public void setRating(String rating) {
        this.rating = rating;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public ModelMengajar() {
        this.kode = kode;
        this.tanggal = tanggal;
        this.mapel = mapel;
        this.guru = guru;
        this.jam = jam;
        this.rating = rating;
        this.status = status;
    }
}
