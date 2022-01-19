package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class LoginModel {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("id")
	private final String idUser;
	@SerializedName("kelas")
	private final String idKelas;
	@SerializedName("message")
	private final String message;

	public LoginModel(Boolean status, String idUser, String idKelas, String message) {
		this.status = status;
		this.idUser = idUser;
		this.idKelas = idKelas;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public String getIdUser() {
		return idUser;
	}

	public String getIdKelas() {
		return idKelas;
	}

	public String getMessage() {
		return message;
	}
}
