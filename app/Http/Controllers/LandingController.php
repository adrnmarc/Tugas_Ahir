<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    OrtuController,
    SiswaController,
    TagihanController,
    LaporanController,
    PengumumanController,
    PembayaranController,
    ProfilAnakController,
    RiwayatPembayaranController,
    LandingController
};
use App\Http\Middleware\CheckAdminLogin;