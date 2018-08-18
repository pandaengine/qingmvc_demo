-- ----------------------------
-- Table structure for pre_sites
-- ----------------------------
DROP TABLE IF EXISTS `pre_sites`;
CREATE TABLE `pre_sites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(50) NOT NULL DEFAULT '' COMMENT '网站名称',
  `url` char(200) NOT NULL DEFAULT '' COMMENT '网站地址',
  `logo` char(100) NOT NULL DEFAULT '' COMMENT 'logo',
  `host` char(100) NOT NULL DEFAULT '' COMMENT '网站顶级域名',
  `summ` varchar(140) NOT NULL COMMENT '网站描述',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除了',
  `is_https` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'https://',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`) USING BTREE COMMENT '地址唯一索引',
  KEY `idx_master` (`host`) COMMENT '主域名索引',
  KEY `idx_title` (`title`) COMMENT '名称索引',
  KEY `idx_lasttime` (`lasttime`) COMMENT '排序索引'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站信息表';

-- ----------------------------
-- Records of pre_sites
-- ----------------------------
INSERT INTO `pre_sites` (`id`, `uid`, `title`, `url`, `logo`, `host`, `summ`, `addtime`, `lasttime`, `is_del`, `is_https`) VALUES ('1', '0', '盲点笔记', 'http://mangdian.net/', '', 'mangdian.net', '盲点笔记-让知识没有盲点，扫除盲点，存储知识，记录知识的成长过程，养成记录知识的习惯', '1533839008', '1533839052', '0', '0');
INSERT INTO `pre_sites` (`id`, `uid`, `title`, `url`, `logo`, `host`, `summ`, `addtime`, `lasttime`, `is_del`, `is_https`) VALUES ('2', '0', 'Logo234可视化网址导航', 'http://logo234.com/', '', 'logo234.com', 'Logo234是新一代的可视化网址导航，原Logo之家,界面清新、可定制网址和主题背景，致力于帮助广大网友更高效率的利用互联网、更方便的记忆和选择自己需要的网站。', '1533839088', '1533839088', '0', '0');
INSERT INTO `pre_sites` (`id`, `uid`, `title`, `url`, `logo`, `host`, `summ`, `addtime`, `lasttime`, `is_del`, `is_https`) VALUES ('3', '0', 'QingCms-开源轻内容管理系统', 'http://qingcms.com/', '', 'qingcms.com', 'QingCms-轻内容管理系统，以微小说，笑话，短文资讯等类微博轻文本或图片为主要内容，可以帮助你轻松的打造清新休闲网站，系统构架健壮、灵活、开源', '1533839141', '1533839141', '0', '0');
INSERT INTO `pre_sites` (`id`, `uid`, `title`, `url`, `logo`, `host`, `summ`, `addtime`, `lasttime`, `is_del`, `is_https`) VALUES ('4', '0', 'QingMVC官方GitHub仓库', 'https://github.com/qingmvc', '', 'github.com', 'QingMVC官方GitHub仓库', '1533839174', '1533839174', '0', '1');
INSERT INTO `pre_sites` (`id`, `uid`, `title`, `url`, `logo`, `host`, `summ`, `addtime`, `lasttime`, `is_del`, `is_https`) VALUES ('5', '0', 'QingMVC框架-开源轻量级PHP框架', 'http://qingmvc.com/', '', 'qingmvc.com', 'QingMVC是一个开源轻量级框架 ，基于MVC和面向对象设计模式，使用Apache2开源协议，可以免费用于商业或个人项目。', '1533839238', '1533839238', '0', '0');
