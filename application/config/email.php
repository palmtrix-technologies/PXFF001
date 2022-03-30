<?php 
$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.example.com', 
    'smtp_port' => 465,
    'smtp_user' => 'palmtrix@gmail.com',
    'smtp_pass' => '123456',
    'smtp_crypto' => 'ssl',
    'mailtype' => 'text',
    'smtp_timeout' => '4', 
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);


// $config = Array(
//     'protocol' => 'smtp',
//     'smtp_host' => 'ssl://smtp.googlemail.com',
//     'smtp_port' => 465,
//     'smtp_user' => 'my_email@gmail.com',
//     'smtp_pass' => 'yourpassword',
//     'mailtype'  => 'html', 
//     'charset'   => 'utf-8',
//     'wordwrap'  => TRUE
// );
//$this->load->library('email', $config);

?>