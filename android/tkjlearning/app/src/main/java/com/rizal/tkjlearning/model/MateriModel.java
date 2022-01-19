package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class MateriModel {
	@SerializedName("id")
	private final String id_pertemuan;
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

	public MateriModel(String id_pertemuan, String judul, String deskripsi, String gambar, String tanggal, String lampiran) {
		this.id_pertemuan = id_pertemuan;
		this.judul = judul;
		this.deskripsi = deskripsi;
		this.gambar = gambar;
		this.tanggal = tanggal;
		this.lampiran = lampiran;
	}

	public String getId_pertemuan() {
		return id_pertemuan;
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
