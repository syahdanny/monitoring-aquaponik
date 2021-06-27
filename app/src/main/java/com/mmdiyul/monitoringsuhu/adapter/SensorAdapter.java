package com.mmdiyul.monitoringsuhu.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.mmdiyul.monitoringsuhu.R;
import com.mmdiyul.monitoringsuhu.model.Sensor;

import java.util.List;

public class SensorAdapter extends RecyclerView.Adapter<SensorAdapter.MyViewHolder> {

    List<Sensor> sensorList;
    private Context context;

    public SensorAdapter(List<Sensor> sensorList, Context context) {
        this.sensorList = sensorList;
        this.context = context;
    }

    @NonNull
    @Override
    public SensorAdapter.MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(context);
        View menuView = layoutInflater.inflate(R.layout.sensor_item, parent, false);
        MyViewHolder viewHolder = new MyViewHolder(menuView);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull SensorAdapter.MyViewHolder holder, int position) {
        Sensor sensor = sensorList.get(position);
        holder.ketinggian.setText(String.valueOf(sensor.getKetinggian()));
        holder.kekeruhan.setText(String.valueOf(sensor.getKekeruhan()));
        holder.pH.setText(String.valueOf(sensor.getpH()));
        holder.update.setText(String.valueOf(sensor.getUpdate()));
    }

    @Override
    public int getItemCount() {
        return sensorList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView ketinggian, kekeruhan, pH, update;

        public MyViewHolder(@NonNull View itemView) {
            super(itemView);
            this.ketinggian = itemView.findViewById(R.id.ketinggian);
            this.kekeruhan = itemView.findViewById(R.id.kekeruhan);
            this.pH = itemView.findViewById(R.id.pH);
            this.update = itemView.findViewById(R.id.update);
        }
    }
}
