package com.example.jurnal_guruku.guru.ui.jadwal;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.model.JadwalModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailJadwalGuru extends AppCompatActivity {
    String kode="";
    ProgressDialog progressDialog;
    TextView txkelas, txnama, txhari, txjamawal, txjamakhir, txstatus, bt_chekin, txdone;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_jadwal_guru);
        txkelas = findViewById(R.id.txkelas);
        txnama = findViewById(R.id.txtnama);
        txhari = findViewById(R.id.txthari);
        txjamawal = findViewById(R.id.txtjamawal);
        txjamakhir = findViewById(R.id.txtjamakhir);
        txstatus = findViewById(R.id.txtstatus);

        Intent data = getIntent();
        kode = data.getStringExtra("putkode");
        progressDialog = new ProgressDialog(DetailJadwalGuru.this);
        loaddata();
    }

    void loaddata(){

        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "jadwal/detail/" +kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String[] thiar = {"Belum Mengajar","Sudah", "Proses",};
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    JSONObject datanya = res.getJSONObject("data");
                    JadwalModel md = new JadwalModel();
                    if (respon.getBoolean("status")) {
                        Toast.makeText(DetailJadwalGuru.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        txkelas.setText(datanya.getString("no_kelas") + ' '+ datanya.getString("nama_singkat") + ' ' + datanya.getString("rombel"));
                        txnama.setText(datanya.getString("nama_guru"));
                        txhari.setText(datanya.getString("hari"));
                        txjamawal.setText(datanya.getString("jam_awal"));
                        txjamakhir.setText(datanya.getString("jam_akhir"));
                        //txstatus.setText(datanya.getString("status"));
                        txstatus.setText(thiar[Integer.parseInt(datanya.getString("status"))]);

                        if (datanya.getBoolean("status")){
                            bt_chekin = findViewById(R.id.btn_checkin);
                        }else{
                            txdone.findViewById(R.id.txtdone);
                        }

//                        JSONObject re = new JSONObject(response);
//                        JSONObject resp = re.getJSONObject("data");
//                        if (resp.getBoolean("status")){
//                            bt_chekin = findViewById(R.id.btn_checkin);
//                        } else{
//                            txdone.findViewById(R.id.txtdone);
//                        }

                    } else {
                        Toast.makeText(DetailJadwalGuru.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

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
                Toast.makeText(DetailJadwalGuru.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


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