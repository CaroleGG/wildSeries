<?php
namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public const NB_MAX_EPISODES = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $program) {
            $seasonNumber = 1;

        while ($seasonNumber <= SeasonFixtures::NB_MAX_SEASONS) {
            for ($i = 1; $i <= self::NB_MAX_EPISODES; $i++){
            //for ($i = 1; $i <= 10 ; $i++){
             $episode = new Episode();

            $episode->setTitle($faker->sentence());
            $episode->setNumber($i);
            $episode->setSeason($this->getReference('season_' . $seasonNumber . '_' . $program['title']));
            $episode->setSynopsis($faker->paragraphs(4, true));

            $manager->persist($episode);

        // $episode2 = new Episode();
        // $episode2->setTitle('Celui qui est perdu');
        // $episode2->setNumber(2);
        // $episode2->setSeason($this->getReference('season1_Friends'));
        // $episode2->setSynopsis('génial');

        // $manager->persist($episode2);

        // $episode2 = new Episode();
        // $episode2->setTitle('Celui qui a un rôle');
        // $episode2->setNumber(3);
        // $episode2->setSeason($this->getReference('season1_Friends'));
        // $episode2->setSynopsis('on adore');

        // $manager->persist($episode2);
            }
           $seasonNumber ++ ; 
       }
    }
       $manager->flush();
      
    }
    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
