package com.rizal.tkjlearning.ui;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.ViewGroup;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.API.NoConnectivityException;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.adapter.TugasAdapter;
import com.rizal.tkjlearning.config.Constants;
import com.rizal.tkjlearning.model.TugasModel;
import com.rizal.tkjlearning.response.GetTugas;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Tugas extends AppCompatActivity {
	private Toolbar toolbar;
	private RecyclerView gridView;
	private TugasAdapter tugasAdapter;
	private List<TugasModel> daftarTugas;
	private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tugas);
		dataInit();
		setupRecyclerView();
		SharedPreferences sharedPreferences = getApplicationContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String idKelas = sharedPreferences.getString("idKelas", "");
		setData(getApplicationContext(),idKelas);
		setSupportActionBar(toolbar);

		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Daftar Tugas");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
    }

	public void setData(Context mContext, String idKelas) {
		try {
			Call<GetTugas> call = APIService.Factory.create(mContext).dataTugas(idKelas);
			call.enqueue(new Callback<GetTugas>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<GetTugas> call, Response<GetTugas> response) {
					progressDialog.dismiss();
					if(response.isSuccessful()) {
						if (response.body() != null) {
							daftarTugas = response.body().getDaftarTugas();
							tugasAdapter.replaceData(daftarTugas);
						}
					}
				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<GetTugas> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						progressDialog.dismiss();
						pesan("Offline, cek koneksi internet anda!");
					}
				}

			});
		} catch (Exception e){
			progressDialog.dismiss();
			e.printStackTrace();
		}
	}

	private void dataInit(){
		progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		toolbar = findViewById(R.id.toolbar);
		gridView = findViewById(R.id.rcTugas);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		tugasAdapter = new TugasAdapter(new ArrayList<>());
		gridView.setLayoutManager(linearLayoutManager);
		gridView.setAdapter(tugasAdapter);
	}

	public void pesan(String msg)
	{
		Toast.makeText(this, msg, Toast.LENGTH_LONG).show();
	}
}
