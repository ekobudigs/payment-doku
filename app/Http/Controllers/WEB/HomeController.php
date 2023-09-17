<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;

class HomeController extends Controller
{
    /**
     * Controller module path.
     *
     * @var string
     */
    private $module;

    /**
     * Controller module title.
     *
     * @var string
     */
    private $title;

    /**
     * Initiate controller properties value.
     */
    public function __construct()
    {
        $this->module = 'web';
        $this->title = 'Beranda';
    }

    /**
     * Display web homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        try {
            $view = $this->module.'.home';
            $data['title'] = $this->title;

            return view($view, $data);
        }
        //
        catch (\Throwable $th) {
            return ResponseController::failed($th->getMessage());
        }
    }
}
