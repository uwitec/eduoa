ALTER TABLE `units` ADD `login_ie_title` VARCHAR( 100 ) NOT NULL COMMENT '登录界面ie title',
ADD `main_ie_title` VARCHAR( 100 ) NOT NULL COMMENT '主页面ie title';

ALTER TABLE `banjis` ADD `status` INT( 1 ) NOT NULL DEFAULT '1' COMMENT '状态(0:删除,1:正常,2:毕业)' AFTER `order_list` ; 

ALTER TABLE `asset_ins` CHANGE `use_person` `use_person` VARCHAR( 20 ) NULL DEFAULT NULL COMMENT '使用人'  ;

ALTER TABLE `asset_outs` CHANGE `use_person` `use_person` VARCHAR( 20 ) NULL DEFAULT NULL COMMENT '使用人' ;

ALTER TABLE `students` ADD `status` INT NOT NULL DEFAULT '1' COMMENT '状态(9:新生 1:正常 2:毕业)' AFTER `password` ;
