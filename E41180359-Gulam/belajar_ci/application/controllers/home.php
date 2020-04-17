<?php 
class Home extends CI_Controller 
{
    //mengextends CI_Controller
    public function index () {

        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->get()
        );
        $this->load->view("HomeView", $data);
    }
    public function detail($id) {
        $this->load->model("ArtikelModel");
        $data = array(
            "artikel" => $this->ArtikelModel->detail($id)
        );
        $this->load->view("DetailView", $data);
    }
    public function tambah() {
        $this->load->model("ArtikelModel");
        if ($this->input->method() == "post") {
            $insert = $this->ArtikelModel->tambah(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'tanggal' => date ("Y-m-d H:i:s")
            ));

            if ($insert) {
                echo "Sukses Tambah Artikel.";
            }else {
                echo "Gagal tambah artikel.";
            }
        }
            $this->load->view("FormView");
    }
    public function ubah($id) {
        $autoReload = base_url();
        $data["artikel"] = $this->ArtikelModel->detail($id);
        if ($this->input->method()=="post") {
            $update = $this->ArtikelModel->ubah(array(
                'judul' => $this->input->post("judul"),
                'penulis' => $this->input->post("penulis"),
                'isi' => $this->input->post("isi"),
                'tanggal' => date ("Y-m-d H:i:s")
            ), $id);
            if ($update) {
                echo "Berhasil";
                redirect($autoReload);
            }else {
                echo "Gagal";
            }
        }
        $this->load->view("EditView", $data);
    }
    public function hapus($id){
        $autoReload = base_url();
        $hapus = $this->ArtikelModel->hapus($id);
        if ($hapus) {
            echo "Berhasil";
            redirect($autoReload);
        }
    
    
    
        // $this->load->model("UserModel"); //memanggil usermodel


        
        // $ubah = $this->UserModel->ubah (array(
        //     echo '<pre>';
        //     print_r($this->UserModel->get());
        //     echo '</pre>';
        // 'nama' => 'Agus',
        // 'email' => 'agus@gmail.com',
        // 'alamat' => 'jember'), 1);
        // if($ubah) {
        //     echo "Ubah data berhasil";
        // }

        
        // $tambah = $this->UserModel->tambah(array(
        //         //data yang akan ditambahkan
        // 'nama' => 'Andri',
        // 'email' => 'Andri@polije.ac.id',
        // 'alamat' => 'ponorogo'
        // ));
        // if($tambah){
        //     echo "Tambah Data Berhasil";
        // }
        
    //     $this->load->library('table'); //memanggil library table
    //     $template =array (
    //         "table_open"=>"<table border=1 cellpadding=3>"
    //     );
    //    //set table template
    //    $this->table->set_template($template);
    //    $this->table->set_caption
    //    ("<h1>menampilkan table dengan HTML table class </h1>"); //caption
    //    $data = array ( // data yang akan dimasukkan ke tabel
    //     array ('Nama', 'Email', 'Jenis Kelamin'),
    //     array ('Gulam', 'gulammubarik77@gmail.com', 'Laki-Laki'),
    //     array ('Agung', 'agungwahyu@gmail.com', 'Laki-Laki'),
    //     array ('Dheni', 'Dheni@gmail.com', 'Laki-Laki')
    //    );
    //    echo $this->table->generate ($data); //tampilkan tabel
        //memanggil library session
        // $this->load->library("session");
        // //set session
        // $this->session->set_userdata("nama","politeknik");
        // //show session
        // echo 'Nama Anda : ' .$this->session->userdata("nama");
        // echo '<br>Sesion di hapus<br>';
        // //hapus session nama
        // $this->session->unset_userdata("nama");
        // echo 'Nama Anda :' .$this->session->userdata("nama");

        // $error = "";
        // $data = "";
        // if ($this->input->method() == "post") {
        //     //konfigurasi
        // $config ['upload_path'] = './gambar';
        // $config ['allowed_types'] = 'gif|jpg|png';
        // $config ['max_size'] = 100;
        // $config ['max_width'] = 1024;
        // $config ['max_height'] = 768;
        // //paggil library
        // $this->load->library('upload', $config);
        // //cek apakah gagal upload
        // if (!$this->upload->do_upload('gambar')){
        //     $error = $this->upload->display_errors();
        // }else { //jika file berhasil upload
        //     $data = $this->upload->data();
        // }
        // }
        // $this->load->view("HomeView", array(
        //     'error' => $error,
        //     'data' => $data
        // ));
        // // //cek apakah method = post
        // if ($this->input->method() == "post") {
        //     //tampilkan data
        //     echo "nama : " . $this->input->post ("nama"). '<br>';
        //     echo "email : " . $this->input->post ("email") ;
        // }
        // $this->load->view("HomeView");
        // $this ->load->helper ("belajar"); //memanggil helper belajar
        // tampilkanTebal ("Politeknik Negeri Jember <br>");
        // tampilkanMiring ("Jurusan Teknologi Informasi<br>");
        // tampilkanBergaris ("2020 <br>");
        // $this ->load->helper ("form"); //memanggil helper form
        // echo form_open ('/'); //membuka form
        // echo form_label ('Nama :') . '<br>'; //membuat label
        // echo form_input ('nama') . '<br>'; //membuat textbox
        // echo form_label ('Alamat : ') . '<br>'; //membuat label
        // echo form_textarea ('alamat') . '<br>'; //membuat textbox
        // echo form_submit ('submit', 'kirim Data'); //membuat tombol
        // echo form_close (); //menutup form
        // $this ->load->helper ("url"); //memanggil helper url
        // echo site_url () . '<br>'; //lokasi website
        // echo base_url () . '<br>'; //folder lokasi website
        // echo current_url() . '<br>'; // url yang sedang dibuka
        // echo anchor ('http://google.com', 'google.com') . '<br>'; //membuat url
        // echo anchor ('http://polije.ac.id', 'polije.ac.id');
         // $this ->load->helper ("number"); //memanggil helper number
        // echo 'ukuran GB : ' . byte_format (4512244422) . '<br>';
        // echo 'ukuran MB : ' . byte_format (52245023) . '<br>';
        // echo 'ukuran KB : ' . byte_format (145023) ;
        // $this ->load->helper ("html"); 
        // echo heading ('Selamat Datang!', 1); //heading
        // echo ul (array( //ul
        //     'kesatu',
        //     'kedua',
        //     'ketiga'
        // ));
        // echo ol (array ( //ol
        //     'kesatu',
        //     'kedua',
        //     'ketiga'
       // ));
        // $this ->load->model ("DataModel"); //memanggil DataModel
        // $dataArr = $this->DataModel->getData ();
        // echo "nama : " . $dataArr["nama"] . '<br>' ;
        // echo "status : " . $dataArr["status"] . '<br>' ;
        // echo "website : " . $dataArr["website"] . '<br>' ;

        // $this->load->view ("HomeView" , array ("data" => $dataArr)); //Memanggil HomeView

         //echo "selamat datang";
    }
}
?>