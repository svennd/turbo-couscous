<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        echo "pages::index";
        return view('welcome_message');
    }


    public function view($page = 'home')
    {
        echo "pages::view";
        var_dump($page);
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('header', $data)
            . view('pages/' . $page)
            . view('footer');
    }
}