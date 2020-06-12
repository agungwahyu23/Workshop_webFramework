package com.example.jurnal_guruku.config;

import android.content.Context;
import android.content.SharedPreferences;

public class authdata {
    private static authdata mInstance;
    public static Context mCtx;

    public static final String SHARED_PREF_NAME = "sharedguruku";
    private static final String sudahlogin = "n";
    private static final String level = "level";
    private static final String token = "token";
    private static final String akses_data = "akses_data";
    private static final String kode_user = "kode_user";

    private authdata(Context context){
        mCtx = context;
    }
    public static synchronized authdata getInstance(Context context){
        if (mInstance == null){
            mInstance = new authdata(context);
        }
        return mInstance;
    }

    public boolean setdatauser(String xloginas, String tokennya , String aksesnya, String kodenya ){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(level, xloginas);
        editor.putString(sudahlogin, "y");
        editor.putString(token, tokennya);
        editor.putString(akses_data, aksesnya);
        editor.putString(kode_user, kodenya);

//
        editor.apply();

        return true;
    }
    public boolean ceklogin(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        if(sharedPreferences.getString(token, null)!=null){
            return true;
        }
        return false;
    }

    public boolean logout(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        return true;
    }

    public String getToken() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(token, null);
    }

    public String getKodeUser() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(kode_user, null);
    }

    public String getAksesData() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(akses_data, null);
    }
    public String getLevel(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(level, null);
    }

}
