package com.example.app100notes.models;

public class Folder {
    private long id;
    private String name;


    public Folder(String name) {
        this.name = name;
    }


    public long getId() {
        return id;
    }


    public String getName() {
        return name;
    }

    public String setName(String name) {
        return name;
    }
}
