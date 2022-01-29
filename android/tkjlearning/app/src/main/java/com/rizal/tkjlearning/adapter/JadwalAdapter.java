package com.rizal.tkjlearning.adapter;

import android.annotation.SuppressLint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.model.JadwalModel;

import java.util.List;

public class JadwalAdapter extends RecyclerView.Adapter<JadwalAdapter.MyJadwalHolder> {
	public List<JadwalModel> mJadwalList;

	public JadwalAdapter(List<JadwalModel> mJadwalList) {
		this.mJadwalList = mJadwalList;
	}

	@NonNull
	@Override
	public JadwalAdapter.MyJadwalHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.singgle_jadwal, parent, false);
		JadwalAdapter.MyJadwalHolder holder;
		holder = new JadwalAdapter.MyJadwalHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull JadwalAdapter.MyJadwalHolder holder, final int position){
		holder.mJudul.setText(mJadwalList.get(position).getNamaMapel());
		holder.mJadwal.setText(mJadwalList.get(position).getJadwal());
		holder.mKelas.setText(mJadwalList.get(position).getNamaKelas());
	}

	public int getItemCount () {
		return mJadwalList.size();
	}

	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<JadwalModel> dataJadwal) {
		this.mJadwalList = dataJadwal;
		notifyDataSetChanged();
	}

	public static class MyJadwalHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul,mJadwal,mKelas;

		MyJadwalHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_nama);
			mJadwal = itemView.findViewById(R.id.txt_jadwal);
			mKelas = itemView.findViewById(R.id.txt_kelas);

		}
	}
}
