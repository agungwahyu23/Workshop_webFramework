package com.example.jurnal_guruku.config;

public class ServerApi {
   public static final String IPServer="http://192.168.1.7/Workshop_webFramework/jurnal_guru/api/";
//   public static final String IPServer="http://192.168.43.194:8080/Workshop_webFramework/jurnal_guru/api/";


    public static final String URL_LOGIN=IPServer+"auth/authlogin";
    public static final String URL_LOGOUT=IPServer+"Api/authlogout";
    public static final String URL_SAVE_DATA=IPServer+"Api/savedata";
    public static final String URL_GET_DATA=IPServer+"Api/getdataresult";
    public static final String URL_GET_DETAIL_DATA=IPServer+"Api/getdetaildata";
}
