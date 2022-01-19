package com.rizal.tkjlearning.response;

import com.google.gson.annotations.SerializedName;
import com.rizal.tkjlearning.model.MapelModel;

import java.util.List;

public class GetMapel {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("result")
	private final List<MapelModel> daftarMapel;
	@SerializedName("message")
	private final String message;

	public GetMapel(Boolean status, List<MapelModel> daftarMapel, String message) {
		this.status = status;
		this.daftarMapel = daftarMapel;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public List<MapelModel> getDaftarMapel() {
		return daftarMapel;
	}

	public String getMessage() {
		return message;
	}
}
