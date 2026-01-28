package com.example.app100notes.models;
import androidx.room.Entity;
import androidx.room.ForeignKey;
import androidx.room.Ignore;
import androidx.room.PrimaryKey;

import com.google.gson.annotations.SerializedName;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;

@Entity
public class Note {
    @PrimaryKey (autoGenerate = true)
    private int id;
    private String title;
    private String content;
    private int is_pinned;

    //@ForeignKey()
    private int user_id;
    private Long folder_id;

    @SerializedName("created_at")
    private String date_created;
    @SerializedName("updated_at")
    private String date_updated;

    public Note(String title, String content, int is_pinned, int user_id, String date_created) {
        this.title = title;
        this.content = content;
        this.is_pinned = is_pinned;
        this.user_id = user_id;
        this.date_created = date_created;

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setContent(String content) {
        this.content = content;
    }
    public String getContent() {
        return content;
    }

    public int getIsPinned() {
        return is_pinned;
    }

    public void setIsPinned(int is_pinned) {
        this.is_pinned = is_pinned;
    }

    public String getDate_created() {
        return formatDate(date_created);
    }

    public void setDate_created(String date_created) {
        this.date_created = date_created;
    }

    public String getDate_updated() {
        return formatDate(date_updated);
    }

    public void setDate_updated(String date_updated) {
        this.date_updated = date_updated;
    }

    public Long getFolder_id() {
        return folder_id;
    }


    public void setFolder_id(Long folder_id) {
        this.folder_id = folder_id;
    }

    private String formatDate(String isoDate) {
        try {
            SimpleDateFormat input =
                    new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'", Locale.getDefault());
            input.setTimeZone(TimeZone.getTimeZone("UTC"));

            Date date = input.parse(isoDate);

            SimpleDateFormat output =
                    new SimpleDateFormat("dd/MM/yyyy HH:mm", Locale.getDefault());

            return output.format(date);
        } catch (Exception e) {
            return isoDate;
        }
    }
}