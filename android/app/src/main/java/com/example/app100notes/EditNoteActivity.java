package com.example.app100notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;

import com.example.app100notes.data.ApiService;
import com.example.app100notes.models.Note;
import com.example.app100notes.models.NoteRequest;
import com.google.android.material.appbar.MaterialToolbar;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditNoteActivity extends AppCompatActivity {

    TextView editTextViewContent;
    TextView editTextViewTitle;
    TextView textViewCreatedAt;
    TextView textViewUpdatedAt;
    CheckBox editCheckbox;
    ApiService apiService;
    Button buttonSaveEdit;
    MaterialToolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_edit_note);
        editTextViewTitle = findViewById(R.id.edit_text_view_edit_title);
        editTextViewContent = findViewById(R.id.edit_text_view_edit_content_id);
        editCheckbox = findViewById(R.id.checkbox_edit_id);
        buttonSaveEdit = findViewById(R.id.button_save_edit_id);
        textViewCreatedAt = findViewById(R.id.text_view_note_date_created_id);
        textViewUpdatedAt = findViewById(R.id.text_view_note_date_updated_id);

        toolbar = findViewById(R.id.toolbar_id);
        setSupportActionBar(toolbar);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(v -> {
            finish();
        });


        int noteId = getIntent().getIntExtra("notes_id", -1);
        if (noteId == -1) {
            finish();
            return;
        }
        String title = getIntent().getStringExtra("title");
        String content = getIntent().getStringExtra("content");
        int pinned = getIntent().getIntExtra("is_pinned", 0);
        String dateCreated = getIntent().getStringExtra("created_at");
        String dateUpdated = getIntent().getStringExtra("updated_at");
        editTextViewTitle.setText(title);
        editTextViewContent.setText(content);
        textViewCreatedAt.setText(dateCreated);
        textViewUpdatedAt.setText(dateUpdated);

        editCheckbox.setChecked(pinned == 1);
        apiService = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);

        buttonSaveEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String title = editTextViewTitle.getText().toString().trim();
                String content = editTextViewContent.getText().toString().trim();
                boolean pinned = editCheckbox.isChecked();

                ApiService api = RetroFitClient.getRetrofitInstance(EditNoteActivity.this).create(ApiService.class);
                Call<Note> call = api.editNote(
                        noteId,
                        new NoteRequest(title, content, pinned)
                );

                call.enqueue(new Callback<Note>() {
                    @Override
                    public void onResponse(Call<Note> call, Response<Note> response) {
                        if (!response.isSuccessful()) {
                            Toast.makeText(EditNoteActivity.this,
                                    "Erro ao criar (" + response.code() + ")",
                                    Toast.LENGTH_LONG).show();
                            return;
                        }

                        Toast.makeText(EditNoteActivity.this, "Nota editada!", Toast.LENGTH_SHORT).show();
                        startActivity(new Intent(EditNoteActivity.this, MainActivity.class));
                        //finish(); // volta à MainActivity (lista)
                    }

                    @Override
                    public void onFailure(Call<Note> call, Throwable t) {
                        Toast.makeText(EditNoteActivity.this,
                                "Erro: " + t.getMessage(),
                                Toast.LENGTH_LONG).show();
                    }
                });

            }
        });
    }

}
