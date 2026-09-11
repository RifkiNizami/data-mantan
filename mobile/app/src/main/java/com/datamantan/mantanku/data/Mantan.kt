package com.datamantan.mantanku.data

import com.google.gson.annotations.SerializedName

data class Mantan(
    @SerializedName("id") val id: Int? = null,
    @SerializedName("nama") val nama: String,
    @SerializedName("no_hp") val noHp: String,
    @SerializedName("alamat") val alamat: String?,
    @SerializedName("makanan_favorit") val makananFavorit: String? = null,
    @SerializedName("created_at") val createdAt: String? = null,
    @SerializedName("updated_at") val updatedAt: String? = null,
)
