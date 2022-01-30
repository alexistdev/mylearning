package com.rizal.tkjlearning.fragment;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.ui.Jadwal;
import com.rizal.tkjlearning.ui.Matapelajaran;
import com.rizal.tkjlearning.ui.Tugas;

public class Home_fragment extends Fragment {

	private CardView mMapel,mJadwal,mTugas;
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View myview = inflater.inflate(R.layout.fragment_home, container, false);
		init(myview);
		mMapel.setOnClickListener(view -> {
			Intent intent = new Intent(getActivity(), Matapelajaran.class);
			startActivity(intent);
		});
		mJadwal.setOnClickListener(view -> {
			Intent intent = new Intent(getActivity(), Jadwal.class);
			startActivity(intent);
		});
		mTugas.setOnClickListener(view -> {
			Intent intent = new Intent(getActivity(), Tugas.class);
			startActivity(intent);
		});
		return myview;
	}


	public void init(View view) {
		mMapel = view.findViewById(R.id.cd_mapel);
		mJadwal = view.findViewById(R.id.cd_jadwal);
		mTugas = view.findViewById(R.id.cd_tugas);
	}

}

