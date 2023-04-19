<?php

namespace App\EntityListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\User;

class UserLoadEventListener
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    // On déclare une propriété pour récupérer la clé du .env
    private $encryptSecret;

    // ====================================================== //
    // ==================== CONSTRUCTEUR ==================== //
    // ====================================================== //
    public function __construct($encryptSecret)
    {
        $this->encryptSecret = $encryptSecret;
    }
    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function postLoad(User $user)
    {
        $algo = 'aes-256-gcm';
        $key = $this->encryptSecret;
        $iv = base64_decode($user->getSecretIv());
        if(!is_null($user->getNom())){
            // On décode le nom crypté encodé en base64
            $data = base64_decode($user->getNom());
            // On récupére le tag ayant été ajouté lors du cryptage
            $tag = substr($data, 0, 16);
            $encodedName = substr($data, 16);
            $nom = openssl_decrypt($encodedName, $algo, $key, 0, $iv, $tag);
            $user->setNom($nom);
        }
        if(!is_null($user->getPrenom())){
            // On décode le nom crypté encodé en base64
            $data = base64_decode($user->getPrenom());
            // On récupére le tag ayant été ajouté lors du cryptage
            $tag = substr($data, 0, 16);
            $encodedName = substr($data, 16);
            $prenom = openssl_decrypt($encodedName, $algo, $key, 0, $iv, $tag);
            $user->setPrenom($prenom);
        }
    }
}
