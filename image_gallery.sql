-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2015 at 11:22 AM
-- Server version: 5.6.20
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `image_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'admin', 'd6bf4bb9a66419380a7e8b034270d381');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE IF NOT EXISTS `user_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `tag` varchar(50) DEFAULT NULL,
  `image_url` varchar(50) DEFAULT NULL,
  `insta_user_id` varchar(100) DEFAULT NULL,
  `insta_img_id` varchar(100) DEFAULT NULL,
  `instagram_url` varchar(200) DEFAULT NULL,
  `insta_link` varchar(200) DEFAULT NULL,
  `insta_text` varchar(250) DEFAULT NULL,
  `image_order` int(11) DEFAULT '0',
  `is_active` tinyint(4) DEFAULT '1',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `tag`, `image_url`, `insta_user_id`, `insta_img_id`, `instagram_url`, `insta_link`, `insta_text`, `image_order`, `is_active`, `last_updated`) VALUES
(50, NULL, 'America', 'uploads/images/2015/03/14263991252846.jpg', '1744578026', '209452966268598718_6731501', 'http://scontent.cdninstagram.com/hphotos-xap1/outbound-distilleryimage10/t0.0-17/OBPTH/e45f64a8b1ab11e181bd12313817987b_7.jpg', 'https://instagram.com/p/LoIFzzl3m-/', '#BeverlyHills #California #America', 2, 1, '2015-03-15 05:58:47'),
(51, NULL, 'America', 'uploads/images/2015/03/14263991372629.jpg', '1744578026', '940972960053772718_217309143', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10914648_414519158716245_1070540647_n.jpg', 'https://instagram.com/p/0PAevzQMGu/', 'ÙŠØ§ Ø­ÙŠØ§Ø© Ø§Ù„Ø´Ù‚Ù‰ Ù…Ø¹ Ù‡Ø§Ù„Ø²Ø­Ù…Ù‡ Ø¹Ø§Ù„ØµØ¨Ø­ðŸ˜¡ðŸ˜¢', 3, 1, '2015-03-15 05:58:58'),
(52, NULL, 'America', 'uploads/images/2015/03/14263991505808.jpg', '1744578026', '941025553358671126_36465146', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11055479_1021786427849264_186233466_n.jpg', 'https://instagram.com/p/0PMcFIgk0W/', 'So awesome to run some rounds thru a 50 cal today! #Barrett #50cal #shockwaveinthedesert2015 #2a #america #arizona #killingcactus #guns #gunporn #funinthesun #ammo', 4, 1, '2015-03-15 05:59:12'),
(53, NULL, 'America', 'uploads/images/2015/03/14263991573949.jpg', '1744578026', '940949174396427849_144756574', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11018472_455533611278836_985508416_n.jpg', 'https://instagram.com/p/0O7EnrmJ5J/', '#today #in #newyork  #saturday #sunroof #manhattan #midtown #batterypark', 5, 1, '2015-03-15 05:59:19'),
(54, NULL, 'bangladesh', 'uploads/images/2015/03/14263991952595.jpg', '1744578026', '941023932726361658_233754846', 'http://scontent.cdninstagram.com/hphotos-xpa1/t51.2885-15/e15/10632095_335995876594126_1387287313_n.jpg', 'https://instagram.com/p/0PMEfzS746/', 'Life in the most densely populated place on Earth -not counting the Vatican City- is not easy #Dhaka #Bangladesh', 6, 1, '2015-03-15 05:59:58'),
(55, NULL, 'bangladesh', 'uploads/images/2015/03/14263992019519.jpg', '1744578026', '941023598490637397_19244820', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11049392_1561004867510161_1042796850_n.jpg', 'https://instagram.com/p/0PL_ohS1RV/', 'Think your living nice #Bangladesh #cribs', 7, 1, '2015-03-15 06:00:03'),
(56, NULL, 'bangladesh', 'uploads/images/2015/03/14263992065829.jpg', '1744578026', '941015309996875788_402751111', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11008224_1375619752762086_933233079_n.jpg', 'https://instagram.com/p/0PKHBQkWAM/', 'ðŸŒµðŸ‰Keep Calm & Go GreenðŸ‰ðŸŒµ\nðŸš©Miracle Garden | Dubai | U.A.EðŸš©\nâž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–âž–\n#miraclegardendubai #miraclegarden #flower #green #decor #dubai #mydubai #abudhabi #uae #instauae #instadubai #emira', 8, 1, '2015-03-15 06:00:08'),
(57, NULL, 'bangladesh', 'uploads/images/2015/03/14263992129037.jpg', '1744578026', '941009161393237007_213123802', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11005285_725809184204680_835437863_n.jpg', 'https://instagram.com/p/0PIti7O2wP/', 'when the sky was orange #dawn #trees #silhouette #earthporn #skyart #bangladesh', 9, 1, '2015-03-15 06:00:15'),
(58, NULL, 'bangladesh', 'uploads/images/2015/03/14263992218724.jpg', '1744578026', '941006398806519777_213123802', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11055586_1557150427878021_2029937408_n.jpg', 'https://instagram.com/p/0PIFWEO2_h/', '#dawn #trees #silhouette #natureporn #savar #bangladesh', 10, 1, '2015-03-15 06:00:23'),
(59, NULL, 'bangladesh', 'uploads/images/2015/03/14263992289922.jpg', '1744578026', '940245426420860025_471560016', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11007911_782119735213351_1923820367_n.jpg', 'https://instagram.com/p/0MbDvTgER5/', 'potions... #blue #yellow #preDrinks #friday #lka #srilanka', 11, 1, '2015-03-15 06:00:31'),
(60, NULL, 'bangladesh', 'uploads/images/2015/03/14265662764954.jpg', '1744578026', '942276638350280355_55770288', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11018526_424094784428155_1652195996_n.jpg', 'https://instagram.com/p/0To5w1BIaj/', 'Looking at my baby pics always cracks me up #iwassotiny#omg#babyme#bangladesh', 12, 1, '2015-03-17 04:24:40'),
(61, NULL, 'bangladesh', 'uploads/images/2015/03/14265665668231.jpg', '1744578026', '942376509435175038_32470919', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10665366_968134126538642_426182741_n.jpg', 'https://instagram.com/p/0T_nFBjmB-/', 'Abandoned flower! #Red #Flower #Unloved #Abandoned #Manikganj #Bangladesh #Morning #March #2015', 13, 1, '2015-03-17 04:29:28'),
(62, NULL, 'bangladesh', 'uploads/images/2015/03/14265665752730.jpg', '1744578026', '922664099337532066_393025315', 'http://scontent.cdninstagram.com/hphotos-xpa1/t51.2885-15/e15/1799773_796431180451656_572477086_n.jpg', 'https://instagram.com/p/zN9hwgBPKi/', '', 14, 1, '2015-03-17 04:29:37'),
(63, NULL, 'bangladesh', 'uploads/images/2015/03/14265669407805.jpg', '1744578026', '942012267057175892_1643580054', 'http://scontent.cdninstagram.com/hphotos-xpa1/t51.2885-15/e15/1515842_1447325378892276_850280735_n.jpg', 'https://instagram.com/p/0Ssyp4AN1U/', 'Singair mosque... A mosque from 15th century... Bagerhat, Bangladesh\n.\n#travel #traveler #traveling #travelbangladesh #Bangladesh #bangladeshi #icwow #explorer #adventure #weekend #travelfreak #bagerhat #heritage #oldmosque #historic', 15, 1, '2015-03-17 04:35:41'),
(64, NULL, 'bangladesh', 'uploads/images/2015/03/14265669615546.jpg', '1744578026', '941991319171867924_185133944', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11049259_878375875556364_1987043675_n.jpg', 'https://instagram.com/p/0SoB0ovaUU/', 'Local Taxi in Bangladesh #vsco #vscocam #vscohub #vscophile #vscogram #illgrammers #justgoshoot #fartoodope #vscgood #hotshotz #hypebeast #instafocus #exploreeverything #fartoodope #wearejuxt #instagood #igmasters #top_masters #igdaily #hotshotz #pro', 16, 1, '2015-03-17 04:36:03'),
(65, NULL, 'bangladesh', 'uploads/images/2015/03/14265669728295.jpg', '1744578026', '941955062567028329_1429298088', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11055976_1414261895544683_1908786781_n.jpg', 'https://instagram.com/p/0SfyOCsEZp/', 'Ø£Ù„ÙŠ Ù…ÙƒÙ‡ ÙˆØ¯Ø¹ØªÙƒÙ… Ø§Ù„Ù„Ù‡. ..', 17, 1, '2015-03-17 04:36:13'),
(66, NULL, 'bangladesh', 'uploads/images/2015/03/14265696854051.jpg', '1744578026', '800330174114470352_1117206957', 'http://scontent.cdninstagram.com/hphotos-xpf1/t51.2885-15/e15/10654841_746159845441455_331285444_n.jpg', 'https://instagram.com/p/sbWA2THpnQ/', 'Great time hiking yesterday, Mt Charleston', 18, 1, '2015-03-17 05:21:27'),
(67, NULL, 'bangladesh', 'uploads/images/2015/03/14265697245405.jpg', '1744578026', '794858058824981401_1117206957', 'http://scontent.cdninstagram.com/hphotos-xap1/t51.2885-15/e15/10643955_1488873158026067_1494272046_n.jpg', 'https://instagram.com/p/sH5zFzHpuZ/', 'Hiking up at Mt. Charleston', 19, 1, '2015-03-17 05:22:06'),
(68, NULL, 'bangladesh', 'uploads/images/2015/03/14265697395452.jpg', '1744578026', '942426377603353741_1565800098', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11008377_339698036235092_1812243914_n.jpg', 'https://instagram.com/p/0UK8wYAYyN/', '#quadbike #smallsize #alrightforbangladesh #125cc #bangladesh #sylhet', 20, 1, '2015-03-17 05:22:21'),
(69, NULL, 'bangladesh', 'uploads/images/2015/03/14265697455428.jpg', '1744578026', '942399837985673171_1540415354', 'http://scontent.cdninstagram.com/hphotos-xap1/t51.2885-15/e15/10299711_678364985598773_1001649226_n.jpg', 'https://instagram.com/p/0UE6jbhY_T/', 'One more beautiful morning. Every morning is beautiful. You just need to have the eye to see it.\n#vscocam #sunrays #sunrise #sunshine #clouds #climbing #HDR #morning #sun #Bandarban #Bangladesh #landscape', 21, 1, '2015-03-17 05:22:27'),
(70, NULL, 'bangladesh', 'uploads/images/2015/03/14265726019840.jpg', '1744578026', '942479375185456948_1722951002', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10665366_787567651339456_611409770_n.jpg', 'https://instagram.com/p/0UW_-OD680/', 'COMMITTED To Generate Income??\nOur Concept Are Very Simple.... Sharing The Opportunity With Others!\nU JOIN... I COMMIT!!\nCome.... Let''s Join Our Movement !\nBe Part Of Our Team..All We Do Is Win!\n\nDare To Join Us?\nBuzz me now!! 0172462729\n\n#pF #pfSoci', 22, 1, '2015-03-17 06:10:05'),
(71, NULL, 'bangladesh', 'uploads/images/2015/03/14265726248060.jpg', '1744578026', '796357595108383606_1117206957', 'http://scontent.cdninstagram.com/hphotos-xpa1/t51.2885-15/e15/10598570_1554766631418100_1164831276_n.jpg', 'https://instagram.com/p/sNOwNynpt2/', 'The White House, 9/2013', 23, 1, '2015-03-17 06:10:26'),
(72, NULL, 'bangladesh', 'uploads/images/2015/03/14265727311828.jpg', '1744578026', '942441263293389614_1736939469', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11024105_652096564913877_165869860_n.jpg', 'https://instagram.com/p/0UOVXwRdsu/', 'COMMITTED To Generate Income??\nOur Concept Are Very Simple.... Sharing The Opportunity With Others!\nU JOIN... I COMMIT!!\nCome.... Let''s Join Our Movement !\nBe Part Of Our Team..All We Do Is Win!\n\nDare To Join Us?\nBuzz me now!!\n0146762286\n\n#pF #pfSoci', 24, 1, '2015-03-17 06:12:13'),
(73, NULL, 'bangladesh', 'uploads/images/2015/03/14265754743557.jpg', '1744578026', '942470944713085037_1364269099', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11049167_852376261474982_593266570_n.jpg', 'https://instagram.com/p/0UVFSuwBBt/', 'I will lay by your side & make sure you''re alright ðŸ’•âœ¨ðŸŒ… #dawn #breakingdawn #morning #sky #sun #nofilter #beauty #nature #amazing #earlybird #followforfollow #love #tweetgram #bangladesh #dhakagraam #me #girl #likeforlike #followme #bengali #p', 26, 1, '2015-03-17 06:57:55'),
(74, NULL, 'bangladesh', 'uploads/images/2015/03/14265754855185.jpg', '1744578026', '942453742400570727_1496950384', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11049153_637499239717344_337669130_n.jpg', 'https://instagram.com/p/0URK91BgVn/', 'Tigers are coming!!!! ', 27, 1, '2015-03-17 06:58:07'),
(75, NULL, 'bangladesh', 'uploads/images/2015/03/14265857517488.jpg', '1744578026', '920528283549312771_332032568', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/10979663_714705735314168_18962856_n.jpg', 'https://instagram.com/p/zGX5jCqCcD/', 'This is just a simple song, that I''ve made for you on my own, ðŸ° there''s no hidden meaning you know, when I say I love you honey! ðŸŒ¹ please believe I really do. | Aimer, c''est savoir dire je t''aime sans parler! \nHappy Valentine''s Day! â¤', 28, 1, '2015-03-17 09:49:13'),
(76, NULL, 'bangladesh', 'uploads/images/2015/03/14265857583000.jpg', '1744578026', '941924370805405249_1090192284', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10004184_997063166987758_867849868_n.jpg', 'https://instagram.com/p/0SYzmHI7ZB/', '', 29, 1, '2015-03-17 09:49:19'),
(77, NULL, 'bangladesh', 'uploads/images/2015/03/14265857723644.jpg', '1744578026', '942572541627156855_1364308665', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10919254_622279947873282_1084054300_n.jpg', 'https://instagram.com/p/0UsLuOuUl3/', '#voicesofbangla #everydaybangladesh #naturalbangladesh #ig_bangladesh_official  #ig_bangladesh  #bangladesh #ig_great_pics  #igrepresent  #igbest_shotz  #ig_eurasia  #igshowtime  #ig_cosmopolitan  #ig_livorno_  #ig_closeups  #ig_shotz  #ig_mood  #ig_', 30, 1, '2015-03-17 09:49:35'),
(78, NULL, 'bangladesh', 'uploads/images/2015/03/14265859501708.jpg', '1744578026', '942585325017532755_706232721', 'http://scontent.cdninstagram.com/hphotos-xfp1/t51.2885-15/e15/10520329_811869902225924_1803517590_n.jpg', 'https://instagram.com/p/0UvFvsKolT/', 'Bengalske torvehaller? :) #indkÃ¸bsoplevelser #Bangladesh', 31, 1, '2015-03-17 09:52:33'),
(79, NULL, 'bangladesh', 'uploads/images/2015/03/14265859689288.jpg', '1744578026', '942578548892009120_771976823', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/10956736_790522731033834_1711067630_n.jpg', 'https://instagram.com/p/0UtjI7nIKg/', '#bazaar #bangladesh Friggin empty, I''ve never seen it this empty :O', 32, 1, '2015-03-17 09:52:49'),
(80, NULL, 'bangladesh', 'uploads/images/2015/03/14265860131834.jpg', '1744578026', '942539576861327123_575716086', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11049264_1384354658552016_1646692500_n.jpg', 'https://instagram.com/p/0UksBZkP8T/', 'å­ŸåŠ æ‹‰æœè£…åŽ‚ #Bangladesh #garment', 33, 1, '2015-03-17 09:53:36'),
(81, NULL, 'bangladesh', 'uploads/images/2015/03/14265860249901.jpg', '1744578026', '942548792680460662_1478938147', 'http://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-15/e15/11008290_742376212543261_965002622_n.jpg', 'https://instagram.com/p/0UmyITMTF2/', '#Bangladesh #National_flag #Pride', 34, 1, '2015-03-17 09:53:47'),
(82, NULL, 'bangladesh', 'uploads/images/2015/03/14265861284752.jpg', '1744578026', '942582692940777769_706232721', 'http://scontent.cdninstagram.com/hphotos-xap1/t51.2885-15/e15/10296888_660129964112534_1386752429_n.jpg', 'https://instagram.com/p/0UufcYKokp/', 'Banglamarked part 2: fem friske fisk pÃ¥ et fladt frisk-fiske fad :) #hvembehÃ¸verkÃ¸lediske? #Bangladesh #faktaerkedelig', 35, 1, '2015-03-17 09:55:30'),
(83, NULL, 'bangladesh', 'uploads/images/2015/03/14265865201931.jpg', '1744578026', '942579038739115842_26619490', 'http://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/e15/11007890_1635623683332401_1092830049_n.jpg', 'https://instagram.com/p/0UtqRIxi9C/', '#Bangladesh #Dhaka #LouisKahn', 36, 1, '2015-03-17 10:02:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
