package com.rizal.tkjlearning.fragment;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.ui.Matapelajaran;

import retrofit2.internal.EverythingIsNonNull;

public class Home_fragment extends Fragment {

	private CardView mMapel;
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View myview = inflater.inflate(R.layout.fragment_home, container, false);
		init(myview);
		mMapel.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View view) {
				Intent intent = new Intent(getActivity(), Matapelajaran.class);
				startActivity(intent);
			}
		});
		return myview;
	}


	public void init(View view) {
		mMapel = view.findViewById(R.id.cd_mapel);
	}

}

