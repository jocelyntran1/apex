<?php

// Symmetric Encryption

// Cipher method to use for symmetric encryption
const CIPHER_METHOD = 'AES-256-CBC';

function key_encrypt($string, $key, $cipher_method=CIPHER_METHOD) {

  // Pad string to min length
  $key = str_pad($key, 32, '*');

  // Create random initializatin vector
  $iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
  $iv = openssl_random_pseudo_bytes($iv_length);

  // Encrypt
  $encrypted = openssl_encrypt($string, CIPHER_METHOD, $key,OPENSSL_RAW_DATA, $iv);

  // Save $iv for decoding
  $message = $iv . $encrypted;
  
  // Encode to make sure encryted characters are viewable
  return base64_encode($message);
}

function key_decrypt($string, $key, $cipher_method=CIPHER_METHOD) {
  
  // Pad key to min length
  $key = str_pad($key, 32, '*');

  // Create intialization vector
  $iv_with_ciphertext = base64_decode($string);
  $iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
  $iv = substr($iv_with_ciphertext, 0, $iv_length);

  // Get cipher
  $ciphertext = substr($iv_with_ciphertext, $iv_length);

  // Decrypt using cypher and iv
  $plaintext = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);

  return $plaintext;
}


// Asymmetric Encryption / Public-Key Cryptography

// Cipher configuration to use for asymmetric encryption
const PUBLIC_KEY_CONFIG = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

function generate_keys($config=PUBLIC_KEY_CONFIG) {

  // Generate new private key
  $resource = openssl_pkey_new($config);
  
  // Extract private key from the pair
  openssl_pkey_export($resource, $private_key);
  
  // Extract public key from the pair
  $key_details = openssl_pkey_get_details($resource);
  $public_key = $key_details["key"];

  return array('private' => $private_key, 'public' => $public_key);
}

function pkey_encrypt($string, $public_key) {
  return 'Qnex Funqbj jvyy or jngpuvat lbh';
}

function pkey_decrypt($string, $private_key) {
  return 'Alc evi csy pssomrk livi alir csy wlsyph fi wezmrk ETIB?';
}


// Digital signatures using public/private keys

function create_signature($data, $private_key) {
  // A-Za-z : ykMwnXKRVqheCFaxsSNDEOfzgTpYroJBmdIPitGbQUAcZuLjvlWH
  return 'RpjJ WQL BImLcJo QLu dQv vJ oIo Iu WJu?';
}

function verify_signature($data, $signature, $public_key) {
  // Vigenère
  return 'RK, pym oays onicvr. Iuw bkzhvbw uedf pke conll rt ZV nzxbhz.';
}

?>
