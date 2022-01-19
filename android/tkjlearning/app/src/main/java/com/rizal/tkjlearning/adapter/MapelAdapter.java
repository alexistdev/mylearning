package com.rizal.tkjlearning.adapter;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.model.MapelModel;
import com.rizal.tkjlearning.ui.Pertemuan;

import java.util.List;

public class MapelAdapter extends RecyclerView.Adapter<MapelAdapter.MyMapelHolder> {
	public List<MapelModel> mMapelList;

	public MapelAdapter(List<MapelModel> mMapelList) {
		this.mMapelList = mMapelList;
	}

	@NonNull
	@Override
	public MapelAdapter.MyMapelHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_menu_matapelajaran, parent, false);
		MapelAdapter.MyMapelHolder holder;
		holder = new MapelAdapter.MyMapelHolder(mView);

		return holder;
	}
	@Override
	public void onBindViewHolder (@NonNull MapelAdapter.MyMapelHolder holder, final int position){
		holder.mJudul.setText(mMapelList.get(position).getNama_pelajaran());
		holder.itemView.setOnClickListener(view -> {
			Intent mIntent = new Intent(view.getContext(), Pertemuan.class);
			mIntent.putExtra("idMapel",mMapelList.get(position).getId_pelajaran());
			view.getContext().startActivity(mIntent);
		});
	}

	public int getItemCount () {
		return mMapelList.size();
	}

	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<MapelModel> dataMapel) {
		this.mMapelList = dataMapel;
		notifyDataSetChanged();
	}
	public static class MyMapelHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul;

		MyMapelHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_mapel);
		}
	}

}
