package com.example.jurnal_guruku.guru.ui.akun.saldo;

import android.app.ProgressDialog;
import android.content.Context;
import android.net.Uri;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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
import com.example.jurnal_guruku.guru.adapter.AdapterIzin;
import com.example.jurnal_guruku.guru.adapter.AdapterSaldo;
import com.example.jurnal_guruku.guru.model.IzinModel;
import com.example.jurnal_guruku.guru.model.SaldoModel;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class SaldoFragment extends Fragment {

        RecyclerView.LayoutManager mManager;
        List<SaldoModel> mItems;
        RecyclerView tempatdatasaldo;
        AdapterSaldo mAdapter;

        private ProgressDialog progressDialog;
        public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
            View root = inflater.inflate(R.layout.fragment_saldo, container, false);
            tempatdatasaldo= root.findViewById(R.id.tmpdatasaldo);
            progressDialog = new ProgressDialog(getContext());
            mItems = new ArrayList<>();

            loaddata();
            mAdapter = new AdapterSaldo(getContext(), mItems);
            mManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
            tempatdatasaldo.setLayoutManager(mManager);
            tempatdatasaldo.setHasFixedSize(true);
            tempatdatasaldo.setAdapter(mAdapter);
            return root;
        }

        void loaddata(){
            progressDialog.setMessage("Please Wait");
            progressDialog.show();

            StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "upah/data", new Response.Listener<String>() {
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
                                    SaldoModel md = new SaldoModel();
                                    md.setCreate_at(datakom.getString("create_at"));
                                    md.setKeterangan(datakom.getString("keterangan"));
                                    md.setJumlah(datakom.getString("jumlah"));
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
