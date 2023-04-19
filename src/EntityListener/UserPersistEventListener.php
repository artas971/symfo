<?php

namespace App\EntityListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\User;

class UserPersistEventListener
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
    public function prePersist(User $user){
        // On déclare l'algorithme de cryptage qui va être utilisé
        $algo = 'aes-256-gcm';
        // On déclare la clé de cryptage qui va être utilisé
        $key = $this->encryptSecret;
        // On déclare le vecteur d'initialisation qui va être utilisé
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($algo));
        // On stocker le vecteur d'initialisation dans la propriété secretIv de l'entité User
        $user->setSecretIv(base64_encode($iv));
        // On crypte le nom de l'utilisateur
        if(!is_null($user->getNom())){
            // On crypte le nom de l'utilisateur
            $nom = openssl_encrypt($user->getNom(), $algo, $key, 0, $iv, $tag);
            // On encode en base64 le nom crypté pour qu'il puisse être stocké dans la base de données
            $nom = base64_encode($tag.$nom);
            // On stocke le nom crypté dans la propriété nom de l'entité User à la place du nom en clair
            $user->setNom($nom);
        }
        if(!is_null($user->getPrenom())){
            // On conforme le prénom de l'utilisateur jean-pierre devient Jean-Pierre
            $prenom = mb_convert_case($user->getPrenom(), MB_CASE_TITLE, "UTF-8");
            // On crypte le nom de l'utilisateur
            $prenom = openssl_encrypt($prenom, $algo, $key, 0, $iv, $tag);
            // On encode en base64 le prénom crypté pour qu'il puisse être stocké dans la base de données
            $prenom = base64_encode($tag.$prenom);
            // On stocke le nom crypté dans la propriété prénom de l'entité User à la place du nom en clair
            $user->setPrenom($prenom);
        }
        // On gère l'email
        $user->setEmail(mb_strtolower($user->getEmail()));
    }
}
