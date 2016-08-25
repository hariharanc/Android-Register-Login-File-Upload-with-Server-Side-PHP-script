package demo.free.com.demoapp.Register;// Created by $USER_NAME on 22-08-2016.

import android.app.Activity;
import android.app.Dialog;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.NetworkError;
import com.android.volley.NoConnectionError;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.ServerError;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONObject;

import demo.free.com.demoapp.R;
import demo.free.com.demoapp.Utils.AppController;
import demo.free.com.demoapp.Utils.MyProgress;

public class RegisterActivity  extends AppCompatActivity{

    EditText edt_user,edt_email,edt_mobile,edt_gender,edt_pass;
    Button btn_reg;
    String user = "",email = "",mobile ="",gender ="",pass ="";
    String statusflag, statusmsg;
    MyProgress myprogress;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register_activty);
        edt_user = (EditText)findViewById(R.id.edt_username);
        edt_email = (EditText)findViewById(R.id.edt_email);
        edt_mobile = (EditText)findViewById(R.id.edt_mobile);
        edt_gender = (EditText)findViewById(R.id.edt_gender);
        edt_pass = (EditText)findViewById(R.id.edt_password);

        user = edt_user.getText().toString();
        email = edt_email.getText().toString();
        mobile = edt_mobile.getText().toString();
        gender = edt_gender.getText().toString();
        pass = edt_pass.getText().toString();

        btn_reg = (Button)findViewById(R.id.btn_reg);
        btn_reg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    sendRequest();

            }
        });

    }

    private void sendRequest() {
        if(edt_user.getText().toString().trim().equalsIgnoreCase("") ||  edt_email.getText().toString().trim().equalsIgnoreCase("") || edt_mobile.getText().toString().trim().equalsIgnoreCase("")
                || edt_gender.getText().toString().trim().equalsIgnoreCase("") || edt_pass.getText().toString().trim().equalsIgnoreCase("")){
            Toast.makeText(RegisterActivity.this,"Plz fill all the fields",Toast.LENGTH_LONG).show();

        }else {
            String URL = "http://172.31.98.126/project/demo/public/index.php";
            Log.d("REG URL", "" + URL);
            myprogress = new MyProgress(RegisterActivity.this, "Loading..");
            myprogress.showProgress();
            JsonObjectRequest register_req = new JsonObjectRequest(Request.Method.POST, URL, null, new Response.Listener<JSONObject>() {

                @Override
                public void onResponse(JSONObject response) {
                    // TODO Auto-generated method stub
                    myprogress.hideProgress();
                    try {
                        if (response != null) {
                            Log.d("Response", "" + response);
                            JSONObject jsonobject = new JSONObject(response.toString());
                            statusflag = jsonobject.getString("result");
                            statusmsg = jsonobject.getString("message");

                            Log.d("Result ", jsonobject.getString("result"));
                            Log.d("Message ", jsonobject.getString("message"));

                            if (statusflag.equalsIgnoreCase("success")) {
                                Toast.makeText(RegisterActivity.this, ""+statusmsg, Toast.LENGTH_SHORT).show();

                            } else {
                                Toast.makeText(RegisterActivity.this, ""+statusmsg, Toast.LENGTH_SHORT).show();
                            }
                        } else {
                            Toast.makeText(RegisterActivity.this, "Unknown Error, please try again later", Toast.LENGTH_SHORT).show();

                        }
                    } catch (Exception ex) {
                        Log.d("profile Exception", ex.toString());
                       myprogress.hideProgress();
                    }
                }
            }, new Response.ErrorListener() {

                @Override
                public void onErrorResponse(VolleyError error) {
                    // TODO Auto-generated method stub
                    Log.d("Error_response", error.toString());
                   myprogress.hideProgress();
                    if (error instanceof NetworkError) {
                        Toast.makeText(RegisterActivity.this, "Network Error", Toast.LENGTH_LONG).show();
                    } else if (error instanceof ServerError) {
                        Toast.makeText(RegisterActivity.this, "ServerError", Toast.LENGTH_LONG).show();
                    } else if (error instanceof AuthFailureError) {
                    } else if (error instanceof ParseError) {
                    } else if (error instanceof NoConnectionError) {
                        Toast.makeText(RegisterActivity.this, "NoConnectionError", Toast.LENGTH_LONG).show();
                    } else if (error instanceof TimeoutError) {
                        Toast.makeText(RegisterActivity.this, "TimeoutError", Toast.LENGTH_LONG).show();

                    }
                }
            }) {
                @Override
                public byte[] getBody() {
                    try {
                        JSONObject mParams = new JSONObject();
                        mParams.put("name", edt_user.getText().toString());
                        mParams.put("email", edt_email.getText().toString());
                        mParams.put("mobileNo", edt_mobile.getText().toString());
                        mParams.put("gender", edt_gender.getText().toString());
                        mParams.put("password", edt_pass.getText().toString());

                        Log.d("name", edt_user.getText().toString());
                        Log.d("email", edt_email.getText().toString());
                        Log.d("mobileNo", edt_mobile.getText().toString());
                        Log.d("gender", edt_gender.getText().toString());
                        Log.d("password", edt_pass.getText().toString());

                        JSONObject message = new JSONObject();
                        message.put("operation","register");
                        message.put("user", mParams);

                        Log.d("jsonobject", message.toString());
                        return message.toString().getBytes("utf-8");
                    } catch (Exception ex) {
                        ex.printStackTrace();
                        return null;
                    }

                }
            };

            register_req.setRetryPolicy(new DefaultRetryPolicy(10000, 0,
                    DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

            AppController.getInstance().addToRequestQueue(register_req);
        }
  }
}
