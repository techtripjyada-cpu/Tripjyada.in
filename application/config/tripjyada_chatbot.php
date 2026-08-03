<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['tripjyada_chatbot'] = array(
    'anthropic_api_key' => getenv('ANTHROPIC_API_KEY'),
    'model'             => 'claude-haiku-4-5-20251001',
    'max_tokens'        => 800,
);
