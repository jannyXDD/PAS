package com.example.app100notes;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.app100notes.data.ApiService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    public TextView editTextViewEmail;
    public TextView editTextViewPassword;
    public TextView textViewRegister;
    private Button buttonLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_login);
        editTextViewEmail = findViewById(R.id.edit_text_view_email_id);
        editTextViewPassword = findViewById(R.id.edit_text_view_password_id);
        buttonLogin = findViewById(R.id.button_login_id);
        textViewRegister = findViewById(R.id.text_view_register_id);

        buttonLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String email = editTextViewEmail.getText().toString();
                String password = editTextViewPassword.getText().toString();
                if (email.isEmpty() || password.isEmpty()){
                    Toast.makeText(getApplicationContext(), "Preencha todos os campos!", Toast.LENGTH_SHORT).show();
                } else{
                    ApiService api = RetroFitClient.getRetrofitInstance(LoginActivity.this).create(ApiService.class);
                    Call<AuthResponse> call = api.login(new LoginRequest(email, password));
                    call.enqueue(new Callback<AuthResponse>() {
                        @Override
                        public void onResponse(Call<AuthResponse> call, Response<AuthResponse> response) {
                            if (!response.isSuccessful() || response.body() == null || response.body().getToken() == null) {
                                Toast.makeText(LoginActivity.this, "Login falhou (" + response.code() + ")", Toast.LENGTH_LONG).show();
                                return;
                            }
                            TokenManager.saveToken(LoginActivity.this, response.body().getToken());
                            startActivity(new Intent(LoginActivity.this, MainActivity.class));
                            finish();

                        }

                        @Override
                        public void onFailure(Call<AuthResponse> call, Throwable t) {
                            Toast.makeText(LoginActivity.this, "Erro: " + t.getMessage(), Toast.LENGTH_LONG).show();
                        }
                    });
                }
            }
        });
        textViewRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(LoginActivity.this, RegisterActivity.class));
            }
        });

    }
}




