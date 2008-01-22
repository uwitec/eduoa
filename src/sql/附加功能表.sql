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


-- ----------------------------
-- 栏目分类
-- ----------------------------
create table categories(
  id                   int(10)       not null auto_increment comment '主键',
  category_name        varchar(18)   not null default ''     comment '栏目分类名称',
  category_nicename    varchar(66)   not null default ''     comment '栏目分类别名',
  category_description longtext                              comment '栏目简介',
  category_parent      int(10)                               comment '父亲栏目',
  category_count       int(10)                               comment '栏目点击',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='栏目分类';


-- ----------------------------
-- 栏目文章
-- ----------------------------
create table posts(
  id                   int(10)       not null auto_increment comment '主键',
  category_id          varchar(18)   not null default ''     comment '栏目分类',
  post_title           varchar(255)  not null                comment '标题',
  post_content         longtext      not null                comment '内容',
  post_status          enum('publish','draft','private','static','object','attachment') not null default 'publish' comment '发布状态',
  post_count           int(10)       not null default 0      comment '点击次数',
  valid_from   date                   ,  -- 生效日期
  valid_thru   date                   ,  -- 终止日期
  created              timestamp                             comment '创建时间',
  modified             timestamp                             comment '修改时间',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='栏目文章';