package com.example.jurnal_guruku.siswa.ui.permintaan;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
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
import com.google.android.material.bottomsheet.BottomSheetBehavior;
import com.google.android.material.bottomsheet.BottomSheetDialog;
import com.hsalf.smilerating.BaseRating;
import com.hsalf.smilerating.SmileRating;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailPermintaanSiswa extends AppCompatActivity {
    String kode="";
    ProgressDialog progressDialog;
    TextView txkelas, txmapel, txhari, txdeskripsi, txjam, txstatus, txtipe, txdiambil, txcreate;

    ImageButton imgrefresh;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_permintaan_siswa);
        txkelas = findViewById(R.id.txkelas);
        txmapel = findViewById(R.id.txmapel);
        txhari = findViewById(R.id.txhari);
        txdeskripsi = findViewById(R.id.deskripsi);
        txjam = findViewById(R.id.txjam);
        txstatus = findViewById(R.id.txstatus);
        txtipe = findViewById(R.id.txtipe);
        txdiambil = findViewById(R.id.txdiambil);
        txcreate = findViewById(R.id.txcreateat);
        imgrefresh = findViewById(R.id.imgrefresh);

        Intent data = getIntent();
        kode = data.getStringExtra("putkode");
        Log.e("kode", kode);
        progressDialog = new ProgressDialog(DetailPermintaanSiswa.this);
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

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "permintaan/detail/" +kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String[] thiar = {"Tidak Aktif","Aktif","Selesai"};
                String[] artipe = {"","Guru Sejurusan","Semua Guru"};
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    JSONObject datanya = res.getJSONObject("data");
                    Log.e("mengajar", String.valueOf(res));
                    if (respon.getBoolean("status")) {
//                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        txkelas.setText(datanya.getString("no_kelas") + ' '+ datanya.getString("nama_singkat") + ' ' + datanya.getString("rombel"));
                        txmapel.setText(datanya.getString("nama_mapel"));
                        txhari.setText(datanya.getString("hari"));
                        txdeskripsi.setText(datanya.getString("deskripsi"));
                        txjam.setText(datanya.getString("jam_awal") + " s/d "+datanya.getString("jam_akhir"));
                        txdiambil.setText(datanya.get("nama_guru").toString());
                        txcreate.setText(UtilApp.setwaktu(datanya.getString("create_at")));

                        txtipe.setText(artipe[Integer.parseInt(datanya.getString("tipe"))]);
                        txstatus.setText(thiar[Integer.parseInt(datanya.getString("status"))]);


                    } else {
                        Toast.makeText(DetailPermintaanSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

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
                Toast.makeText(DetailPermintaanSiswa.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


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