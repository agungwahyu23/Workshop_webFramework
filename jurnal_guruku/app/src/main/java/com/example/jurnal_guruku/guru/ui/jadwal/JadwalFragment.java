package com.example.jurnal_guruku.guru.ui.jadwal;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.jurnal_guruku.MainActivity;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.adapter.AdapterJadwal;
import com.example.jurnal_guruku.guru.model.JadwalModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class JadwalFragment extends Fragment {


    RecyclerView.LayoutManager mManager;
    List<JadwalModel> mItems;
    RecyclerView tempatdatajadwal;
    AdapterJadwal mAdapter;

    private ProgressDialog progressDialog;
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_jadwal, container, false);
        tempatdatajadwal = root.findViewById(R.id.tmpdatadua);
        progressDialog = new ProgressDialog(getContext());
        mItems = new ArrayList<>();

        loaddata();
        mAdapter = new AdapterJadwal(getContext(), mItems);
        mManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
        tempatdatajadwal.setLayoutManager(mManager);
        tempatdatajadwal.setHasFixedSize(true);
        tempatdatajadwal.setAdapter(mAdapter);
        return root;



//        tempatdatajadwal.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Intent detail = new Intent(JadwalFragment.this, DetailJadwalFragment.class);
//                startActivity(detail);
//            }
//        });
    }

    void loaddata(){
        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "jadwal/data", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(getContext(), respon.getString("pesan"), Toast.LENGTH_SHORT).show();


                        JSONArray arr = res.getJSONArray("data");
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject datakom = arr.getJSONObject(i);
                                JadwalModel md = new JadwalModel();
                                md.setHari(datakom.getString("hari"));
                                md.setNama_kelas(datakom.getString("no_kelas") + " " + datakom.getString("nama_singkat") + " " + datakom.getString("rombel"));
                                md.setNama_mapel(datakom.getString("nama_mapel"));
                                md.setThis_week(datakom.getString("this_week"));
                                md.setJam_mulai(datakom.getString("jam_awal"));
                                md.setJam_akhir(datakom.getString("jam_akhir"));
                                mItems.add(md);
                            } catch (Exception ea) {
                                Log.e("erronya atas", "" + ea);
                                ea.printStackTrace();
                            }
                        }
                        mAdapter.notifyDataSetChanged();
                        progressDialog.dismiss();
                    } else {
                        Toast.makeText(getContext(), respon.getString("pesan"), Toast.LENGTH_SHORT).show();

                    }

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
                Toast.makeText(getContext(), "Terjadi Kesalahan " + error, Toast.LENGTH_SHORT).show();
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("token", authdata.getInstance(getContext()).getToken());

                return params;
            }
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();

                return params;
            }
        }; AppController.getInstance().addToRequestQueue(senddata);
    }
}
