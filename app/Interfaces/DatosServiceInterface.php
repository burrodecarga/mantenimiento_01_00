<?php namespace App\Interfaces;

interface DatosServiceInterface
{
    public function timelinesCostByTask();
    public function gastosDeMantenimiento();
    public function gastosDeFallas();
    public function gastosDePersonal();
    public function assignWork($userId,$failId);
}

