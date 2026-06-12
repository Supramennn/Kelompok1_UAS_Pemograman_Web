<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $redirect = $this->requireLogin();

        if ($redirect !== null) {
            return $redirect;
        }

        return view('dashboard/index');
    }
}
