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
  from_id               int(10)                               comment '发件人',
  to_id                 int(10)                               comment '收件人',
  cc_id                 varchar(1000)                         comment '抄送',
  bcc_id                varchar(1000)                         comment '暗送',
  subject               varchar(200)                          comment '主题',
  content               mediumtext                            comment '内容',
  send_time             timestamp                             comment '发送时间',
  read_flag             char(1)                               comment '读取标志',
  send_flag             char(1)                               comment '发送标志',
  delete_flag           char(1)                               comment '删除标志',
  email_box_id          int(10)                               comment '所在邮箱',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='内部邮件';


-- ----------------------------
-- 邮件附件
-- ----------------------------
create table email_attachments(
  id                    int(10)       not null auto_increment comment '邮件附件编号',
  email_id              int(10)       not null                comment '邮件',
  file_id               int(10)       not null                comment '文件',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='内部邮件';
