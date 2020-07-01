package com.example.jurnal_guruku;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.jurnal_guruku.config.AppController;
import com.example.jurnal_guruku.config.ServerApi;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.BerandaGuru;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    EditText Email, Password;
    Button LoginButton;
    RequestQueue requestQueue;
    String EmailHolder, PasswordHolder;
    ProgressDialog progressDialog;
    Boolean CheckEditText;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Email = (EditText) findViewById(R.id.editText_Email);
        Password = (EditText) findViewById(R.id.editText_Password);
        LoginButton = (Button) findViewById(R.id.button_login);
        requestQueue = Volley.newRequestQueue(MainActivity.this);
        progressDialog = new ProgressDialog(MainActivity.this);

        LoginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CheckEditTextIsEmptyOrNot();
                if (CheckEditText){
                    UserLogin();
                }else{
                    Toast.makeText(MainActivity.this, "Please fill all form fields.", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    public void UserLogin(){
    progressDialog.setMessage("Please Wait");
    progressDialog.show();

    StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "auth/authlogin", new Response.Listener<String>() {
        @Override
        public void onResponse(String response) {
            try {
                progressDialog.dismiss();
                JSONObject res = new JSONObject(response);
                JSONObject respon = res.getJSONObject("respon");
                Log.e("testes" , String.valueOf(respon.getBoolean("status")));
                if (respon.getBoolean("status")) {
                    Toast.makeText(MainActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                    JSONObject datalogin = res.getJSONObject("datauser");

                    authdata.getInstance(getApplicationContext()).setdatauser(datalogin.getString("login_as"),datalogin.getString("token"),datalogin.getString("akses_data"),datalogin.getString("kode_pengguna"));
                    if(datalogin.getString("login_as").equals("2")){
                        Toast.makeText(MainActivity.this, "Login Sebagai Guru", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(MainActivity.this, BerandaGuru.class);
                        startActivity(intent);

                    }else if(datalogin.getString("login_as").equals("3")){
                        Toast.makeText(MainActivity.this, "Login Sebagai Siswa", Toast.LENGTH_SHORT).show();

                    }else{
                        Toast.makeText(MainActivity.this, "Invalid Akses", Toast.LENGTH_SHORT).show();

                    }
                } else {
                    Toast.makeText(MainActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();

                }

//                                pd.dismiss();

            } catch (JSONException e) {
                progressDialog.dismiss();
//                                e.printStackTrace();
                Log.e("errorgan", e.getMessage());
            }
        }
    }, new Response.ErrorListener() {
        @Override
        public void onErrorResponse(VolleyError error) {
//                            pd.cancel();
            progressDialog.dismiss();
            Log.e("errornyaa ", "" + error);
            Toast.makeText(MainActivity.this, "Gagal Login, " + error, Toast.LENGTH_SHORT).show();


        }
    }) {
        @Override
        protected Map<String, String> getParams() throws AuthFailureError {
            Map<String, String> params = new HashMap<>();
            params.put("emailnya", EmailHolder);
            params.put("passwordnya", PasswordHolder);

            return params;
        }
    };

    AppController.getInstance().addToRequestQueue(senddata);
}

    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(R.drawable.logosmea)
                .setTitle("Keluar Aplikasi")
                .setMessage("Apakah Anda Ingin Keluar Dari Aplikasi?")
                .setPositiveButton("Ya", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        ActivityCompat.finishAffinity(MainActivity.this);
                        finish();
                    }

                })
                .setNegativeButton("Tidak", null)
                .show();
    }
    public void CheckEditTextIsEmptyOrNot(){
        EmailHolder = Email.getText().toString().trim();
        PasswordHolder = Password.getText().toString().trim();

        if (TextUtils.isEmpty(EmailHolder) || TextUtils.isEmpty(PasswordHolder)){
            CheckEditText = false;
        }else{
            CheckEditText = true;
        }
    }
}
