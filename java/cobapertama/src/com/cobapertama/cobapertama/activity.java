package com.cobapertama.cobapertama;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

public class activity extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        TextView txtBaru = new TextView(this);
        txtBaru.setText("teksPertama di android");
        setContentView(txtBaru);
        //setContentView(R.layout.main);
    }
}