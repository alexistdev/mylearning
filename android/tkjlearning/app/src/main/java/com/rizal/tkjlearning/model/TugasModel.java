package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class TugasModel {
	@SerializedName("id")
	private final String idTugas;

	@SerializedName("judul_tugas")
	private final String judulTugas;

	@SerializedName("created_at")
	private final String tanggalTugas;

	@SerializedName("lampiran")
	private final String lampiranTugas;

	@SerializedName("nama_pelajaran")
	private final String nama_pelajaran;

	public TugasModel(String idTugas, String judulTugas, String tanggalTugas, String lampiranTugas, String nama_pelajaran) {
		this.idTugas = idTugas;
		this.judulTugas = judulTugas;
		this.tanggalTugas = tanggalTugas;
		this.lampiranTugas = lampiranTugas;
		this.nama_pelajaran = nama_pelajaran;
	}

	public String getIdTugas() {
		return idTugas;
	}

	public String getJudulTugas() {
		return judulTugas;
	}

	public String getTanggalTugas() {
		return tanggalTugas;
	}

	public String getLampiranTugas() {
		return lampiranTugas;
	}

	public String getNama_pelajaran() {
		return nama_pelajaran;
	}
}
