package com.rizal.tkjlearning.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.fragment.app.Fragment;
import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.API.NoConnectivityException;
import com.rizal.tkjlearning.LoginActivity;
import com.rizal.tkjlearning.MainActivity;
import com.rizal.tkjlearning.R;
import com.rizal.tkjlearning.config.Constants;
import com.rizal.tkjlearning.model.AkunModel;
import com.rizal.tkjlearning.ui.Editakun;
import com.rizal.tkjlearning.ui.Ketentuan;
import com.rizal.tkjlearning.utils.SessionHandle;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;


public class Account_fragment extends Fragment {
	private ProgressDialog progressDialog;
	private ImageView mEdit;
	private Button mLogout;
	private TextView mNama,mEmail,mPhone,mAlamat,mNisn;
	private ConstraintLayout mBantuan,mKetentuan;

    public Account_fragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

		View mview =  inflater.inflate(R.layout.fragment_account, container, false);
		if(getActivity() != null){
			getActivity().setTitle("Setting Akun");
		}
		SharedPreferences sharedPreferences = getActivity().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String idUser = sharedPreferences.getString("idUser", "");
		dataInit(mview);
		setData(idUser);

		mEdit.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent intent = new Intent(getActivity(), Editakun.class);
				startActivity(intent);
			}
		});
		mLogout.setOnClickListener(v -> {
			SessionHandle.logout(requireContext());
			Intent intent = new Intent(getActivity(), LoginActivity.class);
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
			startActivity(intent);
			if(getActivity()!= null){
				getActivity().finish();
			}
		});

		mBantuan.setOnClickListener(v -> {
			Intent intent = new Intent(getActivity(), MainActivity.class);
			intent.putExtra("bukaBantuan",true);
			startActivity(intent);
		});
		mKetentuan.setOnClickListener(v -> {
			Intent intent = new Intent(getActivity(), Ketentuan.class);
			startActivity(intent);
		});

		return mview;
    }

	private void setData(String idUser)
	{
		try{
			Call<AkunModel> call= APIService.Factory.create(getContext()).detailAkun(idUser);
			call.enqueue(new Callback<AkunModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<AkunModel> call, Response<AkunModel> response) {
					progressDialog.dismiss();
					if(response.body() != null) {
						String nisnx = getString(R.string.akun14) + response.body().getNisn();
						mEmail.setText(response.body().getEmail());
						mNama.setText(response.body().getNama_lengkap());
						mPhone.setText(response.body().getPhone());
						mNisn.setText(nisnx);
						mAlamat.setText(response.body().getAlamat());
					}
				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<AkunModel> call, Throwable t) {
					progressDialog.dismiss();
					if(t instanceof NoConnectivityException) {
						pesan("Internet Offline!");
					}
				}
			});
		} catch (Exception e){
			progressDialog.dismiss();
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}

	private void dataInit(View mview) {
		progressDialog = ProgressDialog.show(getActivity(), "", "Loading.....", true, false);
		mNama = mview.findViewById(R.id.txt_nama);
		mNisn = mview.findViewById(R.id.txt_nisn);
		mPhone = mview.findViewById(R.id.txt_nohp);
		mEmail = mview.findViewById(R.id.txt_email);
		mAlamat = mview.findViewById(R.id.txt_alamat);
		mLogout = mview.findViewById(R.id.btn_logout);
		mEdit = mview.findViewById(R.id.img_edit);
		mBantuan = mview.findViewById(R.id.ly_bantuan);
		mKetentuan = mview.findViewById(R.id.ly_ketentuan);

	}

	private void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}

}
