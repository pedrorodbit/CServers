<?php

class cryptoManager {

  private $encryptionKey = 'TewEURz8#E:JM*T^F#XHD.3D^u,^oF%vb#,CtMW@eUp,)TtTfHye6:#^mPTQLWbR';
  private $secretIV = 'z3fLe6yK=+,yfroo)>:}V-Y*^r3A}M6>gkbV}49aEg8T^44@]^f.+eE3fTUvNp4Q';
  private $encryptMethod = 'AES-256-CBC';
  private $hash = 'sha256';

  public function encrypt($string) {
    $key = hash($this->hash, $this->encryptionKey);
    $iv = substr(hash($this->hash, $this->secretIV), 0, 16);

    $output = openssl_encrypt($string, $this->encryptMethod, $key, 0, $iv);
    return base64_encode($output);
  }

  public function decrypt($string) {
    $key = hash($this->hash, $this->encryptionKey);
    $iv = substr(hash($this->hash, $this->secretIV), 0, 16);

    return openssl_decrypt(base64_decode($string), $this->encryptMethod, $key, 0, $iv);
  }

}
