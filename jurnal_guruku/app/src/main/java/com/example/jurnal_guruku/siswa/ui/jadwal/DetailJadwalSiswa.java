package com.example.jurnal_guruku.siswa.ui.jadwal;

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
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.BerandaGuru;
import com.example.jurnal_guruku.guru.model.JadwalModel;
import com.google.android.material.bottomsheet.BottomSheetBehavior;
import com.google.android.material.bottomsheet.BottomSheetDialog;
import com.hsalf.smilerating.BaseRating;
import com.hsalf.smilerating.SmileRating;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailJadwalSiswa extends AppCompatActivity {
    String kode="",kodemengajar="";
    ProgressDialog progressDialog;
    TextView txkelas, txnama, txhari, txjamawal, txjamakhir, txstatus, txdone;
    Button btn_ingatkan, btn_rating, btn_req_guru;
    LinearLayout panelbt_rating, panelbtn_ingarkan;
    BottomSheetBehavior sheetBehavior;
    BottomSheetDialog sheetDialog;
    View bottom_sheet;
    EditText isiReview;
    String MateriHolder;
    Boolean CheckEditText;
    ImageButton imgrefresh;
    public int noRating = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_jadwal_siswa);
        txkelas = findViewById(R.id.txkelas);
        txnama = findViewById(R.id.txtnama);
        txhari = findViewById(R.id.txthari);
        txjamawal = findViewById(R.id.txtjamawal);
        txjamakhir = findViewById(R.id.txtjamakhir);
        txstatus = findViewById(R.id.txtstatus);
        btn_ingatkan = (Button) findViewById(R.id.btn_ingatkan);
        txdone = findViewById(R.id.txtdone);
        btn_rating = findViewById(R.id.btn_rating);
        panelbt_rating = findViewById(R.id.pnl_btn_rating);
        panelbtn_ingarkan = findViewById(R.id.pnl_btn_ingatkan);
        imgrefresh = findViewById(R.id.imgrefresh);
        btn_req_guru = findViewById(R.id.btn_req_guru);
        isiReview = (EditText) findViewById(R.id.txt_isiReview);

        Intent data = getIntent();
        kode = data.getStringExtra("putkode");
        Log.e("kode", kode);
        progressDialog = new ProgressDialog(DetailJadwalSiswa.this);
        loaddata();

        bottom_sheet = findViewById(R.id.bottom_sheet);
        sheetBehavior = BottomSheetBehavior.from(bottom_sheet);

        btn_ingatkan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new AlertDialog.Builder(DetailJadwalSiswa.this)
                        .setTitle("Pesan Konfirmasi")
                        .setMessage("Apakah Anda Ingin Mengingatkan Guru?")
                        .setPositiveButton("Ya", new DialogInterface.OnClickListener()
                        {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                postReq("ingatkanguru/");
                            }

                        })
                        .setNegativeButton("Tidak", null)
                        .show();
            }
        });
        btn_req_guru.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new AlertDialog.Builder(DetailJadwalSiswa.this)
                        .setTitle("Pesan Konfirmasi")
                        .setMessage("Apakah Anda Ingin Membuat Permintaan Guru Pengganti?")
                        .setPositiveButton("Ya", new DialogInterface.OnClickListener()
                        {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                postReq("buatpermintaan/");
                            }

                        })
                        .setNegativeButton("Tidak", null)
                        .show();
            }
        });
        imgrefresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loaddata();
            }
        });
        btn_rating.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showBottomSheetDialog();
            }
        });
    }

    //method buat nampilin bottomsheet
    private void showBottomSheetDialog() {
        final View view = getLayoutInflater().inflate(R.layout.activity_bottomsheet_beri_rating, null);

        SmileRating smileRating = view.findViewById(R.id.siswa_rating);
        smileRating.setOnSmileySelectionListener(new SmileRating.OnSmileySelectionListener() {
            @Override
            public void onSmileySelected(@BaseRating.Smiley int smiley, boolean reselected) {

            }
        });

        smileRating.setOnRatingSelectedListener(new SmileRating.OnRatingSelectedListener() {
            @Override
            public void onRatingSelected(int level, boolean reselected) {
                noRating = level;
                Log.e("ratingnya",""+String.valueOf(noRating));

            }
        });
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
                EditText txt_isiReview = view.findViewById(R.id.txt_isiReview);
                if (noRating > 0){
                    kirimRating(txt_isiReview.getText().toString(), String.valueOf(txt_isiReview));
                }else{
                    Toast.makeText(DetailJadwalSiswa.this, "Pilih Rating Terlebih Dahulu", Toast.LENGTH_LONG).show();
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

    public void postReq(final String link){
        progressDialog.setMessage("Loading . . .");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "permintaan/"+link+ kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        loaddata();

                    } else {
                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

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
                Toast.makeText(DetailJadwalSiswa.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


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
    //methode buat save materi yg dikasih
    public void kirimRating(final String isimateri, final String ratingnya){
        progressDialog.setMessage("Proses . . .");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "mengajar/berirate/" +kodemengajar, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                        loaddata();

                    } else {
                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

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
                Toast.makeText(DetailJadwalSiswa.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


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
                params.put("rating", ratingnya);
                params.put("catatan", isimateri);
                return params;
            }

        };

        AppController.getInstance().addToRequestQueue(senddata);
        sheetDialog.dismiss();
    }



    void loaddata(){

        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "jadwal/detail/" +kode, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String[] thiar = {"Belum Mengajar","Selesai","Proses Mengajar"};
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
                        //txstatus.setText(datanya.getString("status"));
                        txstatus.setText(thiar[Integer.parseInt(datanya.getString("this_week"))]);

                        if (datanya.getString("this_week").equals("0")){
                            if (!res.getBoolean("bisacheckin")){
                                panelbt_rating.setVisibility(View.GONE);
                                panelbtn_ingarkan.setVisibility(View.GONE);
                                txdone.setVisibility(View.VISIBLE);
                                txdone.setText("Belum Waktunya Mengajar");
                            }else{

                                panelbtn_ingarkan.setVisibility(View.VISIBLE);
                                panelbt_rating.setVisibility(View.GONE);
                                txdone.setVisibility(View.GONE);
                            }
                        }else if (datanya.getString("this_week").equals("1")){

                            JSONObject mengajar = res.getJSONObject("mengajar");
                            kodemengajar = mengajar.getString("kode_mengajar");
                            if(mengajar.getString("status").equals("2")){

                                panelbt_rating.setVisibility(View.VISIBLE);
                                panelbtn_ingarkan.setVisibility(View.GONE);
                                txdone.setVisibility(View.GONE);
                            }else{

                                panelbtn_ingarkan.setVisibility(View.GONE);
                                panelbt_rating.setVisibility(View.GONE);
                                txdone.setText("Jadwal Telah Selesai");
                                txdone.setVisibility(View.VISIBLE);
                            }
                        }else if (datanya.getString("this_week").equals("2")){
                            panelbtn_ingarkan.setVisibility(View.GONE);
                            panelbt_rating.setVisibility(View.GONE);
                            txdone.setVisibility(View.VISIBLE);
                            txdone.setText("Proses Mengajar");
                        }

//                        JSONObject re = new JSONObject(response);
//                        JSONObject resp = re.getJSONObject("data");
//                        if (resp.getBoolean("status")){
//                            bt_rating = findViewById(R.id.btn_checkin);
//                        } else{
//                            txdone.findViewById(R.id.txtdone);
//                        }

                    } else {
                        Toast.makeText(DetailJadwalSiswa.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

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
                Toast.makeText(DetailJadwalSiswa.this, "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();


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