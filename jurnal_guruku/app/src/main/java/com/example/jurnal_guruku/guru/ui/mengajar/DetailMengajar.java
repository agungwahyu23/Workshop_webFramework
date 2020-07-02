package com.example.jurnal_guruku.guru.ui.mengajar;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.UtilApp;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.ui.mengajar.DetailMengajar;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailMengajar extends AppCompatActivity {
    String kode="";
    ProgressDialog progressDialog;
    TextView txkelas, txnama, txhari, txjamawal, txjamakhir, txstatus;
    TextView txmateri, txstatusajar, txjammulaiajar, txjamkahirajar, txcatatan, txtipeguru, txrating;
    ImageButton imgrefresh;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_mengajar);
        txkelas = findViewById(R.id.txkelas);
        txnama = findViewById(R.id.txtnama);
        txhari = findViewById(R.id.txthari);
        txjamawal = findViewById(R.id.txtjamawal);
        txjamakhir = findViewById(R.id.txtjamakhir);
        txstatus = findViewById(R.id.txtstatus);
        imgrefresh = findViewById(R.id.imgrefresh);
        txmateri = findViewById(R.id.txmateri);
        txstatusajar = findViewById(R.id.txstatusajar);
        txjammulaiajar = findViewById(R.id.txtjamawalajar);
        txjamkahirajar = findViewById(R.id.txtjamakhirajar);
        txcatatan = findViewById(R.id.txcatatansiswa);
        txtipeguru = findViewById(R.id.txtipeguru);
        txrating = findViewById(R.id.txrating);

        Intent data = getIntent();
        kode = data.getStringExtra("putkode");
        Log.e("kode", kode);
        progressDialog = new ProgressDialog(DetailMengajar.this);
        loaddata();

        imgrefresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loaddata();
            }
        });
    }




    void loaddata(){

        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "mengajar/detail/" +kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String[] thiar = {"Belum Mengajar","Selesai","Proses Mengajar"};
                String[] arTipe = {"","Guru sesuai jadwal","Guru Pengganti"};
                String[] thiarajar = {"","Proses Mengajar","Menunggu Rating","Selesai","Tidak Masuk","Izin",""};
                String[] stRating = {"Belum Ada Rating","Buruk Sekali","Buruk","Cukup","Baik", "Baik Sekali"};
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    JSONObject datanya = res.getJSONObject("data");
                    Log.e("mengajar", String.valueOf(res));
                    if (respon.getBoolean("status")) {
//                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        txkelas.setText(datanya.getString("no_kelas") + ' '+ datanya.getString("nama_singkat") + ' ' + datanya.getString("rombel"));
                        txnama.setText(datanya.getString("nama_guru"));
                        txhari.setText(datanya.getString("hari"));
                        txjamawal.setText(datanya.getString("jam_awal"));
                        txjamakhir.setText(datanya.getString("jam_akhir"));
                        txstatus.setText(thiar[Integer.parseInt(datanya.getString("this_week"))]);
                        txstatusajar.setText(thiarajar[Integer.parseInt(datanya.getString("status"))]);
                        txrating.setText(stRating[Integer.parseInt(datanya.getString("rating"))]);
                        txtipeguru.setText(arTipe[Integer.parseInt(datanya.getString("tipe"))]);


                        txmateri.setText(datanya.getString("materi"));
                        txjammulaiajar.setText(UtilApp.setwaktu(datanya.getString("mulai")));
                        txjammulaiajar.setText(UtilApp.setwaktu(datanya.getString("akhir")));
                        txcatatan.setText(datanya.getString("catatan_siswa"));

                    } else {
                        Toast.makeText(DetailMengajar.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

                    }
                    progressDialog.dismiss();

                } catch (JSONException e) {
                    progressDialog.dismiss();
                    Log.e("errorgan", e.getMessage());
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressDialog.dismiss();
                Log.e("errornyaa ", "" + error);
                Toast.makeText(DetailMengajar.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("token", authdata.getInstance(getApplicationContext()).getToken());

                return params;
            }
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();


                return params;
            }

        };

        AppController.getInstance().addToRequestQueue(senddata);
    }
}
