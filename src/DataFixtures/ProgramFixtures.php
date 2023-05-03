<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
   
        public const PROGRAMS = [
            [   'title' => 'Friends',
                'synopsis' => 'un appart New Yorkais' , 
                'category' =>'Comedie',
            ],

            [   'title' => 'The Big Bang Theorie',
                'synopsis' => 'un appart à Pasadena' , 
                'category' =>'Comedie',
            ],
            [   'title' => 'Sense 8', 
                'synopsis' => 'évènements paranormaux' , 
                'category' =>'Action',
            ],
            [   'title' => 'The Night Agent', 
                'synopsis' => 'FBi et conspiration' ,   
                'category' =>'Action',
            ],
            [   'title' => 'Lucifer',
                'synopsis' => 'Lucifer est lassé d\'être le Seigneur des Ténèbres' ,     
                'category' =>'Fantastique',
                ] ,
        ];
        public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $currentProgram) {
            $program = new Program();
            $program->setTitle($currentProgram['title']);
            $program->setSynopsis($currentProgram['synopsis']);
            $program->setCategory($this->getReference('category_' . $currentProgram['category']));
            $manager->persist($program);
            $this->addReference('program_' . $currentProgram['title'], $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
