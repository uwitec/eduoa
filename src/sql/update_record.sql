ALTER TABLE `units` ADD `login_ie_title` VARCHAR( 100 ) NOT NULL COMMENT '登录界面ie title',
ADD `main_ie_title` VARCHAR( 100 ) NOT NULL COMMENT '主页面ie title';

ALTER TABLE `banjis` ADD `status` INT( 1 ) NOT NULL DEFAULT '1' COMMENT '状态(0:删除,1:正常,2:毕业)' AFTER `order_list` ; 