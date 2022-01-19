package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class AkunModel {
	@SerializedName("email")
	private final String email;

	@SerializedName("nisn")
	private final String nisn;

	@SerializedName("phone")
	private final String phone;

	@SerializedName("nama_lengkap")
	private final String nama_lengkap;

	@SerializedName("alamat")
	private final String alamat;

	public AkunModel(String email, String nisn, String phone, String nama_lengkap, String alamat) {
		this.email = email;
		this.nisn = nisn;
		this.phone = phone;
		this.nama_lengkap = nama_lengkap;
		this.alamat = alamat;
	}

	public String getEmail() {
		return email;
	}

	public String getNisn() {
		return nisn;
	}

	public String getPhone() {
		return phone;
	}

	public String getNama_lengkap() {
		return nama_lengkap;
	}

	public String getAlamat() {
		return alamat;
	}
}
