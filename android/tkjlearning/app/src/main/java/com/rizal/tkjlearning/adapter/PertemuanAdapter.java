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
import com.rizal.tkjlearning.model.MateriModel;
import com.rizal.tkjlearning.ui.Detailpertemuan;
import com.rizal.tkjlearning.ui.Pertemuan;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class PertemuanAdapter extends RecyclerView.Adapter<PertemuanAdapter.MyPertemuanHolder>{
	public List<MateriModel> mPertemuanList;

	public PertemuanAdapter(List<MateriModel> mPertemuanList) {
		this.mPertemuanList = mPertemuanList;
	}

	@NonNull
	@Override
	public PertemuanAdapter.MyPertemuanHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_pertemuan1, parent, false);
		PertemuanAdapter.MyPertemuanHolder holder;
		holder = new PertemuanAdapter.MyPertemuanHolder(mView);

		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull PertemuanAdapter.MyPertemuanHolder holder, final int position){
		holder.mJudul.setText(mPertemuanList.get(position).getJudul());

		String tanggal = mPertemuanList.get(position).getTanggal();
		Date Dibuat = new Date(Long.parseLong(tanggal) * 1000);
		SimpleDateFormat formatter = new SimpleDateFormat("EEE, d MMM yyyy", Locale.getDefault());
		String date = formatter.format(Dibuat);
		holder.mTanggal.setText(date);


		holder.itemView.setOnClickListener(view -> {
			Intent mIntent = new Intent(view.getContext(), Detailpertemuan.class);
			mIntent.putExtra("idPertemuan",mPertemuanList.get(position).getId_pertemuan());
			view.getContext().startActivity(mIntent);
		});
	}

	public int getItemCount () {
		return mPertemuanList.size();
	}


	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<MateriModel> dataPertemuan) {
		this.mPertemuanList = dataPertemuan;
		notifyDataSetChanged();
	}

	public static class MyPertemuanHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul,mTanggal;

		MyPertemuanHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_pertemuan1);
			mTanggal = itemView.findViewById(R.id.txt_tgl);
		}
	}
}
