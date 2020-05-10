package com.example.jurnal_guruku.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.jurnal_guruku.Model.ModelData;
import com.example.jurnal_guruku.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class ListAdapter extends BaseAdapter {
    private Context context;
    private ArrayList<ModelData> items;

    public ListAdapter (Context context, ArrayList<ModelData>items) {
        this.context = context;
        this.items = items;
    }
    public int getViewTypeCount(){
        return getCount();
    }

    public int getItemViewType(int position){
        return position;
    }

    @Override
    public int getCount() {
        return items.size();
    }

    @Override
    public Object getItem(int i) {
        return items.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }

    public View getView(int position, View convertView, ViewGroup parent) {
        ViewHolder holder;

        if (convertView == null){
            convertView = LayoutInflater.from(context).inflate(R.layout.list_item_home, parent, false);
            ModelData modelData = (ModelData) getItem(position);

            holder = new ViewHolder();

            holder.tvkelas = (TextView) convertView.findViewById(R.id.kelas);
            holder.tvjam = (TextView) convertView.findViewById(R.id.jam);

            convertView.setTag(holder);
        }else{
            holder = (ViewHolder)convertView.getTag();
        }

        holder.tvkelas.setText("Provinsi: "+items.get(position).getKelas());
        holder.tvjam.setText("Positif: "+items.get(position).getJam());

        return convertView;
    }

    private class ViewHolder {

        protected TextView tvkelas, tvjam;
        protected ImageView iv;
    }
}
