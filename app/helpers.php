<?php

// For add'active' class for activated route nav-item
function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function generateRandomNumber() {
  return mt_rand(1000, 9999);
}

function generateReferralCode($fullName) {
  // Split the full name into first name and last name
  $nameParts = explode(' ', $fullName);

  $firstName = $nameParts[0];

  $randomNumber = generateRandomNumber();
  
  $referralCode = ucfirst($firstName) . $randomNumber;

  return $referralCode;
}