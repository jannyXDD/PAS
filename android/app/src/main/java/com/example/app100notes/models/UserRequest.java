package com.example.app100notes.models;

import com.google.gson.annotations.SerializedName;

public class UserRequest {

    private String name;
    private String email;

    @SerializedName("current_password")
    private String currentPassword;

    @SerializedName("new_password")
    private String newPassword;

    @SerializedName("new_password_confirmation")
    private String newPasswordConfirmation;

    public UserRequest(
            String name,
            String email,
            String currentPassword,
            String newPassword,
            String newPasswordConfirmation
    ) {
        this.name = name;
        this.email = email;
        this.currentPassword = currentPassword;
        this.newPassword = newPassword;
        this.newPasswordConfirmation = newPasswordConfirmation;
    }
}
