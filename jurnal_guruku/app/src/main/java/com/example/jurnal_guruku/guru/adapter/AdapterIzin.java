package com.example.jurnal_guruku.guru.adapter;

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
import com.example.jurnal_guruku.guru.model.IzinModel;
import com.example.jurnal_guruku.guru.ui.jadwal.DetailJadwalGuru;

import java.util.List;

public class AdapterIzin extends RecyclerView.Adapter<AdapterIzin.HolderData> {
    private List<IzinModel> mItems;
    private Context context;

    public AdapterIzin(Context context, List<IzinModel> mItems){
        this.mItems = mItems;
        this.context = context;
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View layout = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.template_izin,viewGroup,false);
        AdapterIzin.HolderData holderData = new AdapterIzin.HolderData((layout));
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterIzin.HolderData holder, int position) {
        IzinModel me = mItems.get(position);
        String[] thiar = {"Belum Mengajar","Sudah", "Proses",};
        String[] thiarcolor = {"#d35400","#f1c40f", "#2ecc71",};
        try{
            holder.createat.setText(me.getCreate_at());
            holder.keterangan.setText(me.getKeterangan());
            holder.status.setText(thiar[Integer.parseInt(me.getStatus())]);
            holder.jam.setText(me.getAkhir() + " - " + me.getAkhir());
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

    public class HolderData extends RecyclerView.ViewHolder{
        LinearLayout panelstatus;
        TextView createat , keterangan, jam, status;
        CardView cardpanel;
        String kode;
        public HolderData(View itemView) {

            super(itemView);
            createat = itemView.findViewById(R.id.create);
            keterangan = itemView.findViewById(R.id.keterangan);
            jam = itemView.findViewById(R.id.jam);
            status = itemView.findViewById(R.id.status);
            panelstatus = itemView.findViewById(R.id.panelstatus);
            cardpanel = itemView.findViewById(R.id.cardizin);

//            cardpanel.setOnClickListener(new View.OnClickListener() {
//                @Override
//                public void onClick(View v) {
//                    Intent intent = new Intent(context, DetailJadwalGuru.class);
//                    intent.putExtra("putkode", kode);
//                    context.startActivity(intent);
//                }
//            });


        }
    }
}
