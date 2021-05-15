CREATE DATABASE b97452_Tarea1_if4101;

USE b97452_Tarea1_if4101;

CREATE TABLE tb_actor
(
	actor_id INT auto_increment PRIMARY KEY 
    ,name VARCHAR(50) not null
    ,last_name varchar(50) not null
);

create table tb_genre
(
	 genre_id int auto_increment primary key
    ,genre_name varchar(50) not null
);

create table tb_movie
(
	 code int primary key
    ,name varchar(50) not null
    ,duration varchar(50) not null
    ,language varchar(50) not null
    ,synopsis varchar(100) 
);


CREATE TABLE tb_movie_actor
(
	 movie_code INT NOT NULL
	,actor_id INT NOT NULL
	,CONSTRAINT pk_movie_actor PRIMARY KEY (movie_code, actor_id)
	,CONSTRAINT fk_movie_actor_movie FOREIGN KEY (movie_code) REFERENCES tb_movie(code)
	,CONSTRAINT fk_movie_actor_actor FOREIGN KEY (actor_id) REFERENCES tb_actor(actor_id)
);

CREATE TABLE tb_movie_genre
(
	 movie_code INT NOT NULL
	,genre_id INT NOT NULL
	,CONSTRAINT pk_movie_genre PRIMARY KEY (movie_code, genre_id)
	,CONSTRAINT fk_movie_genre_movie FOREIGN KEY (movie_code) REFERENCES tb_movie(code)
	,CONSTRAINT fk_movie_genre_genre FOREIGN KEY (genre_id) REFERENCES tb_genre(genre_id)
);

DELIMITER $$
create procedure sp_delete_movie_by_name(in p_movie_name varchar(50))
begin
SELECT @local_movie_code := code FROM tb_movie WHERE name = p_movie_name;

DELETE FROM tb_movie_genre
WHERE movie_code = @local_movie_code;

DELETE FROM tb_movie_actor
WHERE movie_code = @local_movie_code;

DELETE FROM tb_movie
WHERE code = @local_movie_code;
end;

DELIMITER $$
create procedure sp_get_actors()
begin
select
	 actor_id 
    ,name
    ,last_name
from tb_actor;
end;


DELIMITER $$
create procedure sp_get_genres()
begin 
select
	genre_name
from tb_genre;
end;


DELIMITER $$
create procedure sp_get_movie_by_genre(in p_movie_genre varchar(50))
begin 
SELECT
 MV.code
,MV.name
,MV.duration
,MV.language
,MV.synopsis
FROM tb_movie MV
	JOIN tb_movie_genre MVG
    	ON MV.code = MVG.movie_code
		JOIN tb_genre gen
        	on gen.genre_id = mvg.genre_id
WHERE genre_name = p_movie_genre;
end;

DELIMITER $$
create procedure sp_get_movie_by_name(in p_movie_name varchar(50))
begin 
SELECT 
	 code
	,name
	,duration
	,language
	,synopsis
FROM tb_movie
WHERE name LIKE CONCAT('%', p_movie_name , '%');
end;


DELIMITER $$
create procedure sp_insert_actors(in p_actor_name varchar(50), in p_last_name varchar(50))
begin 
INSERT INTO tb_actor
(
	 name
    ,last_name
)
VALUES
(
 p_actor_name
,p_last_name
);
end


DELIMITER $$
create procedure sp_insert_actor_to_movie(in p_movie_code int, in p_actor_full_name varchar(50))
begin 
SELECT @local_id_actor := actor_id FROM tb_actor WHERE  CONCAT(name,' ', last_name) = p_actor_full_name;

INSERT INTO tb_movie_actor
(
	movie_code,
    actor_id
)
VALUES
(
	p_movie_code
    ,@local_id_actor
);
end;

DELIMITER $$
create procedure sp_insert_genre_to_movie(in p_movie_code int, in p_genre_name varchar(50))
begin 
SELECT @local_id_genre := genre_id FROM tb_genre WHERE  genre_name = p_genre_name;

INSERT INTO tb_movie_genre
(
	movie_code,
    genre_id
)
VALUES
(
	p_movie_code
    ,@local_id_genre
);
end;

