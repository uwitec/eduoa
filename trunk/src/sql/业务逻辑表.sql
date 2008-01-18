/* 单位表 */
create table units (
  id                    int(10)       not null auto_increment comment '单位编号',
  unit_name             varchar(100)  not null default ''     comment '单位名称',
  tel_no                varchar(100)  not null default ''     comment '电话',
  fax_no                varchar(100)  not null default ''     comment '传真',
  post_no               varchar(50)   not null default ''     comment '邮编',
  address               varchar(200)  not null default ''     comment '地址',
  website               varchar(200)  not null default ''     comment '网站',
  email                 varchar(200)  not null default ''     comment '电子信箱',
  bank_name             varchar(200)  not null default ''     comment '开户行',
  bank_no               varchar(200)  not null default ''     comment '账号',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='单位';


/* 部门表 */
create table departments(
  id                    int(10)       not null auto_increment comment '部门编号',
  parent_id             int(10)                               comment '上级部门',
  department_name       varchar(100)                          comment '部门名称',
  english_name          varchar(100)                          comment '英文名',
  tel_no                varchar(100)                          comment '部门电话',
  fax_no                varchar(100)                          comment '部门传真',
  order_list            int(2)                                comment '部门排序',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='部门';


/* 教学楼 */
create table teaching_buildings(
  id                    int(10)       not null auto_increment comment '主键',
  building_no           varchar(100)                          comment '教学楼编号',
  building_name         varchar(100)                          comment '教学楼名称',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教学楼';


/* 教室类型 */
create table classroom_types(
  id               int(10)       not null auto_increment comment '类型编号',
  type_name        varchar(100)                          comment '类型名称',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教室类型';


/* 教室信息 */
create table classrooms(
  id                    int(10)       not null auto_increment comment '教室编号',
  classroom_name        varchar(100)                          comment '教室名称',
  classroom_type_id     int(10)                               comment '教室类型',
  teaching_building_id  int(10)                               comment '所在教学楼',
  seating               int(3)                                comment '座位数',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教室信息';


/* 课程表 */
create table courses(
  id                    int(10)       not null auto_increment comment '课程编号',
  course_name           varchar(20)                           comment '课程名称',
  teaching_material     varchar(100)                          comment '课程教材',
  course_code           varchar(20)                           comment '课程代码',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='课程';


/* 学期类型表 */
create table semester_types(
  id                    int(10)       not null auto_increment comment '学期类型编号',
  type_name             varchar(20)                           comment '学期名称',
  flag                  int(1)                                comment '标志(1:学期 2:假期)',
  start_date            date                                  comment '开始时间',
  end_date              date                                  comment '结束时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学期类型';


/* 学期表 */
create table semesters(
  id                    int(10)       not null auto_increment comment '学期编号',
  semester_name         varchar(50)                           comment '学期名称',
  is_current            int(1)                                comment '当前学期',
  semester_type_id      int(10)                               comment '学期类型',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学期';


/* 教师表 */
create table teachers(
  id                    int(10)       not null auto_increment comment '教师编号',
  user_id               int(10)                               comment '用户',
  teacher_type          int(1)        not null default 1      comment '教职工类型(1:教师 2:职工)',
  teacher_name          varchar(20)   not null                comment '姓名',
  is_work               int(1)                                comment '是否在岗', 
  birthday              timestamp                             comment '出生日期',
  sex                   int(1)                                comment '性别',
  people_id             int(10)                               comment '民族',
  degree_id             int(10)                               comment '学位',
  duty                  varchar(100)                          comment '职称',
  cert_number           varchar(18)                           comment '身份证号',
  get_busy_date         timestamp                             comment '参加工作时间',
  address               varchar(100)                          comment '个人联系方式',
  email                 varchar(100)                          comment '电子邮箱',
  graduate_the_college  varchar(100)                          comment '毕业院校',
  specialty             varchar(100)                          comment '所学专业',
  office_phone          varchar(100)                          comment '办公电话',
  department_id         int(10)                               comment '所属部门',
  file_id               int(10)                               comment '照片',
  password              varchar(32)                           comment '口令',
  flag                  int(1)                                comment '状态(1:在岗 0:离职)',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教师';


/* 教职工离职(复职)信息调度 */
create table teacher_is_works(
  id                    int(10)       not null auto_increment comment '教职工离职(复职)编号',
  teacher_id            int(10)       not null                comment '教师',
  flag                  int(1)        not null                comment '操作行为', 
  created               timestamp                             comment '离职(复职)时间',
  reason                varchar(1000)                         comment '离职(复职)原因',
  assessor              varchar(100)                          comment '审核人',
  remark                varchar(2000)                         comment '备注',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教职工离职(复职)信息调度';


/* 教工奖惩信息表 */
create table teacher_rewards(
  id                    int(10)       not null auto_increment comment '教工奖惩信息编号',
  teacher_id            int(10)       not null                comment '教师名称',
  created               timestamp                             comment '奖惩日期',
  flag                  int(1)        not null                comment '奖惩标记', 
  content               varchar(200)                          COMMENT '奖惩内容',
  reason                varchar(1000)                         comment '奖惩原因',
  remark                varchar(2000)                         comment '备注',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教工奖惩信息';


/* 教工继续教育信息表 */
create table teacher_continuing_educations(
  id                    int(10)       not null auto_increment comment '教工继续教育信息编号',
  teacher_id            int(10)       not null                comment '教师名称',
  start_date            date                                  comment '教育开始日期',
  end_date              date                                  comment '教育结束日期',
  organization          varchar(100)                          comment '教育机构名称', 
  address               varchar(100)                          comment '教育讲师名称',
  content               varchar(2000)                         comment '继续教育内容',
  certificate_info      varchar(2000)                         comment '获得证书情况',
  remark                varchar(2000)                         comment '备注信息',
  created               timestamp                             comment '创建日期',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教工继续教育';


/* 班级 */
create table banjis(
  id                    int(10)       not null auto_increment comment '内部编号',
  class_no              varchar(10)                           comment '班级编号',
  class_name            varchar(100)  not null                comment '班级名称',
  entrance_year         int(4)        not null                comment '入学年份',
  teacher_id            int(10)       not null                comment '班主任',
  academic_year_id      int(10)                               comment '学年制',
  classroom_id          int(10)                               comment '固定教室',
  class_size            int(3)                                comment '班级人数',
  order_list            int(2)                                comment '班级排序',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='班级';


/* 教师任教信息表 */
create table tearcher_work_infos(
  id                    int(10)       not null auto_increment comment '编号',
  teacher_id            int(10)       not null                comment '教师',
  banji_id              int(10)       not null                comment '班级',
  course_id             int(10)       not null                comment '课程',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='教师任教信息';


/* 学生档案 */
create table students(
  id                    int(10)       not null auto_increment comment '内部编号',
  student_no            int(12)                               comment '学号(sp用)',
  file_no               varchar(20)                           comment '学号(档案编号)',
  banji_id              int(10)                               comment '所在班级',
  birthday              date                                  comment '出生日期',
  sex                   int(1)                                comment '性别',
  people_id             int(10)                               comment '民族',
  native_place          varchar(30)                           comment '籍贯',
  total_score           varchar(10)                           comment '总分',
  political_feature     varchar(30)                           comment '政治面貌',
  physical_condition    varchar(30)                           comment '健康状况',
  cert_number           varchar(18)                           comment '身份证号',
  graduate_the_college  varchar(100)                          comment '毕业学校',
  foreign_language      varchar(30)                           comment '外语语种',
  enter_the_way         varchar(30)                           comment '入学方式',
  origin                varchar(30)                           comment '学生来源',
  address               varchar(100)                          comment '家庭住址',
  zip                   varchar(6)                            comment '家庭邮编',
  telphone              varchar(50)                           comment '家庭电话',
  email                 varchar(100)                          comment '电子邮箱',
  enter_date            date                                  comment '入学日期',
  remark                varchar(2000)                         comment '备注',
  student_phone         varchar(50)                           comment '学生电话',
  father_name           varchar(30)                           comment '父亲姓名',
  father_unit           varchar(100)                          comment '父亲单位',
  father_phone          varchar(50)                           comment '父亲电话',
  mother_name           varchar(30)                           comment '母亲姓名',
  mother_unit           varchar(100)                          comment '母亲单位',
  mother_phone          varchar(50)                           comment '母亲电话',
  file_id               int(10)                               comment '照片',
  password              varchar(32)                           comment '口令',
  status                int(1)                                comment '状态(9:新生 1:正常 2:毕业)',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学生档案';


/* 学生成长档案类型 */
create table grow_file_types(
  id                    int(10)       not null auto_increment comment '档案类型编号',
  type_name             varchar(20)   not null                comment '档案类型名称',
  flag                  int(1)        not null default 1      comment '有效标志',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学生成长档案类型';


/* 学生成长档案 */
create table student_grow_files(
  id                    int(10)       not null auto_increment comment '档案编号',
  student_id            int(10)       not null                comment '学生',
  semester_id           int(10)                               comment '学期',
  grow_file_type_id     int(10)       not null                comment '档案类型',
  title                 varchar(200)                          comment '标题',
  description           text                                  comment '描述',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学生成长档案';


/* 学生班级调整 */
create table student_particular_changes(
  id                    int(10)       not null auto_increment comment '内部编号',
  student_id            int(10)       not null                comment '学生',
  old_banji_id          int(10)       not null                comment '原班级',
  new_banji_id          int(10)       not null                comment '新班级',
  change_reason         varchar(200)                          comment '调班原因',
  ratifier              varchar(100)                          comment '批准人',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学生班级调整';


/* 课时表 */
create table hours(
  id                    int(10)       not null auto_increment comment '课时编号',
  hour_name             varchar(30)   not null                comment '课时名词',
  order_list            int(1)                                comment '排序',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='课时表';


/* 星期表 */
create table weeks(
  id                    int(10)       not null auto_increment comment '课时编号',
  week_name             varchar(10)   not null                comment '星期',
  primary key (id)  
)engine=MyISAM default charset=utf8 comment='星期表';


/* 课程表 */
create table curriculum_schedules(
  id                    int(10)       not null auto_increment comment '内部编号',
  class_id              int(10)       not null                comment '班级'
  hour_id               int(10)       not null                comment '科时',
  week_id               int(10)       not null                comment '星期',
  teacher_id            int(10)       not null                comment '教师名称',
  primary key (id)  
)engine=MyISAM default charset=utf8 comment='课程表';


/* 考试管理 */
create table exams(
  id                    int(10)       not null auto_increment comment '考试编号',
  semester_id           int(10)                               comment '学期',
  exam_name             varchar(100)                          comment '考试名称',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='考试';


/* 学生考试成绩 */
create table exam_results(
  id                    int(10)       not null auto_increment comment '内部编号',
  student_id            int(10)       not null                comment '学生',
  exam_id               int(10)                               comment '考试名',
  semester_id           int(10)                               comment '学期',
  course_id             int(10)                               comment '课程',
  score                 decimal(3,2)                          comment '分数',                  
  primary key (id)
)engine=MyISAM default charset=utf8 comment='学生考试成绩';


/* 文档类型表 */
create table document_types(
  id                    int(10)       not null auto_increment comment '文档类型编号',
  type_name             varchar(100)  not null                comment '文档类型名称',
  flag                  int(1)                                comment '有效标志',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='文档类型';


/* 文档表 */
create table documents(
  id                    int(10)       not null auto_increment comment '文档编号',
  document_type_id      int(10)                               comment '文档类型',
  rate_id               int(10)                               comment '缓急',
  course_id             int(10)                               comment '课程',
  title                 varchar(2000)                         comment '标题', 
  subhead               varchar(2000)                         comment '副标题',
  keyword               varchar(200)                          comment '主题词',
  content               text                                  comment '内容',
  is_commons            int(1)                                comment '是否公共',
  is_sms                int(1)                                comment '是否短信',
  sms_date              timestamp                             comment '短信时间',
  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='文档';


/* 文档附件表 */
create table doc_files(
  id                    int(10)       not null auto_increment comment '接收内部编号',
  document_id           int(10)       not null                comment '文档',
  file_id               int(10)       not null                comment '附件',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='文档附件';


/* 文档班级接收表 */
create table doc_class_receiving_logs(
  id                    int(10)       not null auto_increment comment '接收内部编号',
  document_id           int(10)       not null                comment '文档',

  created               timestamp                             comment '创建时间',
  modified              timestamp                             comment '修改时间',
  primary key (id)
)engine=MyISAM default charset=utf8 comment='文档班级接收';