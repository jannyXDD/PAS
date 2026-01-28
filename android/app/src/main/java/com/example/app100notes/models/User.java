package com.example.app100notes.models;

import androidx.room.PrimaryKey;

import com.google.gson.annotations.SerializedName;

public class User {

    @PrimaryKey(autoGenerate = true)
    //@SerializedName("user_id")
    private long id;
    private String name;
    private String email;
    private String password;

/**
 * Constructor
 */
    public User(String name, String email, String password) {
        this.name = name;
        this.email = email;
        this.password = password;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
}
