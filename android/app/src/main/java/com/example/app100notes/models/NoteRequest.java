package com.example.app100notes.models;

public class NoteRequest {
    private String title;
    private String content;
    private int is_pinned;
    private Long folder_id;


    public NoteRequest(String title, String content, boolean pinned, Long folderId) {
        this.title = title;
        this.content = content;
        this.is_pinned = pinned ? 1 : 0;
        this.folder_id = folderId;

    }
}
