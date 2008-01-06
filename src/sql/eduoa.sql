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

