<?php

# -----------------------------------------------------------------------------
# curlfunc($site) - get basic info from given site
# returns an array consisting of 'site', 'url', 'http_code', 'content'
# -----------------------------------------------------------------------------

function curlfunc($site) {

    $ch = curl_init($site);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla 5.0");
    $content = curl_exec($ch);
    $curl_info = curl_getinfo($ch);
    curl_close($ch);
    return array(
        'site' => $site,
        'url' => urldecode($curl_info['url']),
        'http_code' => $curl_info['http_code'],
        'content' => $content
    );
}

# EOF: