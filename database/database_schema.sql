drop database if exists `math_exam_dblab`;
create database `math_exam_dblab`;
use `math_exam_dblab`;

drop table if exists `school`;
create table `school` (
	`id` int not null auto_increment,
    `name` varchar(50) not null,
    `description` text,
    `address` varchar(200),
    constraint `pk_school_id` primary key (`id`)
);

-- !! grade id is char(4)
drop table if exists `grade`;
create table `grade` (
	`id` char(4) not null,
    `description` text,
    constraint `pk_grade_id` primary key (`id`)
);

drop table if exists `role`;
create table `role` (
	`id` int not null,
    `name` varchar(50),
    `description` text,
    constraint `pk_role_id` primary key (`id`)
);

drop table if exists `user`;
create table `user` (
	`id` int not null auto_increment,
	`username` varchar(100) not null unique,
    `email` varchar(150),
    `password` varchar(100),
    `remember_token` varchar(100),
    `first_name` varchar(100),
    `last_name` varchar(100),
    `avatar` varchar(600),
    `birthdate` date,
    `mobile_phone` varchar(20),
    `telephone` varchar(20),
    `school_id` int,
    `grade_id` char(4),
    `address` varchar(200),
	`parent_name` varchar(100),
    `parent_phone` varchar(20),
    `description` text,
    `email_verified_at` datetime,
    `role_ids` varchar(20),
    `updated_at` datetime,
    `created_at` datetime,
    `deleted_at` datetime,
    `deleted_by` int,
    constraint `pk_user_id` primary key (`id`)
);

-- drop table if exists `user_role`;
-- create table `user_role` (
-- 	`user_id` int not null,
--     `role_id` int not null,
--     `created_at` datetime,
--     `updated_at` datetime,
--     `created_by` int,
--     `updated_by` int,
-- 	constraint `pk_user_role_user_id_role_id` primary key (`user_id`, `role_id`)
-- );

drop table if exists `question`;
create table `question` (
	`id` int not null auto_increment,
    `content` varchar(6000),
    `grade_id` char(4),
    `solution` text,
    `deleted_at` datetime,
    `deleted_by` int,
    constraint `pk_question_id` primary key (`id`)
);

drop table if exists `choice`;
create table `choice` (
	`id` int not null,
    `question_id` int not null,
    `content` varchar(1000),
    `is_solution` tinyint(1),
	constraint `pk_choice_question_id_id` primary key (`question_id`, `id`)
);

drop table if exists `test`;
create table `test` (
	`id` int not null auto_increment,
    `code` int not null default 0,
    `name` varchar(200) not null,
    `grade_id` char(4),
    `duration` smallint,
    `description` text,
    `no_of_questions` smallint,
    `created_at` datetime,
    `created_by` int,
    `deleted_at` datetime,
    `deleted_by` int,
	constraint `pk_test_id_code` primary key (`id`, `code`)
);

drop table if exists `test_content`;
create table `test_content` (
	`test_id` int not null,
    `test_code` int not null default 0,
    `question_id` int not null,
    `question_order` int,
    constraint `pk_test_content_test_id_question_id`
    primary key (`test_id`, `test_code`, `question_id`)
);

drop table if exists `work_history`;
create table `work_history` (
	`id` int not null auto_increment,
	`user_id` int not null,
    `test_id` int not null,
    `test_code` int not null default 0,
    `no_of_correct` smallint,
    `started_at` datetime,
    `ended_at` datetime,
    `submitted_at` datetime,
    constraint `pk_work_history_id` primary key (`id`)
);

drop table if exists `work_history_detail`;
create table `work_history_detail` (
	`work_history_id` int not null,
    `question_id` int not null,
    `choice_ids` varchar(50),
    `updated_at` datetime,
    constraint `pk_work_history_detail`
    primary key (`work_history_id`, `question_id`)
);


alter table `user`
add constraint `fk_user_school`
foreign key (`school_id`) references `school` (`id`)
on update cascade
on delete restrict;

alter table `user`
add constraint `fk_user_grade`
foreign key (`grade_id`) references `grade` (`id`)
on update cascade
on delete restrict;

alter table `user`
add constraint `fk_user_user_deleted`
foreign key (`deleted_by`) references `user` (`id`)
on update cascade
on delete restrict;

-- alter table `user_role`
-- add constraint `fk_user_role_user`
-- foreign key (`user_id`) references `user` (`id`)
-- on update cascade
-- on delete restrict;

-- alter table `user_role`
-- add constraint `fk_user_role_role`
-- foreign key (`role_id`) references `role` (`id`)
-- on update cascade
-- on delete restrict;

