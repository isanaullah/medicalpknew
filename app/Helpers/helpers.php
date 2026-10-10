<?php

if (!function_exists('getYoutubeEmbedUrl')) {
    function getYoutubeEmbedUrl($url)
    {
        // If it's already an embed URL, return it
        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }

        // Extract video ID from various YouTube URL formats
        $patterns = [
            // Standard watch URL: https://www.youtube.com/watch?v=VIDEO_ID
            '/youtube\.com\/watch\?v=([^&]+)/',
            // Short URL: https://youtu.be/VIDEO_ID
            '/youtu\.be\/([^?]+)/',
            // Embed URL: https://www.youtube.com/embed/VIDEO_ID
            '/youtube\.com\/embed\/([^?]+)/',
            // Mobile URL: https://m.youtube.com/watch?v=VIDEO_ID
            '/m\.youtube\.com\/watch\?v=([^&]+)/'
        ];

        $videoId = null;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $videoId = $matches[1];
                break;
            }
        }

        if ($videoId) {
            // Clean up video ID (remove any extra parameters)
            $videoId = explode('?', $videoId)[0];
            return 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1&iv_load_policy=3';
        }

        // If no match, return original URL
        return $url;
    }
}

if (!function_exists('getYouTubeVideoId')) {
    function getYouTubeVideoId($url)
    {
        $patterns = [
            '/youtube\.com\/watch\?v=([^&]+)/',
            '/youtu\.be\/([^?]+)/',
            '/youtube\.com\/embed\/([^?]+)/',
            '/m\.youtube\.com\/watch\?v=([^&]+)/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}
