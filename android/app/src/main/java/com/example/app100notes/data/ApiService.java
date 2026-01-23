package com.example.app100notes.data;

import com.example.app100notes.AuthResponse;
import com.example.app100notes.LoginRequest;
import com.example.app100notes.models.Note;
import com.example.app100notes.models.NoteRequest;
import com.example.app100notes.models.NoteResponse;
import com.example.app100notes.models.RegisterRequest;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

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

    //@GET("manga/{id}")
    //Call<MangaDetailsResponse> getMangaById(@Path("id") int id);
    //@GET("manga/{id}/characters")
   // Call<MangaCharactersResponse> getMangaCharacters(@Path("id") int id);
}