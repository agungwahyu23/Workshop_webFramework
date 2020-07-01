package com.example.jurnal_guruku.guru;

import android.content.DialogInterface;
import android.os.Bundle;
import android.view.MenuItem;

import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.guru.ui.home.HomeFragment;
import com.example.jurnal_guruku.guru.ui.jadwal.JadwalFragment;
import com.example.jurnal_guruku.guru.ui.permintaan.PermintaanMain;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

public class BerandaGuru  extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_beranda_guru);

        loadFragment(new HomeFragment());
        BottomNavigationView navView = findViewById(R.id.bn_main);
        navView.setOnNavigationItemSelectedListener(this);
        // Passing each menu ID as a set of Ids because each
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
                fragment = new HomeFragment();
                break;
            case R.id.navigation_jadwal:
                fragment = new JadwalFragment();
                break;
            case R.id.navigation_mengajar:
                fragment = new JadwalFragment();
                break;
            case R.id.navigation_permintaan:
                fragment = new PermintaanMain();
                break;

            case R.id.navigation_akun:
                fragment = new JadwalFragment();
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
                        ActivityCompat.finishAffinity(BerandaGuru.this);
                        finish();
                    }

                })
                .setNegativeButton("Tidak", null)
                .show();
    }
}
