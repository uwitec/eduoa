-- --------------------------------------
-- 资产类型表
-- --------------------------------------
create table asset_types (
  id                    int(10)       not null auto_increment comment '资产类型编号',
  type_name             varchar(200)                          comment '名称',
  type_code             varchar(200)                          comment '编码',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='资产类型';


-- --------------------------------------
-- 资产状态表
-- --------------------------------------
create table asset_statuses (
  id                    int(10)       not null auto_increment comment '资产状态编号',
  status_name           varchar(200)                          comment '名称',
  status_code           varchar(200)                          comment '编码',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='资产状态';


-- ----------------------------
-- 资产增加方式表
-- ----------------------------
create table asset_in_methods (
  id                    int(10)       not null auto_increment comment '资产状态编号',
  method_name           varchar(200)                          comment '名称',
  method_code           varchar(200)                          comment '编码',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='增加方式';


-- ----------------------------
-- 资产表
-- ----------------------------
create table assets (
  id                    int(10)       not null auto_increment comment '资产编号',
  asset_name            varchar(200)                          comment '资产名称',
  asset_code            varchar(200)                          comment '资产代码',
  asset_type_id         int(10)                               comment '类别',
  standard_code         varchar(200)                          comment '国标编码',
  provider              varchar(200)                          comment '生产厂商',
  made_date             date                                  comment '生产日期',
  in_date               date                                  comment '入帐日期',
  residual_rate         varchar(20)                           comment '净残值率',
  use_years             varchar(20)                           comment '预计使用年限',
  actual_value          varchar(20)                           comment '原值',
  net_value             varchar(20)                           comment '净值',
  location              varchar(100)                          comment '存放地点',
  department_id         int(10)                               comment '使用部门',
  asset_status_id       int(10)                               comment '使用情况',
  asset_in_method_id    int(10)                               comment '增加方式',
  belong_user           varchar(20)                           comment '保管人员',
  clear_method_id       int(10)                               comment '报废方式',
  clear_date            date                                  comment '报废时间',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='增加方式';


-- ----------------------------
-- 资产借出
-- ----------------------------
create table asset_outs (
  id                    int(10)       not null auto_increment comment '资产入库编号',
  asset_id              int(10)       not null                comment '资产',
  from_date             date                                  comment '借出日期',
  end_date              date                                  comment '计划归还日期',
  department_id         int(10)                               comment '使用部门',
  use_person            int(10)                               comment '使用人',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key  (id)
)engine=MyISAM default charset=utf8 comment='资产借出';


-- ----------------------------
-- 资产归还
-- ----------------------------
create table asset_ins (
  id                    int(10)       not null auto_increment comment '资产入库编号',
  asset_id              int(10)       not null                comment '资产',
  in_date               date                                  comment '入库时间',
  department_id         int(10)                               comment '使用部门',
  use_person            int(10)                               comment '使用人',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key  (id)
)engine=MyISAM default charset=utf8 comment='资产归还';


-- ----------------------------
-- 资产维修
-- ----------------------------
create table asset_maintenances (
  id                    int(10)       not null auto_increment comment '资产维修编号',
  asset_id              int(10)       not null                comment '资产',
  send_date             date                                  comment '送修日期',
  maintenance_date      date                                  comment '维修日期',
  reason                varchar(200)                          comment '故障原因',
  station               varchar(200)                          comment '维修单位',
  accessories           varchar(200)                          comment '配件名称',
  quantity              int(4)                                comment '数量',
  price                 decimal(8,2)                          comment '单价',
  money                 decimal(8,2)                          comment '金额',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key  (id)
)engine=MyISAM default charset=utf8 comment='资产维修';