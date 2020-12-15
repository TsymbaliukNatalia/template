<?php 
require_once "template.php";

$views = 'views/';
// телефон та електронна адреса компанії для виводу на сайті
$telephone_number = "096 28 59 14";
$email_adress = "root@gmail.com";

if(!isset($_GET['page'])){
    $content = file_get_contents('views/main.html');
    $header = file_get_contents('views/header.html');
    $head = file_get_contents('views/head.html');
    $tpl->set_value('HEAD', $head);
    $tpl->set_value('TITLE', 'My template title');
    $tpl->set_value('HEADER', $header);
} else {
    $page = $_GET['page'];//index.php?page=about
    $file_name = $views.$page.'.html';
    $tpl->set_value('HEADER','');
    $head = file_get_contents('views/head.html');
    $tpl->set_value('HEAD', $head);
    $tpl->set_value('TITLE', $page);

    if(file_exists($file_name)){
        $content = file_get_contents($file_name);
    } else {
        header("HTTP/1.0 404 Not Found");
    }
}

$tpl->get_tpl('views/template.html');



$nav = file_get_contents('views/nav.html');
$tpl->set_value('NAV', $nav);

$footer = file_get_contents('views/footer.html');
$tpl->set_value('FOOTER', $footer);
$tpl->set_value('HELLO_FOOTER','Привіт, я футер! Я маю бути внизу сайту, але не сьогодні)))');

$tpl->set_value('ABOUT','Про нас');
$tpl->set_value('CONTACT','Контакти');

$tpl->set_value('CONTENT', $content);

$tpl->set_value('TELEPHONE', $telephone_number);
$tpl->set_value('EMAIL', $email_adress);



$tpl->tpl_parse();
echo $tpl->html;