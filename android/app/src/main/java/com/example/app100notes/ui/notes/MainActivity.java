package com.example.app100notes.ui.notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.app100notes.R;
import com.example.app100notes.adapters.NoteAdapter;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.Note;
import com.example.app100notes.ui.user.ProfileActivity;
import com.google.android.material.appbar.MaterialToolbar;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {

    NoteAdapter adapter;
    private RetroFitClient RetrofitClient;
    FloatingActionButton floatingButton;
    MaterialToolbar toolbar;
    ImageView profileImage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        RecyclerView recyclerView = findViewById(R.id.recycler_view_notes_id);
        floatingButton = findViewById(R.id.floating_button_create_id);
        toolbar = findViewById(R.id.toolbar_id);
        setSupportActionBar(toolbar);


        ImageView profileImg = toolbar.findViewById(R.id.profile_image_id);

        profileImg.setOnClickListener(v -> {
            startActivity(new Intent(this, ProfileActivity.class));
        });

        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        ApiService apiService = RetrofitClient.getRetrofitInstance(this).create(ApiService.class);
        Call<List<Note>> call = apiService.getNotes();

        call.enqueue(new Callback<List<Note>>() {
            @Override
            public void onResponse(Call<List<Note>> call, Response<List<Note>> response) {
                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(MainActivity.this, "Erro HTTP: " + response.code(), Toast.LENGTH_LONG).show();
                    return;
                }

                List<Note> noteList = response.body();
                adapter = new NoteAdapter(MainActivity.this, noteList);
                recyclerView.setAdapter(adapter);
            }

            @Override
            public void onFailure(Call<List<Note>> call, Throwable t) {
                Toast.makeText(MainActivity.this, "Erro: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
        floatingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, CreateNoteActivity.class));
            }
        });
    }
}