DELIMITER $$
create procedure sp_insert_movie(in p_code int, in p_name varchar(50), 
in p_duration varchar(50), in p_language varchar(50), in p_synopsis varchar(100))
begin 
INSERT INTO `tb_movie`
(
 `code`
, `name`
, `duration`
, `language`
, `synopsis`
) 
VALUES
(
 p_code
,p_name
,p_duration
,p_language
,p_synopsis
);
end


DELIMITER $$
create procedure sp_insert_genre( in p_genre_name varchar(50))
begin 
INSERT INTO tb_genre
(
 genre_name   
)
VALUES
(
p_genre_name    
);
end;

DELIMITER $$
create procedure sp_get_genres_by_movieName( in p_movieName varchar(50))
begin 
select 
g.genre_name
from tb_movie MV
	JOIN tb_movie_genre mvg
		ON MV.CODE = mvg.movie_code
        JOIN tb_genre g
			ON g.genre_id = mvg.genre_id
where mv.name = p_movieName;
end;

DELIMITER $$
create procedure sp_get_actors_by_movieName( in p_movieName varchar(50))
begin 
select 
a.name
,a.last_name
from tb_movie MV
	JOIN tb_movie_actor MVA
		ON MV.CODE = MVA.movie_code
        JOIN tb_actor A
			ON A.ACTOR_ID = MVA.ACTOR_ID
where mv.name = p_movieName;
end;

DELIMITER $$
CREATE procedure sp_get_actors_by_MovieGenre( in p_genre_name varchar(50))
begin 
select distinct
 a.name
,a.last_name
from tb_movie MV
	JOIN tb_movie_actor MVA
		ON MV.CODE = MVA.movie_code
        JOIN tb_actor A
			ON A.ACTOR_ID = MVA.ACTOR_ID
            JOIN tb_movie_genre mvg
				ON MV.CODE = mvg.movie_code
				JOIN tb_genre g
					ON g.genre_id = mvg.genre_id
where g.genre_name = p_genre_name;
end;

DELIMITER $$
create procedure sp_get_genres_by_MovieGenre( in p_genre_name varchar(50))
begin 
select distinct
g.genre_name
from tb_movie MV
	JOIN tb_movie_genre mvg
		ON MV.CODE = mvg.movie_code
        JOIN tb_genre g
			ON g.genre_id = mvg.genre_id
where g.genre_name = p_genre_name;
end;

DELIMITER $$
create procedure sp_get_movieName_by_genre_and_actor( in p_genre_name varchar(50), in p_actor_fullName varchar(50))
begin 
SELECT
	 MV.name
    ,CONCAT(A.NAME, A.LAST_NAME) AS FULL_NAME
    ,gen.genre_name
FROM tb_movie MV
	JOIN tb_movie_genre MVG
    	ON MV.code = MVG.movie_code
		JOIN TB_GENRE GEN
        	ON GEN.GENRE_ID = MVG.GENRE_ID
            JOIN TB_MOVIE_ACTOR MVA
				ON MV.CODE = MVA.MOVIE_CODE
                JOIN TB_ACTOR A
					ON MVA.ACTOR_ID = A.ACTOR_ID
WHERE GEN.genre_name = p_genre_name AND CONCAT(A.name,' ', A.last_name) = p_actor_fullName;
end;

DELIMITER $$
create procedure sp_get_movieData_by_movieName( in p_movieName varchar(50))
begin 
SELECT 
	 code
	,name
	,duration
	,language
	,synopsis
FROM tb_movie
WHERE name = p_movieName;
end;

DELIMITER $$
create procedure sp_modify_movieName(in p_movieCode int, in p_newMovieName varchar(50))
begin 
UPDATE tb_movie
SET name = p_newMovieName
WHERE code = p_movieCode;
end;

DELIMITER $$
create procedure sp_modify_movieDuration(in p_movieCode int, in p_newMovieDuration varchar(50))
begin 
UPDATE tb_movie
SET duration = p_newMovieDuration
WHERE code = p_movieCode;
end;

DELIMITER $$
create procedure sp_modify_movieLanguage(in p_movieCode int, in p_newLanguage varchar(50))
begin 
UPDATE tb_movie
SET language = p_newLanguage
WHERE code = p_movieCode;
end;

DELIMITER $$
create procedure sp_modify_movieSynopsis(in p_movieCode int, in p_newSynopsis varchar(50))
begin 
UPDATE tb_movie
SET synopsis = p_newSynopsis
WHERE code = p_movieCode;
end;







