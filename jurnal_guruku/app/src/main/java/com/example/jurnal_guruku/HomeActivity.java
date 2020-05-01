package com.example.jurnal_guruku;

import android.os.Bundle;
import android.view.MenuItem;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class HomeActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    private BottomNavigationView menu_bawah;
    private TextView tulisan;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        menu_bawah = findViewById(R.id.menu_bawah);
        tulisan = findViewById(R.id.tulisan);
        menu_bawah.setOnNavigationItemSelectedListener(this);

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
}