-- --------------------------------------
-- 行政区划
-- --------------------------------------
create table regions(
  id               int(11)       not null auto_increment comment '主键',
  region_name      varchar(30)   not null                comment '行政地区名称',
  maximum          int(6)        not null default 0      comment '最大记录数',
  flag             int(1)        not null                comment '有效标志',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='行政区划';


-- --------------------------------------
-- 民族
-- --------------------------------------
create table people(
  id                    int(10)       not null auto_increment comment '民族编号',
  people_name           varchar(20)   not null                comment '民族名称',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='民族';


-- --------------------------------------
-- 学位
-- --------------------------------------
create table degrees (
  id                    int(10)       not null auto_increment comment '学位编号',
  degree_name           varchar(20)   not null                comment '学位名称',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学位';



-- --------------------------------------
-- 学年制
-- --------------------------------------
create table academic_years(
  id                    int(10)       not null auto_increment comment '学年制编号',
  ay_name               varchar(20)   not null                comment '学年制名称',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学年制';


-- --------------------------------------
-- 文件表
-- --------------------------------------
create table `files` (
  `id`                    int(10)       not null auto_increment comment '文件编号',
  `path`                  varchar(255)  not null default ''     COMMENT '路径',
  `name`                  varchar(255)  not null default ''     COMMENT '文件名称',
  `fspath`                varchar(255)                          COMMENT '',
  `type`                  varchar(255)  not null default ''     COMMENT '',
  `size`                  int(10)       not null default '0'    COMMENT '大小',
  `deleted`               tinyint(4)    not null default '0'    COMMENT '',
  `comment`               text                                  COMMENT '',
  `created`               timestamp     not null default '2008-01-01 00:00:01',
  `updated`               timestamp     not null default '2008-01-01 00:00:01',
  primary key  (`id`)
)engine=MyISAM default charset=utf8 comment='文件';


-- --------------------------------------
-- 缓急表
-- --------------------------------------
create table rates(
  id                    int(10)       not null auto_increment comment '内部编号',
  rate_name             varchar(10)   not null                comment '缓急名',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='缓急';