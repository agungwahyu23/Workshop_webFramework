package com.example.jurnal_guruku.guru.ui.jadwal;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
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
import com.google.android.material.bottomsheet.BottomSheetBehavior;
import com.google.android.material.bottomsheet.BottomSheetDialog;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailJadwalGuru extends AppCompatActivity {
    String kode="";
    ProgressDialog progressDialog;
    TextView txkelas, txnama, txhari, txjamawal, txjamakhir, txstatus, txdone;
    Button bt_chekin, bt_check_in;
    BottomSheetBehavior sheetBehavior;
    BottomSheetDialog sheetDialog;
    View bottom_sheet;
    EditText materi;
    String MateriHolder;
    Boolean CheckEditText;

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
        bt_chekin = (Button) findViewById(R.id.btn_checkin);
        txdone = findViewById(R.id.txtdone);
        bt_check_in = findViewById(R.id.btn_check_in);
        materi = (EditText) findViewById(R.id.txt_materi);

        Intent data = getIntent();
        kode = data.getStringExtra("putkode");
        progressDialog = new ProgressDialog(DetailJadwalGuru.this);
        loaddata();

        bottom_sheet = findViewById(R.id.bottom_sheet);
        sheetBehavior = BottomSheetBehavior.from(bottom_sheet);


        bt_chekin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showBottomSheetDialog();
            }
        });
    }

    //method buat nampilin bottomsheet
    private void showBottomSheetDialog() {
        final View view = getLayoutInflater().inflate(R.layout.activity_bottomsheet_guru_checkin, null);

        if (sheetBehavior.getState() == BottomSheetBehavior.STATE_EXPANDED) {
            sheetBehavior.setState(BottomSheetBehavior.STATE_COLLAPSED);
        }
        (view.findViewById(R.id.bt_close)).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sheetDialog.dismiss();
            }
        });
        (view.findViewById(R.id.btn_check_in)).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EditText txt_materi = view.findViewById(R.id.txt_materi);
                if (!txt_materi.getText().toString().isEmpty()){
                    CheckIn(txt_materi.getText().toString());
                }else{
                    Toast.makeText(DetailJadwalGuru.this, "Materi Tidak Boleh Kosong.", Toast.LENGTH_LONG).show();
                }
            }
        });

        sheetDialog = new BottomSheetDialog(this);
        sheetDialog.setContentView(view);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.KITKAT) {
            sheetDialog.getWindow().addFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
        }

        sheetDialog.show();
        sheetDialog.setOnDismissListener(new DialogInterface.OnDismissListener() {
            @Override
            public void onDismiss(DialogInterface dialog) {
                sheetDialog = null;
            }
        });
    }

    //methode buat save materi yg dikasih
    public void CheckIn(final String isimateri){
        progressDialog.setMessage("Proses . . .");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "mengajar/cekin/" +kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(DetailJadwalGuru.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        loaddata();

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
                params.put("materi", isimateri);
                return params;
            }

        };

        AppController.getInstance().addToRequestQueue(senddata);
        sheetDialog.dismiss();
    }

    //Method untuk mengecek apakah kolom udah terisi apa belum
    public void CheckEditTextIsEmptyOrNot(){
        MateriHolder = materi.getText().toString().trim();
        if (TextUtils.isEmpty(MateriHolder)){
            CheckEditText = false;
        }else{
            CheckEditText = true;
        }
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
                        txstatus.setText(thiar[Integer.parseInt(datanya.getString("this_week"))]);

                        if (datanya.getString("this_week").equals("0")){
                            if (!res.getBoolean("bisacheckin")){
                                bt_chekin.setVisibility(View.INVISIBLE);
                                txdone.setVisibility(View.VISIBLE);
                                txdone.setText("Belum Waktunya Mengajar");
                            }else{

                                bt_chekin.setVisibility(View.VISIBLE);
                                txdone.setVisibility(View.INVISIBLE);
                            }
                        }else if (datanya.getString("this_week").equals("1")){
                            bt_chekin.setVisibility(View.INVISIBLE);
                            txdone.setVisibility(View.VISIBLE);
                        }else{
                            bt_chekin.setVisibility(View.INVISIBLE);
                            txdone.setVisibility(View.INVISIBLE);
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