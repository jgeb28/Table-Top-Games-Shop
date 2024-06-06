<?php

declare(strict_types=1);

function is_input_empty(string $elem1, string $elem2) {

    if (
        empty($elem1)  || empty($elem2) 
    ) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}

function is_phone_invalid(string $phone) {

      // Remove special characters
      $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    
      // Check if the phone number is 10 digits long
      if (strlen($phone) != 9) {
          return true;
      }
      
      // Check if the phone number only contains digits
      if (!preg_match('/^[0-9]{9}$/', $phone)) {
          return true;
      }

      return false;
   
}