<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;

class JsonPlaceholderApi
{
    private Client $httpClient;
    private string $baseUrl = 'https://jsonplaceholder.typicode.com';

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    private function sendRequest(
        string $method,
        string $url,
        array  $data = []
    ): array
    {
        try {
            $response = $this->httpClient->request(
                $method, $url, $data
            );

            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            $request = Message::toString($e->getRequest());
            $response = Message::toString($e->getResponse());

            return [
                'request' => $request,
                'response' => $response,
            ];
        }
    }

    public function getUsers(): array
    {
        return $this->sendRequest(
            'GET',
            "{$this->baseUrl}/users"
        );
    }

    public function getUserPosts(int $userId): array
    {
        return $this->sendRequest(
            'GET',
            "{$this->baseUrl}/users/${userId}/posts"
        );
    }

    public function getUserTodos(int $userId): array
    {
        return $this->sendRequest(
            'GET',
            "{$this->baseUrl}/users/${userId}/todos"
        );
    }

    public function getPost(int $postId): array
    {
        return $this->sendRequest(
            'GET',
            "{$this->baseUrl}/posts/$postId"
        );
    }

    public function createPost(array $postData): array
    {
        return $this->sendRequest(
            'POST',
            "{$this->baseUrl}/posts",
            ['json' => $postData]
        );
    }

    public function updatePost(int $postId, array $postData): array
    {
        return $this->sendRequest(
            'PUT',
            "{$this->baseUrl}/posts/{$postId}",
            ['json' => $postData]
        );
    }

    public function deletePost(int $postId): void
    {
        $this->sendRequest(
            'DELETE',
            "{$this->baseUrl}/posts/{$postId}"
        );
    }

}