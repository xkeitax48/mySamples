INSERT INTO `i_category`
(`category_id`, `category_name`)
VALUES
(1, '望むべき結果'),
(2, '次に起こすべき行動');


INSERT INTO `i_sub_category`
(`sub_category_id`, `category_id`, `sub_category_name`)
VALUES
(1, 1, '目標'),
(2, 1, 'ゴール'),
(3, 1, 'プロジェクト'),
(4, 1, 'ビジョン'),
(5, 1, 'フォーカス'),
(6, 1, '他人'),
(7, 2, 'iPhone'),
(8, 2, 'PC'),
(9, 2, '職場'),
(10, 2, '家');


INSERT INTO i_task
(title, created, category_id, sub_category)
VALUES
("1てすと１です", NOW(), 1,1),
("1てすと２です", NOW(), 1,1),
("1てすと３です", NOW(), 1,1),
("2てすと４です", NOW(), 1,2),
("3てすと５です", NOW(), 1,3),
("4てすと６です", NOW(), 1,4),
("5てすと７です", NOW(), 1,5),
("6てすと８です", NOW(), 1,6),
("7てすと９です", NOW(), 2,7),
("8てすと１０です", NOW(), 2,8),
("9てすと１１です", NOW(), 2,9),
("10てすと１２です", NOW(), 2,10),
("9てすと１３です", NOW(), 2,9),
("9てすと１４です", NOW(), 2,9)
;





INSERT INTO i_task
(title, created)
VALUES
("1てすと１です", NOW())
;



UPDATE i_task
SET
sub_category = 7
WHERE task_id = 1
;



INSERT INTO a_diary
(name, d_date, diary)
VALUES
("大関", "2015/1/2", "1/2のおおせきの日記"),
("大関", "2015/1/3", "1/3のおおせきの日記"),
("大関", "2015/1/4", "1/4のおおせきの日記"),
("度会", "2015/1/1", "1/1のわたらいの日記"),
("度会", "2015/1/2", "1/2のわたらいの日記");




SELECT
	d_date,
	diary
FROM a_diary
WHERE	name LIKE "大関"
ORDER BY
	d_date	ASC
;


SELECT
	name,
	diary
FROM a_diary
WHERE	d_date = 20150102
ORDER BY
	name
;




INSERT INTO a_person
(name, kana, email, password)
VALUES
("大関", "おおせき", "test@a.com", "hoge"),
("渡会", "わたらい", "test@b.com", "hogehoge");




INSERT INTO a_diary
(person_id, create_day, diary)
VALUES
("1", "20150203", "Hello, world!1"),
("1", "20150201", "Hello, world!2"),
("2", "20150205", "Hello, world!3"),
("1", "20150205", "Hello, world!4"),
("2", "20150206", "testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest");







SELECT *
FROM
	a_diary

