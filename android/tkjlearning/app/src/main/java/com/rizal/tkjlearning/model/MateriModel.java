package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class MateriModel {
	@SerializedName("id")
	private final String idpertemuan;
	@SerializedName("judul")
	private final String judul;
	@SerializedName("deskripsi")
	private final String deskripsi;
	@SerializedName("gambar")
	private final String gambar;
	@SerializedName("tanggal")
	private final String tanggal;
	@SerializedName("lampiran")
	private final String lampiran;

	public MateriModel(String idpertemuan, String judul, String deskripsi, String gambar, String tanggal, String lampiran) {
		this.idpertemuan = idpertemuan;
		this.judul = judul;
		this.deskripsi = deskripsi;
		this.gambar = gambar;
		this.tanggal = tanggal;
		this.lampiran = lampiran;
	}

	public String getIdpertemuan() {
		return idpertemuan;
	}

	public String getJudul() {
		return judul;
	}

	public String getDeskripsi() {
		return deskripsi;
	}

	public String getGambar() {
		return gambar;
	}

	public String getTanggal() {
		return tanggal;
	}

	public String getLampiran() {
		return lampiran;
	}
}
