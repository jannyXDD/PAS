package com.example.app100notes.ui.user;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.app100notes.R;
import com.example.app100notes.data.TokenManager;
import com.example.app100notes.data.ApiService;
import com.example.app100notes.data.RetroFitClient;
import com.example.app100notes.models.AuthResponse;
import com.example.app100notes.models.RegisterRequest;
import com.google.android.material.appbar.MaterialToolbar;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterActivity extends AppCompatActivity {

    private EditText editTextName, editTextEmail, editTextPassword, editTextConfirmPassword;
    private Button buttonRegister;
    private TextView textViewGoLogin;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        MaterialToolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        }
        toolbar.setNavigationOnClickListener(v -> finish());

        editTextName = findViewById(R.id.edit_text_register_name_id);
        editTextEmail = findViewById(R.id.edit_text_register_email_id);
        editTextPassword = findViewById(R.id.edit_text_register_password_id);
        editTextConfirmPassword = findViewById(R.id.edit_text_register_confirm_password_id);
        buttonRegister = findViewById(R.id.button_register_id);
        textViewGoLogin = findViewById(R.id.text_view_go_login_id);
        buttonRegister.setOnClickListener(v -> register(

        ));

        textViewGoLogin.setOnClickListener(v -> {
            startActivity(new Intent(this, LoginActivity.class));
            finish();
        });
    }

    private void register() {
        String name = editTextName.getText().toString().trim();
        String email = editTextEmail.getText().toString().trim();
        String password = editTextPassword.getText().toString();
        String confirm = editTextConfirmPassword.getText().toString();

        if (name.isEmpty() || email.isEmpty() || password.isEmpty() || confirm.isEmpty()) {
            Toast.makeText(this, "Some fields are empty", Toast.LENGTH_SHORT).show();
            return;
        }

        if (!Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            Toast.makeText(this, "Invalid email", Toast.LENGTH_SHORT).show();
            return;
        }

        if (!password.equals(confirm)) {
            Toast.makeText(this, "Passwords don't match", Toast.LENGTH_SHORT).show();
            return;
        }

        if (password.length() < 8) {
            Toast.makeText(this, "Minimum 8 characters", Toast.LENGTH_SHORT).show();
            return;
        }

        ApiService api = RetroFitClient.getRetrofitInstance(RegisterActivity.this).create(ApiService.class);
        Call<AuthResponse> call = api.register(new RegisterRequest(name ,email, password));
        call.enqueue(new Callback<AuthResponse>() {
            @Override
            public void onResponse(Call<AuthResponse> call, Response<AuthResponse> response) {
                if (!response.isSuccessful() || response.body() == null || response.body().getToken() == null) {
                    Toast.makeText(RegisterActivity.this, "Register failed (" + response.code() + ")", Toast.LENGTH_LONG).show();
                    return;
                }
                TokenManager.saveToken(RegisterActivity.this, response.body().getToken());
                startActivity(new Intent(RegisterActivity.this, LoginActivity.class));
                finish();

            }

            @Override
            public void onFailure(Call<AuthResponse> call, Throwable t) {
                Toast.makeText(RegisterActivity.this, "Error: " + t.getMessage(), Toast.LENGTH_LONG).show();
            }
        });

    }
}
