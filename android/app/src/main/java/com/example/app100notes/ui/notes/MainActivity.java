package com.example.app100notes.ui.notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
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
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.textfield.TextInputEditText;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {

    NoteAdapter adapter;

    FloatingActionButton floatingButton;
    MaterialToolbar toolbar;

    private final List<Note> allNotes = new ArrayList<>();
    private final List<Note> filteredNotes = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        RecyclerView recyclerView = findViewById(R.id.recycler_view_notes_id);
        floatingButton = findViewById(R.id.floating_button_create_id);
        toolbar = findViewById(R.id.toolbar_id);
        setSupportActionBar(toolbar);

        TextInputEditText editSearch = findViewById(R.id.edit_text_search_id);

        editSearch.addTextChangedListener(new android.text.TextWatcher() {
            @Override public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
            @Override public void afterTextChanged(android.text.Editable s) {}


            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                filterByTitle(s.toString());
            }
        });

        BottomNavigationView bottomNav = findViewById(R.id.bottom_navigation);

        bottomNav.setOnItemSelectedListener(item -> {
            if (item.getItemId() == R.id.nav_notes) {
                startActivity(new Intent(this, MainActivity.class));
                finish();
                return true;
            }
            if (item.getItemId() == R.id.nav_folders) {
                startActivity(new Intent(this, FoldersActivity.class));
                finish();
                return true;
            }
            return false;
        });

        ImageView profileImg = toolbar.findViewById(R.id.profile_image_id);

        profileImg.setOnClickListener(v -> {
            startActivity(new Intent(this, ProfileActivity.class));
        });

        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        ApiService apiService = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);

        long folderId = getIntent().getLongExtra("folder_id", -1);

        Call<List<Note>> call;
        if (folderId != -1) {
            call = apiService.getNotesByFolder(folderId);
        } else {
            call = apiService.getNotes();
        }

        call.enqueue(new Callback<List<Note>>() {
            @Override
            public void onResponse(Call<List<Note>> call, Response<List<Note>> response) {
                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(MainActivity.this, "Error HTTP: " + response.code(), Toast.LENGTH_LONG).show();
                    return;
                }

                allNotes.clear();
                allNotes.addAll(response.body());

                filteredNotes.clear();
                filteredNotes.addAll(allNotes);

                if (adapter == null) {
                    adapter = new NoteAdapter(MainActivity.this, filteredNotes);
                    recyclerView.setAdapter(adapter);
                } else {
                    adapter.notifyDataSetChanged();
                }
            }

            @Override
            public void onFailure(Call<List<Note>> call, Throwable t) {
                Toast.makeText(MainActivity.this, "Error: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
        floatingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, CreateNoteActivity.class));
            }
        });
    }
    private void filterByTitle(String query) {
        filteredNotes.clear();

        if (query == null || query.trim().isEmpty()) {
            filteredNotes.addAll(allNotes);
        } else {
            String q = query.toLowerCase().trim();

            for (Note n : allNotes) {
                String title = n.getTitle();
                boolean matchTitle = title != null && title.toLowerCase().contains(q);
                if (matchTitle) {
                    filteredNotes.add(n);
                }
            }
        }

        if (adapter != null) adapter.notifyDataSetChanged();
    }
}