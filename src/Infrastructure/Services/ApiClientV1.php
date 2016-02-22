<?php
namespace Language\Infrastructure\Services;

use Furesz\TypeChecker\TypeChecker;
use Language\ApiCall;
use Language\Domain\Contracts\ApiClient;
use Language\Domain\Entities\Applet;
use Language\Domain\ValueObjects\ApiResponse;
use Language\Domain\ValueObjects\Language;
use RuntimeException;
use UnexpectedValueException;

/**
 * API client implementation.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApiClientV1 implements ApiClient
{
    /**
     * {@inheritdoc}
     */
    public function getLanguageFileContent(Language $language)
    {
        try {
            $response = $this->call(
                'system_api',
                'language_api',
                [
                    'system' => 'LanguageFiles',
                    'action' => 'getLanguageFile',
                ],
                ['language' => $language]
            );

            $response->validateApiResponse();
        } catch (UnexpectedValueException $e) {
            throw new RuntimeException(
                sprintf('Unable the get language content. Language: %s', $language)
            );
        }

        return $response->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getAppletLanguageFileContent(Applet $applet, Language $language)
    {
        try {
            $response = $this->call(
                'system_api',
                'language_api',
                [
                    'system' => 'LanguageFiles',
                    'action' => 'getAppletLanguageFile',
                ],
                [
                    'applet' => $applet,
                    'language' => $language,
                ]
            );

            $response->validateApiResponse();
        } catch (UnexpectedValueException $e) {
            throw new RuntimeException(
                sprintf('Unable the get language content. Language: %s', $language)
            );
        }

        return $response->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getAppletLanguages(Applet $applet)
    {
        try {
            $response = $this->call(
                'system_api',
                'language_api',
                [
                    'system' => 'LanguageFiles',
                    'action' => 'getAppletLanguages',
                ],
                ['applet' => $applet->getAppletId()]
            );

            $response->validateApiResponse();
        } catch (UnexpectedValueException $e) {
            throw new RuntimeException(
                sprintf('Unable the get languages for applet. Applet: %s', $applet->getAppletId())
            );
        }

        $languages = [];

        foreach ($response->getData() as $languageCode) {
            $languages[] = new Language($languageCode);
        }

        return $languages;
    }

    /**
     * @param string $target
     * @param string $mode
     * @param array $getParameters
     * @param array $postParameters
     *
     * @throws \InvalidArgumentException If $target is not a string.
     * @throws \InvalidArgumentException If $mode is not a string.
     * @throws RuntimeException If unable to originate API call.
     * @throws \UnexpectedValueException If response format is invalid.
     *
     * @return \Language\Domain\ValueObjects\ApiResponse
     */
    public function call($target, $mode, array $getParameters = [], array $postParameters = [])
    {
        TypeChecker::assertString($target, '$target');
        TypeChecker::assertString($mode, '$mode');

        $apiResponse = ApiCall::call(
            $target,
            $mode,
            $getParameters,
            $postParameters
        );

        if (! $apiResponse) {
            throw new RuntimeException('Failed to originate API call!');
        }

        if (! array_key_exists('status', $apiResponse) || ! array_key_exists('data', $apiResponse)) {
            throw new UnexpectedValueException('Invalid API response received!');
        }

        return new ApiResponse($apiResponse['status'], $apiResponse['data']);
    }
}
