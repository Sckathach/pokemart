<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\Plush;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const CARD_1 = 'card-1';
    private const CARD_2 = 'card-2';
    private const CARD_3 = 'card-3';
    private const PLUSH_1 = 'plush-1';
    private const PLUSH_2 = 'plush-2';
    private const PLUSH_3 = 'plush-3';
    private const PLUSH_4 = 'plush-4';

    private static function cardDataGenerator(): \Generator
    {
        yield [0, 'Pikachu', 'electric', 90, self::CARD_1];
        yield [1, 'Pichu', 'electric', 50, self::CARD_2];
        yield [2, 'Bulbasaur', 'grass', 70, self::CARD_3];
    }
    private static function plushDataGenerator(): \Generator
    {
        yield [0, 'Jirachi', 10.99, 6.5, "gen3", 5, self::PLUSH_1];
        yield [1, 'Évoli', 16.99, 6.5, "gen2", 5, self::PLUSH_2];
        yield [2, 'Dracofeu', 16.99, 6.5, "gen2", 5, self::PLUSH_3];
        yield [3, 'Noctali', 19.99, 13, "gen2", 5, self::PLUSH_4];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::cardDataGenerator() as [$id, $name, $type, $hp, $cardReference]) {
            $card = new Card();
            $card->setId($id);
            $card->setName($name);
            $card->setType($type);
            $card->setHp($hp);
            $manager->persist($card);

            $this->addReference($cardReference, $card);
        }

        foreach (self::plushDataGenerator() as [$id, $name, $price, $height, $generation, $note, $plushReference]) {
            $plush = new Plush();
            $plush->setId($id);
            $plush->setName($name);
            $plush->setPrice($price);
            $plush->setHeight($height);
            $plush->setGeneration($generation);
            $plush->setNote($note);
            $manager->persist($plush);

            $this->addReference($plushReference, $plush);
        }

        $manager->flush();
    }
}
