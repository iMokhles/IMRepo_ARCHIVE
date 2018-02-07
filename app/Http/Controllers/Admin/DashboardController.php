<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard() {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['users'] = $this->usersWidget();

        return view('dashboard', $this->data);
    }

    protected function usersWidget() {
        return $this->createWidget('green', 'users', '200', '/admin/users');
    }

    protected function createWidget($color, $icon, $count, $url) {
        return [
            'color' => $color,
            'icon' => $icon,
            'count' => $count,
            'url' => $url,
        ];
    }
}
