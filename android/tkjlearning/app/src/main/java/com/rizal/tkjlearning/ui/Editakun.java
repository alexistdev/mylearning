package com.rizal.tkjlearning.ui;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.widget.EditText;

import com.rizal.tkjlearning.R;

public class Editakun extends AppCompatActivity {
	private Toolbar toolbar;
	private EditText nNama,nNisn,nTelp;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_editakun);
		dataInit();
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Edit Akun");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}

    }

	private void dataInit(){
		//progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		toolbar = findViewById(R.id.toolbar);
		nNama = findViewById(R.id.txt_edtnama);
		nNisn = findViewById(R.id.txt_edtnisn);
		nTelp = findViewById(R.id.txt_edtnotelp);
		nTelp = findViewById(R.id.txt_edtnotelp);
	}

}
