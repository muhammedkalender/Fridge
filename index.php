<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

use Helpers\Logger;
use Objects\Coke;
use Objects\Fridge;

Logger::log("İşlemler Başlıyor");

Logger::log("Obje tanımlanıyor", true);
$fridge = new Fridge();

Logger::log("Kapak açılıyor", true);
$fridge->open();

Logger::log("Kapak tekrar açılıyor", true);
$fridge->open();

Logger::log("Dolabın durumu soruluyor", true);
$fridge->printStatus();

echo $fridge->printShelfStatus();

$coke = null;

Logger::log("20 Adet Kola Ekleniyor", true);
foreach (range(1, 20) as $index) {
    Logger::log("{$index}. Kola Tanımlanıyor");

    $coke = new Coke();
    $fridge->put($coke);
}

Logger::log("Dolabın durumu soruluyor", true);
$fridge->printStatus();

$fridge->printShelfStatus();

Logger::log("Kolanın bilgileri alınıyor", true);
echo $coke->getInfo() . "<br>";

Logger::log("Kapak kapatılıyor", true);
$fridge->close();

Logger::log("21. kola tanımlanıyor", true);
$coke = new Coke();

Logger::log("21. kola dolaba konuyor", true);
$fridge->put($coke);

Logger::log("Dolabın kapağı açılıyor", true);
$fridge->open();

Logger::log("Yeni kola dolaba konuyor", true);
$fridge->put($coke);

Logger::log("Dolap tamamen dolduruluyor", true);
foreach (range(22, 60) as $index) {
    Logger::log("{$index}. Kola Tanımlanıyor");

    $coke = new Coke();
    $fridge->put($coke);
}

Logger::log("Dolabın güncel durumu yazdırılıyor", true);
$fridge->printStatus();

Logger::log("61. İçecek dolaba konmaya çalışıyor", true);
$fridge->put(new Coke());

Logger::log("Dolaptaki güncel kola sayısı", true);
echo $fridge->getCount() . "<br>";

echo $fridge->printShelfStatus();

Logger::log("Dolaptan kola alınıyor", true);
$fridge->take();

Logger::log("Dolabın güncel durumu yazdırılıyor", true);
$fridge->printStatus();

Logger::log("Dolaptaki güncel kola sayısı", true);
echo $fridge->getCount() . "<br>";

$fridge->printShelfStatus();