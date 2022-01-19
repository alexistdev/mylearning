package com.rizal.tkjlearning.ui;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
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
import com.rizal.tkjlearning.adapter.PertemuanAdapter;
import com.rizal.tkjlearning.model.MateriModel;
import com.rizal.tkjlearning.response.GetPertemuan;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Pertemuan extends AppCompatActivity {
	private Toolbar toolbar;
	private RecyclerView gridView;
	private PertemuanAdapter pertemuanAdapter;
	private List<MateriModel> daftarPertemuan;
	private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pertemuan);

		dataInit();
		setupRecyclerView();

		Intent iin= getIntent();
		Bundle extra = iin.getExtras();
		if(extra != null){
			final String idMapel = extra.getString("idMapel","0");
			setData(getApplicationContext(),idMapel);
		}
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Pertemuan");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
    }

	public void setData(Context mContext, String idMapel) {
		try{
			Call<GetPertemuan> call = APIService.Factory.create(mContext).dataPertemuan(idMapel);
			call.enqueue(new Callback<GetPertemuan>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<GetPertemuan> call, Response<GetPertemuan> response) {
					progressDialog.dismiss();
					if(response.isSuccessful()) {
						if (response.body() != null) {
							daftarPertemuan = response.body().getDaftarPertemuan();
							pertemuanAdapter.replaceData(daftarPertemuan);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<GetPertemuan> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						progressDialog.dismiss();
						pesan("Offline, cek koneksi internet anda!");
					}
				}
			});
		}catch (Exception e){
			progressDialog.dismiss();
			e.printStackTrace();
		}
	}

	private void dataInit(){
		progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		toolbar = findViewById(R.id.toolbar);
		gridView = findViewById(R.id.rcPertemuan);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		pertemuanAdapter = new PertemuanAdapter(new ArrayList<>());
		gridView.setLayoutManager(linearLayoutManager);
		gridView.setAdapter(pertemuanAdapter);
	}

	public void pesan(String msg)
	{
		Toast.makeText(this, msg, Toast.LENGTH_LONG).show();
	}

}
