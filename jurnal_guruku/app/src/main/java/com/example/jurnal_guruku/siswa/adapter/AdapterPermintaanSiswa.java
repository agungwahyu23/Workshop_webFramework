package com.example.jurnal_guruku.siswa.adapter;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.config.UtilApp;
import com.example.jurnal_guruku.guru.model.PermintaanModel;
import com.example.jurnal_guruku.guru.ui.jadwal.DetailJadwalGuru;
import com.example.jurnal_guruku.siswa.ui.permintaan.DetailPermintaanSiswa;

import java.util.List;

public class AdapterPermintaanSiswa extends RecyclerView.Adapter<AdapterPermintaanSiswa.HolderData> {
    private List<PermintaanModel> mItems;
    private Context context;

    public AdapterPermintaanSiswa(Context context, List<PermintaanModel> mItems){
        this.mItems = mItems;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View layout = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.template_permintaan,viewGroup,false);
        AdapterPermintaanSiswa.HolderData holderData = new AdapterPermintaanSiswa.HolderData((layout));
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull HolderData holder, int position) {
        PermintaanModel me = mItems.get(position);
        String[] thiar = {"Tidak Aktif","Aktif","Selesai"};
        String[] thiarcolor = {"#e74c3c","#2980b9", "#27ae60",};
        try{
            holder.createat.setText(UtilApp.setwaktu(me.getCreate_at()));
            holder.namamapel.setText(me.getNama_mapel());
            holder.jam.setText(me.getJam_awal() + " - " + me.getJam_akhir());
            holder.deskripsi.setText(me.getDeskripsi());
            holder.status.setText(thiar[Integer.parseInt(me.getStatus())]);
            holder.panelstatus.setBackgroundColor(Color.parseColor(thiarcolor[Integer.parseInt(me.getStatus())]));
            holder.kode = me.getKode();
        }catch (Exception ea){
            ea.printStackTrace();
        }
    }


    public int getItemCount() {
        return mItems.size();
    }

    public class HolderData extends RecyclerView.ViewHolder {
        TextView createat, namamapel, jam, deskripsi, status;
        LinearLayout panelstatus;
        CardView cardpanel;
        String kode;
        public HolderData(@NonNull View itemView) {

            super(itemView);
            createat = itemView.findViewById(R.id.create);
            namamapel = itemView.findViewById(R.id.nama_mapel);
            jam = itemView.findViewById(R.id.jam_p);
            deskripsi = itemView.findViewById(R.id.deskripsi);
            cardpanel = itemView.findViewById(R.id.cardpermintaan);
            status = itemView.findViewById(R.id.status);
            panelstatus = itemView.findViewById(R.id.panelstatus);

            cardpanel.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(context, DetailPermintaanSiswa.class);
                    intent.putExtra("putkode", kode);
                    context.startActivity(intent);
                }
            });
        }
    }
}