-- alter table `user_role`
-- add constraint `fk_user_role_user_created`
-- foreign key (`created_by`) references `user` (`id`)
-- on update cascade
-- on delete restrict;

-- alter table `user_role`
-- add constraint `fk_user_role_user_updated`
-- foreign key (`updated_by`) references `user` (`id`)
-- on update cascade
-- on delete restrict;

alter table `question`
add constraint `fk_question_grade`
foreign key (`grade_id`) references `grade` (`id`)
on update cascade
on delete restrict;

alter table `question`
add constraint `fk_question_user_deleted`
foreign key (`deleted_by`) references `user` (`id`)
on update cascade
on delete restrict;

alter table `choice`
add constraint `fk_choice_question`
foreign key (`question_id`) references `question` (`id`)
on update cascade
on delete restrict;

alter table `test`
add constraint `fk_test_grade`
foreign key (`grade_id`) references `grade` (`id`)
on update cascade
on delete restrict;

alter table `test`
add constraint `fk_test_user_created`
foreign key (`created_by`) references `user` (`id`)
on update cascade
on delete restrict;

alter table `test`
add constraint `fk_test_user_deleted`
foreign key (`deleted_by`) references `user` (`id`)
on update cascade
on delete restrict;

alter table `test_content`
add constraint `fk_test_content_test`
foreign key (`test_id`, `test_code`) references `test` (`id`, `code`)
on update cascade
on delete restrict;

alter table `test_content`
add constraint `fk_test_content_question`
foreign key (`question_id`) references `question` (`id`)
on update cascade
on delete restrict;

alter table `work_history`
add constraint `fk_work_history_user`
foreign key (`user_id`) references `user` (`id`)
on update cascade
on delete restrict;

alter table `work_history`
add constraint `fk_work_history_test_content`
foreign key (`test_id`, `test_code`) references `test` (`id`, `code`)
on update cascade
on delete restrict;

alter table `work_history_detail`
add constraint `fk_work_history_detail_work_history`
foreign key (`work_history_id`) references `work_history` (`id`)
on update cascade
on delete restrict;

alter table `work_history_detail`
add constraint `fk_work_history_detail_question`
foreign key (`question_id`) references `question` (`id`)
on update cascade
on delete restrict;

-- delete from `role`;
-- insert into `role`
-- values (1, 'admin', null),
-- 		(2, 'teacher', null),
--         (3, 'student', null);

-- delete from `grade`;
-- insert into `grade` values (10, 'Lớp 10'), (11, 'Lớp 11'), (12, 'Lớp 12');

-- delete from `school`;
-- insert into `school`
-- values
-- (1, 'THCS Lê Thanh Nghị', '', 'Gia Tân, Gia Lộc, Hải Dương'),
-- (2, 'THPT Gia Lộc', '', 'TT Gia Lộc, Gia Lộc, Hải Dương'),
-- (3, 'THPT Chuyên Nguyễn Trãi', '', 'Đường Ngô Quyền, TP Hải Dương, Hải Dương'),
-- (4, 'THPT Hồng Quang', '', 'Chương Dương, Trần Phú, TP Hải Dương, Hải Dương'),
-- (5, 'THPT chuyên Khoa học Tự nhiên', '', '182 đường Lương Thế Vinh, quận Thanh Xuân, Hà Nội'),
-- (6, 'THPT Thăng Long', '', 'Số 44, Tạ Quang Bửu, Hai Bà Trưng, Hà Nội');

-- insert into `question`
-- (`id`, `content`, `solution`)
-- values
-- (10, '\\(\\sqrt(4) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{10}{5}\\)'),
-- (11, '\\(\\sqrt(9) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{18}{2}\\)'),
-- (12, '\\(\\sqrt(16) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{100}{25}\\)'),
-- (13, '\\(\\sqrt(25) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{50}{10}\\)');
-- insert into `choice`
-- (`id`, `question_id`, `content`, `is_solution`)
-- values
-- (0, 10, '2', true),
-- (1, 10, '3', false),
-- (2, 10, '1.9', false),
-- (3, 10, '\\(\\sqrt(2)^2\\)', true),
-- (0, 11, '3', true),
-- (1, 11, '4', false),
-- (2, 11, '2.9', false),
-- (3, 11, '\\(\\sqrt(3)^2\\)', true),
-- (0, 12, '4', true),
-- (1, 12, '5', false),
-- (2, 12, '3.9', false),
-- (3, 12, '\\(\\sqrt(4)^2\\)', true),
-- (0, 13, '5', true),
-- (1, 13, '6', false),
-- (2, 13, '4.9', false),
-- (3, 13, '\\(\\sqrt(5)^2\\)', true);
