package com.example.app100notes.adapters;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.app100notes.R;
import com.example.app100notes.models.Folder;
import com.example.app100notes.ui.notes.MainActivity;

import java.util.List;

public class FolderAdapter extends RecyclerView.Adapter<FolderAdapter.FolderViewHolder> {

    private final List<Folder> folders;
    private final Context context;
    public interface OnFolderLongClickListener {
        void onFolderLongClick(Folder folder, int position);
    }

    private OnFolderLongClickListener longClickListener;

    public void setOnFolderLongClickListener(OnFolderLongClickListener listener) {
        this.longClickListener = listener;
    }

    public FolderAdapter(Context context, List<Folder> folders) {
        this.context = context;
        this.folders = folders;
    }
    public void removeAt(int position) {
        folders.remove(position);
        notifyItemRemoved(position);
    }

    @NonNull
    @Override
    public FolderViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context)
                .inflate(R.layout.item_folder, parent, false);
        return new FolderViewHolder(view);
    }


    @Override
    public void onBindViewHolder(@NonNull FolderViewHolder holder, int position) {
        Folder folder = folders.get(position);
        holder.textName.setText(folder.getName());

        holder.itemView.setOnLongClickListener(v -> {
            if (longClickListener != null) {
                int pos = holder.getAdapterPosition();
                if (pos != RecyclerView.NO_POSITION) {
                    longClickListener.onFolderLongClick(folder, pos);
                }
            }
            return true;
        });

        holder.itemView.setOnClickListener(v -> {

            Intent intent = new Intent(context, MainActivity.class);
            intent.putExtra("folder_id", folder.getId());
            context.startActivity(intent);
        });

    }

    @Override
    public int getItemCount() {
        return folders.size();
    }


    static class FolderViewHolder extends RecyclerView.ViewHolder {

        TextView textName;

        public FolderViewHolder(@NonNull View itemView) {
            super(itemView);
            textName = itemView.findViewById(R.id.text_folder_name_id);
        }
    }
}