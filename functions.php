<?php 
function summarize($text, $word_count = 20) {
    // Remove HTML tags
    $text = strip_tags($text);

    // Split text into words
    $words = preg_split('/\s+/', $text);

    // Slice the array to get the specified number of words
    $summary_words = array_slice($words, 0, $word_count);

    // Join the words back into a string
    $summary = implode(' ', $summary_words);

    return $summary . '...';
}

function getImageType($base64) {
    $imageType = '';
    
    if (substr($base64, 0, 4) === '/9j/') {
        $imageType = 'image/jpeg';
    } elseif (substr($base64, 0, 8) === 'iVBORw0K') {
        $imageType = 'image/png';
    }

    return $imageType;
}