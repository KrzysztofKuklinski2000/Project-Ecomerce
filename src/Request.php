<?php 
declare(strict_types=1);

namespace App;

class Request {
    private array $get = [];
    
    public function __construct(array $get) {
        $this->get = $get;
    }

    public function get(string $param, $default = null) {
        return $this->get[$param] ?? $default;
    }
}