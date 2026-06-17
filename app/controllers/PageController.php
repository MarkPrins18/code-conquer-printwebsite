<?php

class PageController {
    public function home(): void 
    {
        global $translations;
        view('guest/home/index', ['translations' => $translations]);
    }

    public function about(): void 
    {
        global $aboutUsTranslations;
        view('guest/about/index', ['translations' => $aboutUsTranslations]);
    }

    public function services(): void 
    {
        global $servicesTranslations;
        view('guest/services/index', ['translations' => $servicesTranslations]);
    }
 
}
