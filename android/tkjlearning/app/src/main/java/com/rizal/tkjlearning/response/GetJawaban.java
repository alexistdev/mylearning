package com.rizal.tkjlearning.response;

import com.google.gson.annotations.SerializedName;
import com.rizal.tkjlearning.model.JawabanModel;

import java.util.List;

public class GetJawaban {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("result")
	private final List<JawabanModel> daftarJawaban;
	@SerializedName("message")
	private final String message;

	public GetJawaban(Boolean status, List<JawabanModel> daftarJawaban, String message) {
		this.status = status;
		this.daftarJawaban = daftarJawaban;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public List<JawabanModel> getDaftarJawaban() {
		return daftarJawaban;
	}

	public String getMessage() {
		return message;
	}
}
