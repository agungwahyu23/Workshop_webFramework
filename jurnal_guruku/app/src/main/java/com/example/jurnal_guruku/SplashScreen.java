package com.example.jurnal_guruku;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.BerandaGuru;
import com.example.jurnal_guruku.siswa.ui.DashboardSiswa;

import static java.lang.Thread.sleep;

public class SplashScreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                try {
                    sleep(1000);
                    SplashScreen.this.finish();
                    if (authdata.getInstance(getApplicationContext()).ceklogin()) {
                        if (authdata.getInstance(getApplicationContext()).getLevel().equals("2")){
                           Intent home = new Intent(SplashScreen.this, BerandaGuru.class);
                           startActivity(home);
                        } else{
                            Intent home = new Intent(SplashScreen.this, DashboardSiswa.class);
                            startActivity(home);
                        }
                    }
                    else {
                        Intent b = new Intent(SplashScreen.this, MainActivity.class);
                        startActivity(b);
                    }
                }
                catch (InterruptedException e) {

                    e.printStackTrace();
                }
            }
        }, 2000);
    }
}
