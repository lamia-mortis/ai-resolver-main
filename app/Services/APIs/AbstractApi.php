<?php 

declare(strict_types=1);

namespace App\Services\APIs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class AbstractApi implements ApiInterface 
{
    public const SERVICE_KEY = '';

    protected string $origin;
    protected array $errorMessages = [
        'guzzle' => 'Error during execution request to the %s: ',
        'json'   => 'Error during parsing JSON from the %s response: ',
    ];

    public function __construct(protected readonly Client $client)
    {
        $this->origin = static::createOrigin();
    } 

    abstract protected static function createOrigin(): string;
    abstract protected function createUrl(string $path): string;

     /**
     * @param array<mixed> $data
     * @var ResponseInterface $response
     * @throws GuzzleException
     * @throws JsonException
     * @return array<mixed>
     */
    public function send(string $method, string $path, array $options = []): array
    {
        try {
            $url = $this->createUrl($path);
            $response = $this->client->request($method, $url, $options);
            $responseBody = $response->getBody()->getContents();

            return json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        } catch(GuzzleException $exception) {
            $concreteMessage = sprintf($this->errorMessages['guzzle'], static::SERVICE_KEY);
            Log::error($concreteMessage . $exception->getMessage());

            return [];
        } catch(JsonException $exception) {
            $concreteMessage = sprintf($this->errorMessages['json'], static::SERVICE_KEY);
            Log::error($concreteMessage . $exception->getMessage());

            return [];
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }
}