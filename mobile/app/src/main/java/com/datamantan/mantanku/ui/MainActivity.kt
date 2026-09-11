package com.datamantan.mantanku.ui

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.datamantan.mantanku.R
import com.datamantan.mantanku.adapter.MantanAdapter
import com.datamantan.mantanku.data.ApiResult
import com.datamantan.mantanku.data.Mantan
import com.datamantan.mantanku.data.MantanRepository
import com.datamantan.mantanku.databinding.ActivityMainBinding
import kotlinx.coroutines.launch

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private val repository = MantanRepository()
    private lateinit var adapter: MantanAdapter

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setupRecyclerView()

        binding.fabAdd.setOnClickListener {
            startActivity(Intent(this, MantanFormActivity::class.java))
        }

        binding.swipeRefresh.setOnRefreshListener { loadData() }
    }

    override fun onResume() {
        super.onResume()
        loadData()
    }

    private fun setupRecyclerView() {
        adapter = MantanAdapter(
            onItemClick = { mantan -> openDetail(mantan) },
            onEditClick = { mantan -> openEdit(mantan) },
            onDeleteClick = { mantan -> confirmDelete(mantan) },
        )
        binding.recyclerView.layoutManager = LinearLayoutManager(this)
        binding.recyclerView.adapter = adapter
    }

    private fun openDetail(mantan: Mantan) {
        val intent = Intent(this, MantanDetailActivity::class.java)
        intent.putExtra(MantanDetailActivity.EXTRA_ID, mantan.id ?: -1)
        startActivity(intent)
    }

    private fun openEdit(mantan: Mantan) {
        val intent = Intent(this, MantanFormActivity::class.java)
        intent.putExtra(MantanFormActivity.EXTRA_ID, mantan.id ?: -1)
        intent.putExtra(MantanFormActivity.EXTRA_NAMA, mantan.nama)
        intent.putExtra(MantanFormActivity.EXTRA_NO_HP, mantan.noHp)
        intent.putExtra(MantanFormActivity.EXTRA_ALAMAT, mantan.alamat)
        intent.putExtra(MantanFormActivity.EXTRA_MAKANAN_FAVORIT, mantan.makananFavorit)
        startActivity(intent)
    }

    private fun confirmDelete(mantan: Mantan) {
        AlertDialog.Builder(this)
            .setTitle(R.string.msg_delete_confirm_title)
            .setMessage(getString(R.string.msg_delete_confirm_message, mantan.nama))
            .setPositiveButton(R.string.btn_delete) { _, _ -> deleteMantan(mantan) }
            .setNegativeButton(android.R.string.cancel, null)
            .show()
    }

    private fun deleteMantan(mantan: Mantan) {
        val id = mantan.id ?: return
        lifecycleScope.launch {
            when (val result = repository.delete(id)) {
                is ApiResult.Success -> {
                    Toast.makeText(this@MainActivity, result.data, Toast.LENGTH_SHORT).show()
                    loadData()
                }
                is ApiResult.Error -> {
                    Toast.makeText(this@MainActivity, result.message, Toast.LENGTH_SHORT).show()
                }
            }
        }
    }

    private fun loadData() {
        binding.progressBar.visibility = View.VISIBLE
        binding.emptyView.visibility = View.GONE

        lifecycleScope.launch {
            when (val result = repository.getAll()) {
                is ApiResult.Success -> {
                    adapter.submitList(result.data)
                    binding.emptyView.visibility = if (result.data.isEmpty()) View.VISIBLE else View.GONE
                }
                is ApiResult.Error -> {
                    Toast.makeText(this@MainActivity, result.message, Toast.LENGTH_LONG).show()
                    binding.emptyView.visibility = if (adapter.itemCount == 0) View.VISIBLE else View.GONE
                }
            }
            binding.progressBar.visibility = View.GONE
            binding.swipeRefresh.isRefreshing = false
        }
    }
}
