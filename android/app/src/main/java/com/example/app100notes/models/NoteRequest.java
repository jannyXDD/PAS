package com.example.app100notes.models;

public class NoteRequest {
    private String title;
    private String content;
    private int is_pinned;

    public NoteRequest(String title, String content, boolean pinned) {
        this.title = title;
        this.content = content;
        this.is_pinned = pinned ? 1 : 0;
    }
}
