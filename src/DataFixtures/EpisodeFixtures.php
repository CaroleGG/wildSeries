<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('Celui qui déménage');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Friends'));
        $episode->setSynopsis('Wahou');

        $manager->persist($episode);

        $episode2 = new Episode();
        $episode2->setTitle('Celui qui est perdu');
        $episode2->setNumber(2);
        $episode2->setSeason($this->getReference('season1_Friends'));
        $episode2->setSynopsis('génial');

        $manager->persist($episode2);

        $episode2 = new Episode();
        $episode2->setTitle('Celui qui a un rôle');
        $episode2->setNumber(3);
        $episode2->setSeason($this->getReference('season1_Friends'));
        $episode2->setSynopsis('on adore');

        $manager->persist($episode2);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
