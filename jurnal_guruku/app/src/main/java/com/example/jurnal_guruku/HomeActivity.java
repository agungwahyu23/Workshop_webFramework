package com.example.jurnal_guruku;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.jurnal_guruku.Adapter.ListAdapter;
import com.example.jurnal_guruku.Model.ModelData;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class HomeActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {
    private String URLstring = "http://192.168.43.194:8080/Workshop_webFramework/jurnal_guru/api/jadwal/data";
    private static ProgressDialog mProgressDialog;
    private ListView listView;
    ArrayList<ModelData> dataModelArrayList;
    private ListAdapter listAdapter;

    private BottomNavigationView menu_bawah;
    private TextView tulisan;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        menu_bawah = findViewById(R.id.menu_bawah);
        menu_bawah.setOnNavigationItemSelectedListener(this);

        listView = findViewById(R.id.lv);

        retrieveJSON();

    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        switch (menuItem.getItemId()){
            case R.id.home:
                //aksi ketika home di klik
                tulisan.setText("Tombol home diklik");
                break;
            case R.id.profile:
                //aksi ketika profile di klik
                tulisan.setText("Tombol profile diklik");
                break;
            case R.id.folder:
                //aksi ketika folder di klik
                tulisan.setText("Tombol folder diklik");
                break;
            case R.id.pesan:
                //aksi ketika pesan di klik
                tulisan.setText("Tombol pesan diklik");
                break;
        }
        return true;
    }

    private void retrieveJSON() {
        showSimpleProgressDialog(this, "Loading...","Fetching Json",false);

        StringRequest stringRequest = new StringRequest(Request.Method.GET, URLstring, new Response.Listener<String>() {
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {

                    JSONObject obj = new JSONObject(response);
                    if(obj.optString("title").equals("Data Jadwal")){

                        dataModelArrayList = new ArrayList<>();
                        JSONArray dataArray  = obj.getJSONArray("data");
                        for (int i = 0; i < dataArray.length(); i++) {
                            ModelData playerModel = new ModelData();
                            JSONObject dataobj = dataArray.getJSONObject(i);
                            playerModel.setKelas(dataobj.getString("nama_singkat"));
                            playerModel.setJam(dataobj.getString("jam_awal"));

                            dataModelArrayList.add(playerModel);
                        }
                        setupListview();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //displaying the error in toast if occurrs
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void setupListview(){
        removeSimpleProgressDialog();  //will remove progress dialog
        listAdapter = new ListAdapter(this, dataModelArrayList);
        listView.setAdapter(listAdapter);
    }

    public static void removeSimpleProgressDialog() {
        try {
            if (mProgressDialog != null) {
                if (mProgressDialog.isShowing()) {
                    mProgressDialog.dismiss();
                    mProgressDialog = null;
                }
            }
        } catch (IllegalArgumentException ie) {
            ie.printStackTrace();
        } catch (RuntimeException re) {
            re.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static void showSimpleProgressDialog(Context context, String title, String msg, boolean isCancelable) {
        try {
            if (mProgressDialog == null) {
                mProgressDialog = ProgressDialog.show(context, title, msg);
                mProgressDialog.setCancelable(isCancelable);
            }
            if (!mProgressDialog.isShowing()) {
                mProgressDialog.show();
            }
        } catch (IllegalArgumentException ie) {
            ie.printStackTrace();
        } catch (RuntimeException re) {
            re.printStackTrace();
        } catch (Exception e) {
            e.printStackTrace();
        }

    }
}