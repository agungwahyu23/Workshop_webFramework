package com.example.jurnal_guruku.guru.ui.jadwal;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.jurnal_guruku.R;

public class DetailJadwalFragment extends Fragment {
    TextView teks;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_detail_jadwal, container, false);
        teks = root.findViewById(R.id.lv);
        return root;
    }
}
