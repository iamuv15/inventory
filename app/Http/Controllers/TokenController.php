<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use Auth;
use App\Kerberos;

class TokenController extends Controller
{
  public function isValid(Request $request){
    // encrypted token
    // $data = $request['data'];
    $encrypted = $request['data'];

    //user instance
    if(!DB::table('kerberos_auth')->where('email', '=', $request['email'])->first()) {
      // $user = DB::table('kerberos_auth')->where('email', '=', $request['email'])->first();

      // resource server secret
      $secret = $this->resourceServerSecret();

      // insert data into the table

      $kerberos = new Kerberos();

      $kerberos->email = $request['email'];
      $kerberos->encrypted = $request['data'];
      $kerberos->valid_time = date("Y/m/d H:i:s", strtotime("+30 minutes"));

      if($kerberos->save()){
        return $secret.''.$request['data'];
      }
    }
    else{
      $secret = $this->resourceServerSecret();

      if(DB::table('kerberos_auth')->where('email', '=', $request['email'])->delete()){
        $kerberos = new Kerberos();

        $kerberos->email = $request['email'];
        $kerberos->encrypted = $request['data'];
        $kerberos->valid_time = date("Y/m/d H:i:s", strtotime("+30 minutes"));

        if($kerberos->save()){
          return $secret.''.$request['data'];
        }
      }
    }
  }

  public function resourceServerSecret(){
    $client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost/xampp/kerberos/public/'
    ]);

    $response = $client->request('GET', 'resource/secret');

    $data = $response->getBody();

    $data = json_decode($data);

    return $data[0]->private_key;
  }

  function CryptoAesDecrypt($secret, $encrypted){

    $jsondata = json_decode($encrypted, true);
    try {
        $salt = hex2bin($jsondata["salt"]);
        $iv  = hex2bin($jsondata["iv"]);
    } catch(Exception $e) { return null; }

    $ciphertext = base64_decode($jsondata["ciphertext"]);
    $iterations = 999; //same as js encrypting

    $key = hash_pbkdf2("sha512", $secret, $salt, $iterations, 64);

    $decrypted= openssl_decrypt($ciphertext , 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

    return $decrypted;

  }
}
