use math_exam_dblab;
select * from `user`;

insert into question (content) values ('The well known Pythagorean theorem \\(x^2 + y^2 = z^2\\) was proved to be invalid for other exponents. Meaning the next equation has no integer solutions:\n\\[ x^n + y^n = z^n \\]');
insert into question (content) values ('\\(< > \\subset \\supset \\subseteq \\supseteq\\) $c = 1$');
update question
set content = '\\(< > \\subset \\supset \\subseteq \\supseteq\\) $c = 1$'
where id=3;

select * from `question`;
select * from `choice`;

delete from question where id=2;

select * from `role`;

update user
set role_ids='2'
where username='ddt';

update user
set role_ids='3', school_id=2, grade_id=11
where username='trang';

update user
set role_ids='1'
where username='admin';

update user
set role_ids='2'
where username='hung';

update user
set role_ids='1|2|3'
where username='root';

select * from grade;

insert into grade values (10, 'Lớp 10'), (11, 'Lớp 11'), (12, 'Lớp 12');

select * from school;

insert into `school`
values
(1, 'THCS Lê Thanh Nghị', '', 'Gia Tân, Gia Lộc, Hải Dương'),
(2, 'THPT Gia Lộc', '', 'TT Gia Lộc, Gia Lộc, Hải Dương'),
(3, 'THPT Chuyên Nguyễn Trãi', '', 'Đường Ngô Quyền, TP Hải Dương, Hải Dương'),
(4, 'THPT Hồng Quang', '', 'Chương Dương, Trần Phú, TP Hải Dương, Hải Dương'),
(5, 'THPT chuyên Khoa học Tự nhiên', '', '182 đường Lương Thế Vinh, quận Thanh Xuân, Hà Nội'),
(6, 'THPT Thăng Long', '', 'Số 44, Tạ Quang Bửu, Hai Bà Trưng, Hà Nội'),
(7, 'THPT Chuyên Nguyễn Chí Thanh', '', '08 Lê Duẩn, Phường Nghĩa Tân, Gia Nghĩa, Đăk Nông');

select * from choice;

select * from question;

insert into `question`
(`id`, `content`, `solution`)
values
(10, '\\(\\sqrt(4) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{10}{5}\\)'),
(11, '\\(\\sqrt(9) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{18}{2}\\)'),
(12, '\\(\\sqrt(16) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{100}{25}\\)'),
(13, '\\(\\sqrt(25) = ?\\)', 'Because \\(\\sqrt(4) = \\frac{50}{10}\\)');
insert into `choice`
(`id`, `question_id`, `content`, `is_solution`)
values
(0, 10, '2', true),
(1, 10, '3', false),
(2, 10, '1.9', false),
(3, 10, '\\(\\sqrt(2)^2\\)', true),
(0, 11, '3', true),
(1, 11, '4', false),
(2, 11, '2.9', false),
(3, 11, '\\(\\sqrt(3)^2\\)', true),
(0, 12, '4', true),
(1, 12, '5', false),
(2, 12, '3.9', false),
(3, 12, '\\(\\sqrt(4)^2\\)', true),
(0, 13, '5', true),
(1, 13, '6', false),
(2, 13, '4.9', false),
(3, 13, '\\(\\sqrt(5)^2\\)', true);

