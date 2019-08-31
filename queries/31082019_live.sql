create table visit_call_report_attachment (
id_submit_attachment int(11) primary key auto_increment,
attachment varchar(500),
id_submit_report int(11)
);

alter table visit_call_report
modify column jenis_report int(11) comment '1 untuk visit, 0 untuk call';
