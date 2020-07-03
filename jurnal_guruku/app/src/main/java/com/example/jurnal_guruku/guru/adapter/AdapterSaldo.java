package com.example.jurnal_guruku.guru.adapter;

import android.content.Context;
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
import com.example.jurnal_guruku.guru.model.SaldoModel;

import java.util.List;

public class AdapterSaldo extends RecyclerView.Adapter<AdapterSaldo.HolderData> {
    private List<SaldoModel> mItems;
    private Context context;

    public AdapterSaldo(Context context, List<SaldoModel> mItems){
        this.mItems = mItems;
        this.context = context;
    }


    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View layout = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.template_saldo,viewGroup,false);
        AdapterSaldo.HolderData holderData = new AdapterSaldo.HolderData((layout));
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterSaldo.HolderData holder, int position) {
        SaldoModel me = mItems.get(position);
        try{
            holder.createat.setText(me.getCreate_at());
            holder.keterangan.setText(me.getKeterangan());
            holder.jumlah.setText(me.getJumlah());
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
        TextView createat , keterangan, jumlah;
        CardView cardpanel;
        String kode;
        public HolderData(View itemView) {

            super(itemView);
            createat = itemView.findViewById(R.id.create);
            keterangan = itemView.findViewById(R.id.keterangan);
            jumlah = itemView.findViewById(R.id.jumlah);
            cardpanel = itemView.findViewById(R.id.cardsaldo);

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
