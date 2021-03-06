package com.rizal.tkjlearning.API;

import android.content.Context;
import com.rizal.tkjlearning.BuildConfig;
import com.rizal.tkjlearning.config.Constants;
import com.rizal.tkjlearning.model.AkunModel;
import com.rizal.tkjlearning.model.LoginModel;
import com.rizal.tkjlearning.model.MateriModel;
import com.rizal.tkjlearning.response.GetJadwal;
import com.rizal.tkjlearning.response.GetJawaban;
import com.rizal.tkjlearning.response.GetMapel;
import com.rizal.tkjlearning.response.GetPertemuan;
import com.rizal.tkjlearning.response.GetTugas;
import java.util.concurrent.TimeUnit;
import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.Query;
public interface APIService {


	/* Mendapatkan List Riwayat Jawaban  */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/jawaban")
	Call<GetJawaban> dataJawaban(@Query("id_user") String idUser);

	/* Mendapatkan List Tugas */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/tugas")
	Call<GetTugas> dataTugas(@Query("id_kelas") String idKelas);


	/* Mendapatkan List Jadwal  */
	@GET("api/jadwal")
	Call<GetJadwal> dataJadwal(@Query("id_kelas") String idKelas);


	/* Mendapatkan Detail Akun */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/akun")
	Call<AkunModel> detailAkun(@Query("id") String idUser);

	//API untuk login

	@FormUrlEncoded
	@POST("api/login")
	Call<LoginModel> loginUser(@Field("email") String email,
							   @Field("password") String password);

	/* Mendapatkan Data Mata Pelajaran */
	@GET("api/mapel")
	Call<GetMapel> dataMapel(@Query("id_kelas") String idKelas);

	/* Mendapatkan Data Pertemuan */
	@GET("api/pertemuan")
	Call<GetPertemuan> dataPertemuan(@Query("id_mapel") String idMapel);

	/* Mendapatkan Detail Pertemuan */
	@GET("api/pertemuan/detail")
	Call<MateriModel> detailPertemuan(@Query("id") String idPertemuan);

	class Factory{
		public static APIService create(Context mContext){
			OkHttpClient.Builder builder = new OkHttpClient.Builder();
			builder.readTimeout(20, TimeUnit.SECONDS);
			builder.connectTimeout(20, TimeUnit.SECONDS);
			builder.writeTimeout(20, TimeUnit.SECONDS);
			builder.addInterceptor(new NetworkConnectionInterceptor(mContext));
			HttpLoggingInterceptor logging = new HttpLoggingInterceptor();
			if(BuildConfig.DEBUG){
				logging.setLevel(HttpLoggingInterceptor.Level.BODY);
			}else {
				logging.setLevel(HttpLoggingInterceptor.Level.NONE);
			}
			OkHttpClient client = builder.build();

			Retrofit retrofit = new Retrofit.Builder()
					.baseUrl(Constants.URL)
					.client(client)
					.addConverterFactory(GsonConverterFactory.create())
					.build();

			return retrofit.create(APIService.class);
		}
	}
}
