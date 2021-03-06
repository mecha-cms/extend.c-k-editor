<?php

$path = Extend::state('panel', 'path');
$r = __DIR__ . DS . '..' . DS . '..' . DS . '..';

// Dynamic resource
Route::set(x($path) . '/::g::/-/c-k-editor([^/]+)\.js', function($alt = "") use($path, $r) {
    extract(Lot::get(), EXTR_SKIP);
    $i = 60 * 60 * 24 * 30 * 12; // 1 Year
    HTTP::type('application/javascript')->header([
        'Pragma' => 'private',
        'Cache-Control' => 'private, max-age=' . $i,
        'Expires' => gmdate('D, d M Y H:i:s', time() + $i) . ' GMT'
    ]);
    $state = extend([
        'language' => explode('-', $config->language, 2)[0],
        'simpleUpload' => [
            'uploadUrl' => $url . '/' . $path . '/::s::/-/c-k-editor/push/' . $user->token
        ]
    ], Extend::state('c-k-editor:editor'));
    $c = 'ClassicEditor.defaultConfig=' . json_encode($state) . ';';
    $script = content($r . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor' . $alt . '.js') ?: "";
    echo $c . $script;
    return;
});

// Image upload path
Route::set(x($path) . '/::s::/-/c-k-editor/push/([^/]+)', function($token) {
    extract(Lot::get(), EXTR_SKIP);
    HTTP::status(200);
    $out = ['uploaded' => false];
    if ($token !== $user->token) {
        $out['error']['message'] = $language->message_error_token;
    }
    $blob = HTTP::files('upload');
    if (!empty($blob['type']) && strpos($blob['type'], 'image/') !== 0) {
        $out['error']['message'] = $language->message_error_page_image_blob;
    } else {
        $name = To::file($blob['name']);
        $state = Extend::state('panel', 'page');
        $candy = [
            'date' => new Date,
            'x' => Path::X($name),
            'hash' => Guard::hash(),
            'id' => sprintf('%u', time()),
            'name' => Path::N($name),
            'uid' => uniqid()
        ];
        $blob['name'] = $name = candy($state['image']['name'] ?? $name, $candy);
        $directory = candy(strtr($state['image']['directory'] ?? "", '/', DS), $candy);
        $response = File::push($blob, $path = rtrim(ASSET . ($user->status !== 1 ? DS . $user->key : "") . DS . $directory, DS));
        if ($response === false) {
            // $out['uploaded'] = true;
            $out['error']['message'] = $language->message_error_file_exist($path . DS . $name);
            // $out['url'] = To::URL($path . DS . $name);
        } else if (is_int($response)) {
            $out['error']['code'] = $response;
            $out['error']['message'] = $language->message_info_file_push[$response] ?? $language->error . ': ' . $response;
        } else {
            $out['uploaded'] = true;
            $out['url'] = To::URL($response);
        }
    }
    HTTP::type('application/json');
    echo json_encode($out);
    return;
});