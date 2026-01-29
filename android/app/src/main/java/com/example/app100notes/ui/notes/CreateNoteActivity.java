package com.example.app100notes.ui.notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.app100notes.R;
import com.example.app100notes.data.TokenManager;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.Folder;
import com.example.app100notes.models.Note;
import com.example.app100notes.models.NoteRequest;
import com.google.android.material.appbar.MaterialToolbar;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CreateNoteActivity extends AppCompatActivity {


    private EditText editTextTitle;
    private EditText editTextContent;
    private CheckBox checkBoxPinned;
    private Button buttonSave;
    private MaterialToolbar toolbar;
    private Spinner spinnerFolders;
    ArrayAdapter<String> adapter;

    List<Folder> folders = new ArrayList<>();
    List<String> folderNames = new ArrayList<>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        if (TokenManager.getToken(this) == null) {
            finish();
            return;
        }

        setContentView(R.layout.activity_create_note);

        folderNames.add("No folder");

        spinnerFolders = findViewById(R.id.spinnerFolders_id);
        editTextTitle = findViewById(R.id.edit_text_create_title_id);
        editTextContent = findViewById(R.id.edit_text_create_content_id);
        checkBoxPinned = findViewById(R.id.check_box_pinned_id);
        buttonSave = findViewById(R.id.button_create_id);

        adapter = new ArrayAdapter<>(this,
                        android.R.layout.simple_spinner_item,
                        folderNames);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerFolders.setAdapter(adapter);
        loadFolders();

        toolbar = findViewById(R.id.toolbar_id);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(v -> {
            finish();
        });

        buttonSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String title = editTextTitle.getText().toString().trim();
                String content = editTextContent.getText().toString().trim();
                boolean pinned = checkBoxPinned.isChecked();
                int pos = spinnerFolders.getSelectedItemPosition();


                Long folderId = null;
                if (pos != 0 && folders.size() >= pos) {
                    folderId = folders.get(pos - 1).getId();
                }

                if (title.isEmpty() || content.isEmpty()) {
                    Toast.makeText(CreateNoteActivity.this, "Must fill title and content", Toast.LENGTH_SHORT).show();
                    return;
                }


                ApiService api = RetroFitClient.getRetrofitInstance(CreateNoteActivity.this).create(ApiService.class);
                Call<Note> call = api.createNote(new NoteRequest(title, content, pinned, folderId));

                call.enqueue(new Callback<Note>() {
                    @Override
                    public void onResponse(Call<Note> call, Response<Note> response) {
                        if (!response.isSuccessful()) {
                            Toast.makeText(CreateNoteActivity.this,
                                    "Error (" + response.code() + ")",
                                    Toast.LENGTH_LONG).show();
                            return;
                        }

                        Toast.makeText(CreateNoteActivity.this, "Note created!", Toast.LENGTH_SHORT).show();
                        startActivity(new Intent(CreateNoteActivity.this, MainActivity.class));
                        finish();
                    }

                    @Override
                    public void onFailure(Call<Note> call, Throwable t) {
                        Toast.makeText(CreateNoteActivity.this,
                                "Error: " + t.getMessage(),
                                Toast.LENGTH_LONG).show();
                    }
                });

            }
        });
    }
    private void loadFolders() {
        ApiService api = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);


        Call<List<Folder>> call = api.getFolders();
        call.enqueue(new Callback<List<Folder>>() {
            @Override
            public void onResponse(Call<List<Folder>> call, Response<List<Folder>> response) {
                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(CreateNoteActivity.this, "Erro a carregar pastas (" + response.code() + ")", Toast.LENGTH_LONG).show();
                    return;
                }

                folders.clear();
                folderNames.clear();

                folderNames.add("Sem pasta");
                folders.addAll(response.body());

                for (Folder f : folders) {
                    folderNames.add(f.getName());
                }

                adapter.notifyDataSetChanged();
            }

            @Override
            public void onFailure(Call<List<Folder>> call, Throwable t) {
                Toast.makeText(CreateNoteActivity.this, "Erro: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
    }

}