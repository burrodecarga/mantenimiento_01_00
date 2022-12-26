<?php namespace App\Interfaces;

interface CeoServiceInterface
{
    public function prueba();
    public function fails();
    public function repareid();
    public function actives();

    ////////////////////////////////////////////////////////////////por zonas

    public function byZone();
    public function byEquipment();
    public function byType();
}
