package com.rizal.tkjlearning.ui;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.view.ViewGroup;
import android.widget.Toast;

import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.API.NoConnectivityException;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.adapter.JadwalAdapter;
import com.rizal.tkjlearning.adapter.PertemuanAdapter;
import com.rizal.tkjlearning.model.JadwalModel;
import com.rizal.tkjlearning.model.MateriModel;
import com.rizal.tkjlearning.response.GetJadwal;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Jadwal extends AppCompatActivity {
	private Toolbar toolbar;
	private RecyclerView gridView;
	private ProgressDialog progressDialog;
	private JadwalAdapter jadwalAdapter;
	private List<JadwalModel> daftarJadwal;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_jadwal);
		dataInit();
		setupRecyclerView();
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Pertemuan");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
		String idUser = "6";
		setData(getApplicationContext(),idUser);
    }

	public void setData(Context mContext, String idUser) {
		try {
			Call<GetJadwal> call = APIService.Factory.create(mContext).dataJadwal(idUser);
			call.enqueue(new Callback<GetJadwal>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<GetJadwal> call, Response<GetJadwal> response) {
					progressDialog.dismiss();
					if(response.isSuccessful()) {
						if (response.body() != null) {
							daftarJadwal = response.body().getDaftarJadwal();
							jadwalAdapter.replaceData(daftarJadwal);
						}
					}
				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<GetJadwal> call, Throwable t) {
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

	private void dataInit(){
		progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		toolbar = findViewById(R.id.toolbar);
		gridView = findViewById(R.id.rcJadwal);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		jadwalAdapter = new JadwalAdapter(new ArrayList<>());
		gridView.setLayoutManager(linearLayoutManager);
		gridView.setAdapter(jadwalAdapter);
	}

	public void pesan(String msg)
	{
		Toast.makeText(this, msg, Toast.LENGTH_LONG).show();
	}
}
