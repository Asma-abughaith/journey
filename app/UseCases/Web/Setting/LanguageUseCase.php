<?php

namespace App\UseCases\Web\Setting;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Setting\LanguageRepositoryInterface;

class LanguageUseCase
{
    protected $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function setLang($lang)
    {
        return $this->languageRepository->setLanguage([
            'lang'=>$lang
        ]);
    }

}
