<?php 
declare(strict_types=1);

namespace App;

class Request {
    private array $get = [];
    private array $post = [];
    private array $server = [];
    
    public function __construct(array $get, array $post, array $server) {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    public function isPost(): bool {
        return $this->server['REQUEST_METHOD'] === "POST";
    }

    public function get(string $param, $default = null) {
        return $this->get[$param] ?? $default;
    }

    public function post(string $param, $default = null) {
        return $this->post[$param] ?? $default;
    }

}