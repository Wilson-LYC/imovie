/*
 Navicat Premium Data Transfer

 Source Server         : 本地MySQL
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : imovie

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 30/05/2023 13:25:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buy_type
-- ----------------------------
DROP TABLE IF EXISTS `buy_type`;
CREATE TABLE `buy_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '类别名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buy_type
-- ----------------------------
INSERT INTO `buy_type` VALUES (1, '在线观看');
INSERT INTO `buy_type` VALUES (2, '立即购票');

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '收藏记录id',
  `uid` int(0) NULL DEFAULT NULL COMMENT '用户id',
  `mid` int(0) NULL DEFAULT NULL COMMENT '电影id',
  `create_time` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES (37, 50, 2, '2023-05-27 19:23:56');
INSERT INTO `collection` VALUES (38, 50, 1, '2023-05-28 22:01:37');

-- ----------------------------
-- Table structure for film_criticism
-- ----------------------------
DROP TABLE IF EXISTS `film_criticism`;
CREATE TABLE `film_criticism`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '观影时间',
  `way` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '观影方式',
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '观影平台/影院',
  `score` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '评分',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '评论',
  `uid` int(0) NULL DEFAULT NULL COMMENT 'uid',
  `mid` int(0) NULL DEFAULT NULL COMMENT 'mid',
  `create_time` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of film_criticism
-- ----------------------------
INSERT INTO `film_criticism` VALUES (32, '', '', '', '10', '电影好好看', 50, 1, '2023-05-28 22:06:48');

-- ----------------------------
-- Table structure for movie_characteristic
-- ----------------------------
DROP TABLE IF EXISTS `movie_characteristic`;
CREATE TABLE `movie_characteristic`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '特色',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_characteristic
-- ----------------------------
INSERT INTO `movie_characteristic` VALUES (1, 'IMAX');
INSERT INTO `movie_characteristic` VALUES (2, '杜比');
INSERT INTO `movie_characteristic` VALUES (3, '中国巨幕');
INSERT INTO `movie_characteristic` VALUES (4, 'CINITY');
INSERT INTO `movie_characteristic` VALUES (5, '3D');
INSERT INTO `movie_characteristic` VALUES (6, '2D');

-- ----------------------------
-- Table structure for movie_info
-- ----------------------------
DROP TABLE IF EXISTS `movie_info`;
CREATE TABLE `movie_info`  (
  `mid` int(0) NOT NULL AUTO_INCREMENT COMMENT '电影id',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '电影名（中文）',
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '别名（外文名）',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '类型',
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '版本',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '语言',
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '时长',
  `origin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '片源地',
  `director` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '导演',
  `actor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '主演',
  `release_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '上映时间',
  `score_db` double NULL DEFAULT NULL COMMENT '豆瓣评分',
  `score_my` double NULL DEFAULT NULL COMMENT '猫眼评分',
  `score_tpp` double NULL DEFAULT NULL COMMENT '淘票票评分',
  `income` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '票房',
  `buy_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '购票/观影链接',
  `buy_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '在线观看or立即购票',
  `preview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '电影预告片',
  `introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '简介',
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '封面',
  `characteristic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '放映特色',
  PRIMARY KEY (`mid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_info
-- ----------------------------
INSERT INTO `movie_info` VALUES (1, '流浪地球2', 'The Wandering Earth Ⅱ', '科幻/冒险/灾难', 'IMAX 2D/杜比影院 2D/中国巨幕 2D/CINITY 2D', '普通话', '173分钟', '中国', '郭帆', '吴京、刘德华、李雪健、沙溢等', '2023-01-22 09:00', 8.3, 9.3, 9, '40.29 亿', 'https://www.iqiyi.com/v_1yzsojq1cg8.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', 'v.f42905.mp4', '<p>\r\n                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2044年至2058年，科学家们发现太阳正急速衰老、持续膨胀，数百年内将吞噬包括地球在内的整个太阳系。面临末日灾难与生命存续的双重挑战，联合政府成立，总部设立在美国纽约，但世界政局动荡不堪，人类纷纷自救但仍内斗不止，大大小小各种战争频发，伴随着重工业的无序扩张，世界一片荒芜，科技在重压下加速发展，人类转入以航天工业为主的计划经济社会，并举全球之力提出了数百个自救计划，其中以下四种计划进入方案论证阶段：\r\n                    </p>\r\n                    <ul>\r\n                        <li>移山计划：由中国提出，为流浪地球主体计划，计划建造1万座发动机推动地球走向新家园，行星发动机同步网络依赖原本是互联网的地下光纤，是利用网络切片形成的高密级发动机专用网络。</li>\r\n                        <li>方舟计划：由美国提出，在地球同步轨道建立“方舟号空间站”，利用空间站带领人类逃离太阳系，即“飞船派”，太空电梯是方舟计划的核心。</li>\r\n                        <li>方舟计划：由美国提出，在地球同步轨道建立“方舟号空间站”，利用空间站带领人类逃离太阳系，即“飞船派”，太空电梯是方舟计划的核心。</li>\r\n                        <li>逐月计划：由俄罗斯提出，初始的“逐月计划”是考虑到月球质量只有地球的1/81，体积是地球的1/49，自转角动能远远小于地球，刹车/推进耗费资源远小于地球，且氦-3储量丰富，因此期望改造月球作为天然逃生舱，带领人类离开家园。月球基地是逐月计划的核心，但是因为月球结构和大规模生态循环问题，最终发现月球不适合改造，被并入移山计划，计划放逐月球。</li>\r\n                        <li>逐月计划：由俄罗斯提出，初始的“逐月计划”是考虑到月球质量只有地球的1/81，体积是地球的1/49，自转角动能远远小于地球，刹车/推进耗费资源远小于地球，且氦-3储量丰富，因此期望改造月球作为天然逃生舱，带领人类离开家园。月球基地是逐月计划的核心，但是因为月球结构和大规模生态循环问题，最终发现月球不适合改造，被并入移山计划，计划放逐月球。</li>\r\n                    </ul>', 'p2885955777.webp', 'IMAX 3D');
INSERT INTO `movie_info` VALUES (2, '银河护卫队3', 'Guardians of the Galaxy Vol. 3', '喜剧/动作/科幻/惊悚/冒险', 'IMAX 3D/杜比影院 3D/中国巨幕 3D/CINITY 3D', '普通话/英语', '150分钟', '欧美', '詹姆斯·古恩', '克里斯·帕拉特、佐伊·索尔达娜等', '2023-05-05', 8.5, 9.3, 9.3, '5.03 亿', 'https://www.maoyan.com/cinemas?movieId=341224', '立即购票', '银河护卫队3.mp4', '银河护卫队成员们在“虚无知地”上安顿了下来。然而，由于火箭浣熊（布莱德利·库珀配音）的神秘往事侵扰，他们平静的生活很快被打破。“星爵”彼得·奎尔（克里斯·帕拉特饰）依然迷失在失去卡魔拉（佐伊·索尔达娜饰）的痛苦中，但是他必须团结起他的团队，前往执行一项危险的任务，只为营救火箭浣熊。如果这项任务失败，那么为人熟知的银河护卫队有可能就此走向终结。', 'p2889358680.webp', 'IMAX 3D/杜比影院 3D');
INSERT INTO `movie_info` VALUES (3, '速度与激情10', 'Fast X', '动作/悬疑/惊悚/犯罪/冒险', 'IMAX 3D/杜比影院 3D/中国巨幕 3D/CINITY 3D', '普通话英语', '141分钟', '欧美', '路易斯·莱特里尔', '范·迪塞尔/米歇尔·罗德里格兹等', '2023-05-17', 6.5, 8.9, 9, '5.44 亿', 'https://www.maoyan.com/cinemas?movieId=343035', '立即购票', '速度与激情10.mp4', '当家人们陷入危机，唐老大（范·迪塞尔 饰）为救飞车家族再度出山。终途启程，这场前所未有的疾速狂飙，你准备好了吗？', 'p2890967727.webp', 'IMAX 3D/杜比影院 3D');
INSERT INTO `movie_info` VALUES (4, '无名', 'Hidden Blade', '剧情/悬疑/历史', 'IMAX 2D/杜比影院 2D/中国巨幕 2D/CINITY 2D', '普通话/沪语/粤语/日语', '128分钟', '中国', '程耳', '梁朝伟/周迅/黄磊等', '2023-01-22', 6.6, 9, 9.2, '9.31 亿', 'https://www.iqiyi.com/v_14sswl58acc.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', '无名.mp4', '影片通过对上世纪二十年代开始奋斗在上海的中国共产党领导下的中共特科，在隐蔽战线与各方势力殊死较量过程的再现，表现了在走向胜利过程中不可或缺的党的秘密战线上那些无名英雄，他们不可取代的贡献。全面抗战爆发后，中国共产党领导的中共特科在上海周旋于重庆、汪伪、日本间谍机构之间，通过错综复杂的敌后情报系统，策反敌人，获取情报，诛杀汉奸，建立更广泛的统一战线，直至抗战胜利的前夜…...', 'p2886187418.webp', 'IMAX 2D/杜比影院 2D');
INSERT INTO `movie_info` VALUES (5, '寻梦环游记', 'Coco', '喜剧/动画/音乐/奇幻', '3D', '英语/西班牙语', '105分钟', '欧美', '李·昂克里奇/阿德里安·莫利纳', '阿德里安·莫利纳/马修·奥尔德里奇等', '2017-11-24', 9.1, 9.6, 9.4, '12.3 亿', 'https://www.iqiyi.com/v_19rrfqa6n8.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', '寻梦环游记.mp4', '一个鞋匠家庭出身的12岁墨西哥小男孩米格，自幼有一个音乐梦，但音赠舟厦乐却是被家庭所禁止的，他们认为自己被音乐诅咒了。在米格秘密追寻音乐梦时，因为触碰了一把吉他而踏上了亡灵土地。每年的亡灵节日，逝去的家人都会返回人间与亲人团聚，但从来还没有人去到过亡灵的世界。米格被多彩绚丽的亡灵世界所震达多户凝撼，而更令他的惊喜的是，他重逢了失去的太爷爷和祖辈们，一家人要想办法将米格重去舟艰新送回人间。', 'p2503997609.webp', '3D');
INSERT INTO `movie_info` VALUES (6, '疯狂动物城', 'Zootopia', '喜剧/动画/冒险', 'IMAX 3D/中国巨幕 3D', '英语/挪威语', '109分钟', '欧美', '拜伦·霍华德/瑞奇·摩尔/杰拉德·布什', '金妮弗·古德温/杰森·贝特曼等', '2016-03-04', 9.2, 9.5, 9.5, '15.32 亿', 'https://www.iqiyi.com/v_19rrluwf4o.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', '疯狂动物城.mp4', '一个现代化的动物都市，每种动物在这里都有自己的居所，有沙漠气候的撒哈拉广场、常年严寒的冰川镇等等，它就像一座大熔炉，动物们在这里和平共处——无论是大象还是小老鼠，只要努力，都能闯出一番名堂。兔子朱迪从小就梦想能成为动物城市的警察，尽管身边的所有人都觉得兔子不可能当上警察，但她还是通过自己的努力，跻身到了全是大块头动物城警察局，成为了第一个兔子警官。为了证明自己，她决心侦破一桩神秘案件。追寻真相的路上，朱迪迫使在动物城里以坑蒙拐骗为生的狐狸尼克帮助自己，却发现这桩案件背后隐藏着一个意欲颠覆动物城的巨大阴谋，他们不得不联手合作，去尝试揭开隐藏在这巨大阴谋后的真相 。', 'p2315672625.webp', 'IMAX 3D');
INSERT INTO `movie_info` VALUES (7, '神偷奶爸', 'Despicable Me', '喜剧/动画/冒险', '3D', '英语', '95分钟', '欧美', '皮埃尔·柯芬/克里斯·雷纳德', '史蒂夫·卡瑞尔/杰森·席格尔等', '2010-07-09', 8.7, 8.9, 8.6, '暂无', 'https://www.iqiyi.com/v_19rr7r6h3o.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', '神偷奶爸.mp4', '一直以来，自诩为全世界最让人胆战心惊的超级混蛋的格鲁 （ 史蒂夫·卡瑞尔 配音），始终觉得没有人可以阻挡他充满着邪恶趣味的前进脚步，可是当他才炼设鸦与3个小女孩的生命有所交集之后，他很快就意识到，自己即将面对的是有史以来最艰难的挑战。 在一个被白色的尖桩篱笆和茂盛的玫瑰花丛所包围的看似快乐祥和的郊外社区里，坐落着一座全黑色的大房子，周围则是死气沉沉且略显呆板的绿色草坪。周遭邻居所不知道的是，在这座房子的下面，有一个非常隐蔽的巨大的藏匿之处，里面竟然驻扎着一支用心极度险恶的小矮人军队，而他们的头头格鲁则正在计划整个人类历史上最疯狂的抢劫案——没错，他打算偷走月亮。 不管是在什么样的环境下，格鲁天生似乎就只对做一些不道德的坏事感兴趣，简直是越堕落越快乐……除此之外，他背后还有一个可怕的军械库的支持和武装，最擅长的就是发射缩小光线和冷冻光线。格鲁已经做好了最先进的战斗准备，无论是地面还是空中作业，他都有办法应付——他已懂欠辨经想好了，他会毫不犹豫地清除掉任何挡在自己前进路线上的人，不达目的誓不罢休。直到有一天，他遇到了3个来自于孤儿院的小女孩，白故腿并与她们共同结成的强大意志力发生了激烈的碰撞 。', 'p792776858.webp', '3D');
INSERT INTO `movie_info` VALUES (8, '唐人街探案', 'Detective Chinatown', '喜剧/动作/悬疑', '中国巨幕 2D', '普通话/英语/泰语', '135分钟', '中国', '陈思诚', '王宝强/刘昊然/佟丽娅等', '2015-12-31', 7.7, 9, 9, '8.23 亿', 'https://www.iqiyi.com/v_19rrl9vhkw.html', '在线观看', '唐人街探案.mp4', '天赋异禀的结巴少年“ 秦风”警校落榜，被姥姥遣送泰国找远房表舅——号称“唐人街第一神探 ”，实则“猥琐”大叔的“ 唐仁“散心。不想一夜花天酒地后，唐仁沦为离奇凶案嫌疑人，不得不和秦风亡命天涯，穷追不舍的警探——-“疯狗”黄兰登；无敌幸运的警察——“草包”坤泰；穷凶极恶、阴差阳错的“匪帮三人组”；高深莫测的“唐人街教父”；“美艳风骚老板娘”等悉数登场。辨陵订腿七天，唐仁、秦风这对“欢喜冤家”、“天作之合”必须取长补短、同仇敌忾，他们要在躲避警察追捕、匪帮追杀、黑帮围剿的同时，在短短“七天”内，完成找到“失落的黄金”、查明“真凶”、为他们“洗清罪名”这些“逆天”的任务。', 'p2302930556.webp', '中国巨幕');
INSERT INTO `movie_info` VALUES (9, '唐人街探案2', 'Detective Chinatown 2', '喜剧/动作/悬疑', 'IMAX 2D/中国巨幕 2D', '普通话/英语/日语/粤语', '121分钟', '中国', '陈思诚', '王宝强/刘昊然/肖央等', '2018-02-16', 6.6, 9, 8.9, '33.98 亿', 'https://www.iqiyi.com/v_19rr839kro.html', '在线观看', '唐人街探案2.mp4', '秦风接到唐仁的邀请来纽约参加其与阿香的婚礼。壕气逼人的唐仁迎接秦风，极尽招摇。岂料“婚礼”是唐仁为巨额奖金而参加的世界名侦大赛，比赛的内容是寻找杀害唐人街教父七叔的孙子的凶手。 受骗的秦风怒极欲走，却被纽约华人刑警陈英送来的讯息所吸引。七叔孙子的死法离奇，寻人上升为悬赏缉凶。“名侦探”们各显“其能”，鸡飞狗跳。众人调查的同时另一起案件发生，作案手法极其相似。原本锁定的凶手竟有了不在场证明，秦风不禁对自己的推理产生了怀疑。第三起案件发生连环案件。秦风、唐仁二人再次披挂，摆脱各路纠缠，闹翻纽约，几欲接近真相。第四起，与凶手失之交臂，诡计呼之欲出。真凶伏法，动机令人不寒而栗。看似完美结案的背后却隐藏着另一个发人深省的谜题 。', 'p2512717519.webp', 'IMAX 2D');
INSERT INTO `movie_info` VALUES (10, '唐人街探案3', 'Detective Chinatown 3', '喜剧/悬疑', 'IMAX 2D/中国巨幕 2D/杜比视界 2D', '普通话/日语/英语/泰语', '136分钟', '中国', '陈思诚', '王宝强/刘昊然/妻夫木聪等', '2021-02-12', 5.3, 8.8, 9, '45.2 亿', 'https://www.iqiyi.com/v_19rrcuh1jw.html', '在线观看', '唐人街探案3.mp4', '继曼谷、纽约之后，东京再出大案。唐人街神探唐仁（王宝强 饰）、秦风（刘昊然 饰）受侦探野田昊（妻夫木聪 饰）的邀请前往破案。“CRIMASTER世界侦探排行榜”中的侦探们闻讯后也齐聚东京，加入挑战，而排名第一Q的现身，让这个大案更加扑朔迷离，一场亚洲最强神探之间的较量即将爆笑展开……', 'p2622388913.webp', 'IMAX 2D');
INSERT INTO `movie_info` VALUES (11, '保你平安', 'Post Truth', '剧情/喜剧', 'IMAX 2D/中国巨幕 2D/CINITY 2D', '普通话', '112分钟', '中国', '大鹏', '大鹏/李雪琴/尹正/王迅等', '2023-03-10', 7.7, 9.3, 9.4, '7.0 亿', 'https://www.iqiyi.com/v_1vgjcs0l0yo.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01', '在线观看', '保你平安.mp4', '落魄中年魏平安以直播带货卖墓地为生，他的客户韩露过世后被造谣抹黑，魏平安路见不平，辟谣跑断腿，笑料频出，反转不断，而他自己也因此陷入到新的谣言和网暴之中。', 'p2889498097.webp', '中国巨幕');
INSERT INTO `movie_info` VALUES (12, '阿凡达：水之道', 'Avatar: The Way of Water', '动作/科幻/冒险', 'CINITY 3D/IMAX 3D/杜比影院 3D/中国巨幕 3D', '英语', '193分钟', '欧美', '詹姆斯·卡梅隆', '萨姆·沃辛顿/佐伊·索尔达娜等', '2022-12-16', 7.8, 9, 9.2, '17.0 亿', 'https://www.iqiyi.com/v_1xvgooktmdg.html?vfrm=pcw_playpage&vfrmblk=cloud_cinema_playlist&vfrmrst=0', '在线观看', '阿凡达：水之道.mp4', '《阿凡达：水之道》设定在上一部影片的剧情落幕十余年后，讲述了萨利一家（杰克、奈蒂莉和孩子们）的故事：危机未曾消散，一家人拼尽全力彼此守护、奋力求生，并历经艰险磨难。杰克和奈蒂莉组建了家庭，他们的孩子也逐渐成长，为这个家庭带来了许多欢乐。然而危机未曾消散，萨利一家拼尽全力彼此守护、奋力求生，最终来到潘多拉星球临海的岛礁族寻求庇护。岛礁族首领特诺瓦里与罗娜尔为萨利一家提供了庇护所，这个部族的成员都是天生的潜水好手，也和海洋中的各种生物建立了密切联系。拥有流线型身躯的蛇颈水兽就和前作中丛林部族的重铠马一样，是岛礁部族信赖的伙伴。在影片中，潘多拉更多奇特自然景观将会揭开神秘的面纱。碧蓝深邃的海底世界，前所未见的海洋物种，世外桃源一般的岛礁，《阿凡达：水之道》将呈现完全不同于前作的全新地貌，从以幽暗为主色调的雨林来到波澜壮阔的海洋，带来无比强烈的视觉冲击。《阿凡达：水之道》由詹姆斯·卡梅隆执导。詹姆斯·卡梅隆、里克·杰法和阿曼达·斯尔沃联合操刀编剧，故事则由詹姆斯·卡梅隆、里克·杰法、阿曼达·斯尔沃、乔什·弗莱曼和夏恩·萨雷诺共同完成。詹姆斯·卡梅隆和乔恩·兰道担任制片人，戴维·瓦尔德斯和里查德·贝纳姆出任执行制片人。《阿凡达：水之道》将于12月16日在影院上映。', 'p2884182275.webp', 'CINITY 3D');

-- ----------------------------
-- Table structure for movie_language
-- ----------------------------
DROP TABLE IF EXISTS `movie_language`;
CREATE TABLE `movie_language`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '类别名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_language
-- ----------------------------
INSERT INTO `movie_language` VALUES (1, '普通话');
INSERT INTO `movie_language` VALUES (2, '粤语');
INSERT INTO `movie_language` VALUES (3, '英语');
INSERT INTO `movie_language` VALUES (4, '日语');
INSERT INTO `movie_language` VALUES (5, '韩语');
INSERT INTO `movie_language` VALUES (6, '法语');
INSERT INTO `movie_language` VALUES (7, '德语');
INSERT INTO `movie_language` VALUES (8, '俄语');
INSERT INTO `movie_language` VALUES (9, '泰语');

-- ----------------------------
-- Table structure for movie_orgin
-- ----------------------------
DROP TABLE IF EXISTS `movie_orgin`;
CREATE TABLE `movie_orgin`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '片源地',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_orgin
-- ----------------------------
INSERT INTO `movie_orgin` VALUES (1, '中国');
INSERT INTO `movie_orgin` VALUES (2, '欧美');

-- ----------------------------
-- Table structure for movie_pic
-- ----------------------------
DROP TABLE IF EXISTS `movie_pic`;
CREATE TABLE `movie_pic`  (
  `pid` int(0) NOT NULL AUTO_INCREMENT COMMENT '海报id',
  `mid` int(0) NULL DEFAULT NULL COMMENT '所属电影',
  `path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '文件名',
  `like` int(0) NULL DEFAULT 0 COMMENT '点赞数',
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_pic
-- ----------------------------
INSERT INTO `movie_pic` VALUES (1, 1, 'p2885955777.webp', 7);
INSERT INTO `movie_pic` VALUES (2, 1, 'p2886492514.webp', 8);
INSERT INTO `movie_pic` VALUES (3, 1, 'p2886492520.webp', 2);
INSERT INTO `movie_pic` VALUES (4, 1, 'p2886547579.webp', 6);
INSERT INTO `movie_pic` VALUES (5, 1, 'p2886874068.webp', 1);
INSERT INTO `movie_pic` VALUES (6, 1, 'p2886547582.webp', 3);
INSERT INTO `movie_pic` VALUES (7, 2, 'p2889358680.webp', 0);
INSERT INTO `movie_pic` VALUES (8, 2, 'p2890165008.webp', 1);
INSERT INTO `movie_pic` VALUES (9, 2, 'p2891875313.webp', 0);
INSERT INTO `movie_pic` VALUES (10, 2, 'p2890633511.webp', 0);
INSERT INTO `movie_pic` VALUES (11, 2, 'p2891261995.webp', 0);
INSERT INTO `movie_pic` VALUES (12, 3, 'p2890967727.webp', 0);
INSERT INTO `movie_pic` VALUES (13, 3, 'p2891529838.webp', 0);
INSERT INTO `movie_pic` VALUES (14, 3, 'p2890967602.webp', 0);
INSERT INTO `movie_pic` VALUES (15, 4, 'p2886187418.webp', 0);
INSERT INTO `movie_pic` VALUES (16, 4, 'p2886702316.webp', 0);
INSERT INTO `movie_pic` VALUES (17, 4, 'p2886355706.webp', 0);
INSERT INTO `movie_pic` VALUES (18, 5, 'p2503997609.webp', 0);
INSERT INTO `movie_pic` VALUES (19, 5, 'p2505512585.webp', 0);
INSERT INTO `movie_pic` VALUES (20, 5, 'p2505512603.webp', 0);
INSERT INTO `movie_pic` VALUES (21, 5, 'p2505426440.webp', 0);
INSERT INTO `movie_pic` VALUES (22, 6, 'p2315672625.webp', 0);
INSERT INTO `movie_pic` VALUES (24, 6, 'p2321985914.webp', 0);
INSERT INTO `movie_pic` VALUES (25, 6, 'p2321985934.webp', 0);
INSERT INTO `movie_pic` VALUES (26, 6, 'p2321985925.webp', 0);
INSERT INTO `movie_pic` VALUES (27, 6, 'p2321985918.webp', 0);
INSERT INTO `movie_pic` VALUES (28, 6, 'p2321985911.webp', 0);
INSERT INTO `movie_pic` VALUES (29, 6, 'p2321985910.webp', 0);
INSERT INTO `movie_pic` VALUES (30, 6, 'p2321985904.webp', 0);
INSERT INTO `movie_pic` VALUES (31, 6, 'p2321985901.webp', 0);
INSERT INTO `movie_pic` VALUES (32, 7, 'p792776858.webp', 0);
INSERT INTO `movie_pic` VALUES (33, 7, 'p761757923.webp', 0);
INSERT INTO `movie_pic` VALUES (34, 7, 'p725931993.webp', 0);
INSERT INTO `movie_pic` VALUES (35, 7, 'p697155124.webp', 0);
INSERT INTO `movie_pic` VALUES (36, 7, 'p644417009.webp', 0);
INSERT INTO `movie_pic` VALUES (37, 8, 'p2302930556.webp', 0);
INSERT INTO `movie_pic` VALUES (38, 8, 'p2302925952.webp', 0);
INSERT INTO `movie_pic` VALUES (39, 8, 'p2302919452.webp', 0);
INSERT INTO `movie_pic` VALUES (40, 9, 'p2512717519.webp', 0);
INSERT INTO `movie_pic` VALUES (41, 9, 'p2642476495.webp', 0);
INSERT INTO `movie_pic` VALUES (42, 9, 'p2506695545.webp', 0);
INSERT INTO `movie_pic` VALUES (43, 9, 'p2506742977.webp', 0);
INSERT INTO `movie_pic` VALUES (44, 10, 'p2622388913.webp', 0);
INSERT INTO `movie_pic` VALUES (45, 10, 'p2622388983.webp', 1);
INSERT INTO `movie_pic` VALUES (46, 10, 'p2622388914.webp', 0);
INSERT INTO `movie_pic` VALUES (47, 10, 'p2622388912.webp', 1);
INSERT INTO `movie_pic` VALUES (48, 10, 'p2622388911.webp', 0);
INSERT INTO `movie_pic` VALUES (49, 10, 'p2622388882.webp', 0);
INSERT INTO `movie_pic` VALUES (50, 10, 'p2632860681.webp', 0);
INSERT INTO `movie_pic` VALUES (51, 1, 'p2886773577.webp', 0);
INSERT INTO `movie_pic` VALUES (52, 10, 'p2579995779.webp', 1);
INSERT INTO `movie_pic` VALUES (53, 10, 'p2631735545.webp', 0);
INSERT INTO `movie_pic` VALUES (54, 11, 'p2889498097.webp', 0);
INSERT INTO `movie_pic` VALUES (55, 11, 'p2888966333.webp', 0);
INSERT INTO `movie_pic` VALUES (56, 11, 'p2888088442.webp', 0);
INSERT INTO `movie_pic` VALUES (57, 12, '2109241156106055-0-lp.jpg', 0);
INSERT INTO `movie_pic` VALUES (58, 12, 'p2884182275.webp', 0);
INSERT INTO `movie_pic` VALUES (59, 12, 'p2884143863.webp', 0);
INSERT INTO `movie_pic` VALUES (60, 12, 'p2884143855.webp', 0);
INSERT INTO `movie_pic` VALUES (61, 12, 'p2884143854.webp', 0);

-- ----------------------------
-- Table structure for movie_type
-- ----------------------------
DROP TABLE IF EXISTS `movie_type`;
CREATE TABLE `movie_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '类别名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movie_type
-- ----------------------------
INSERT INTO `movie_type` VALUES (1, '动作');
INSERT INTO `movie_type` VALUES (2, '喜剧');
INSERT INTO `movie_type` VALUES (3, '科幻');
INSERT INTO `movie_type` VALUES (4, '灾难');
INSERT INTO `movie_type` VALUES (5, '动作');
INSERT INTO `movie_type` VALUES (6, '惊悚');
INSERT INTO `movie_type` VALUES (7, '剧情');
INSERT INTO `movie_type` VALUES (8, '冒险');
INSERT INTO `movie_type` VALUES (9, '动画');
INSERT INTO `movie_type` VALUES (10, '奇幻');
INSERT INTO `movie_type` VALUES (11, '悬疑');

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info`  (
  `uid` int(0) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '用户名',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '邮箱',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '密码',
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '头像',
  `create_time` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '注册时间',
  `introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '简介',
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '性别',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES (50, 'wilson', 'wilson_lyc@qq.com', '202cb962ac59075b964b07152d234b70', '1685120851_头像.png', '2023-05-25 17:06:52', '这个人很懒，什么都没有留下', '未知');
INSERT INTO `user_info` VALUES (51, '张三', 'wilson_lyc@foxmail.com', '202cb962ac59075b964b07152d234b70', 'default_avatar.png', '2023-05-29 00:07:09', '这个人很懒，什么都没有留下', '未知');

SET FOREIGN_KEY_CHECKS = 1;
