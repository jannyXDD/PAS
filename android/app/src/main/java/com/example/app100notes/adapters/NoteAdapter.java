package com.example.app100notes.adapters;

import static androidx.constraintlayout.widget.ConstraintSet.GONE;
import static androidx.constraintlayout.widget.ConstraintSet.VISIBLE;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.app100notes.ui.notes.EditNoteActivity;
import com.example.app100notes.R;
import com.example.app100notes.models.Note;

import java.util.List;

public class NoteAdapter extends RecyclerView.Adapter<ViewHolder> {

    Context context;

    private List<Note> noteList;

    public NoteAdapter(Context context, List<Note> noteList) {
        this.context = context;
        this.noteList = noteList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_note,parent,false);
        return new ViewHolder(view);
    }


    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        Note note = noteList.get(position);
        holder.titleTextView.setText(note.getTitle());
        holder.contentTextView.setText(note.getContent());
        if(note.getIsPinned() == 1){
            holder.pinImageView.setVisibility(VISIBLE);
        } else{
            holder.pinImageView.setVisibility(GONE);
        }

        holder.itemView.setOnClickListener(v ->{

            Intent intent = new Intent(context, EditNoteActivity.class);
            intent.putExtra("notes_id", note.getId());
            intent.putExtra("title", note.getTitle());
            intent.putExtra("content", note.getContent());
            intent.putExtra("is_pinned", note.getIsPinned());
            intent.putExtra("created_at", note.getDate_created());
            intent.putExtra("updated_at", note.getDate_updated());
            intent.putExtra("folder_id", note.getFolder_id());
            context.startActivity(intent);
        });
    }

    @Override
    public int getItemCount() {
        return noteList.size();
    }

}