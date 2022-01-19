package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class JadwalModel {
	@SerializedName("id")
	private final String idJadwal;

	@SerializedName("nama_pelajaran")
	private final String namaMapel;

	@SerializedName("nama_kelas")
	private final String namaKelas;

	@SerializedName("jadwal")
	private final String jadwal;

	public JadwalModel(String idJadwal, String namaMapel, String namaKelas, String jadwal) {
		this.idJadwal = idJadwal;
		this.namaMapel = namaMapel;
		this.namaKelas = namaKelas;
		this.jadwal = jadwal;
	}

	public String getIdJadwal() {
		return idJadwal;
	}

	public String getNamaMapel() {
		return namaMapel;
	}

	public String getNamaKelas() {
		return namaKelas;
	}

	public String getJadwal() {
		return jadwal;
	}
}
