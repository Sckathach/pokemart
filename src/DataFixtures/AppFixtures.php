<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\Generation;
use App\Entity\Member;
use App\Entity\Comment;
use App\Entity\Plush;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private static function cardDataGenerator(): \Generator
    {
        yield [1, 'Pikachu', 'electric', 90, 'card-1'];
        yield [2, 'Pichu', 'electric', 50, 'card-2'];
        yield [3, 'Bulbasaur', 'grass', 70, 'card-3'];
    }

    private static function memberDataGenerator(): \Generator
    {
        yield ['Cynthia', 'cynthia@pokemon.org'];
        yield ['Red', 'red@pokemon.org'];
        yield ['Professor Oak', 'professor@pokemon.org'];
    }

    private static function commentDataGenerator(): \Generator
    {
        yield ['I know that the bond between us and our Pokémon is strong!', 'cynthia@pokemon.org'];
        yield ['Izi pizi lemon skweezi.', 'red@pokemon.org'];
        yield ['I\'m impressed! ...', 'professor@pokemon.org'];
    }
    private static function plushDataGenerator(): \Generator
    {
        yield [1, 'Jirachi', 10.99, 6.5, 'Generation4', 'cynthia@pokemon.org'];
        yield [2, 'Évoli', 16.99, 6.5, 'Generation4', 'professor@pokemon.org'];
        yield [3, 'Dracofeu', 16.99, 6.5, 'Generation4', 'cynthia@pokemon.org'];
        yield [4, 'Noctali', 19.99, 13, 'Generation2', 'professor@pokemon.org'];
        yield [5, 'Minidraco', 16.99, 6.5, 'Generation2', 'cynthia@pokemon.org'];
    }

    private static function generationDataGenerator(): \Generator
    {
        yield [1, 'Generation1', 'Generation1', 'Le début de l\'aventure'];
        yield [2, 'Generation2', 'Generation2', 'La *presque* meilleure'];
        yield [3, 'Generation3', 'Generation3', 'Oui'];
        yield [4, 'Generation4', 'Generation4', 'OUIOUIOUIOUIOUI'];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::cardDataGenerator() as [$id, $name, $type, $hp, $cardReference])
        {
            $card = new Card();
            $card->setId($id);
            $card->setName($name);
            $card->setType($type);
            $card->setHp($hp);
            $manager->persist($card);

            $this->addReference($cardReference, $card);
        }

        foreach (self::generationDataGenerator() as [$id, $name, $tag, $description])
        {
            $generation = new Generation();
            $generation->setId($id);
            $generation->setName($name);
            $generation->setTag($tag);
            $generation->setDescription($description);
            $this->addReference($tag, $generation);
            $manager->persist($generation);
        }

        foreach (self::plushDataGenerator() as [$id, $name, $price, $height, $generation, $createdBy])
        {
            $collection = $this->getReference($generation);
            $plush = new Plush();
            $plush->setId($id);
            $plush->setName($name);
            $plush->setPrice($price);
            $plush->setHeight($height);
            $plush->setGeneration($generation);
            $plush->setCollection($collection);
            $plush->setCreatedBy($createdBy);
            $manager->persist($plush);
        }

        foreach (self::memberDataGenerator() as [$name, $comment])
        {
            $member = new Member();
            $member->setName($name);
            $this->addReference($comment, $member);
            $manager->persist($member);
        }

        foreach (self::commentDataGenerator() as [$content, $memberReference])
        {
            $member = $this->getReference($memberReference);
            $comment = new Comment();
            $comment->setContent($content);
            $comment->setMember($member);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
