<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Application;


use App\Domain\Model\Engine\EngineInterface;
use Google\Cloud\Translate\V3\TranslationServiceClient;

final class GoogleEngine implements EngineInterface
{
    /**
     * @var TranslationServiceClient
     */
    private $translationServiceClient;
    /**
     * @var string
     */
    private $projectId;
    
    /**
     * GoogleEngine constructor.
     *
     * @param TranslationServiceClient $translationServiceClient
     * @param string                   $projectId
     */
    public function __construct(TranslationServiceClient $translationServiceClient, string $projectId)
    {
        $this->translationServiceClient = $translationServiceClient;
        $this->projectId                = $projectId;
    }
    
    public static function id(): string
    {
        return 'google_cloud_translate';
    }
    
    public static function description(): string
    {
        return 'Google Cloud Translation';
    }
    
    public function translate(string $content, string $targetLanguage): string
    {
        try {
            $response = $this->translationServiceClient->translateText(
                [$content],
                $targetLanguage,
                TranslationServiceClient::locationName($this->projectId, 'global')
            );
            var_dump($response);
//        } catch (\Exception $exception) {
        } finally {
            echo 'qwer';
            $this->translationServiceClient->close();
        }
        
        $translation = '';
        foreach ($response->getTranslations() as $key => $translationItem) {
            $separator = $key === 2
                ? '!'
                : ', ';
            $translation .= $translationItem->getTranslatedText() . $separator;
        }
        
        return $translation;
    }
}