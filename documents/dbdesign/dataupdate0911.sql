/*
Navicat MySQL Data Transfer

Source Server         : spanker
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : hsoa

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2013-09-11 22:10:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `p_menu`
-- ----------------------------
DROP TABLE IF EXISTS `p_menu`;
CREATE TABLE `p_menu` (
  `MenuID` int(11) NOT NULL AUTO_INCREMENT COMMENT '�˵�ID',
  `PMenuID` int(11) NOT NULL COMMENT '���ڵ�˵�ID',
  `Icon` varchar(64) DEFAULT NULL,
  `Isleaf` tinyint(4) NOT NULL,
  `Name` varchar(64) NOT NULL COMMENT '�˵�����',
  `Url` varchar(64) NOT NULL COMMENT '�˵�·��',
  `OrderIndex` tinyint(4) NOT NULL,
  PRIMARY KEY (`MenuID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='�˵���';

-- ----------------------------
-- Records of p_menu
-- ----------------------------
INSERT INTO `p_menu` VALUES ('1', '0', 'plugin', '1', '��ҳ', 'school/welcome/index', '1');
INSERT INTO `p_menu` VALUES ('2', '0', null, '0', 'ϵͳ����', '', '2');
INSERT INTO `p_menu` VALUES ('3', '0', null, '0', '�ɼ�ͳ��', '', '3');
INSERT INTO `p_menu` VALUES ('4', '0', null, '0', '�ɼ�����', '', '4');
INSERT INTO `p_menu` VALUES ('5', '2', null, '1', '�༶����', 'school/manClass/index', '1');
INSERT INTO `p_menu` VALUES ('6', '2', '', '1', '��ʦ����', 'school/manTeacher/index', '2');
INSERT INTO `p_menu` VALUES ('7', '2', null, '1', '��Ŀ����', 'school/manSubject/index', '3');
INSERT INTO `p_menu` VALUES ('8', '2', null, '1', 'ѧ������', 'school/manStudent/index', '4');
INSERT INTO `p_menu` VALUES ('9', '2', null, '1', '���Թ���', 'school/manExam/index', '5');
INSERT INTO `p_menu` VALUES ('10', '2', null, '1', '�ɼ�����', 'school/manScore/index', '6');
INSERT INTO `p_menu` VALUES ('11', '3', null, '1', 'ѧ���ɼ�', 'school/statStudent/index', '1');
INSERT INTO `p_menu` VALUES ('12', '3', null, '1', 'ѧ������', 'school/statSturank/index', '2');
INSERT INTO `p_menu` VALUES ('13', '3', null, '1', '�༶�ɼ�', 'school/statClass/index', '3');
INSERT INTO `p_menu` VALUES ('14', '4', null, '1', 'ѧ������', 'school/anaStudent/index', '1');
INSERT INTO `p_menu` VALUES ('15', '4', null, '1', '�༶����', 'school/anaClass/index', '2');


/*
Navicat MySQL Data Transfer

Source Server         : spanker
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : hsoa

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2013-09-11 22:12:07
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `info_subject`
-- ----------------------------
DROP TABLE IF EXISTS `info_subject`;
CREATE TABLE `info_subject` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT COMMENT '��ĿID',
  `SubjectName` varchar(32) NOT NULL COMMENT '��Ŀ����',
  `Type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0.������ 1.�� 2.��',
  `ReferSubjectID` varchar(64) DEFAULT NULL COMMENT '������ĿID',
  `SchoolID` int(11) NOT NULL COMMENT '0.Ĭ�ϳ�ʼ >0.����ѧУID',
  `FullScore` decimal(8,2) DEFAULT NULL COMMENT '�ܷ�',
  `PassScore` decimal(8,2) DEFAULT NULL,
  `CreateTime` datetime NOT NULL COMMENT '����ʱ��',
  `CreatorID` int(11) NOT NULL COMMENT '������',
  `State` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0.��Ч 1.��Ч',
  PRIMARY KEY (`SubjectID`),
  UNIQUE KEY `Index_NS` (`SubjectName`,`SchoolID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='��Ŀ��Ϣ��';

-- ----------------------------
-- Records of info_subject
-- ----------------------------
INSERT INTO `info_subject` VALUES ('1', '����', '0', '', '0', '150.00', '90.00', '2013-07-06 00:09:06', '0', '1');
INSERT INTO `info_subject` VALUES ('2', '��ѧ', '0', '', '0', '150.00', '90.00', '2013-07-06 00:09:22', '0', '1');
INSERT INTO `info_subject` VALUES ('3', 'Ӣ��', '0', '', '0', '150.00', '90.00', '2013-07-06 00:09:28', '0', '1');
INSERT INTO `info_subject` VALUES ('4', '����', '2', '', '0', '100.00', '60.00', '2013-07-06 00:09:37', '0', '1');
INSERT INTO `info_subject` VALUES ('5', '��ѧ', '2', '', '0', '100.00', '60.00', '2013-07-06 00:09:45', '0', '1');
INSERT INTO `info_subject` VALUES ('6', '����', '2', '', '0', '100.00', '60.00', '2013-07-06 00:09:51', '0', '1');
INSERT INTO `info_subject` VALUES ('7', '����', '1', '', '0', '100.00', '60.00', '2013-07-06 00:09:56', '0', '1');
INSERT INTO `info_subject` VALUES ('8', '��ʷ', '1', '', '0', '100.00', '60.00', '2013-07-06 00:10:01', '0', '1');
INSERT INTO `info_subject` VALUES ('9', '����', '1', '', '0', '100.00', '60.00', '2013-07-06 00:10:06', '0', '1');
INSERT INTO `info_subject` VALUES ('10', '����ۺ�', '2', '4,5,6', '0', '300.00', '180.00', '2013-07-06 00:11:08', '0', '1');
INSERT INTO `info_subject` VALUES ('11', '�Ŀ��ۺ�', '1', '7,8,9', '0', '300.00', '180.00', '2013-07-06 00:11:20', '0', '1');
INSERT INTO `info_subject` VALUES ('12', '�ܷ�(���)', '2', '1,2,3,4,5,6', '0', '750.00', '450.00', '2013-07-06 00:13:16', '0', '1');
INSERT INTO `info_subject` VALUES ('13', '�ܷ�(�Ŀ�)', '1', '1,2,3,7,8,9', '0', '750.00', '450.00', '2013-07-27 19:26:05', '0', '1');
INSERT INTO `info_subject` VALUES ('14', '�ܷ�', '0', '1,2,3,4,5,6,7,8,9', '0', '1050.00', '630.00', '2013-07-27 19:26:05', '0', '1');



/*
Navicat MySQL Data Transfer

Source Server         : spanker
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : hsoa

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2013-09-11 22:16:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `p_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `p_role_menu`;
CREATE TABLE `p_role_menu` (
  `RoleID` int(11) NOT NULL COMMENT '��ɫID',
  `MenuID` int(11) NOT NULL COMMENT '�˵�ID',
  PRIMARY KEY (`RoleID`,`MenuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��ɫ�˵���';

-- ----------------------------
-- Records of p_role_menu
-- ----------------------------
INSERT INTO `p_role_menu` VALUES ('1', '1');
INSERT INTO `p_role_menu` VALUES ('1', '3');
INSERT INTO `p_role_menu` VALUES ('1', '4');
INSERT INTO `p_role_menu` VALUES ('1', '11');
INSERT INTO `p_role_menu` VALUES ('1', '12');
INSERT INTO `p_role_menu` VALUES ('1', '13');
INSERT INTO `p_role_menu` VALUES ('1', '14');
INSERT INTO `p_role_menu` VALUES ('1', '15');
INSERT INTO `p_role_menu` VALUES ('2', '1');
INSERT INTO `p_role_menu` VALUES ('2', '2');
INSERT INTO `p_role_menu` VALUES ('2', '3');
INSERT INTO `p_role_menu` VALUES ('2', '4');
INSERT INTO `p_role_menu` VALUES ('2', '10');
INSERT INTO `p_role_menu` VALUES ('2', '11');
INSERT INTO `p_role_menu` VALUES ('2', '12');
INSERT INTO `p_role_menu` VALUES ('2', '13');
INSERT INTO `p_role_menu` VALUES ('2', '14');
INSERT INTO `p_role_menu` VALUES ('2', '15');
INSERT INTO `p_role_menu` VALUES ('3', '1');
INSERT INTO `p_role_menu` VALUES ('3', '2');
INSERT INTO `p_role_menu` VALUES ('3', '3');
INSERT INTO `p_role_menu` VALUES ('3', '4');
INSERT INTO `p_role_menu` VALUES ('3', '10');
INSERT INTO `p_role_menu` VALUES ('3', '11');
INSERT INTO `p_role_menu` VALUES ('3', '12');
INSERT INTO `p_role_menu` VALUES ('3', '13');
INSERT INTO `p_role_menu` VALUES ('3', '14');
INSERT INTO `p_role_menu` VALUES ('3', '15');
INSERT INTO `p_role_menu` VALUES ('4', '0');
INSERT INTO `p_role_menu` VALUES ('4', '1');
INSERT INTO `p_role_menu` VALUES ('4', '2');
INSERT INTO `p_role_menu` VALUES ('4', '3');
INSERT INTO `p_role_menu` VALUES ('4', '4');
INSERT INTO `p_role_menu` VALUES ('4', '6');
INSERT INTO `p_role_menu` VALUES ('4', '8');
INSERT INTO `p_role_menu` VALUES ('4', '9');
INSERT INTO `p_role_menu` VALUES ('4', '10');
INSERT INTO `p_role_menu` VALUES ('4', '11');
INSERT INTO `p_role_menu` VALUES ('4', '12');
INSERT INTO `p_role_menu` VALUES ('4', '13');
INSERT INTO `p_role_menu` VALUES ('4', '14');
INSERT INTO `p_role_menu` VALUES ('4', '15');
INSERT INTO `p_role_menu` VALUES ('5', '0');
INSERT INTO `p_role_menu` VALUES ('5', '1');
INSERT INTO `p_role_menu` VALUES ('5', '2');
INSERT INTO `p_role_menu` VALUES ('5', '3');
INSERT INTO `p_role_menu` VALUES ('5', '4');
INSERT INTO `p_role_menu` VALUES ('5', '5');
INSERT INTO `p_role_menu` VALUES ('5', '6');
INSERT INTO `p_role_menu` VALUES ('5', '7');
INSERT INTO `p_role_menu` VALUES ('5', '8');
INSERT INTO `p_role_menu` VALUES ('5', '9');
INSERT INTO `p_role_menu` VALUES ('5', '10');
INSERT INTO `p_role_menu` VALUES ('5', '11');
INSERT INTO `p_role_menu` VALUES ('5', '12');
INSERT INTO `p_role_menu` VALUES ('5', '13');
INSERT INTO `p_role_menu` VALUES ('5', '14');
INSERT INTO `p_role_menu` VALUES ('5', '15');

