package com.qreatiq.travelgo;

import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.design.widget.BottomSheetDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.Spinner;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class CreateTourActivity extends AppCompatActivity {

    ArrayList<String> daysArray=new ArrayList<>();
    ArrayList<String> locationArray=new ArrayList<>();

    Spinner many_days,location;
    RequestQueue queue;
    BottomSheetDialog bottomSheetDialog;
    Uri filePath;
    ImageView imageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_tour);

        Toolbar toolbar=(Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });

        many_days=(Spinner) findViewById(R.id.many_days);
        location=(Spinner) findViewById(R.id.location);
        imageView=(ImageView) findViewById(R.id.image);
        queue = Volley.newRequestQueue(this);

        daysArray.add("1 day");
        daysArray.add("2 days");
        daysArray.add("3 days");
        daysArray.add("4 days");
        daysArray.add("5 days");
        ArrayAdapter adapter=new ArrayAdapter(this,R.layout.support_simple_spinner_dropdown_item,daysArray);
        many_days.setAdapter(adapter);

        getLocation();
    }

    private void getLocation(){
        String url = "http://192.168.1.241/travel-go/api/getLocation.php";

        JsonObjectRequest jsonObjectRequest=new JsonObjectRequest(Request.Method.GET, url, null
                , new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    for(int x=0;x<response.getJSONArray("location").length();x++) {
                        JSONObject loc=response.getJSONArray("location").getJSONObject(x);
                        locationArray.add(loc.getString("name"));
                    }
                    ArrayAdapter adapter=new ArrayAdapter(CreateTourActivity.this,R.layout.support_simple_spinner_dropdown_item,locationArray);
                    location.setAdapter(adapter);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("error",error.getMessage());
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                HashMap<String, String> headers = new HashMap<String, String>();
                headers.put("Content-Type", "application/json");
                return headers;
            }
        };
        queue.add(jsonObjectRequest);
    }

    public void addMedia(View v){
        bottomSheetDialog=new BottomSheetDialog(this);
        View view = View.inflate(this, R.layout.list_attach_item, null);
        bottomSheetDialog.setContentView(view);
        bottomSheetDialog.show();
//        startActivityForResult(new Intent(MediaStore.ACTION_IMAGE_CAPTURE),1);
    }

    public void camera(View v){
        startActivityForResult(new Intent(MediaStore.ACTION_IMAGE_CAPTURE),1);
    }

    public void gallery(View v){
        Intent in =new Intent(Intent.ACTION_PICK);
        in.setType("image/*");
        startActivityForResult(in,0);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        Bitmap bitmap;
        if(resultCode==RESULT_OK){
            if(requestCode==1){
                filePath = data.getData();
                bitmap=(Bitmap) data.getExtras().get("data");

                imageView.setImageBitmap(bitmap);
                imageView.setVisibility(View.VISIBLE);
            }
            else if(requestCode==0){

                Uri selectedImage = data.getData();
                try {
                    bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), selectedImage);

                    imageView.setImageBitmap(bitmap);
                    imageView.setVisibility(View.VISIBLE);
                } catch (IOException e) {
                    Log.i("TAG", "Some exception " + e);
                }
            }

            bottomSheetDialog.hide();
        }
    }
}
