-- 問1
SELECT group_name AS 'グループ', MIN(ranking) AS 'ランキング最上位', MAX(ranking) AS 'ランキング最下位'
FROM countries
GROUP BY group_name;

-- 問2
SELECT AVG(height) AS '平均身長', AVG(weight) AS '平均体重'
FROM players
WHERE position = 'GK';


-- 問3
SELECT c.name AS 国名, AVG(p.height) AS 平均身長
FROM countries c
JOIN players p ON c.id = p.country_id
GROUP BY c.name
ORDER BY AVG(p.height) DESC;

-- 問4
SELECT 
  (SELECT name FROM countries WHERE id = p.country_id) AS 国名, 
  AVG(p.height) AS 平均身長
FROM players p
GROUP BY p.country_id
ORDER BY 平均身長 DESC;

-- 問5
SELECT 
  p.kickoff AS キックオフ日時, 
  (SELECT name FROM countries WHERE id = p.my_country_id) AS 国名1, 
  (SELECT name FROM countries WHERE id = p.enemy_country_id) AS 国名2
FROM pairings p
ORDER BY p.kickoff ASC;

-- 問6
SELECT 
  p.name AS 名前, 
  p.position AS ポジション, 
  p.club AS 所属クラブ,
  (SELECT COUNT(*) FROM goals g WHERE g.player_id = p.id) AS ゴール数
FROM players p
ORDER BY ゴール数 DESC;

-- 問7
SELECT 
  p.name AS 名前, 
  p.position AS ポジション, 
  p.club AS 所属クラブ, 
  COUNT(g.id) AS ゴール数
FROM players p
LEFT JOIN goals g ON p.id = g.player_id
GROUP BY p.name, p.position, p.club
ORDER BY ゴール数 DESC;

-- 問8
SELECT 
  p.position AS ポジション, 
  COUNT(g.id) AS ゴール数
FROM players p
LEFT JOIN goals g ON p.id = g.player_id
GROUP BY p.position
ORDER BY ゴール数 DESC;

-- 問9
SELECT 
  birth AS 誕生日, 
  FLOOR(DATEDIFF('2014-06-13', birth) / 365) AS 年齢, 
  name AS 名前, 
  position AS ポジション
FROM players
ORDER BY 年齢 DESC;

-- 問10
SELECT COUNT(*) AS 'COUNT(g.goal_time)'
FROM goals
WHERE player_id IS NULL;

-- 問11
SELECT c.group_name, COUNT(g.id)
FROM goals g
JOIN pairings p ON g.pairing_id = p.id
JOIN countries c ON p.my_country_id = c.id
WHERE p.kickoff BETWEEN '2014-06-13' AND '2014-06-27'
GROUP BY c.group_name;

-- 問12
SELECT g.goal_time
FROM goals g
JOIN players p ON g.player_id = p.id
JOIN countries c ON p.country_id = c.id
WHERE g.pairing_id = 103;

-- 問13
SELECT c.name, COUNT(g.goal_time) 
FROM goals g
JOIN players p ON g.player_id = p.id
JOIN countries c ON p.country_id = c.id
WHERE g.pairing_id IN (39, 103)
GROUP BY c.name;

-- 問14
SELECT 
  p.kickoff, 
  c1.name AS my_country, 
  c2.name AS enemy_country, 
  c1.ranking AS my_ranking, 
  c2.ranking AS enemy_ranking,
  COUNT(g.id) AS my_goals
FROM pairings p
LEFT JOIN countries c1 ON p.my_country_id = c1.id
LEFT JOIN countries c2 ON p.enemy_country_id = c2.id
LEFT JOIN goals g ON g.pairing_id = p.id AND g.player_id IN (
  SELECT id FROM players WHERE country_id = c1.id
)
WHERE c1.group_name = 'C'
GROUP BY p.id
ORDER BY p.kickoff, c1.ranking;

-- 問15
SELECT 
  p.kickoff, 
  c1.name AS my_country, 
  c2.name AS enemy_country, 
  c1.ranking AS my_ranking, 
  c2.ranking AS enemy_ranking,
  COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c1.id AND g.pairing_id = p.id
  ), 0) AS my_goals
FROM pairings p
LEFT JOIN countries c1 ON p.my_country_id = c1.id
LEFT JOIN countries c2 ON p.enemy_country_id = c2.id
WHERE c1.group_name = 'C'
ORDER BY p.kickoff, c1.ranking;

-- 問16
SELECT 
  p.kickoff, 
  c1.name AS my_country, 
  c2.name AS enemy_country, 
  c1.ranking AS my_ranking, 
  c2.ranking AS enemy_ranking,
  COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c1.id AND g.pairing_id = p.id
  ), 0) AS my_goals,
  COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c2.id AND g.pairing_id = p.id
  ), 0) AS enemy_goals
FROM pairings p
LEFT JOIN countries c1 ON p.my_country_id = c1.id
LEFT JOIN countries c2 ON p.enemy_country_id = c2.id
WHERE c1.group_name = 'C'
ORDER BY p.kickoff, c1.ranking;

-- 問17
SELECT 
  p.kickoff, 
  c1.name AS my_country, 
  c2.name AS enemy_country, 
  c1.ranking AS my_ranking, 
  c2.ranking AS enemy_ranking,
  COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c1.id AND g.pairing_id = p.id
  ), 0) AS my_goals,
  COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c2.id AND g.pairing_id = p.id
  ), 0) AS enemy_goals,
  (COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c1.id AND g.pairing_id = p.id
  ), 0) - COALESCE((
    SELECT COUNT(g.id)
    FROM goals g
    JOIN players pl ON g.player_id = pl.id
    WHERE pl.country_id = c2.id AND g.pairing_id = p.id
  ), 0)) AS goal_diff
FROM pairings p
LEFT JOIN countries c1 ON p.my_country_id = c1.id
LEFT JOIN countries c2 ON p.enemy_country_id = c2.id
WHERE c1.group_name = 'C'
ORDER BY p.kickoff, c1.ranking;

-- 問18
SELECT 
  p.kickoff AS kickoff,
  DATE_SUB(p.kickoff, INTERVAL 12 HOUR) AS kickoff_jp
FROM pairings p
WHERE p.my_country_id = 1 
AND p.enemy_country_id = 4;


-- 問19
SELECT 
  FLOOR(DATEDIFF('2014-06-13', birth) / 365) AS age,
  COUNT(*) AS player_count
FROM players
GROUP BY age
ORDER BY age;

-- 問20
SELECT 
  FLOOR(DATEDIFF('2014-06-13', birth) / 365) DIV 10 * 10 AS age_group,
  COUNT(*) AS player_count
FROM players
GROUP BY age_group
ORDER BY age_group;

-- 問21
SELECT 
  FLOOR(DATEDIFF('2014-06-13', birth) / 365) DIV 5 * 5 AS age_group,
  COUNT(*) AS player_count
FROM players
GROUP BY age_group
ORDER BY age_group;

-- 問22
SELECT 
  FLOOR(DATEDIFF('2014-06-13', birth) / 365) DIV 5 * 5 AS age_group,
  position,
  COUNT(*) AS player_count,
  AVG(height) AS avg_height,
  AVG(weight) AS avg_weight
FROM players
GROUP BY age_group, position
ORDER BY age_group, position;

-- 問23
SELECT 
  name, 
  height, 
  weight
FROM players
ORDER BY height DESC
LIMIT 5;

-- 問24
SELECT 
  name, 
  height, 
  weight
FROM players
ORDER BY height DESC
LIMIT 15 OFFSET 5;


