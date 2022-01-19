package com.rizal.tkjlearning;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.rizal.tkjlearning.API.APIService;
import com.rizal.tkjlearning.model.APIError;
import com.rizal.tkjlearning.model.LoginModel;
import com.rizal.tkjlearning.utils.ErrorUtils;
import com.rizal.tkjlearning.utils.SessionHandle;
import java.util.regex.Pattern;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class LoginActivity extends AppCompatActivity {
	private ProgressDialog pDialog;
	private Button mLogin;
	private EditText mEmail,mPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
      	this.dataInit();
		/* Cek Login */
		if(SessionHandle.isLoggedIn(this)){
			Intent intent = new Intent(LoginActivity.this, MainActivity.class);
			startActivity(intent);
			finish();
		}
        mLogin.setOnClickListener(v -> {
			String email = mEmail.getText().toString();
			String password = mPassword.getText().toString();
			if(email.trim().length()> 0 && password.trim().length() >0){
				if(cekEmail(email)){
					checkLogin(email,password);
				}else{
					pesan("Masukkan email yang valid !");
				}
			} else {
				pesan("Semua kolom harus diisi!");
			}
		});
    }
	private void checkLogin(final String email, final String password) {
		tampilkanDialog();
		try{
			Call<LoginModel> login = APIService.Factory.create(getApplicationContext()).loginUser(email,password);
			login.enqueue(new Callback<LoginModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<LoginModel> call, Response<LoginModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							if (SessionHandle.login(LoginActivity.this, response.body().getIdUser(), response.body().getIdKelas())){
								Intent intent = new Intent(LoginActivity.this, MainActivity.class);
								startActivity(intent);
								finish();
							}
						}
					} else {
						sembunyikanDialog();
						APIError error = ErrorUtils.parseError(response);
						pesan(error.message());
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<LoginModel> call, Throwable t) {
					sembunyikanDialog();
					pesan(t.getMessage());
				}
			});
		} catch (Exception e){
			sembunyikanDialog();
			e.printStackTrace();
			pesan(e.getMessage());
		}

	}

	private boolean cekEmail(String email){
		return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
				+ "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
				+ "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
				+ "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
	}

	private void dataInit(){
		mLogin = findViewById(R.id.tbl_login);
		mEmail = findViewById(R.id.ed_email);
		mPassword = findViewById(R.id.ed_password);
		pDialog = new ProgressDialog(this);
		pDialog.setCancelable(false);
		pDialog.setMessage("Loading.....");
	}

	private void tampilkanDialog(){
		if(!pDialog.isShowing()){
			pDialog.show();
		}
	}

	private void sembunyikanDialog(){
		if(pDialog.isShowing()){
			pDialog.dismiss();
		}
	}

	private void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}
}
