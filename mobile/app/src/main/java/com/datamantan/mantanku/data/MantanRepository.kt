package com.datamantan.mantanku.data

import com.google.gson.Gson
import retrofit2.Response

sealed class ApiResult<out T> {
    data class Success<T>(val data: T) : ApiResult<T>()
    data class Error(val message: String) : ApiResult<Nothing>()
}

class MantanRepository(private val service: MantanApiService = RetrofitClient.api) {

    suspend fun getAll(): ApiResult<List<Mantan>> = safeCall {
        val response = service.getAll()
        handle(response)?.data ?: emptyList()
    }

    suspend fun getOne(id: Int): ApiResult<Mantan?> = safeCall {
        val response = service.getOne(id)
        handle(response)?.data
    }

    suspend fun create(nama: String, noHp: String, alamat: String, makananFavorit: String?): ApiResult<Mantan?> = safeCall {
        val response = service.create(nama, noHp, alamat, makananFavorit)
        handle(response)?.data
    }

    suspend fun update(id: Int, nama: String, noHp: String, alamat: String, makananFavorit: String?): ApiResult<Mantan?> = safeCall {
        val response = service.update(id, nama, noHp, alamat, makananFavorit)
        handle(response)?.data
    }

    suspend fun delete(id: Int): ApiResult<String> = safeCall {
        val response = service.delete(id)
        handle(response)?.message ?: "Data berhasil dihapus"
    }

    private suspend fun <T> safeCall(block: suspend () -> T): ApiResult<T> {
        return try {
            ApiResult.Success(block())
        } catch (e: ApiException) {
            ApiResult.Error(e.message ?: "Terjadi kesalahan")
        } catch (e: Exception) {
            ApiResult.Error(e.message ?: "Gagal terhubung ke server")
        }
    }

    private fun <T> handle(response: Response<T>): T? {
        if (response.isSuccessful) {
            return response.body()
        }
        val errorBody = response.errorBody()?.string()
        val parsed = try {
            Gson().fromJson(errorBody, ApiErrorResponse::class.java)
        } catch (e: Exception) {
            null
        }
        val message = parsed?.errors?.values?.flatten()?.firstOrNull()
            ?: parsed?.message
            ?: "Permintaan gagal (${response.code()})"
        throw ApiException(message)
    }
}

class ApiException(message: String) : Exception(message)
