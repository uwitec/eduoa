-- ----------------------------
-- 邮箱文件夹
-- ----------------------------
create table email_boxes (
  id                    int(10)       not null auto_increment comment '邮箱文件夹编号',
  box_name              varchar(100)  not null                comment '文件夹名称',
  order_list            int(1)                                comment '文件夹排序',
  user_id               int(10)       not null                comment '用户',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='邮箱文件夹';

-- ----------------------------
-- 内部邮件
-- ----------------------------
create table emails (
  id                    int(10)       not null auto_increment comment '邮件编号',
  from_id               int(10)                               comment '',
  to_id                 int(10)                               comment '',
  cc_id                 varchar(1000)                         comment '',
  bcc_id                varchar(1000)                         comment '',
  subject               varchar(200)                          comment '',
  content               mediumtext                            comment '',
  send_time             timestamp                             comment '',
  read_flag             char(1)                               comment '',
  send_flag             char(1)                               comment '',
  delete_flag           char(1)                               comment '',
  email_box_id          int(10)                               comment '',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='内部邮件';


-- ----------------------------
-- 邮件附件
-- ----------------------------
create table email_attachments(
  id                    int(10)       not null auto_increment comment '邮件附件编号',
  email_id              int(10)       NOT NULL                COMMENT '邮件',
  file_id               int(10)       not null                comment '文件',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='内部邮件';
