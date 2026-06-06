<?php

function translate($key, $translations, $language)
{
    return $translations[$language][$key] ?? $translations['en'][$key] ?? $key;
}
