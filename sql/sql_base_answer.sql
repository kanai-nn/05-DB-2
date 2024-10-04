-- 問1
SELECT uniform_num, name, club FROM players;
-- 問2
SELECT id, name, ranking, group_name FROM countries WHERE group_name = 'C';
-- 問3
SELECT id, name, ranking, group_name FROM countries WHERE group_name != 'C';
-- 問4
SELECT * FROM players WHERE TIMESTAMPDIFF(YEAR, birth, CURDATE()) >= 40;
-- 問5
SELECT * FROM players WHERE height < 170;
-- 問6
SELECT * FROM countries WHERE ranking BETWEEN 36 AND 56;
-- 問7
SELECT * FROM players WHERE position IN ('GK', 'DF', 'MF');
-- 問8
SELECT * FROM goals WHERE player_id IS NULL;
-- 問9
SELECT * FROM goals WHERE player_id IS NOT NULL;
-- 問10
SELECT * FROM players WHERE name LIKE '%ニョ';
-- 問11
SELECT * FROM players WHERE name LIKE '%ニョ%';
-- 問12
SELECT * FROM countries WHERE group_name NOT IN ('A');
-- 問13
SELECT * FROM players WHERE (weight / POW(height / 100, 2)) BETWEEN 20 AND 29;
-- 問14
SELECT * FROM players WHERE height < 165 OR weight < 60;
-- 問15
SELECT * FROM players WHERE (position = 'FW' OR position = 'MF') AND height < 170;
-- 問16
SELECT DISTINCT position FROM players;
-- 問17
SELECT name, club, (height + weight) AS "height + weight" FROM players;
-- 問18
SELECT CONCAT(name, '選手のポジションは\'', position, '\'です') AS "POSITION" FROM players;
-- 問19
SELECT name, club, (height + weight) AS "体力指数" FROM players;
-- 問20
SELECT * FROM countries ORDER BY ranking ASC;
-- 問21
SELECT * FROM players ORDER BY birth DESC;
-- 問22
SELECT * FROM players ORDER BY height DESC, weight DESC;
-- 問23
SELECT id, country_id, uniform_num, SUBSTRING(position, 1, 1), name
FROM players;
-- 問24
SELECT name, LENGTH(name)  FROM countries ORDER BY LENGTH(name) DESC;
-- 問25
SELECT name, DATE_FORMAT(birth, '%Y年%m月%d日') AS birthday FROM players;
-- 問26
SELECT IFNULL(player_id, 9999) AS player_id, goal_time FROM goals;
-- 問27
SELECT 
  CASE 
    WHEN player_id IS NULL THEN 9999 
    ELSE player_id 
  END AS player_id, 
  goal_time
FROM goals;
-- 問28
SELECT 
  AVG(height) AS 平均身長, 
  AVG(weight) AS 平均体重
FROM players;
-- 問29
SELECT COUNT(*) AS "日本のゴール数"
FROM goals
WHERE player_id BETWEEN 714 AND 736;
-- 問30
SELECT COUNT(player_id) AS "オウンゴール以外のゴール数"
FROM goals;
-- 問31
SELECT 
    MAX(height) AS "最大身長", 
    MAX(weight) AS "最大体重"
FROM players;
-- 問32
SELECT MIN(ranking) AS "AグループのFIFAランク最上位"
FROM countries
WHERE group_name = 'A';
-- 問33
SELECT SUM(ranking) AS "CグループのFIFAランクの合計値"
FROM countries
WHERE group_name = 'C';

-- 問34
SELECT countries.name AS name, players.name AS name, players.uniform_num AS uniform_num
FROM players
JOIN countries ON players.country_id = countries.id;
-- 問35
SELECT countries.name AS name, players.name AS name, goals.goal_time AS goal_time
FROM goals
JOIN players ON goals.player_id = players.id
JOIN countries ON players.country_id = countries.id
WHERE goals.player_id IS NOT NULL;
-- 問36
SELECT goal_time, uniform_num, position, name
FROM goals
LEFT JOIN players ON goals.player_id = players.id;
-- 問37
SELECT goal_time, uniform_num, position, name
FROM goals
RIGHT JOIN players ON goals.player_id = players.id;
-- 問38
SELECT
  countries.name AS country_name,
  goals.goal_time,
  players.position,
  COALESCE(players.name, 'オウンゴール') AS player_name
FROM
  goals
LEFT JOIN players ON goals.player_id = players.id
LEFT JOIN countries ON players.country_id = countries.id;
-- 問39
SELECT pairings.kickoff, 
       c1.name AS my_country, 
       c2.name AS enemy_country
FROM pairings 
JOIN countries c1 ON pairings.my_country_id = c1.id
JOIN countries c2 ON pairings.enemy_country_id = c2.id;
-- 問40
SELECT id, goal_time,
    (SELECT name FROM players WHERE players.id = goals.player_id) AS player_name
FROM goals;
-- 問41
SELECT id, goal_time,
    (SELECT name FROM players WHERE players.id = goals.player_id) AS player_name
FROM goals;
-- 問42
SELECT position, height AS 最大身長, name, club
FROM players p1
WHERE height = (
    SELECT MAX(height)
    FROM players p2
    WHERE p1.position = p2.position
);
-- 問43
SELECT position, 
  (SELECT MAX(height) FROM players p2 WHERE p1.position = p2.position) AS 最大身長, 
  (SELECT name FROM players p3 WHERE p3.height = (SELECT MAX(height) FROM players p4 WHERE p1.position = p4.position) AND p3.position = p1.position) AS 名前
FROM players p1
GROUP BY position;
-- 問44
SELECT uniform_num, position, name, height
FROM players
WHERE height < (SELECT AVG(height) FROM players);
-- 問45
SELECT group_name, MAX(ranking), MIN(ranking)
FROM countries
GROUP BY group_name
HAVING (MAX(ranking) - MIN(ranking)) > 50;
-- 問46
SELECT '1980' AS 誕生年, COUNT(id) 
FROM players
WHERE birth LIKE '1980%'
UNION
SELECT '1981' AS 誕生年, COUNT(id) 
FROM players
WHERE birth LIKE '1981%';
-- 問47
SELECT id, position, name, height, weight
FROM players
WHERE height > 195
UNION ALL
SELECT id, position, name, height, weight
FROM players
WHERE weight > 95;


