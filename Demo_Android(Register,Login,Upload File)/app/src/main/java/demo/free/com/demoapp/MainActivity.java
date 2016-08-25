package demo.free.com.demoapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import demo.free.com.demoapp.File_Upload.FileUploadActivity;
import demo.free.com.demoapp.Login.LoginActivity;
import demo.free.com.demoapp.Register.RegisterActivity;

public class MainActivity extends AppCompatActivity implements  View.OnClickListener {
Button btn_register,btn_login,btn_fileupload;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        btn_register = (Button)findViewById(R.id.btn_reg);
        btn_login = (Button)findViewById(R.id.btn_log);
        btn_fileupload = (Button)findViewById(R.id.btn_file);

        btn_register.setOnClickListener(this);
        btn_login.setOnClickListener(this);
        btn_fileupload.setOnClickListener(this);

    }
    @Override
    public void onClick(View view) {

        switch (view.getId()) {
            case R.id.btn_reg:
                Intent i = new Intent(this, RegisterActivity.class);
                startActivity(i);
                break;
            case R.id.btn_log:
                Intent j = new Intent(this, LoginActivity.class);
                startActivity(j);
                break;
            case R.id.btn_file:
                Intent k = new Intent(this, FileUploadActivity.class);
                startActivity(k);
                break;
            default:
                break;
        }
    }
}
