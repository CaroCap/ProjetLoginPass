<?php

namespace App\DataFixtures;

// Ajouter le using en écrivant Utilisateur puis Tabulation pour finir le mot et ajouter le use
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurFixtures extends Fixture
{

    private $passwordHasher;
    
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        // Créer 5 utilisateurs (sans hydrate) Roles ADMIN
        for ($i=1; $i <= 5; $i++) { 
            $user = new Utilisateur;
            $user->setNom("utilisateur".$i);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setEmail("utilisateur".$i."@interface3.be");
            $user->setPassword($this->passwordHasher->hashPassword($user, "pass".$i));
            // dans chaque boucle injecter
            $manager->persist($user);
        }

        // Créer 5 utilisateurs (sans hydrate)
        for ($i=6; $i <= 10; $i++) { 
            $user = new Utilisateur;
            $user->setNom("utilisateur".$i);
            $user->setRoles(['ROLE_CLIENT', 'ROLE_JOUEUR']);
            $user->setEmail("utilisateur".$i."@interface3.be");
            $user->setPassword($this->passwordHasher->hashPassword($user, "pass".$i));
            // dans chaque boucle injecter
            $manager->persist($user);
        }
        // Stocker les utilisateurs
        $manager->flush();
    }
}
