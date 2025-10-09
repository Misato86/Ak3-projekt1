<?php

namespace App\Storage;

class JsonFileHandler {
    protected string $filepath;

    public function __construct(string $table, JsonDbConnection $dbManager) {
        $this -> filepath = $dbManager -> getPath($table);

        
        if (!file_exists($this -> filepath)) {
            file_put_contents($this -> filepath, json_encode([]));
        }
    }
    public function read(): array {
        $content = file_get_contents($this -> filepath);
        return json_decode($content, true) ?? [];
    }
    public function write(array $data): void {
        file_put_contents($this -> filepath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
# write a function that returns fibonacci numbers
