<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_MAX_SEASONS = 5;

    public function load(ObjectManager $manager): void
    {
        
        $faker = Factory::create();

         foreach (ProgramFixtures::PROGRAMS as $program) {
            $seasonNumber = 1;

             while ($seasonNumber <= self::NB_MAX_SEASONS) { 
                //for($i = 1; $i < self::NB_MAX_SEASONS; $i++) {
                     $season = new Season();
                    //$season->setNumber($seasonNumber);
                     $season->setNumber($seasonNumber);
                     //$season->setProgram($this->getReference('program_' . $faker->numberBetween(1, 10)));
                     $season->setProgram($this->getReference('program_'. $program['title']));
                    $season->setYear($faker->year());
                     $season->setDescription($faker->paragraphs(3, true));

                     $manager->persist($season);
            //a changer!! 11mai
                     $this->addReference('season_' . $seasonNumber . '_' . $program['title'], $season);
                     $seasonNumber++;
                //}
                 
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
