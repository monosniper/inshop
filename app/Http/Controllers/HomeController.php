<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function report()
    {
        return view('pages.report');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function confidential()
    {
        return view('pages.confidential');
    }

    public function ourShops()
    {
        return view('pages.ourShops');
    }

    public function sitemap()
    {
        return view('pages.sitemap');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function updates()
    {
        return view('pages.updates');
    }

    public function useConditions()
    {
        return view('pages.useConditions');
    }

    public function domains()
    {
        return view('pages.domains');
    }

    public function hosting()
    {
        return view('pages.hosting');
    }

    public function seo()
    {
        return view('pages.seo');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
