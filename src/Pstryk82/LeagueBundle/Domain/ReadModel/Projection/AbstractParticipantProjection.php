<?php

namespace Pstryk82\LeagueBundle\Domain\ReadModel\Projection;

abstract class AbstractParticipantProjection
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Team
     */
    private $team;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var ArrayCollection
     */
    private $games;

    public function __construct($id)
    {
        $this->id = $id;
        $this->games = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team.
     *
     * @param Team $team
     *
     * @return $this
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team.
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     *
     * @return $this
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

//    /**
//     * @param Game $game
//     *
//     * @return $this
//     */
//    public function addGame(Game $game)
//    {
//        $this->games->add($game);
//
//        return $this;
//    }
//
//    /**
//     * @param Game $game
//     *
//     * @return $this
//     */
//    public function removeGame(Game $game)
//    {
//        $this->games->removeElement($game);
//
//        return $this;
//    }
}
