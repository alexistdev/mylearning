package com.rizal.tkjlearning.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.API.NoConnectivityException;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.adapter.JawabanAdapter;
import com.rizal.tkjlearning.model.JawabanModel;
import com.rizal.tkjlearning.response.GetJawaban;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Tugas_fragment extends Fragment {
	private RecyclerView gridView;
	private JawabanAdapter jawabanAdapter;
	private List<JawabanModel> daftarJawaban;
	private ProgressDialog progressDialog;


	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		// Inflate the layout for this fragment
		View view = inflater.inflate(R.layout.fragment_tugas, container, false);
		dataInit(view);
		setupRecyclerView();
		String idUser = "6";
		setData(getContext(),idUser);
		return view;
	}

	private void setData(Context context, String idUser) {
		try {
			Call<GetJawaban> call = APIService.Factory.create(context).dataJawaban(idUser);
			call.enqueue(new Callback<GetJawaban>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<GetJawaban> call, Response<GetJawaban> response) {
					progressDialog.dismiss();
					if(response.isSuccessful()) {
						if (response.body() != null) {
							daftarJawaban = response.body().getDaftarJawaban();
							jawabanAdapter.replaceData(daftarJawaban);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<GetJawaban> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						progressDialog.dismiss();
						pesan("Offline, cek koneksi internet anda!");
					}
				}
			});
		} catch (Exception e) {
			progressDialog.dismiss();
			e.printStackTrace();
		}
	}

	@Override
	public void onResume() {
		super.onResume();
		//setupRecyclerView();
	}

	private void dataInit(View mView){
		progressDialog = ProgressDialog.show(getContext(), "", "Loading.....", true, false);
		gridView = mView.findViewById(R.id.rcRiwayat);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getActivity()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		jawabanAdapter = new JawabanAdapter(new ArrayList<>());
		gridView.setLayoutManager(linearLayoutManager);
		gridView.setAdapter(jawabanAdapter);
	}

	public void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
