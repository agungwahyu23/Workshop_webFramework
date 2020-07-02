package com.example.jurnal_guruku.guru.ui.akun;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;

import com.example.jurnal_guruku.MainActivity;
import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.authdata;
import com.example.jurnal_guruku.guru.BerandaGuru;
import com.example.jurnal_guruku.guru.adapter.AdapterJadwal;
import com.example.jurnal_guruku.guru.ui.akun.izin.IzinFragment;
import com.example.jurnal_guruku.guru.ui.akun.izin.IzinGuru;

import java.util.ArrayList;

public class Akun extends Fragment {

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.activity_akun, container, false);
        RelativeLayout rtkeluar = root.findViewById(R.id.rtkeluarakun);
        RelativeLayout rtizin = root.findViewById(R.id.rtdataizin);

        rtizin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), IzinGuru.class);
                startActivity(intent);
            }
        });

        rtkeluar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder builder = new AlertDialog.Builder(getContext());
                builder.setCancelable(false);
                builder.setMessage("Apakah Anda Ingin Keluar ? ");
                builder.setPositiveButton("Ya", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        authdata.getInstance(getContext()).logout();
                        startActivity(new Intent(getActivity(), MainActivity.class)
                                .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));

                    }
                });
                builder.setNegativeButton("Tidak", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                });
                AlertDialog alert = builder.create();
                alert.show();
            }
        });
        return root;
    }
}