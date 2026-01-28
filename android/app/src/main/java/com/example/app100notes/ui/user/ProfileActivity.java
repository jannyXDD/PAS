package com.example.app100notes.ui.user;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;

import com.example.app100notes.R;
import com.example.app100notes.data.TokenManager;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.UserRequest;
import com.example.app100notes.models.UserResponse;
import com.google.android.material.appbar.MaterialToolbar;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfileActivity extends AppCompatActivity {

    TextView editTextName;
    TextView editTextEmail;
    TextView editTextCurrentPassword;
    TextView editTextNewPassword;
    TextView editTextConfirmNewPassword;
    ApiService apiService;
    Button buttonSaveEdit;
    Button buttonLogout;
    Button buttonCancel;
    MaterialToolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_profile);
        editTextName = findViewById(R.id.edit_text_profile_name_id);
        editTextEmail = findViewById(R.id.edit_text_profile_email_id);
        editTextCurrentPassword = findViewById(R.id.edit_text_profile_current_password_id);
        editTextNewPassword = findViewById(R.id.edit_text_profile_new_password_id);
        editTextConfirmNewPassword = findViewById(R.id.edit_text_profile_confirm_new_password_id);
        toolbar = findViewById(R.id.toolbar_profile_id);
        buttonSaveEdit = findViewById(R.id.button_save_profile_id);
        buttonLogout = findViewById(R.id.button_profile_logout_id);
        buttonCancel = findViewById(R.id.button_cancel_profile_id);

        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(v -> {
            finish();
        });

        String name = getIntent().getStringExtra("name");
        String email = getIntent().getStringExtra("email");
        editTextName.setText(name);
        editTextEmail.setText(email);

        apiService = RetroFitClient.getRetrofitInstance(this).create(ApiService.class);
        loadUser();

        buttonSaveEdit.setOnClickListener(v -> updateProfile());
        buttonLogout.setOnClickListener(v -> doLogout());
        buttonCancel.setOnClickListener(v -> finish());
    }

    private void doLogout() {
        apiService.logout().enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {

                TokenManager.clear(ProfileActivity.this);

                Intent intent = new Intent(ProfileActivity.this, LoginActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {

                TokenManager.clear(ProfileActivity.this);

                Intent intent = new Intent(ProfileActivity.this, LoginActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);
            }
        });
    }

    private void updateProfile() {

        String name = editTextName.getText().toString().trim();
        String email = editTextEmail.getText().toString().trim();

        String currentPass = editTextCurrentPassword.getText().toString();
        String newPass = editTextNewPassword.getText().toString();
        String confirmPass = editTextConfirmNewPassword.getText().toString();

        if (name.isEmpty()) {
            editTextName.setError("Must fill the name");
            editTextName.requestFocus();
            return;
        }
        if (email.isEmpty()) {
            editTextEmail.setError("Must fill the email");
            editTextEmail.requestFocus();
            return;
        }

        boolean wantsPasswordChange =
                !currentPass.trim().isEmpty() || !newPass.trim().isEmpty() || !confirmPass.trim().isEmpty();

        if (wantsPasswordChange) {
            if (currentPass.trim().isEmpty()) {
                editTextCurrentPassword.setError("Insert your current password");
                editTextCurrentPassword.requestFocus();
                return;
            }
            if (newPass.trim().isEmpty()) {
                editTextNewPassword.setError("Insert new password");
                editTextNewPassword.requestFocus();
                return;
            }
            if (!newPass.equals(confirmPass)) {
                editTextConfirmNewPassword.setError("Passwords don't match");
                editTextConfirmNewPassword.requestFocus();
                return;
            }
        } else {
            currentPass = null;
            newPass = null;
            confirmPass = null;
        }

        buttonSaveEdit.setEnabled(false);

        UserRequest request = new UserRequest(
                name,
                email,
                currentPass,
                newPass,
                confirmPass
        );

        apiService.updateUser(request).enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                buttonSaveEdit.setEnabled(true);

                if (response.isSuccessful()) {
                    Toast.makeText(ProfileActivity.this, "Perfil atualizado!", Toast.LENGTH_SHORT).show();
                    finish();
                    return;
                }

                if (response.code() == 422) {
                    Toast.makeText(ProfileActivity.this, "Dados inválidos (password atual pode estar errada).", Toast.LENGTH_LONG).show();
                    return;
                }

                Toast.makeText(ProfileActivity.this, "Erro: " + response.code(), Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                buttonSaveEdit.setEnabled(true);
                Toast.makeText(ProfileActivity.this, "Falha: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });

    }
    private void loadUser() {
        apiService.getMe().enqueue(new Callback<UserResponse>() {
            @Override
            public void onResponse(Call<UserResponse> call, Response<UserResponse> response) {
                if (!response.isSuccessful() || response.body() == null) return;

                UserResponse user = response.body();
                editTextName.setText(user.getName());
                editTextEmail.setText(user.getEmail());
            }

            @Override
            public void onFailure(Call<UserResponse> call, Throwable t) {
                Toast.makeText(ProfileActivity.this, "Erro ao carregar perfil", Toast.LENGTH_SHORT).show();
            }
        });
    }
}