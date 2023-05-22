<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
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
    public function show(int $id , ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // ou $program = $programRepository->find($id);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        //dd($program);
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
        
    }

    #[Route('/show/{programId}/seasons/{seasonId}', name: 'season_show', requirements: ['programId' => '\d+', 'seasonId' => '\d+'], methods: ['GET'])]
    //public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
   // {
    public function showSeason(Program $programId, Season $seasonId,): Response
    {
       // si l 44 $program = $programRepository->findOneBy(['id' => $programId]);
        //si l 44 $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        
        return $this->render('program/season_show.html.twig', [
            'program' => $programId, //si l 44$program,
            'season' => $seasonId //si l44 $season,
        ]);
    }
}