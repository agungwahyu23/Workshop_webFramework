package com.example.jurnal_guruku.guru.adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import com.example.jurnal_guruku.R;
import com.example.jurnal_guruku.guru.model.JadwalModel;

import java.util.List;

public class AdapterJadwal extends RecyclerView.Adapter<AdapterJadwal.HolderData> {
    private List<JadwalModel> mItems;
    private Context context;

    public AdapterJadwal(Context context, List<JadwalModel> mItems){
        this.mItems = mItems;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View layout = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.template_jadwal,viewGroup,false);
        AdapterJadwal.HolderData holderData = new AdapterJadwal.HolderData((layout));
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterJadwal.HolderData holder, int position) {
        JadwalModel me = mItems.get(position);
        String[] thiar = {"Belum Mengajar","Sudah", "Proses",};
        String[] thiarcolor = {"#d35400","#f1c40f", "#2ecc71",};
        try{
            holder.namakelas.setText(me.getNama_kelas());
            holder.namamapel.setText(me.getNama_mapel());
            holder.status.setText(thiar[Integer.parseInt(me.getThis_week())]);
            holder.jam.setText(me.getJam_mulai() + " - " + me.getJam_akhir());
            holder.panelstatus.setBackgroundColor(Color.parseColor(thiarcolor[Integer.parseInt(me.getThis_week())]));
            holder.kode = me.getKode();
        }catch (Exception ea){
            ea.printStackTrace();
        }
    }


    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderData extends RecyclerView.ViewHolder {
        LinearLayout panelstatus;
        TextView namakelas , namamapel , jam, status;
        CardView cardpanel;
        String kode;
        public HolderData(@NonNull View itemView) {

            super(itemView);
            namakelas = itemView.findViewById(R.id.nama_kelas);
            namamapel = itemView.findViewById(R.id.nama_mapel);
            jam = itemView.findViewById(R.id.jam);
            status = itemView.findViewById(R.id.status);
            panelstatus = itemView.findViewById(R.id.panelstatus);
            cardpanel = itemView.findViewById(R.id.cardjadwal);
        }
    }
}
