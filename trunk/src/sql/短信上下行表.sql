/* 短信下行表 */
create table phs_submit(
	id				int(10)			NOT NULL auto_increment		COMMENT '自增编号',
	sSchoolCode		varchar(32)		NOT NULL 					COMMENT '学校编号',
	nNeddReport		tinyint(1)		DEFAULT '0'					COMMENT '是否要求返回状态报告(0不要求，1要求)',
	nPriority		tinyint(1)									COMMENT '发送优先级(0-3,优先级越高等待时间越短)',
	sServerID		varchar(10)									COMMENT '业务代码',
	nMsgFormat		int(4)										COMMENT '短消息格式(请填写15)',
	sFeeType		varchar(2)									COMMENT '收费类型(00免费01按条收费02包月03封顶)',
	sFeeCode		varchar(6)									COMMENT '按条资费代码(单位为分)',
	sFixedFee		varchar(6)		DEFAULT '000000'			COMMENT '默认000000',
	sSendTime		datetime									COMMENT '发送时间',
	sChargeTermID	varchar(21)									COMMENT '短信计费用户号码，小灵通加区号',
	sDestTermID		varchar(21)									COMMENT '短信接收号码',
	sReplyPath		varchar(21)									COMMENT '回复路径，key叫号码，小灵通加区号，显示的发送方号码',
	nMsgLength		int(4)										COMMENT '消息长度，×2计算',
	cMsgCont		varchar(252)								COMMENT '短信内容',
	nMsgType		tinyint(1)		DEFAULT '0'					COMMENT '短消息类型',
	sInsertTime		datetime									COMMENT '消息写入时间',
	sError			varchar(32)									COMMENT '发送错误代码(默认0)',
	sState			tinyint(1)									COMMENT '发送状态（0未发送；1已发送)',
	sDoor			varchar(20)		NOT NULL DEFAULT 'T02'		COMMENT '通道类型',
	sStay1			varchar(256)								COMMENT '预留字段1',
	sStay2			varchar(256)								COMMENT '预留字段2',
	primary key (id)
)engine=MyISAM default charset=utf8 comment='短信下行表';


/* 短信上行表 */
create table phs_deliver(
	id				int(10)       not null auto_increment		COMMENT '自增编号',
	sMsgID			varchar(32)									COMMENT '网关生成的短消息流水号',
	nIsReport		int(4)										COMMENT '是否状态报告',
	nMsgFormat		int(4)										COMMENT '短消息格式(请填写15)',
	SRecvTime		varchar(14)									COMMENT '短信接收时间(格式yyyymmddhhmiss)',
	sSrcTermID		varchar(21)									COMMENT '短信发送号码',
	sDestTermID		varchar(21)									COMMENT '短信接收号码',
	nMsgLength		int(4)										COMMENT '消息长度，×2计算',
	sMsgContent		varchar(252)								COMMENT '短信内容',
	sInsertTime		datetime									COMMENT '消息写入时间',
	nSpDealResult	int(4)			DEFAULT '0'					COMMENT '默认值0',
	sLinkID			varchar(64)									COMMENT '交易识别码',
	primary key (id)
)engine=MyISAM default charset=utf8 comment='短信上行表';