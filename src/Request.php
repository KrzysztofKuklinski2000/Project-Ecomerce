<?php 
declare(strict_types=1);

namespace App;

class Request {
    private array $get = [];
    public array $post = [];
    private array $server = [];
    public array $session = [];
    
    public function __construct(array $get, array $post, array $server, array $session) {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->session = $session;
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

    public function session(string $param, $defalut = null) {
        return $this->session[$param] ?? $default;
    }

    public function hasSession():bool {
        return !empty($this->session);
    }
    

}