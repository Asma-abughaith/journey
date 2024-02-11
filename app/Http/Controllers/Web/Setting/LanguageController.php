<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use App\UseCases\Web\Setting\LanguageUseCase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    protected $languageUseCase;

    public function __construct(  LanguageUseCase $languageUseCase) {
        $this->languageUseCase = $languageUseCase;

    }
    public function switchLanguage($lang)
    {
        try {
            $this->languageUseCase->setLang($lang);
            Toastr::success('language changed to successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
