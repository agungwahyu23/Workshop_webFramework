package com.example.jurnal_guruku.siswa.uis.homes;
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

public class HomeFragmentSiswa extends Fragment {
    private TextView txtusername, txtmapel, txtnama, txttgsindividu, txtrating;
    List<JadwalModel> mItems;
    RecyclerView tempatdata;
    LinearLayoutManager panelrating;
    AdapterJadwal mAdapter;

    private ProgressDialog progressDialog;
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_home, container, false);
        txtusername = root.findViewById(R.id.username);
        txtmapel = root.findViewById(R.id.mpl);
        txtnama = root.findViewById(R.id.nama_siswa);
        txttgsindividu = root.findViewById(R.id.tgsindividu);
        txtrating = root.findViewById(R.id.rating);
        tempatdata = root.findViewById(R.id.tmpdatadua);
        progressDialog = new ProgressDialog(getContext());
        mItems = new ArrayList<>();
        return root;
    }
}
