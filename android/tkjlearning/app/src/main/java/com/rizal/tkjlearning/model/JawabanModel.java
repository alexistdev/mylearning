package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class JawabanModel {
	@SerializedName("id")
	private final String idJawaban;

	@SerializedName("upload_tugas")
	private final String uploadTugas;

	@SerializedName("tanggal")
	private final String tanggal;

	@SerializedName("judul_tugas")
	private final String judulTugas;

	public JawabanModel(String idJawaban, String uploadTugas, String tanggal, String judulTugas) {
		this.idJawaban = idJawaban;
		this.uploadTugas = uploadTugas;
		this.tanggal = tanggal;
		this.judulTugas = judulTugas;
	}

	public String getIdJawaban() {
		return idJawaban;
	}

	public String getUploadTugas() {
		return uploadTugas;
	}

	public String getTanggal() {
		return tanggal;
	}

	public String getJudulTugas() {
		return judulTugas;
	}
}

