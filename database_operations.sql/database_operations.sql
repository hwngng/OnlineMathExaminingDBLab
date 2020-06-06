use math_exam_dblab;
select * from `user`;

insert into question (content) values ('The well known Pythagorean theorem \\(x^2 + y^2 = z^2\\) was proved to be invalid for other exponents. Meaning the next equation has no integer solutions:\n\\[ x^n + y^n = z^n \\]');
insert into question (content) values ('\\(< > \\subset \\supset \\subseteq \\supseteq\\)');
update question
set content = '\\(< > \\subset \\supset \\subseteq \\supseteq\\)'
where id=4;

select * from `question`;

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
(6, 'THPT Thăng Long', '', 'Số 44, Tạ Quang Bửu, Hai Bà Trưng, Hà Nội');

select * from choice;

select * from question;