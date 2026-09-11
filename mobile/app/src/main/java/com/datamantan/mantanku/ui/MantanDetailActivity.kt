package com.datamantan.mantanku.ui

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import com.datamantan.mantanku.data.ApiResult
import com.datamantan.mantanku.data.Mantan
import com.datamantan.mantanku.data.MantanRepository
import com.datamantan.mantanku.databinding.ActivityDetailBinding
import kotlinx.coroutines.launch

class MantanDetailActivity : AppCompatActivity() {

    private lateinit var binding: ActivityDetailBinding
    private val repository = MantanRepository()
    private var mantan: Mantan? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)
        binding.toolbar.setNavigationOnClickListener { finish() }

        binding.btnEdit.setOnClickListener {
            val current = mantan ?: return@setOnClickListener
            val intent = Intent(this, MantanFormActivity::class.java)
            intent.putExtra(MantanFormActivity.EXTRA_ID, current.id ?: -1)
            intent.putExtra(MantanFormActivity.EXTRA_NAMA, current.nama)
            intent.putExtra(MantanFormActivity.EXTRA_NO_HP, current.noHp)
            intent.putExtra(MantanFormActivity.EXTRA_ALAMAT, current.alamat)
            intent.putExtra(MantanFormActivity.EXTRA_MAKANAN_FAVORIT, current.makananFavorit)
            startActivity(intent)
        }

        val id = intent.getIntExtra(EXTRA_ID, -1)
        if (id == -1) {
            finish()
            return
        }
        loadDetail(id)
    }

    override fun onResume() {
        super.onResume()
        val id = intent.getIntExtra(EXTRA_ID, -1)
        if (id != -1) loadDetail(id)
    }

    private fun loadDetail(id: Int) {
        lifecycleScope.launch {
            when (val result = repository.getOne(id)) {
                is ApiResult.Success -> {
                    val data = result.data
                    if (data == null) {
                        Toast.makeText(this@MantanDetailActivity, "Data tidak ditemukan", Toast.LENGTH_SHORT).show()
                        finish()
                        return@launch
                    }
                    mantan = data
                    binding.tvNama.text = data.nama
                    binding.tvNoHp.text = data.noHp
                    binding.tvAlamat.text = data.alamat.orEmpty().ifBlank { "-" }
                    binding.tvMakananFavorit.text = data.makananFavorit.orEmpty().ifBlank { "-" }
                }
                is ApiResult.Error -> {
                    Toast.makeText(this@MantanDetailActivity, result.message, Toast.LENGTH_LONG).show()
                }
            }
        }
    }

    companion object {
        const val EXTRA_ID = "extra_id"
    }
}
