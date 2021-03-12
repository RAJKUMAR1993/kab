ERROR - 2021-02-10 19:22:12 --> Query error: Unknown column 'profile_id' in 'where clause' - Invalid query: SELECT *
FROM `tbl_student_institute_view_time`
WHERE `profile_id` = '6'
AND `status` = 'online'
AND `ref_type` = 'speaker'
ERROR - 2021-02-10 19:22:12 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Dashboard.php 30
ERROR - 2021-02-10 19:22:15 --> Query error: Unknown column 'profile_id' in 'where clause' - Invalid query: SELECT *
FROM `tbl_student_institute_view_time`
WHERE `profile_id` = '6'
AND `status` = 'online'
AND `ref_type` = 'speaker'
ERROR - 2021-02-10 19:22:15 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Dashboard.php 30
ERROR - 2021-02-10 19:29:37 --> Severity: Warning --> file_get_contents(::1): failed to open stream: No such file or directory D:\Xampp\htdocs\vfair\application\models\Institute_model.php 52
ERROR - 2021-02-10 19:38:39 --> Severity: 4096 --> Object of class stdClass could not be converted to string D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\live_status_data.php 51
ERROR - 2021-02-10 19:38:39 --> Severity: 4096 --> Object of class stdClass could not be converted to string D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\live_status_data.php 51
ERROR - 2021-02-10 19:39:08 --> Severity: error --> Exception: syntax error, unexpected '?>' D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\live_status_data.php 48
ERROR - 2021-02-10 19:41:48 --> Severity: error --> Exception: Call to a member function result() on array D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\studentlogintime.php 48
ERROR - 2021-02-10 19:42:14 --> Severity: error --> Exception: Call to a member function result() on array D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\studentlogintime.php 48
ERROR - 2021-02-10 19:59:52 --> Severity: error --> Exception: Call to a member function result() on array D:\Xampp\htdocs\vfair\application\views\speaker\dashboard\studentlogintime.php 48
ERROR - 2021-02-10 20:55:52 --> Query error: Unknown column 'received' in 'where clause' - Invalid query: SELECT `tbl_speaker_student_schedule`.*
FROM `tbl_speaker_student_schedule`
LEFT JOIN `tbl_speakers` ON `tbl_speakers`.`speaker_id` = `tbl_speaker_student_schedule`.`speaker_id`
WHERE `received` = 'upcoming'
AND `tbl_speaker_student_schedule`.`speaker_id` = '6'
AND `tbl_speakers`.`speaker_status` = 'Active'
AND `tbl_speakers`.`is_deleted` = 0
ERROR - 2021-02-10 20:55:52 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\views\speaker\includes\footer.php 53
ERROR - 2021-02-10 21:20:27 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT `tbl_speaker_student_schedule`.*
FROM `tbl_speaker_student_schedule`
LEFT JOIN `tbl_speakers` ON `tbl_speakers`.`speaker_id` = `tbl_speaker_student_schedule`.`speaker_id`
WHERE `status` = 'pending'
AND `tbl_speaker_student_schedule`.`speaker_id` = '6'
AND `tbl_speakers`.`speaker_status` = 'Active'
AND `tbl_speakers`.`is_deleted` = 0
ERROR - 2021-02-10 21:20:27 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\views\speaker\includes\footer.php 53
ERROR - 2021-02-10 21:24:08 --> Severity: Warning --> file_get_contents(::1): failed to open stream: No such file or directory D:\Xampp\htdocs\vfair\application\models\Institute_model.php 52
ERROR - 2021-02-10 21:28:31 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT *
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 21:30:00 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:20:35 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:21:48 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT `tbl_speaker_student_schedule`.*
FROM `tbl_speaker_student_schedule`
LEFT JOIN `tbl_speakers` ON `tbl_speakers`.`speaker_id` = `tbl_speaker_student_schedule`.`speaker_id`
WHERE `status` = 'replied'
AND `tbl_speaker_student_schedule`.`speaker_id` = '6'
AND `tbl_speakers`.`speaker_status` = 'Active'
AND `tbl_speakers`.`is_deleted` = 0
ERROR - 2021-02-10 22:21:48 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\views\speaker\includes\footer.php 53
ERROR - 2021-02-10 22:24:10 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:31:15 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:31:18 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:31:23 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:31:48 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:32:01 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:32:43 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:34:27 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:35:30 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:35:35 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:11 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:12 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:23 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:23 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Enquiries.php 29
ERROR - 2021-02-10 22:36:24 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:24 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Enquiries.php 29
ERROR - 2021-02-10 22:36:24 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:36:24 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Enquiries.php 29
ERROR - 2021-02-10 22:37:39 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:37:39 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Enquiries.php 29
ERROR - 2021-02-10 22:38:13 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:38:13 --> Severity: error --> Exception: Call to a member function result() on boolean D:\Xampp\htdocs\vfair\application\controllers\speaker\Enquiries.php 29
ERROR - 2021-02-10 22:38:19 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:38:22 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:38:23 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:38:26 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:38:57 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:40:01 --> Severity: error --> Exception: Call to a member function result() on array D:\Xampp\htdocs\vfair\application\views\speaker\enquiries\enquiries.php 101
ERROR - 2021-02-10 22:40:04 --> Severity: error --> Exception: Call to a member function result() on array D:\Xampp\htdocs\vfair\application\views\speaker\enquiries\enquiries.php 101
ERROR - 2021-02-10 22:41:52 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.`student_name`, `tbl_students`.`email`, `tbl_students`.`phone`
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:42:05 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.`student_name`, `tbl_students`.`email`, `tbl_students`.`phone`
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:42:09 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.`student_name`, `tbl_students`.`email`, `tbl_students`.`phone`
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:44:49 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:44:55 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:45:37 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:45:40 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:46:58 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'received'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:47:52 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:50:41 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:50:45 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'Replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:51:15 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:52:06 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 22:55:30 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ERROR - 2021-02-10 22:55:37 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'replied'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ERROR - 2021-02-10 22:57:52 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
ERROR - 2021-02-10 23:01:27 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: SELECT `tbl_institute_ask_a_question`.*, `tbl_students`.*
FROM `tbl_institute_ask_a_question`
JOIN `tbl_students` ON `tbl_institute_ask_a_question`.`student_id` = `tbl_students`.`student_id`
WHERE `status` = 'pending'
AND `tbl_institute_ask_a_question`.`institute_id` = '6'
AND `tbl_institute_ask_a_question`.`type` = 'speaker'
ORDER BY `id` DESC
