package com.rizal.tkjlearning;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.rizal.tkjlearning.fragment.Account_fragment;
import com.rizal.tkjlearning.fragment.Bantuan;
import com.rizal.tkjlearning.fragment.Home_fragment;
import com.rizal.tkjlearning.fragment.Tugas_fragment;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

		loadFragment(new Home_fragment());
		/* Mengatur Menu bottom bar */
		BottomNavigationView bottomNavigationView = findViewById(R.id.bottomMenu);
		bottomNavigationView.setOnNavigationItemSelectedListener(item -> {
			Fragment fragment = null;
			switch (item.getItemId()){
				case R.id.home_menu:
					fragment = new Home_fragment();
					break;
				case R.id.bantuan_menu:
					fragment = new Bantuan();
					break;
				case R.id.tugas_menu:
					fragment = new Tugas_fragment();
					break;
				default:
					fragment = new Account_fragment();
			}
			return loadFragment(fragment);
		});

		Bundle extras = getIntent().getExtras();
		if(extras!=null && extras.containsKey("bukaBantuan")) {
			boolean bukaKeranjang = extras.getBoolean("bukaBantuan");
			if(bukaKeranjang){
				Fragment fragment = null;
				fragment = new Bantuan();
				loadFragment(fragment);

//				bottomNavigationView.performClick();
			}
		}
    }

	private boolean loadFragment(Fragment fragment) {
		if (fragment != null) {
			getSupportFragmentManager().beginTransaction()
					.replace(R.id.fl_container, fragment)
					.commit();
			return true;
		}
		return false;
	}
}
