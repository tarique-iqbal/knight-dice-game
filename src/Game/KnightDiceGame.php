<?php

declare(strict_types=1);

namespace Game;

use Game\Entity\KnightCircle;
use Game\Repository\KnightRepositoryInterface;
use Game\Service\GamePlayServiceInterface;
use Game\Service\TemplateServiceInterface;

/**
 * Class KnightDiceGame
 * @package Game
 */
class KnightDiceGame
{
    private const NUMBER_OF_KNIGHTS_REQUIRED = 2;

    /**
     * @var KnightRepositoryInterface
     */
    private KnightRepositoryInterface $knightRepository;

    /**
     * @var GamePlayServiceInterface
     */
    private GamePlayServiceInterface $gamePlayService;

    /**
     * @var TemplateServiceInterface
     */
    private TemplateServiceInterface $templateService;

    /**
     * @param KnightRepositoryInterface $knightRepository
     * @param GamePlayServiceInterface $gamePlayService
     * @param TemplateServiceInterface $templateService
     */
    public function __construct(
        KnightRepositoryInterface $knightRepository,
        GamePlayServiceInterface $gamePlayService,
        TemplateServiceInterface $templateService
    ) {
        $this->knightRepository = $knightRepository;
        $this->gamePlayService = $gamePlayService;
        $this->templateService = $templateService;
    }

    /**
     * @param int $numberOfKnights
     * @return void
     */
    public function run(int $numberOfKnights): void
    {
        if ($numberOfKnights < self::NUMBER_OF_KNIGHTS_REQUIRED) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Minimum number Of Knights must be greater than or equal to %s.',
                    self::NUMBER_OF_KNIGHTS_REQUIRED
                )
            );
        }

        $knightCircle = new KnightCircle();

        for ($i = 1; $i <= $numberOfKnights; $i++) {
            $this->knightRepository->add($i, $knightCircle);
            $knightCircle->increaseNumberOfKnights();
        }

        $winner = $this->gamePlayService->play($knightCircle);

        $this->templateService->render(
            BASE_DIR . '/src/Game/Template/game_winner',
            ['knight' => $winner]
        );
    }
}
