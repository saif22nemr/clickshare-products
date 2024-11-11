<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
function isUrlActive($url, $checkFull = false, $data = [])
{
    $path = Request::path();

    // If query parameters need to be checked, verify all at once
    if (!empty($data)) {
        $requestData = Request::all();
        foreach ($data as $key => $value) {
            if (!isset($requestData[$key]) || $requestData[$key] != $value) {
                return false;
            }
        }
    }

    // Check for partial or full match of the URL
    if ($checkFull) {
        return $path === $url;
    } else {
        return Str::contains($path, $url) || $path === $url;
    }
}

if (!function_exists('getInputError')) {
    function getInputError($inputName, $errors, $errorClass = 'is-invalid')
    {
        if ($errors->has($inputName)) {
            return $errorClass;
        }
        return null;
    }
}
if (!function_exists('generateComplexPassword')) {
    function generateComplexPassword($length = 12)
    {
        // Define character pools for the password
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()-_=+<>?';

        // Combine all character pools
        $allCharacters = $upperCase . $lowerCase . $numbers . $specialChars;

        // Ensure the password includes at least one character from each pool
        $password = $upperCase[rand(0, strlen($upperCase) - 1)] .
            $lowerCase[rand(0, strlen($lowerCase) - 1)] .
            $numbers[rand(0, strlen($numbers) - 1)] .
            $specialChars[rand(0, strlen($specialChars) - 1)];

        // Fill the rest of the password with random characters from the full pool
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
        }

        // Shuffle the characters to make the password unpredictable
        return str_shuffle($password);
    }
}

if (!function_exists('isPasswordComplex')) {
    function isPasswordComplex($password)
    {
        $minLength = 8;

        // Check if password meets complexity requirements:
        if (strlen($password) < $minLength) {
            return 'Password must be at least ' . $minLength . ' characters long.';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return 'Password must contain at least one uppercase letter.';
        }
        if (!preg_match('/[a-z]/', $password)) {
            return 'Password must contain at least one lowercase letter.';
        }
        if (!preg_match('/[0-9]/', $password)) {
            return 'Password must contain at least one number.';
        }
        if (!preg_match('/[\W_]/', $password)) { // \W matches any non-word character, including special characters
            return 'Password must contain at least one special character.';
        }

        // If all checks pass, the password is complex
        return true;
    }
}

function getHomeUrl($user = null)
{
    if (isset($user->id)):
        if ($user->type == 'admin'):
            return route('admin.home');
        elseif ($user->type == 'manager'):
            return route('manager.home');
        elseif ($user->type == 'employee'):
            return route('employee.home');
        endif;
    endif;
    if (auth('admin')->check()):
        return route('admin.home');
    elseif (auth('manager')->check()):
        return route('manager.home');
    elseif (auth('employee')->check()):
        return route('employee.home');
    endif;
    return route('login');
}

function checkAuth()
{
    if (auth('admin')->check()):
        return auth('admin')->user();
    elseif (auth('manager')->check()):
        return auth('manager')->user();
    elseif (auth('employee')->check()):
        return auth('employee')->user();
    endif;
    return null;
}
function deleteUserImage($user)
{
    if ($user->image != null and Storage::disk('upload')->exists($user->image_path)):
        Storage::disk('upload')->delete($user->image_path);
        return true;
    endif;
    return false;
}

