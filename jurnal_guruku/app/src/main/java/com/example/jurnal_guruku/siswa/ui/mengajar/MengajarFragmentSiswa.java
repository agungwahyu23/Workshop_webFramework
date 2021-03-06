package com.example.jurnal_guruku.siswa.ui.mengajar;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.fragment.app.DialogFragment;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.appeaser.sublimepickerlibrary.datepicker.SelectedDate;
import com.appeaser.sublimepickerlibrary.helpers.SublimeOptions;
import com.appeaser.sublimepickerlibrary.recurrencepicker.SublimeRecurrencePicker;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.UtilApp;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.model.JadwalModel;
import com.example.jurnal_guruku.siswa.adapter.AdapterJadwalSiswa;
import com.example.jurnal_guruku.siswa.adapter.AdapterMengajarSiswa;
import com.example.jurnal_guruku.siswa.model.ModelMengajar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class MengajarFragmentSiswa extends Fragment {


    String mDateStart;
    String mDateEnd, title="";

    RecyclerView.LayoutManager mManager;
    List<ModelMengajar> mItems;
    RecyclerView tempatdatajadwal;
    AdapterMengajarSiswa mAdapter;
    ImageButton btnRefresh, btnPicker;
    private ProgressDialog progressDialog;
    TextView judulpage;
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_mengajar_siswa, container, false);
        tempatdatajadwal = root.findViewById(R.id.tmpdatadua);
        btnPicker = root.findViewById(R.id.btndatepicker);
        btnRefresh = root.findViewById(R.id.refresh);
        judulpage = root.findViewById(R.id.judulpage);
        progressDialog = new ProgressDialog(getContext());
        SimpleDateFormat formatter= new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date(System.currentTimeMillis());
        mDateStart = formatter.format(date);
        mDateEnd = formatter.format(date);
        mItems = new ArrayList<>();

        loaddata();
        mAdapter = new AdapterMengajarSiswa(getContext(), mItems);
        mManager = new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false);
        tempatdatajadwal.setLayoutManager(mManager);
        tempatdatajadwal.setHasFixedSize(true);
        tempatdatajadwal.setAdapter(mAdapter);

        btnPicker.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDateRangePicker();
            }
        });

        btnRefresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loaddata();
            }
        });


        return root;
    }
    private void openDateRangePicker(){
        SublimePickerFragment pickerFrag = new SublimePickerFragment();
        pickerFrag.setCallback(new SublimePickerFragment.Callback() {
            @Override
            public void onCancelled() {
                Toast.makeText(getActivity(), "User cancel",
                        Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onDateTimeRecurrenceSet(final SelectedDate selectedDate, int hourOfDay, int minute,
                                                SublimeRecurrencePicker.RecurrenceOption recurrenceOption,
                                                String recurrenceRule) {

                @SuppressLint("SimpleDateFormat")
                SimpleDateFormat formatDate = new SimpleDateFormat("yyyy-MM-dd");
                mDateStart = formatDate.format(selectedDate.getStartDate().getTime());
                mDateEnd = formatDate.format(selectedDate.getEndDate().getTime());
                Log.e("isi ", "onDateTimeRecurrenceSet: " + mDateStart);
                Log.e("isi ", "mDateEnd: " + mDateEnd);
                loaddata();
            }
        });

        // ini configurasi agar library menggunakan method Date Range Picker
        SublimeOptions options = new SublimeOptions();
        options.setCanPickDateRange(true);
        options.setPickerToShow(SublimeOptions.Picker.DATE_PICKER);

        Bundle bundle = new Bundle();
        bundle.putParcelable("SUBLIME_OPTIONS", options);
        pickerFrag.setArguments(bundle);

        pickerFrag.setStyle(DialogFragment.STYLE_NO_TITLE, 0);
        pickerFrag.show(getChildFragmentManager(), "SUBLIME_PICKER");
    }
    void loaddata(){
        progressDialog.setMessage("Please Wait");
        progressDialog.show();

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "mengajar/data?tipe=1&subtipe=2&keyone=" + mDateStart +"&keytwo="+ mDateEnd +"&keysub=", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(getContext(), respon.getString("pesan"), Toast.LENGTH_SHORT).show();

                        judulpage.setText(res.getString("title"));
                        JSONArray arr = res.getJSONArray("data");
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject datakom = arr.getJSONObject(i);
                                ModelMengajar md = new ModelMengajar();
                                md.setTanggal(UtilApp.settanggal(datakom.getString("mulai").split(" ")[0]));
                                md.setKode(datakom.getString("kode_mengajar"));
                                md.setMapel(datakom.getString("nama_mapel"));
                                md.setGuru(datakom.getString("nama_guru"));
                                md.setJam(datakom.getString("jam_awal")+ " s/d "+datakom.getString("jam_akhir"));
                                md.setRating(datakom.getString("rating"));
                                md.setStatus(datakom.getString("status"));
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
