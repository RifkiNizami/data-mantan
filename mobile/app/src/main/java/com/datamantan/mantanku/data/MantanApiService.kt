package com.datamantan.mantanku.data

import retrofit2.Response
import retrofit2.http.DELETE
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.GET
import retrofit2.http.PUT
import retrofit2.http.POST
import retrofit2.http.Path

interface MantanApiService {

    @GET("api/mantan")
    suspend fun getAll(): Response<ApiListResponse>

    @GET("api/mantan/{id}")
    suspend fun getOne(@Path("id") id: Int): Response<ApiItemResponse>

    @FormUrlEncoded
    @POST("api/mantan")
    suspend fun create(
        @Field("nama") nama: String,
        @Field("no_hp") noHp: String,
        @Field("alamat") alamat: String,
        @Field("makanan_favorit") makananFavorit: String?,
    ): Response<ApiItemResponse>

    @FormUrlEncoded
    @PUT("api/mantan/{id}")
    suspend fun update(
        @Path("id") id: Int,
        @Field("nama") nama: String,
        @Field("no_hp") noHp: String,
        @Field("alamat") alamat: String,
        @Field("makanan_favorit") makananFavorit: String?,
    ): Response<ApiItemResponse>

    @DELETE("api/mantan/{id}")
    suspend fun delete(@Path("id") id: Int): Response<ApiSimpleResponse>
}
