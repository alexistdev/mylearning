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

public class home_fragment2 extends Fragment {
	private CardView mPelajaran,mTugas,mJadwal;



    public home_fragment2() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
		View view = inflater.inflate(R.layout.fragment_home2, container, false);
		dataInit(view);
		mPelajaran.setOnClickListener(v -> {
			Intent mIntent = new Intent(getContext(), Matapelajaran.class);
			startActivity(mIntent);
		});
		mTugas.setOnClickListener(v -> {
			Intent mIntent = new Intent(getContext(), Tugas.class);
			startActivity(mIntent);
		});
		mJadwal.setOnClickListener(v -> {
			Intent mIntent = new Intent(getContext(), Jadwal.class);
			startActivity(mIntent);
		});
        return view;
    }

	private void dataInit(View mview){

    	mPelajaran = mview.findViewById(R.id.cd_matapelajaran);
		mTugas = mview.findViewById(R.id.cd_tugas);
		mJadwal = mview.findViewById(R.id.cd_jadwal);

	}

//	private void pesan(String msg)
//	{
//		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
//	}
}
