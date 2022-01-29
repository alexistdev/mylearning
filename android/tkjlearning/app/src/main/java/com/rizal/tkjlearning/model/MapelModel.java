package com.rizal.tkjlearning.model;

import com.google.gson.annotations.SerializedName;

public class MapelModel {
	@SerializedName("id")
	private final String id_pelajaran;
	@SerializedName("name")
	private final String nama_pelajaran;

	public MapelModel(String id_pelajaran, String nama_pelajaran) {
		this.id_pelajaran = id_pelajaran;
		this.nama_pelajaran = nama_pelajaran;
	}

	public String getId_pelajaran() {
		return id_pelajaran;
	}

	public String getNama_pelajaran() {
		return nama_pelajaran;
	}
}
