<?php namespace App\Helper;

use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;

class FirebaseHelper
{
    protected $firebase;

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(public_path('firebase_credentials.json'));

        $apiKey = env('FIREBASE_API_KEY');

        $this->firebase = (new Factory)
            ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
            ->create();
    }

    public function createToken($uid, $claims)
    {
        $auth = $this->firebase->getAuth();

        $customToken = $auth->createCustomToken($uid, $claims);

        return (string)$customToken;
    }

    public function getUser($token)
    {
        $auth = $this->firebase->getAuth();

        $user = $auth->getUser($token);

        return $user;
    }

    public function db()
    {
        return $this->firebase->getDatabase();
    }

    public function save($path, $value)
    {
        if(\App::environment() === 'production'){
            return $this->db()->getReference($path)->set($value);
        }
    }

    public function update($path, $value)
    {
        if(\App::environment() === 'production'){
            return $this->db()->getReference($path)->update($value);
        }
    }

    public function destroy($path)
    {
        if(\App::environment() === 'production'){
            return $this->db()->getReference($path)->remove();
        }
    }

    public function ref($path = '')
    {
        return $this->db()->getReference($path);
    }

    public function childKeys($path = '')
    {
        $ref = $this->ref($path);

        if($ref->getSnapshot()->numChildren() ){
            return $ref->getChildKeys();
        }
        return [];
    }

    public function value($path)
    {
        // Get value
        return $this->ref($path)->getValue();
    }
}