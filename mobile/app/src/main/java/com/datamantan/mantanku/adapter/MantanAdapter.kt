package com.datamantan.mantanku.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.datamantan.mantanku.data.Mantan
import com.datamantan.mantanku.databinding.ItemMantanBinding

class MantanAdapter(
    private val onItemClick: (Mantan) -> Unit,
    private val onEditClick: (Mantan) -> Unit,
    private val onDeleteClick: (Mantan) -> Unit,
) : ListAdapter<Mantan, MantanAdapter.MantanViewHolder>(DIFF_CALLBACK) {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): MantanViewHolder {
        val binding = ItemMantanBinding.inflate(LayoutInflater.from(parent.context), parent, false)
        return MantanViewHolder(binding)
    }

    override fun onBindViewHolder(holder: MantanViewHolder, position: Int) {
        holder.bind(getItem(position))
    }

    inner class MantanViewHolder(private val binding: ItemMantanBinding) :
        RecyclerView.ViewHolder(binding.root) {

        fun bind(mantan: Mantan) {
            binding.tvNama.text = mantan.nama
            binding.tvNoHp.text = mantan.noHp
            binding.tvAlamat.text = mantan.alamat.orEmpty().ifBlank { "-" }

            val makanan = mantan.makananFavorit
            if (makanan.isNullOrBlank()) {
                binding.tvMakananFavorit.visibility = android.view.View.GONE
            } else {
                binding.tvMakananFavorit.visibility = android.view.View.VISIBLE
                binding.tvMakananFavorit.text = makanan
            }

            binding.root.setOnClickListener { onItemClick(mantan) }
            binding.btnEdit.setOnClickListener { onEditClick(mantan) }
            binding.btnDelete.setOnClickListener { onDeleteClick(mantan) }
        }
    }

    companion object {
        private val DIFF_CALLBACK = object : DiffUtil.ItemCallback<Mantan>() {
            override fun areItemsTheSame(oldItem: Mantan, newItem: Mantan) =
                oldItem.id == newItem.id

            override fun areContentsTheSame(oldItem: Mantan, newItem: Mantan) =
                oldItem == newItem
        }
    }
}
