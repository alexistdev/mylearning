package com.rizal.tkjlearning.adapter;

import android.annotation.SuppressLint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.model.JawabanModel;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class JawabanAdapter extends RecyclerView.Adapter<JawabanAdapter.MyJawabanHolder> {
	public List<JawabanModel> mJawabanList;
	public JawabanAdapter(List<JawabanModel> mJawabanList) {
		this.mJawabanList = mJawabanList;
	}

	@NonNull
	@Override
	public JawabanAdapter.MyJawabanHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_jawaban, parent, false);
		JawabanAdapter.MyJawabanHolder holder;
		holder = new JawabanAdapter.MyJawabanHolder(mView);

		return holder;

	}

	@Override
	public void onBindViewHolder (@NonNull JawabanAdapter.MyJawabanHolder holder, final int position){
		holder.mJudul.setText(mJawabanList.get(position).getJudulTugas());

		String tanggal = mJawabanList.get(position).getTanggal();
		Date Dibuat = new Date(Long.parseLong(tanggal) * 1000);
		SimpleDateFormat formatter = new SimpleDateFormat("EEE, d MMM yyyy", Locale.getDefault());
		String date = formatter.format(Dibuat);
		holder.mTanggal.setText(date);
	}

	public int getItemCount () {
		return mJawabanList.size();
	}

	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<JawabanModel> dataJawaban) {
		this.mJawabanList = dataJawaban;
		notifyDataSetChanged();
	}

	public static class MyJawabanHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul,mTanggal;

		MyJawabanHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_nmtugas);
			mTanggal = itemView.findViewById(R.id.txt_tgl);

		}
	}
}
