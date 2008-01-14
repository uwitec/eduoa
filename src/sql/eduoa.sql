/*********************************************************************************************
/*  表必须有名为 id 的主键。
/*  如果表中包含 created 或 modified 列，cakephp 将自动填充字段（如果适用）。
/*  表名必须为复数的(users、products)。其相应的模型将具有单数的名称(user、product)。
/*  如果要将表关联起来，外键应当遵循 table_id 格式，且使用单数的表名。
/*  例如，user_id、product_id 将是表 user、product的外键。
/*  字段flag用于且仅用于最多表示两种状态。如：0：无效 1： 有效
/*  操作两种状态用status字段。如：0:无效 1:有效 2:拟转让 9:待审核
/*  在使用0和1表示状态的时候，如无特殊说明0始终表示无效，1始终表示有效。
/*********************************************************************************************

/* 角色表 */
create table roles (
  id                   int(10)         not null auto_increment comment '主键',
  role_name            varchar(200)    not null                comment '角色名称',
  type_id              int(1)          not null default 1      comment '类型',
  hierarchy            int(1)                                  comment '角色等级',
  father_id            int(1)                                  comment '父亲角色',
  valid_from           date                                    comment '生效日期',
  valid_thru           date                                    comment '终止日期',
  flag                 int(1)          not null default 1      comment '有效标志(1: 有效; 0: 无效)',
  memo                 varchar(2000)                           comment '备注',
  primary key  (id)
) engine=MyISAM default charset=utf8 comment='角色';


/* 栏目表 */
create table modules (
  id              int(10)         not null auto_increment comment '主键',
  module_name     varchar(60)     not null                comment '栏目(功能) 名称',
  module_type     int(3)                                  comment '栏目(功能) 类型 (1:系统模块 2:oa系统固定模板 3:网站栏目)',
  parent_id       int(10)                                 comment '上级栏目id',
  hierarchy       int(3)          default 1               comment '级别',	
  node            int(1)          default 0               comment '节点 (1:根  0:节点 )',
  image_uri       varchar(200)                            comment '栏目图标 (限止大小、长度、宽度)',
  url             varchar(200)                            comment '链接地址',
  target          varchar(20)                             comment '打开方式 (_top/_self/_parent/_winname/_blank)',
  allow_del       int(1)                                  comment '此栏目是否允许删除(1：允许 0：不允许)',
  allow_add       int(1)                                  comment '此栏目是否允许新增子栏目(1：允许 0：不允许)',
  allow_publish   int(1)                                  comment '此栏目是否允许上文章',
  duty_person     varchar(200)                            comment '栏目责任人',
  duty_company    int(10)	                          comment '栏目责任单位',
  duty_lead       varchar(200)                            comment '栏目责任领导',
  order_list      int(10)                                 comment '栏目的排序',
  max_num         int(10)         default 5               comment '每页最大显示记录数',
  visit_count     int(10)                                 comment '栏目被访问的次数',
  page_type       int(1)                                  comment '页面类别(1：菜单  2：栏目)',
  memo            varchar(2000)                           comment '备注',
  flag            int(1)          default 1               comment '有效标志',
  primary key  (id)
 ) engine=MyISAM default charset=utf8 comment='栏目表';


/* 会员等级 */
create table member_grades(
  id               int(2)        not null auto_increment comment '主键',
  grade_name       varchar(20)   not null                comment '会员等级名称',
  member_per       decimal(2,2)  not null default 0      comment '会员',
  ws_per           decimal(2,2)  not null default 0      comment '会员',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员等级';


/* 会员基本信息表 */
create table users(
  id               int(8)        not null                comment '主键，值同members主键值',
  login_name       varchar(15)   not null  default ''    comment '用户登录名',
  password         varchar(32)   not null  default ''    comment '用户口令',  
  user_name        varchar(20)   not null                comment '真实姓名',
  sex              int(1)        not null  default 1     comment '性别: 1:男 0:女',
  member_no        varchar(25)   not null  default ''    comment '省编号+身份证号码成为会员编号',
  cert_int         varchar(18)   not null  default ''    comment '身份证号码',
  referees         int(8)                                comment '推荐人',
  member_grades_id int(2)        not null default 1      comment '会员等级，默认为普通会员',
  region_id        int(11)                               comment '会员所属地区',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  home_phone       varchar(30)                           comment '家庭电话',
  email            varchar(30)                           comment '电子邮件',
  bank_accounts    varchar(30) DEFAULT '邮政储蓄'	 comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  created          timestamp                             comment '会员创建日期',
  role_id          int(6)        default 1               comment '用户角色',       
  flag             int(1)        not null default 1      comment '会员状态',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员基本信息';
