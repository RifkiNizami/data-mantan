package com.datamantan.mantanku.data

import com.google.gson.annotations.SerializedName

data class ApiListResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String,
    @SerializedName("data") val data: List<Mantan> = emptyList(),
)

data class ApiItemResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String,
    @SerializedName("data") val data: Mantan? = null,
)

data class ApiSimpleResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String,
)

data class ApiErrorResponse(
    @SerializedName("success") val success: Boolean = false,
    @SerializedName("message") val message: String? = null,
    @SerializedName("errors") val errors: Map<String, List<String>>? = null,
)
