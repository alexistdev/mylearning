package com.rizal.tkjlearning.response;

import com.google.gson.annotations.SerializedName;
import com.rizal.tkjlearning.model.JadwalModel;
import com.rizal.tkjlearning.model.JawabanModel;

import java.util.List;

public class GetJadwal {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("result")
	private final List<JadwalModel> daftarJadwal;
	@SerializedName("message")
	private final String message;

	public GetJadwal(Boolean status, List<JadwalModel> daftarJadwal, String message) {
		this.status = status;
		this.daftarJadwal = daftarJadwal;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public List<JadwalModel> getDaftarJadwal() {
		return daftarJadwal;
	}

	public String getMessage() {
		return message;
	}
}
