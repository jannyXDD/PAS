package com.example.app100notes.ui.notes;

import android.content.Intent;
import android.os.Bundle;
import android.text.InputType;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.app100notes.R;
import com.example.app100notes.adapters.FolderAdapter;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.Folder;
import com.example.app100notes.models.Note;
import com.example.app100notes.ui.user.ProfileActivity;
import com.google.android.material.appbar.MaterialToolbar;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class FoldersActivity extends AppCompatActivity {
    FloatingActionButton floatingButton;
    ApiService apiService;

    FolderAdapter adapter;
    RecyclerView recyclerView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_folders);

        apiService = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);

        MaterialToolbar toolbar = findViewById(R.id.toolbar_id);
        setSupportActionBar(toolbar);

        findViewById(R.id.profile_image_id).setOnClickListener(v -> {
            startActivity(new Intent(this, ProfileActivity.class));
        });

        BottomNavigationView bottomNav = findViewById(R.id.bottom_navigation);
        bottomNav.setSelectedItemId(R.id.nav_folders);
        floatingButton = findViewById(R.id.floating_button_create_folder_id);
        floatingButton.setOnClickListener(v -> {
            showCreateFolderDialog();
        });


        bottomNav.setOnItemSelectedListener(item -> {
            if (item.getItemId() == R.id.nav_notes) {
                startActivity(new Intent(this, MainActivity.class));
                finish();
                return true;
            }
            return true;
        });


        recyclerView = findViewById(R.id.recycler_view_folders_id);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));


        List<Folder> folderList = new ArrayList<>();
        adapter = new FolderAdapter(this, folderList);
        recyclerView.setAdapter(adapter);
        adapter.setOnFolderLongClickListener((folder, position) -> {
            String[] options = {"Rename", "Delete"};

            new AlertDialog.Builder(FoldersActivity.this)
                    .setTitle(folder.getName())
                    .setItems(options, (dialog, which) -> {
                        if (which == 0) {
                            showRenameFolderDialog(folder, position);
                        } else {
                            showDeleteFolderDialog(folder, position);
                        }
                    })
                    .show();
        });

        ApiService api = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);
        Call<List<Folder>> call = api.getFolders();


        call.enqueue(new Callback<List<Folder>>() {
            @Override
            public void onResponse(Call<List<Folder>> call, Response<List<Folder>> response) {
                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(FoldersActivity.this,
                            "Error HTTP: " + response.code(),
                            Toast.LENGTH_LONG).show();
                    return;
                }


                folderList.clear();
                folderList.addAll(response.body());
                adapter.notifyDataSetChanged();
            }


            @Override
            public void onFailure(Call<List<Folder>> call, Throwable t) {
                Toast.makeText(FoldersActivity.this,
                        "Error: " + t.getMessage(),
                        Toast.LENGTH_LONG).show();
            }
        });


    }
    private void showCreateFolderDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Create folder");

        final EditText input = new EditText(this);
        input.setHint("Folder name");
        input.setInputType(InputType.TYPE_CLASS_TEXT);

        int padding = (int) (16 * getResources().getDisplayMetrics().density);
        input.setPadding(padding, padding, padding, padding);

        builder.setView(input);

        builder.setPositiveButton("Create", (dialog, which) -> {
            String folderName = input.getText().toString().trim();

            if (!folderName.isEmpty()) {
                createFolder(folderName);
            } else {
                Toast.makeText(this, "Invalid name", Toast.LENGTH_SHORT).show();
            }
        });

        builder.setNegativeButton("Cancel", (dialog, which) -> dialog.dismiss());

        builder.show();
    }
    private void createFolder(String name) {

        Folder folder = new Folder(name);

        apiService.createFolder(folder).enqueue(new Callback<Folder>() {
            @Override
            public void onResponse(Call<Folder> call, Response<Folder> response) {
                if (response.isSuccessful()) {
                    Toast.makeText(FoldersActivity.this,
                            "Folder created",
                            Toast.LENGTH_SHORT).show();

                    loadFolders();
                } else {
                    String msg = "Error: " + response.code();

                    try {
                        if (response.errorBody() != null) {
                            msg += " - " + response.errorBody().string();
                        }
                    } catch (Exception ignored) {}


                    Toast.makeText(FoldersActivity.this, msg, Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<Folder> call, Throwable t) {
                Toast.makeText(FoldersActivity.this,
                        "Error: " + t.getClass().getSimpleName() + " - " + t.getMessage(),
                        Toast.LENGTH_LONG).show();
            }
        });
    }
    private void loadFolders() {
        apiService.getFolders().enqueue(new Callback<List<Folder>>() {
            @Override
            public void onResponse(Call<List<Folder>> call, Response<List<Folder>> response) {
                if (response.isSuccessful() && response.body() != null) {

                    adapter = new FolderAdapter(FoldersActivity.this, response.body());
                    recyclerView.setAdapter(adapter);
                }
            }


            @Override
            public void onFailure(Call<List<Folder>> call, Throwable t) {
                Toast.makeText(FoldersActivity.this, "Error", Toast.LENGTH_SHORT).show();
            }
        });
    }
    private void deleteFolder(long folderId, int position) {
        apiService.deleteFolder(folderId).enqueue(new retrofit2.Callback<Void>() {
            @Override
            public void onResponse(retrofit2.Call<Void> call, retrofit2.Response<Void> response) {
                if (response.isSuccessful()) {
                    Toast.makeText(FoldersActivity.this, "Folder deleted", Toast.LENGTH_SHORT).show();
                    adapter.removeAt(position);
                } else {
                    String msg = "Delete error HTTP " + response.code();
                    try {
                        if (response.errorBody() != null) msg += " - " + response.errorBody().string();
                    } catch (Exception ignored) {}
                    Toast.makeText(FoldersActivity.this, msg, Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(retrofit2.Call<Void> call, Throwable t) {
                Toast.makeText(FoldersActivity.this, "Delete fail: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
    }
    private void showDeleteFolderDialog(Folder folder, int position) {
        new AlertDialog.Builder(this)
                .setTitle("Delete folder")
                .setMessage("The notes inside of this folder won't be deleted. Are you sure you want to delete this folder?")
                .setPositiveButton("Delete",
                        (d, w) -> deleteFolder(folder.getId(), position))
                .setNegativeButton("Cancel", null)
                .show();
    }

    private void showRenameFolderDialog(Folder folder, int position) {
        EditText input = new EditText(this);
        input.setText(folder.getName());
        input.setSelection(folder.getName().length());

        new AlertDialog.Builder(this)
                .setTitle("Rename folder")
                .setView(input)
                .setPositiveButton("Save", (d, w) -> {
                    String newName = input.getText().toString().trim();
                    if (newName.isEmpty()) {
                        Toast.makeText(this, "Invalid name", Toast.LENGTH_SHORT).show();
                        return;
                    }
                    renameFolder(folder, newName, position);
                })
                .setNegativeButton("Cancel", null)
                .show();
    }

    private void renameFolder(Folder folder, String newName, int position) {

        Folder body = new Folder(newName);

        apiService.updateFolder(folder.getId(), body).enqueue(new Callback<Folder>() {
            @Override
            public void onResponse(Call<Folder> call, Response<Folder> response) {
                if (response.isSuccessful() && response.body() != null) {

                    folder.setName(response.body().getName());
                    adapter.notifyItemChanged(position);
                    loadFolders();

                    Toast.makeText(FoldersActivity.this, "Renamed", Toast.LENGTH_SHORT).show();

                } else {
                    String msg = "Rename error HTTP " + response.code();
                    try {
                        if (response.errorBody() != null) msg += " - " + response.errorBody().string();
                    } catch (Exception ignored) {}
                    Toast.makeText(FoldersActivity.this, msg, Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onFailure(Call<Folder> call, Throwable t) {
                Toast.makeText(FoldersActivity.this, "Rename fail: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
    }


}