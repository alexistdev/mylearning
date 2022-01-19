package com.rizal.tkjlearning.response;

import com.google.gson.annotations.SerializedName;
import com.rizal.tkjlearning.model.MateriModel;

import java.util.List;

public class GetPertemuan {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("result")
	private final List<MateriModel> daftarPertemuan;
	@SerializedName("message")
	private final String message;

	public GetPertemuan(Boolean status, List<MateriModel> daftarPertemuan, String message) {
		this.status = status;
		this.daftarPertemuan = daftarPertemuan;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public List<MateriModel> getDaftarPertemuan() {
		return daftarPertemuan;
	}

	public String getMessage() {
		return message;
	}
}
