<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
//use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//prefixe de route
#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
                'programs' => $programs,
            ]);
        
    }

    #[Route('/show/{id<^[0-9]+$>}',requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    //public function show(int $id , ProgramRepository $programRepository): Response
    public function show(Program $program): Response
    {
       // $program = $programRepository->findOneBy(['id' => $id]);
        // ou $program = $programRepository->find($id);
        //dd($program);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id:' . $program->getId() . ' found.'
            );
        }
        //dd($program);
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
        
    }

    #[Route('/show/{program}/seasons/{season}', name: 'season_show', requirements: ['program' => '\d+', 'season' => '\d+'], methods: ['GET'])]
    public function showSeason(Program $program, Season $season): Response
    {        
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('show/{program}/season/{season}/episode/{episode}', name: 'episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}