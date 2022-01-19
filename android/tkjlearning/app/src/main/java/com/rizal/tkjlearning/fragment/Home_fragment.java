package com.rizal.tkjlearning.fragment;

import android.content.Context;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.rizal.tkjlearning.R;

import retrofit2.internal.EverythingIsNonNull;

public class Home_fragment extends Fragment {
	private Context mContext;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		return inflater.inflate(R.layout.fragment_home, container, false);

	}

	@EverythingIsNonNull
	@Override
	public void onAttach(Context context) {
		super.onAttach(context);
		mContext = context;
	}

	@Override
	public void onResume() {
		super.onResume();
		//setupRecyclerView();
	}

}

