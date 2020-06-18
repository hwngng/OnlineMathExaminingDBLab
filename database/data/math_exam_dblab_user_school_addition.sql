INSERT INTO `grade` (`id`, `description`) VALUES
('10', 'Lớp 10'),
('11', 'Lớp 11'),
('12', 'Lớp 12');

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'admin', NULL),
(2, 'teacher', NULL),
(3, 'student', NULL);

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `description`, `address`) VALUES
(1, 'THCS Lê Thanh Nghị', '', 'Gia Tân, Gia Lộc, Hải Dương'),
(2, 'THPT Gia Lộc', '', 'TT Gia Lộc, Gia Lộc, Hải Dương'),
(3, 'THPT Chuyên Nguyễn Trãi', '', 'Đường Ngô Quyền, TP Hải Dương, Hải Dương'),
(4, 'THPT Hồng Quang', '', 'Chương Dương, Trần Phú, TP Hải Dương, Hải Dương'),
(5, 'THPT chuyên Khoa học Tự nhiên', '', '182 đường Lương Thế Vinh, quận Thanh Xuân, Hà Nội'),
(6, 'THPT Thăng Long', '', 'Số 44, Tạ Quang Bửu, Hai Bà Trưng, Hà Nội'),
(7, 'THPT Chuyên Nguyễn Chí Thanh', '', '08 Lê Duẩn, Phường Nghĩa Tân, Gia Nghĩa, Đăk Nông');
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `remember_token`, `first_name`, `last_name`, `avatar`, `birthdate`, `mobile_phone`, `telephone`, `school_id`, `grade_id`, `address`, `parent_name`, `parent_phone`, `description`, `email_verified_at`, `role_ids`, `updated_at`, `created_at`, `deleted_at`, `deleted_by`) VALUES
(1, 'neit_cud', 'ductien.d1204@gmail.com', '$2y$10$5s9DUTExqFxkf6R7RLLSMeX/1o.WFQ2dSZrSiH8h7kFFr6LnuS65O', NULL, 'Đức Tiến', 'Đỗ', NULL, NULL, NULL, NULL, 5, NULL, '11A3/11, ngách 67, ngõ Gốc Đề, Minh Khai , Hà Nội', NULL, NULL, NULL, NULL, '2', '2020-06-18 13:16:10', '2020-06-14 19:50:57', NULL, NULL),
(2, 'admin', 'poodle.is.smoking@gmail.com', '$2y$10$NbKL1zUbrfsBaC0Rk0jOCeielsh9z3dMhm2MLUrrXM3m0h5Xs0xdq', NULL, 'Đậu', 'Chu', NULL, '2020-06-18', NULL, '0352583972', 5, NULL, '11A3/11, ngách 67, ngõ Gốc Đề, Minh Khai , Hà Nội', NULL, NULL, NULL, NULL, '1', '2020-06-18 14:21:44', '2020-06-14 19:51:16', NULL, NULL),
(3, 'root', 'root@root.com', '$2y$10$fSipmEpKbT1bTLgOcTtEdurG1fOSvO/ecpVjNhUECsG/nsv5IOu8C', NULL, 'Lee Phuk', 'Hoo', NULL, NULL, NULL, NULL, 2, NULL, '11A3/11, ngách 67, ngõ Gốc Đề, Minh Khai , Hà Nội', NULL, NULL, NULL, NULL, '1|2|3', '2020-06-18 11:31:57', '2020-06-14 19:51:45', NULL, NULL),
(4, 'YouSunOfABeach', 'meobeo_anxoixeo@yahoo.com', '$2y$10$TX.dTheR1eQlpjS.MT2IPOB4RGH02tjXEgEBVbHBRaHTBZN2XgtYa', NULL, 'Phúc', 'Đờ', NULL, '1999-12-04', '', '0348890490', 3, '10', 'thôn 5, xã Nhân Cơ, huyện Đăk R\'Lấp, tỉnh Đắk Nông', NULL, NULL, NULL, NULL, '3', '2020-06-18 14:19:15', '2020-06-14 19:52:30', NULL, NULL),
(5, 'hooLeePhuk', 'ngoitrongtoilet_gaothettenem@yahoo.com', '$2y$10$TX.dTheR1eQlpjS.MT2IPOB4RGH02tjXEgEBVbHBRaHTBZN2XgtYa', NULL, 'Lee Sheet', 'Hoo', NULL, '1999-12-04', NULL, NULL, 7, '11', 'thôn 5, xã Nhân Cơ, huyện Đăk R\'Lấp, tỉnh Đắk Nông', NULL, NULL, NULL, NULL, '3', '2020-06-18 14:19:14', '2020-06-14 19:52:30', NULL, NULL),
(7, 'abcdefg', 'trai_nhaque_dideple_uong_cafeda@yahoo.com', '$2y$10$rC2CF3NaGyYC10R4dyrImucvHDfsYsEY219vH3wo.JK0Sel3kZ.Z2', NULL, 'Nghĩa ', 'Nguyễn', NULL, NULL, NULL, NULL, 3, '11', '11, ngách 67, ngõ Gốc Đề, Minh Khai , Hà Nội', NULL, NULL, NULL, NULL, '3', '2020-06-18 14:15:57', '2020-06-17 22:37:26', NULL, NULL);

