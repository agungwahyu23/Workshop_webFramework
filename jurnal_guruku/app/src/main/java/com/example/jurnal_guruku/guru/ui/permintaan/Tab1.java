package com.example.jurnal_guruku.guru.ui.permintaan;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.adapter.AdapterPermintaan;
import com.example.jurnal_guruku.guru.model.PermintaanModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class Tab1 extends Fragment {

    RecyclerView.LayoutManager mManager;
    List<PermintaanModel> mItems;
    RecyclerView tempatdatapermintaan1;
    AdapterPermintaan mAdapter;

    private ProgressDialog progressDialog;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_tab1, container, false);

        tempatdatapermintaan1 = root.findViewById(R.id.tmpdatapermintaan1);
        progressDialog = new ProgressDialog(getContext());
        mItems = new ArrayList<>();

        loaddata();

        mAdapter = new AdapterPermintaan(getContext(), mItems);
        mManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
        tempatdatapermintaan1.setLayoutManager(mManager);
        tempatdatapermintaan1.setHasFixedSize(true);
        tempatdatapermintaan1.setAdapter(mAdapter);

        return root;
    }

    private void loaddata() {
        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "permintaan/data?tipe=1&subtipe=1&keyone=1", new Response.Listener<String>() {
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
                                PermintaanModel md = new PermintaanModel();
                                md.setCreate_at(datakom.getString("create_at"));
                                md.setKode(datakom.getString("kode_req"));
                                md.setNama_mapel(datakom.getString("nama_mapel"));
                                md.setJam_awal(datakom.getString("jam_awal"));
                                md.setJam_akhir(datakom.getString("jam_akhir"));
                                md.setDeskripsi(datakom.getString("deskripsi"));
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
