package com.example.silaper;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class ProfileActivity extends AppCompatActivity {

    TextView textView;
    Button logout;
    RecyclerView tempatdata;
    RecyclerView.LayoutManager mManager;
    ProgressDialog mProgressDialog;
    ArrayList<ModelData> dataModelArrayList;
    ListAdapter listAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        mProgressDialog = new ProgressDialog(this);
        tempatdata = findViewById(R.id.rvCorona);
        textView = (TextView) findViewById(R.id.TextViewUserEmail);
        logout = (Button) findViewById(R.id.button_logout);
        String TempHolder = getIntent().getStringExtra("UserEmailTAG");
        textView.setText(textView.getText() + TempHolder);
        dataModelArrayList = new ArrayList<>();
        loaddata();
        mManager = new LinearLayoutManager(getApplication(), LinearLayoutManager.VERTICAL,false);
        tempatdata.setLayoutManager(mManager);
        listAdapter = new ListAdapter(getApplication(), dataModelArrayList);
        tempatdata.setAdapter(listAdapter);

        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                android.app.AlertDialog.Builder adialog = new android.app.AlertDialog.Builder(ProfileActivity.this);
                adialog.setMessage("Apakah anda yakin ingin keluar?");
                adialog.setPositiveButton("Iya",
                        new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                Toast.makeText(ProfileActivity.this, "Berhasil Logout", Toast.LENGTH_LONG).show();
                                finish();
                                Intent regis = new Intent(ProfileActivity.this, MainActivity.class);
                                startActivity(regis);
                            }
                        });
                adialog.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                    }
                });
                android.app.AlertDialog alertDialog = adialog.create();
                alertDialog.show();
            }
        });

    }


    private void loaddata() {
        mProgressDialog.setMessage("Sedang Memuat Data");
        mProgressDialog.show();
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    mProgressDialog.dismiss();
                    JSONArray dataArray = new JSONArray(response);
                    for (int i = 0; i < dataArray.length(); i++) {
                        try {
                            JSONObject dataobj = dataArray.getJSONObject(i);
                            ModelData md = new ModelData();

                            JSONObject dataOb = dataobj.getJSONObject("attributes");
                            md.setProvinsi(dataOb.getString("Provinsi"));
                            md.setKasus_positif(dataOb.getString("Kasus_Posi"));
                            md.setKasus_meninggal(dataOb.getString("Kasus_Meni"));
                            md.setKasus_sembuh(dataOb.getString("Kasus_Semb"));
                            dataModelArrayList.add(md);
                        } catch (Exception ea) {
                            Log.e("errornya atas","+ea");
                            ea.printStackTrace();
                        }
                    }
                    listAdapter.notifyDataSetChanged();
                } catch (JSONException e) {
                    e.printStackTrace();
                    mProgressDialog.dismiss();
                    Log.e("errornya ", ""+e);
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {
            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(ProfileActivity.this);
        requestQueue.add(senddata);
    }
}
