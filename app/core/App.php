<?php

class App {
    //buat 3 protected untuk membuat halaman default 
    protected $controller = 'Home';
    // controler default
    protected $method = 'index';
    //method default
    protected $params = [];
    //parameter default 

    public function __construct()
    {
        // var_dump($_GET); // ambil apapun yang user ketik di url 
        $url = $this->parseURL();
        // var_dump($url); dividio 4 di hapus 
        if( file_exists('../app/controllers/' . $url[0] . '.php') ) { //ada ngga file didalam folder controler yang namanya sesuai yang kita tulis .url[0] itu artinya indeks ke 0, lalu di gabung dengan .php
            $this->controller = $url[0]; // timpa url dengan kontroler 
            unset($url[0]); //hilangkan kontroler dari array nyam supaya biar ambil parameternya 
            //kalau ngga ada parameter maka yang di pake default 
        }
        require_once '../app/controllers/' . $this->controller . '.php'; // memanggil kontroler , lalu digabungin dengan.php
        $this->controller = new $this->controller; //kita panggil lalu kita intanisiasi, supaya biar panggil method

    }

    public function parseURL()
    {
        if( isset($_GET['url'])){ // ambil url yang di ketik 
            $url = rtrim($_GET['url'], '/'); //menghilangkan '/' diakhir dan menaruh url ke php
            $url = filter_var($url, FILTER_SANITIZE_URL);//supaya url kita bersih dari karakter karakter aneh 
            $url = explode('/',$url); //slice '/' hilang lalu string string berubah menjadi element array dah biasanya url ada tanda tangya, sekarang ngga ada 
            return $url;
        }

    }
}