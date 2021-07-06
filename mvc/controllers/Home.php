<?php
    class Home extends Controller
    {
        public function Home()
        {
            $this->view('master' , ['page' => 'home']);
        }
    }
?>