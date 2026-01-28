package com.example.app100notes.data;

import com.example.app100notes.models.AuthResponse;
import com.example.app100notes.models.Folder;
import com.example.app100notes.models.LoginRequest;
import com.example.app100notes.models.Note;
import com.example.app100notes.models.NoteRequest;
import com.example.app100notes.models.NoteResponse;
import com.example.app100notes.models.RegisterRequest;
import com.example.app100notes.models.User;
import com.example.app100notes.models.UserRequest;
import com.example.app100notes.models.UserResponse;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface ApiService {


    @POST("auth/login")
    Call<AuthResponse> login(@Body LoginRequest body);
    @POST("auth/register")
    Call<AuthResponse> register(@Body RegisterRequest body);
    @GET("notes")
    Call<List<Note>>getNotes();

    @GET("notes/{id}")
    Call<NoteResponse>getNoteById(@Path("id")int id);
    @POST("notes")
    Call<Note> createNote(@Body NoteRequest body);

    @PUT("notes/{id}")
    Call<Note> editNote(@Path("id") int id, @Body NoteRequest body);

    @GET("user/{id}")
    Call<User>getUserById(@Path("id")int id);

    @GET("me")
    Call<UserResponse> getMe();

    @PUT("me")
    Call<Void> updateUser(@Body UserRequest request);
    @GET("notes")
    Call<List<Note>> getNotesByFolder(@Query("folder_id") long folderId);
    @POST("folders")
    Call<Folder> createFolder(@Body Folder folder);
    @POST("auth/logout")
    Call<Void> logout();
    @GET("folders")
    Call<List<Folder>> getFolders();


}