package com.datamantan.mantanku.data

import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import java.util.concurrent.TimeUnit

object RetrofitClient {

    /**
     * 10.0.2.2 is the Android emulator's alias for the host machine's
     * localhost, where `php artisan serve` is running on port 8000.
     *
     * Running on a physical device instead? Replace this with your
     * computer's LAN IP, e.g. "http://192.168.1.10:8000/", and make sure
     * the phone and computer are on the same network.
     */
    const val BASE_URL = "http://172.14.5.160:8000/"

    private val loggingInterceptor = HttpLoggingInterceptor().apply {
        level = HttpLoggingInterceptor.Level.BODY
    }

    private val okHttpClient = OkHttpClient.Builder()
        .addInterceptor(loggingInterceptor)
        .connectTimeout(15, TimeUnit.SECONDS)
        .readTimeout(15, TimeUnit.SECONDS)
        .writeTimeout(15, TimeUnit.SECONDS)
        .build()

    val api: MantanApiService by lazy {
        Retrofit.Builder()
            .baseUrl(BASE_URL)
            .client(okHttpClient)
            .addConverterFactory(GsonConverterFactory.create())
            .build()
            .create(MantanApiService::class.java)
    }
}
