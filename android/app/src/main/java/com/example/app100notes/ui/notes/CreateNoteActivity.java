package com.example.app100notes.ui.notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.app100notes.R;
import com.example.app100notes.data.TokenManager;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.Note;
import com.example.app100notes.models.NoteRequest;
import com.google.android.material.appbar.MaterialToolbar;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CreateNoteActivity extends AppCompatActivity {


    private EditText editTextTitle;
    private EditText editTextContent;
    private CheckBox checkBoxPinned;
    private Button buttonSave;
    private MaterialToolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // proteção: sem token, não cria
        if (TokenManager.getToken(this) == null) {
            finish();
            return;
        }


        setContentView(R.layout.activity_create_note);

        editTextTitle = findViewById(R.id.edit_text_create_title_id);
        editTextContent = findViewById(R.id.edit_text_create_content_id);
        checkBoxPinned = findViewById(R.id.check_box_pinned_id);
        buttonSave = findViewById(R.id.button_create_id);

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

                if (title.isEmpty() || content.isEmpty()) {
                    Toast.makeText(CreateNoteActivity.this, "Preenche título e conteúdo", Toast.LENGTH_SHORT).show();
                    return;
                }

                ApiService api = RetroFitClient.getRetrofitInstance(CreateNoteActivity.this).create(ApiService.class);
                Call<Note> call = api.createNote(new NoteRequest(title, content, pinned));

                call.enqueue(new Callback<Note>() {
                    @Override
                    public void onResponse(Call<Note> call, Response<Note> response) {
                        if (!response.isSuccessful()) {
                            Toast.makeText(CreateNoteActivity.this,
                                    "Erro ao criar (" + response.code() + ")",
                                    Toast.LENGTH_LONG).show();
                            return;
                        }

                        Toast.makeText(CreateNoteActivity.this, "Nota criada!", Toast.LENGTH_SHORT).show();
                        startActivity(new Intent(CreateNoteActivity.this, MainActivity.class));
                        //finish(); // volta à MainActivity (lista)
                    }

                    @Override
                    public void onFailure(Call<Note> call, Throwable t) {
                        Toast.makeText(CreateNoteActivity.this,
                                "Erro: " + t.getMessage(),
                                Toast.LENGTH_LONG).show();
                    }
                });

            }
        });
    }

}