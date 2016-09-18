create or replace view league_standings as 
    select t.name, p.* from participant as p
        join abstract_participant as ap on ap.id = p.id
        join team as t on ap.team_id = t.id
    order by
        p.points desc,
        p.goal_difference desc,
        p.goals_for desc;

create or replace view games_pretty as
select thome.name as home, taway.name as away, g.home_team_score as H, g.away_team_score as A, twinner.name from game as g
	join participant as phome on g.home_participant_id = phome.id
	join participant as paway on g.away_participant_id = paway.id
	join team as thome on phome.id = thome.id
	join team as taway on paway.id = taway.id
    left join team as twinner on g.winner_id = twinner.id
;

