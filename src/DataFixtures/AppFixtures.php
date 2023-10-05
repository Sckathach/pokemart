<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\Generation;
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
    private const GENERATION_1 = 'gen1';
    private const GENERATION_2 = 'gen2';
    private const GENERATION_3 = 'gen3';
    private const GENERATION_4 = 'gen4';

    private static function cardDataGenerator(): \Generator
    {
        yield [1, 'Pikachu', 'electric', 90, self::CARD_1];
        yield [2, 'Pichu', 'electric', 50, self::CARD_2];
        yield [3, 'Bulbasaur', 'grass', 70, self::CARD_3];
    }
    private static function plushDataGenerator(): \Generator
    {
        yield [1, 'Jirachi', 10.99, 6.5, self::GENERATION_3, 5, self::PLUSH_1];
        yield [2, 'Évoli', 16.99, 6.5, self::GENERATION_2, 5, self::PLUSH_2];
        yield [3, 'Dracofeu', 16.99, 6.5, self::GENERATION_2, 5, self::PLUSH_3];
        yield [4, 'Noctali', 19.99, 13, self::GENERATION_2, 5, self::PLUSH_4];
    }

    private static function generationDataGenerator(): \Generator
    {
        yield [1, 'Generation1', self::GENERATION_1, 'Le début de l\'aventure'];
        yield [2, 'Generation2', self::GENERATION_2, 'La *presque* meilleure'];
        yield [3, 'Generation3', self::GENERATION_3, 'Oui'];
        yield [4, 'Generation4', self::GENERATION_4, 'OUIOUIOUIOUIOUI'];
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

        foreach (self::plushDataGenerator() as [$id, $name, $price, $height, $generation, $note, $plushReference])
        {
            $collection = $this->getReference($generation);
            $plush = new Plush();
            $plush->setId($id);
            $plush->setName($name);
            $plush->setPrice($price);
            $plush->setHeight($height);
            $plush->setGeneration($generation);
            $plush->setCollection($collection);
            $plush->setNote($note);
            $manager->persist($plush);
        }

        $manager->flush();
    }
}
