<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Friends'));
        $season->setYear(1994);
        $season->setDescription('Amazing');

        

        $manager->persist($season);

        $this->addReference('season1_Friends', $season);

        $season2 = new Season();
        $season2->setNumber(2);
        $season2->setProgram($this->getReference('program_Friends'));
        $season2->setYear(1995);
        $season2->setDescription('trop génial');

        

        $manager->persist($season2);

        $this->addReference('season2_Friends', $season2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
