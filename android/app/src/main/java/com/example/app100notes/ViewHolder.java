package com.example.app100notes;

import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class ViewHolder extends RecyclerView.ViewHolder {
    public TextView titleTextView;
    public TextView contentTextView;
    //public ImageView pinImageView;
    public TextView dateCreatedTextView;
    public TextView dateUpdatedTextView;
    public ImageView pinImageView;



    public ViewHolder(@NonNull View itemView) {
        super(itemView);
        titleTextView = itemView.findViewById(R.id.text_view_note_title_id);
        contentTextView = itemView.findViewById(R.id.text_view_note_content_id);
        dateCreatedTextView = itemView.findViewById(R.id.text_view_note_date_created_id);
        dateUpdatedTextView = itemView.findViewById(R.id.text_view_note_date_updated_id);
        pinImageView = itemView.findViewById(R.id.item_view_pin_id);


    }
}