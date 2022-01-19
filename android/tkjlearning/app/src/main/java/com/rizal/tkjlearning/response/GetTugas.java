package com.rizal.tkjlearning.response;

import com.google.gson.annotations.SerializedName;
import com.rizal.tkjlearning.model.TugasModel;

import java.util.List;

public class GetTugas {
	@SerializedName("status")
	private final Boolean status;

	@SerializedName("result")
	private final List<TugasModel> daftarTugas;

	@SerializedName("message")
	private final String message;

	public GetTugas(Boolean status, List<TugasModel> daftarTugas, String message) {
		this.status = status;
		this.daftarTugas = daftarTugas;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public List<TugasModel> getDaftarTugas() {
		return daftarTugas;
	}

	public String getMessage() {
		return message;
	}
}
