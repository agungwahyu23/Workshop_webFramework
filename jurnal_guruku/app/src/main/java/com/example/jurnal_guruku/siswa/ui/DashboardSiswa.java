package com.example.jurnal_guruku.siswa.ui;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

import android.content.DialogInterface;
import android.os.Bundle;
import android.view.MenuItem;

import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.guru.BerandaGuru;
import com.example.jurnal_guruku.guru.ui.akun.Akun;
import com.example.jurnal_guruku.guru.ui.home.HomeFragment;
import com.example.jurnal_guruku.guru.ui.jadwal.JadwalFragment;
import com.example.jurnal_guruku.guru.ui.permintaan.PermintaanMain;
import com.example.jurnal_guruku.siswa.ui.home.HomeFragmentSiswa;
import com.example.jurnal_guruku.siswa.ui.jadwal.JadwalFragmentSiswa;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class DashboardSiswa extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard_siswa);
        loadFragment(new HomeFragmentSiswa());
        BottomNavigationView navView = findViewById(R.id.bn_main);
        navView.setOnNavigationItemSelectedListener(this);
    }

    private boolean loadFragment(Fragment fragment) {
        if (fragment != null) {
            getSupportFragmentManager().beginTransaction()
                    .replace(R.id.fl_container, fragment)
                    .commit();
            return true;
        }
        return false;
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        Fragment fragment = null;

        switch (menuItem.getItemId()){
            case R.id.navigation_home:
                fragment = new HomeFragmentSiswa();
                break;
            case R.id.navigation_jadwal:
                fragment = new JadwalFragmentSiswa();
                break;
            case R.id.navigation_mengajar:
                fragment = new JadwalFragment();
                break;
            case R.id.navigation_permintaan:
                fragment = new PermintaanMain();
                break;

            case R.id.navigation_akun:
                fragment = new Akun();
                break;
        }
        return loadFragment(fragment);
    }
    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setTitle("Keluar Aplikasi")
                .setMessage("Apakah Anda Ingin Keluar Dari Aplikasi?")
                .setPositiveButton("Ya", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        ActivityCompat.finishAffinity(DashboardSiswa.this);
                        finish();
                    }

                })
                .setNegativeButton("Tidak", null)
                .show();
    }
}