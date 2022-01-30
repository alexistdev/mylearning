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
import com.rizal.tkjlearning.model.TugasModel;
import com.rizal.tkjlearning.ui.DetailTugas;
import com.rizal.tkjlearning.ui.Detailpertemuan;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class TugasAdapter extends RecyclerView.Adapter<TugasAdapter.MyTugasHolder> {
	public List<TugasModel> mTugasList;

	public TugasAdapter(List<TugasModel> mTugasList) {
		this.mTugasList = mTugasList;
	}

	@NonNull
	@Override
	public TugasAdapter.MyTugasHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_tugas, parent, false);
		TugasAdapter.MyTugasHolder holder;
		holder = new TugasAdapter.MyTugasHolder(mView);

		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull TugasAdapter.MyTugasHolder holder, final int position){
		holder.mJudul.setText(mTugasList.get(position).getJudulTugas());
		holder.mMapel.setText(mTugasList.get(position).getNamaMapel());

//		String tanggal = mTugasList.get(position).getTanggalTugas();
//		Date Dibuat = new Date(Long.parseLong(tanggal) * 1000);
//		SimpleDateFormat formatter = new SimpleDateFormat("EEE, d MMM yyyy", Locale.getDefault());
//		String date = formatter.format(Dibuat);
		holder.mTanggal.setText(mTugasList.get(position).getAkhir());



		holder.itemView.setOnClickListener(view -> {
			Intent mIntent = new Intent(view.getContext(), DetailTugas.class);
			//mIntent.putExtra("idPertemuan",mPertemuanList.get(position).getId_pertemuan());
			view.getContext().startActivity(mIntent);
		});
	}

	public int getItemCount () {
		return mTugasList.size();
	}

	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<TugasModel> dataTugas) {
		this.mTugasList = dataTugas;
		notifyDataSetChanged();
	}

	public static class MyTugasHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul,mMapel,mTanggal;

		MyTugasHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_judultugas);
			mMapel = itemView.findViewById(R.id.txt_mapel);
			mTanggal = itemView.findViewById(R.id.txt_tgl);
		}
	}

}
