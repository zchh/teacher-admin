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
