/*初始化管理员和组*/
INSERT INTO `base_cms`.`base_admin_group` (`group_id`, `group_name`) VALUES ('1', 'Root');
INSERT INTO `base_cms`.`base_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_nickname`, `admin_group`) VALUES ('1', 'root', md5('123'), 'root', '1');

/*权限*/
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('1', '登陆后台');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('2', '用户权限可读');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('3', '用户权限可控制');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('4', '管理员权限可读');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('5', '管理员权限可控制');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('6', '文章可控制');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('7', '文章专题可控制');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('8', '文章标签可控制');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('9', '文章可读');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('10', '文章专题可读');
INSERT INTO `base_cms`.`base_admin_power` (`power_id`, `power_name`) VALUES ('11', '文章标签可读');


/*初始化用户组*/
INSERT INTO `base_cms`.`base_user_group` (`group_id`, `group_name`) VALUES ('1', '默认用户组');

/*初始化用户*/
INSERT INTO `base_cms`.`base_user` 
(`user_id`, `user_username`, `user_password`, `user_nickname`, `user_create_date`, `user_update_date`, `user_true`, `user_age`, `user_intro`, `user_sex`, `user_group`) 
VALUES ('1', 'test', md5('123'), 't', now(), now(), '1', '16', '阿斯顿撒的', '男', '1');

/*用户权限*/
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('文章可写');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('文章可评论');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('文章可收藏');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('文章可赞');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('类别可写');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('专题可写');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('图片可写');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('文件可写');
INSERT INTO `base_cms`.`base_user_power` (`power_name`) VALUES ('消息可发');

/*用户文章类别*/
INSERT INTO `base_cms`.`base_article_class` (`class_user`, `class_create_date`, `class_update_date`, `class_name`) VALUES ('1', now(), now(), 'C++');
INSERT INTO `base_cms`.`base_article_class` (`class_user`, `class_create_date`, `class_update_date`, `class_name`) VALUES ('1', now(), now(), 'Java');