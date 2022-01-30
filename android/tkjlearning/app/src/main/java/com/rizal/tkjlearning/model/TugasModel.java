package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class TugasModel {
	@SerializedName("id")
	private final String idTugas;

	@SerializedName("name")
	private final String judulTugas;

	@SerializedName("mapel")
	private final String namaMapel;

	@SerializedName("deskripsi")
	private final String deskripsi;

	@SerializedName("lampiran")
	private final String lampiranTugas;

	@SerializedName("batas_akhir")
	private final String akhir;

	public TugasModel(String idTugas, String judulTugas, String namaMapel, String deskripsi, String lampiranTugas, String akhir) {
		this.idTugas = idTugas;
		this.judulTugas = judulTugas;
		this.namaMapel = namaMapel;
		this.deskripsi = deskripsi;
		this.lampiranTugas = lampiranTugas;
		this.akhir = akhir;
	}

	public String getIdTugas() {
		return idTugas;
	}

	public String getJudulTugas() {
		return judulTugas;
	}

	public String getNamaMapel() {
		return namaMapel;
	}

	public String getDeskripsi() {
		return deskripsi;
	}

	public String getLampiranTugas() {
		return lampiranTugas;
	}

	public String getAkhir() {
		return akhir;
	}
}
