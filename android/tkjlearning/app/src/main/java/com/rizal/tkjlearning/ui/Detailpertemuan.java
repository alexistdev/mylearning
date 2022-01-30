package com.rizal.tkjlearning.ui;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import android.app.DownloadManager;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;
import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.API.NoConnectivityException;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.config.Constants;
import com.rizal.tkjlearning.model.MateriModel;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;


public class Detailpertemuan extends AppCompatActivity {
	private Toolbar toolbar;
	private ProgressDialog progressDialog;
	private TextView mTanggal,mPertemuan,mMateri,mFile;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detailpertemuan);
		dataInit();
		setSupportActionBar(toolbar);
		Intent iin= getIntent();
		Bundle extra = iin.getExtras();
		if(extra != null){
			final String idPertemuan = extra.getString("idPertemuan","0");
			setData(getApplicationContext(),idPertemuan);
		}

		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Detail Pertemuan");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
    }


	private void startDownload(String NamaFile) {
		DownloadManager mManager = (DownloadManager) getSystemService(Context.DOWNLOAD_SERVICE);
		DownloadManager.Request mRqRequest = new DownloadManager.Request(
				Uri.parse(Constants.FILE_URL+NamaFile));
		mManager.enqueue(mRqRequest);
		pesan("Lampiran telah didownload");
	}


	private void setData(Context mContext, String idPertemuan)
	{
		try{
			Call<MateriModel> call= APIService.Factory.create(mContext).detailPertemuan(idPertemuan);
			call.enqueue(new Callback<MateriModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<MateriModel> call, Response<MateriModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							mPertemuan.setText(response.body().getJudul());
							mMateri.setText(response.body().getDeskripsi());
							/* Format tanggal dari Unix ke Human */
//							String tanggal = response.body().getTanggal();
//							Date Dibuat = new Date(Long.parseLong(tanggal) * 1000);
//							SimpleDateFormat formatter = new SimpleDateFormat("EEE, d MMM yyyy", Locale.getDefault());
//							String date = formatter.format(Dibuat);
							mTanggal.setText(response.body().getTanggal());
							if(response.body().getLampiran() != null){
								mFile.setText(response.body().getLampiran());
								mFile.setOnClickListener(v -> startDownload(response.body().getLampiran()));
							}
						}
					}

				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<MateriModel> call, Throwable t) {

					if(t instanceof NoConnectivityException) {

						pesan("Offline, cek koneksi internet anda!");
					}

				}

			});
		} catch (Exception e){
			e.printStackTrace();
		}
	}


	private void dataInit(){
//		progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		toolbar = findViewById(R.id.toolbar);
		mTanggal = findViewById(R.id.dtl_txt_tgl);
		mPertemuan = findViewById(R.id.dtl_nm_pertemuan);
		mMateri = findViewById(R.id.txt_materi);
		mFile = findViewById(R.id.file_pdf);
	}


	private void pesan(String msg)
	{
		Toast.makeText(this, msg, Toast.LENGTH_LONG).show();
	}
}
