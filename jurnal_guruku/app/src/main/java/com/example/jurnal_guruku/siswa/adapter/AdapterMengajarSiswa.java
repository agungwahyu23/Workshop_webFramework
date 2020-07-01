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
import com.example.jurnal_guruku.siswa.model.ModelMengajar;
import com.example.jurnal_guruku.siswa.ui.jadwal.DetailJadwalSiswa;
import com.example.jurnal_guruku.siswa.ui.mengajar.DetailMengajarSiswa;

import java.util.List;

public class AdapterMengajarSiswa extends RecyclerView.Adapter<AdapterMengajarSiswa.HolderData> {
    private List<ModelMengajar> mItems;
    private Context context;

    public AdapterMengajarSiswa(Context context, List<ModelMengajar> mItems){
        this.mItems = mItems;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View layout = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.template_mengajar_siswa,viewGroup,false);
        AdapterMengajarSiswa.HolderData holderData = new AdapterMengajarSiswa.HolderData((layout));
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterMengajarSiswa.HolderData holder, int position) {
        ModelMengajar me = mItems.get(position);
        String[] thiar = {"","Proses Mengajar","Menunggu Rating","Selesai","","",""};
        String[] stSta = {"Belum Ada Rating","Buruk Sekali","Buruk","Cukup","Baik", "Baik Sekali"};
        String[] thiarcolor = {"#fff","#2980b9","#e67e22", "#27ae60",};
        try{
            holder.tanggal.setText(me.getTanggal());
            holder.namaguru.setText(me.getGuru());
            holder.namamapel.setText(me.getMapel());
            holder.status.setText(thiar[Integer.parseInt(me.getStatus())]);
            holder.jam.setText(me.getJam());
            holder.rating.setText(stSta[Integer.parseInt(me.getRating())]);
            holder.panelstatus.setBackgroundColor(Color.parseColor(thiarcolor[Integer.parseInt(me.getStatus())]));
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
        TextView namaguru , namamapel , tanggal, status, jam, rating;
        CardView cardpanel;
        String kode;
        public HolderData(@NonNull View itemView) {

            super(itemView);
            namaguru = itemView.findViewById(R.id.namaguru);
            tanggal = itemView.findViewById(R.id.create);
            rating = itemView.findViewById(R.id.ratingnya);
            namamapel = itemView.findViewById(R.id.nama_mapel);
            jam = itemView.findViewById(R.id.jam_p);
            status = itemView.findViewById(R.id.status);
            panelstatus = itemView.findViewById(R.id.panelstatus);
            cardpanel = itemView.findViewById(R.id.cardpermintaan);

            cardpanel.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(context, DetailMengajarSiswa.class);
                    intent.putExtra("putkode", kode);
                    context.startActivity(intent);
                }
            });
        }
    }
}
