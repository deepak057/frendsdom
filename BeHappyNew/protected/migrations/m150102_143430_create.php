<?php

class m150102_143430_create extends CDbMigration
{
	public function up()
	{
      
//********************** create table command for audios table **********************//     


    Yii::app()->db->createCommand(

	   "CREATE TABLE IF NOT EXISTS `audios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `duration` bigint(20) unsigned DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `uploading_date` datetime DEFAULT NULL,
  `audio_id` varchar(100) NOT NULL,
  `uploaded_by` bigint(20) unsigned NOT NULL,
  `views` bigint(20) unsigned NOT NULL DEFAULT '0',
  `last_watched` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `marked_by` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39"

    	)->query();


    //********************** create table command for battles table **********************//

    Yii::app()->db->createCommand(

   "CREATE TABLE IF NOT EXISTS `battles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `audio_id` varchar(50) DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `gamenumber` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `marked_by` text NOT NULL,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `battle_type` enum('public','private','protected') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
 )  ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1471415007351"

    	)->query();


    //********************** create table command for battle_trackking_session table **********************//

    Yii::app()->db->createCommand(

    	'CREATE TABLE IF NOT EXISTS `battle_trackking_session` (
  `content_id` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'

    	)->query();

     //********************** create table command for battle_user_settings_map table **********************//


    Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `battle_user_settings_map` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) unsigned NOT NULL,
  `bid` bigint(20) unsigned NOT NULL,
  `is_dark` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('B','V') NOT NULL DEFAULT 'B',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56"

    	)->query();


    //********************** create table command for comments table **********************//

    Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `audio_id` varchar(50) NOT NULL,
  `is_dark` enum('0','1') NOT NULL DEFAULT '0',
  `marked_by` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203"

    	)->query();


     //********************** create table command for comment_session table **********************//


    Yii::app()->db->createCommand(

    	'CREATE TABLE IF NOT EXISTS `comment_session` (
  `uid` bigint(20) unsigned NOT NULL,
  `comments` text,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'

    	)->query();
    
    
    //********************** create table command for countries table **********************//


    Yii::app()->db->createCommand(


    	'CREATE TABLE IF NOT EXISTS `countries` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `country` varchar(100) NOT NULL,
       PRIMARY KEY (`id`),
       UNIQUE KEY `country` (`country`)
       ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195'

    	)->query();

    //********************** insert command for countries table **********************//
        


       Yii::app()->db->createCommand(
       	
       	"INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Albania'),
(2, 'Algeria'),
(3, 'Andorra'),
(4, 'Angola'),
(5, 'Anguilla'),
(6, 'Antarctica'),
(7, 'Antigua'),
(8, 'Antilles'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Aruba'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaijan'),
(15, 'Bahamas'),
(16, 'Bangladesh'),
(17, 'Barbados'),
(18, 'Belarus'),
(19, 'Belgium'),
(20, 'Belize'),
(21, 'Benin'),
(22, 'Bermuda'),
(23, 'Bhutan'),
(24, 'Bolivia'),
(25, 'Bosnia'),
(26, 'Botswana'),
(27, 'Brazil'),
(28, 'Brunei'),
(29, 'Bulgaria'),
(30, 'Burkina Faso'),
(31, 'Burundi'),
(32, 'Cambodia'),
(33, 'Cameroon'),
(34, 'Canada'),
(35, 'Cape Verde'),
(36, 'Cayman Islands'),
(37, 'Central Africa'),
(38, 'Chad'),
(39, 'Chile'),
(40, 'China'),
(41, 'Colombia'),
(42, 'Comoros'),
(43, 'Congo'),
(44, 'Cook Islands'),
(45, 'Costa Rica'),
(46, 'Cote D''Ivoire'),
(47, 'Croatia'),
(48, 'Cuba'),
(49, 'Cyprus'),
(50, 'Czech Republic'),
(51, 'Denmark'),
(52, 'Djibouti'),
(53, 'Dominica'),
(54, 'Dominican Rep.'),
(55, 'Ecuador'),
(56, 'Egypt'),
(57, 'El Salvador'),
(58, 'Eritrea'),
(59, 'Estonia'),
(60, 'Ethiopia'),
(61, 'Falkland Islands'),
(62, 'Fiji'),
(63, 'Finland'),
(64, 'France'),
(65, 'Gabon'),
(66, 'Gambia'),
(67, 'Georgia'),
(68, 'Germany'),
(69, 'Ghana'),
(70, 'Gibraltar'),
(71, 'Greece'),
(72, 'Greenland'),
(73, 'Grenada'),
(74, 'Guam'),
(75, 'Guatemala'),
(76, 'Guiana'),
(77, 'Guinea'),
(78, 'Guyana'),
(79, 'Haiti'),
(80, 'Hondoras'),
(81, 'Hong Kong'),
(82, 'Hungary'),
(83, 'Iceland'),
(84, 'India'),
(85, 'Indonesia'),
(86, 'Iran'),
(87, 'Iraq'),
(88, 'Ireland'),
(89, 'Israel'),
(90, 'Italy'),
(91, 'Jamaica'),
(92, 'Japan'),
(93, 'Jordan'),
(94, 'Kazakhstan'),
(95, 'Kenya'),
(96, 'Kiribati'),
(97, 'Korea'),
(98, 'Kyrgyzstan'),
(99, 'Lao'),
(100, 'Latvia'),
(101, 'Lesotho'),
(102, 'Liberia'),
(103, 'Liechtenstein'),
(104, 'Lithuania'),
(105, 'Luxembourg'),
(106, 'Macau'),
(107, 'Macedonia'),
(108, 'Madagascar'),
(109, 'Malawi'),
(110, 'Malaysia'),
(111, 'Maldives'),
(112, 'Mali'),
(113, 'Malta'),
(114, 'Marshal Islands'),
(115, 'Martinique'),
(116, 'Mauritania'),
(117, 'Mauritius'),
(118, 'Mayotte'),
(119, 'Mexico'),
(120, 'Micronesia'),
(121, 'Moldova'),
(122, 'Monaco'),
(123, 'Mongolia'),
(124, 'Montserrat'),
(125, 'Morocco'),
(126, 'Mozambique'),
(127, 'Myanmar'),
(128, 'Namibia'),
(129, 'Nauru'),
(130, 'Nepal'),
(131, 'Netherlands'),
(132, 'New Caledonia'),
(133, 'New Guinea'),
(134, 'New Zealand'),
(135, 'Nicaragua'),
(136, 'Nigeria'),
(137, 'Niue'),
(138, 'Norfolk Island'),
(139, 'Norway'),
(140, 'Palau'),
(141, 'Panama'),
(142, 'Paraguay'),
(143, 'Peru'),
(144, 'Philippines'),
(145, 'Poland'),
(146, 'Polynesia'),
(147, 'Portugal'),
(148, 'Puerto'),
(149, 'Romania'),
(150, 'Russia'),
(151, 'Rwanda'),
(152, 'Saint Lucia'),
(153, 'Samoa'),
(154, 'San Marino'),
(155, 'Senegal'),
(156, 'Seychelles'),
(157, 'Sierra Leone'),
(158, 'Singapore'),
(159, 'Slovakia'),
(160, 'Slovenia'),
(161, 'Somalia'),
(162, 'South Africa'),
(163, 'Spain'),
(164, 'Sri Lanka'),
(165, 'St. Helena'),
(166, 'Sudan'),
(167, 'Suriname'),
(168, 'Swaziland'),
(169, 'Sweden'),
(170, 'Switzerland'),
(171, 'Taiwan'),
(172, 'Tajikistan'),
(173, 'Tanzania'),
(174, 'Thailand'),
(175, 'Togo'),
(176, 'Tokelau'),
(177, 'Tonga'),
(178, 'Trinidad'),
(179, 'Tunisia'),
(180, 'Turkey'),
(181, 'Uganda'),
(182, 'Ukraine'),
(183, 'United Kingdom'),
(184, 'United States'),
(185, 'Uruguay'),
(186, 'Uzbekistan'),
(187, 'Vanuatu'),
(188, 'Venezuela'),
(189, 'Vietnam'),
(190, 'Virgin Islands'),
(191, 'Yugoslavia'),
(192, 'Zaire'),
(193, 'Zambia'),
(194, 'Zimbabwe')"
       	
       	)->query();






    //********************** create table command for directories table **********************//

        Yii::app()->db->createCommand(

        	'CREATE TABLE IF NOT EXISTS `directories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=755'

        	)->query(); 



    //********************** insert command for directories table **********************//

        Yii::app()->db->createCommand(

       

"INSERT INTO `directories` (`id`, `item`, `parent`) VALUES
(1, 'HOME', NULL),
(2, 'NFL', NULL),
(3, 'NCAAF', NULL),
(4, 'NBA', NULL),
(5, 'NCAAB', NULL),
(6, 'MLB', NULL),
(7, 'NHL', NULL),
(8, 'MMA', NULL),
(9, 'SOCCER', NULL),
(10, 'OTHER', NULL),
(11, 'ATHLETES', NULL),
(12, 'MY FAVORITES', NULL),
(20, 'General', 2),
(21, 'NFC', 2),
(22, 'East', 21),
(23, 'Dallas Cowboys', 22),
(24, 'New York Giants', 22),
(25, 'Philadelphia Eagles', 22),
(26, 'Washington Redskins', 22),
(27, 'North', 21),
(28, 'Chicago Bears', 27),
(29, 'Detroit Lions', 27),
(30, 'Green Bay Packers', 27),
(31, 'Minnesota Vikings', 27),
(32, 'South', 21),
(33, 'Atlanta Falcons', 32),
(34, 'Carolina Panthers', 32),
(35, 'New Orleans Saints', 32),
(36, 'Tampa Bay Bucs', 32),
(37, 'West', 21),
(38, 'Arizona Cardinals', 37),
(39, 'San Francisco 49ers', 37),
(40, 'Seattle Seahawks', 37),
(41, 'St. Louis Rams', 37),
(42, 'AFC', 2),
(43, 'East', 42),
(44, 'Buffalo Bills', 43),
(45, 'Miami Dolphins', 43),
(46, 'New England Patriots', 43),
(47, 'New York Jets', 43),
(48, 'North', 42),
(49, 'Baltimore Ravens', 48),
(50, 'Cincinnati Bengals', 48),
(51, 'Pittsburgh Steelers', 48),
(52, 'Cleveland Browns', 48),
(53, 'South', 42),
(54, 'Houston Texans', 53),
(55, 'Indianapolis Colts', 53),
(56, 'Jacksonville Jaguars', 53),
(57, 'Tennessee Titans', 53),
(58, 'West', 42),
(59, 'Denver Broncos', 58),
(60, 'Kansas City Chiefs', 58),
(61, 'Oakland Raiders', 58),
(62, 'San Diego Chargers', 58),
(63, 'General', 3),
(64, 'American Athletic', 3),
(65, 'Cincinnati', 64),
(66, 'Connecticut', 64),
(67, 'East Carolina', 64),
(68, 'Houston', 64),
(69, 'Memphis', 64),
(70, 'South Florida', 64),
(71, 'SMU', 64),
(72, 'Temple', 64),
(73, 'Tulane', 64),
(74, 'Tulsa', 64),
(75, 'UCF', 64),
(76, 'ACC', 3),
(77, 'Atlantic Division', 76),
(78, 'Boston College', 77),
(79, 'Clemson', 77),
(80, 'Florida State', 77),
(81, 'Louisville', 77),
(82, 'North Carolina State', 77),
(83, 'Syracuse', 77),
(84, 'Wake Forest', 77),
(85, 'Coastal Division', 76),
(86, 'Duke', 85),
(87, 'Georgia Tech', 85),
(88, 'Miami (Fla.)', 85),
(89, 'North Carolina', 85),
(90, 'Pittsburgh', 85),
(91, 'Virginia', 85),
(92, 'Virginia Tech', 85),
(93, 'Big Ten', 3),
(94, 'East Division', 93),
(95, 'Indiana', 94),
(96, 'Maryland', 94),
(97, 'Michigan', 94),
(98, 'Michigan State', 94),
(99, 'Ohio State', 94),
(100, 'Penn State', 94),
(101, 'Rutgers', 94),
(102, 'West Division', 93),
(103, 'Illinois', 102),
(104, 'Iowa', 102),
(105, 'Minnesota', 102),
(106, 'Nebraska', 102),
(107, 'Northwestern', 102),
(108, 'Purdue', 102),
(109, 'Wisconsin', 102),
(110, 'Big 12', 3),
(111, 'Baylor', 110),
(112, 'Iowa State', 110),
(113, 'Kansas', 110),
(114, 'Kansas State', 110),
(115, 'Oklahoma', 110),
(116, 'Oklahoma State', 110),
(117, 'TCU', 110),
(118, 'Texas', 110),
(119, 'Texas Tech', 110),
(120, 'West Virginia', 110),
(121, 'Conference USA', 3),
(122, 'East Division', 121),
(123, 'Florida Atlantic', 122),
(124, 'Florida International', 122),
(125, 'Marshall', 122),
(126, 'Middle Tennessee', 122),
(127, 'Old Dominion', 122),
(128, 'UAB', 122),
(129, 'Western Kentucky', 122),
(130, 'West Division', 121),
(131, 'Louisiana Tech', 130),
(132, 'North Texas', 130),
(133, 'Rice', 130),
(134, 'Southern Mississippi', 130),
(135, 'UTEP', 130),
(136, 'UTSA', 130),
(137, 'FBS Independents', 3),
(138, 'Army', 137),
(139, 'Brigham Young', 137),
(140, 'Navy', 137),
(141, 'Notre Dame', 137),
(142, 'MAC', 3),
(143, 'East Division', 142),
(144, 'Akron', 143),
(145, 'Bowling Green', 143),
(146, 'Buffalo', 143),
(147, 'Kent State', 143),
(148, 'Massachusetts', 143),
(149, 'Miami (Ohio)', 143),
(150, 'Ohio', 143),
(151, 'West Division', 142),
(152, 'Ball State', 151),
(153, 'Central Michigan', 151),
(154, 'Eastern Michigan', 151),
(155, 'Northern Illinois', 151),
(156, 'Toledo', 151),
(157, 'Western Michigan', 151),
(158, 'Mountain West', 3),
(159, 'Mountain Division', 158),
(160, 'Air Force', 159),
(161, 'Boise State', 159),
(162, 'Colorado State', 159),
(163, 'New Mexico', 159),
(164, 'Utah State', 159),
(165, 'Wyoming', 159),
(166, 'West Division', 158),
(167, 'Fresno State', 166),
(168, 'Hawaii', 166),
(169, 'Nevada', 166),
(170, 'San Diego State', 166),
(171, 'San Jose State', 166),
(172, 'UNLV', 166),
(173, 'Pac-12', 3),
(174, 'North Division', 173),
(175, 'California', 174),
(176, 'Oregon', 174),
(177, 'Oregon State', 174),
(178, 'Stanford', 174),
(179, 'Washington', 174),
(180, 'Washington State', 174),
(181, 'South Division', 173),
(182, 'Arizona', 181),
(183, 'Arizona State', 181),
(184, 'Colorado', 181),
(185, 'USC', 181),
(186, 'UCLA', 181),
(187, 'Utah', 181),
(188, 'SEC', 3),
(189, 'East Division', 188),
(190, 'Florida', 189),
(191, 'Georgia', 189),
(192, 'Kentucky', 189),
(193, 'Missouri', 189),
(194, 'South Carolina', 189),
(195, 'Tennessee', 189),
(196, 'Vanderbilt', 189),
(197, 'West Division', 188),
(198, 'Alabama', 197),
(199, 'Arkansas', 197),
(200, 'Auburn', 197),
(201, 'LSU', 197),
(202, 'Mississippi State', 197),
(203, 'Ole Miss', 197),
(204, 'Texas A&M', 197),
(205, 'Sun Belt', 3),
(206, 'Appalachian State', 205),
(207, 'Arkansas State', 205),
(208, 'Georgia Southern', 205),
(209, 'Georgia State', 205),
(210, 'Idaho', 205),
(211, 'Louisiana-Monroe', 205),
(212, 'New Mexico State', 205),
(213, 'South Alabama', 205),
(214, 'Texas State', 205),
(215, 'Troy', 205),
(216, 'UL Lafayette', 205),
(217, 'General', 4),
(218, 'Eastern Conference', 4),
(219, 'Atlantic', 218),
(220, 'Boston Celtics', 219),
(221, 'Brooklyn Nets', 219),
(222, 'New York Knicks', 219),
(223, 'Philadelphia 76ers', 219),
(224, 'Toronto Raptors', 219),
(225, 'Central', 218),
(226, 'Chicago Bulls', 225),
(227, 'Cleveland Cavaliers', 225),
(228, 'Detroit Pistons', 225),
(229, 'Indiana Pacers', 225),
(230, 'Milwaukee Bucks', 225),
(231, 'Southeast', 218),
(232, 'Atlanta Hawks', 231),
(233, 'Charlotte Hornets', 231),
(234, 'Miami Heat', 231),
(235, 'Orlando Magic', 231),
(236, 'Washington Wizards', 231),
(237, 'Western Conference', 4),
(238, 'Southwest', 237),
(239, 'Dallas Mavericks', 238),
(240, 'Houston Rockets', 238),
(241, 'Memphis Grizzlies', 238),
(242, 'New Orleans Pelicans', 238),
(243, 'San Antonio Spurs', 238),
(244, 'Northwest', 237),
(245, 'Denver Nuggets', 244),
(246, 'Minnesota Timberwolves', 244),
(247, 'Portland Trail Blazers', 244),
(248, 'Oklahoma City Thunder', 244),
(249, 'Utah Jazz', 244),
(250, 'Pacific', 237),
(251, 'Golden State Warriors', 250),
(252, 'Los Angeles Clippers', 250),
(253, 'Los Angeles Lakers', 250),
(254, 'Phoenix Suns', 250),
(255, 'Sacramento Kings', 250),
(256, 'General', 5),
(257, 'American Athletic', 5),
(258, 'Cincinnati', 257),
(259, 'Connecticut', 257),
(260, 'Houston', 257),
(261, 'Louisville', 257),
(262, 'Memphis', 257),
(263, 'Rutgers', 357),
(264, 'South Florida', 257),
(265, 'SMU', 257),
(266, 'Temple', 257),
(267, 'UCF', 257),
(268, 'America East', 5),
(269, 'Albany', 268),
(270, 'Binghamton', 268),
(271, 'Hartford', 268),
(272, 'Maine', 268),
(273, 'UMBC', 268),
(274, 'New Hampshire', 268),
(275, 'Stony Brook', 268),
(276, 'UMass Lowell', 268),
(277, 'Vermont', 268),
(278, 'ACC', 5),
(279, 'Boston College', 278),
(280, 'Clemson', 278),
(281, 'Duke', 278),
(282, 'Florida State', 278),
(283, 'Georgia Tech', 278),
(284, 'Maryland', 357),
(285, 'Miami (Fla.)', 278),
(286, 'NC State', 278),
(287, 'North Carolina', 278),
(288, 'Notre Dame', 278),
(289, 'Pittsburgh', 278),
(290, 'Syracuse', 278),
(291, 'Virginia', 278),
(292, 'Virginia Tech', 278),
(293, 'Wake Forest', 278),
(294, 'Atlantic Sun', 5),
(295, 'E. Tennessee State', 294),
(296, 'Florida Gulf Coast', 294),
(297, 'Jacksonville', 294),
(298, 'Kennesaw State', 294),
(299, 'Lipscomb', 294),
(300, 'Mercer', 294),
(301, 'North Florida', 294),
(302, 'Northern Kentucky', 294),
(303, 'South Carolina Upstate', 294),
(304, 'Stetson', 294),
(305, 'Atlantic 10', 5),
(306, 'Dayton', 305),
(307, 'Duquesne', 305),
(308, 'Fordham', 305),
(309, 'George Mason', 305),
(310, 'George Washington', 305),
(311, 'La Salle', 305),
(312, 'Massachusetts', 305),
(313, 'Rhode Island', 305),
(314, 'Richmond', 305),
(315, 'Saint Joseph''s', 305),
(316, 'Saint Louis', 305),
(317, 'St. Bonaventure', 305),
(318, 'VCU', 305),
(319, 'Big East', 5),
(320, 'Butler', 319),
(321, 'Creighton', 319),
(322, 'DePaul', 319),
(323, 'Georgetown', 319),
(324, 'Marquette', 319),
(325, 'Providence', 319),
(326, 'Seton Hall', 319),
(327, 'St. John''s', 319),
(328, 'Villanova', 319),
(329, 'Xavier', 319),
(330, 'Big Sky', 5),
(331, 'Eastern Washington', 330),
(332, 'Idaho State', 330),
(333, 'Montana', 330),
(334, 'Montana State', 330),
(335, 'North Dakota', 330),
(336, 'Northern Arizona', 330),
(337, 'Northern Colorado', 330),
(338, 'Portland State', 330),
(339, 'Sacramento State', 330),
(340, 'Southern Utah', 330),
(341, 'Weber State', 330),
(342, 'Big South', 5),
(343, 'South', 342),
(344, 'Charleston Southern', 343),
(345, 'Coastal Carolina', 343),
(346, 'Gardner-Webb', 343),
(347, 'UNC-Asheville', 343),
(348, 'Presbyterian', 343),
(349, 'Winthrop', 343),
(350, 'North', 342),
(351, 'Campbell', 350),
(352, 'High Point', 350),
(353, 'Liberty', 350),
(354, 'Longwood', 350),
(355, 'Radford', 350),
(356, 'VMI', 350),
(357, 'Big Ten', 5),
(358, 'Illinois', 357),
(359, 'Indiana', 357),
(360, 'Iowa', 357),
(361, 'Michigan State', 357),
(362, 'Michigan', 357),
(363, 'Minnesota', 357),
(364, 'Nebraska', 357),
(365, 'Northwestern', 357),
(366, 'Ohio State', 357),
(367, 'Penn State', 357),
(368, 'Purdue', 357),
(369, 'Wisconsin', 357),
(370, 'Big 12', 5),
(371, 'Baylor', 370),
(372, 'Iowa State', 370),
(373, 'Kansas', 370),
(374, 'Kansas State', 370),
(375, 'Oklahoma', 370),
(376, 'Oklahoma State', 370),
(377, 'TCU', 370),
(378, 'Texas', 370),
(379, 'Texas Tech', 370),
(380, 'West Virginia', 370),
(381, 'Big West', 5),
(382, 'Cal Poly', 381),
(383, 'Cal State Fullerton', 381),
(384, 'UC Davis', 381),
(385, 'UC Riverside', 381),
(386, 'Hawaii', 381),
(387, 'Long Beach State', 381),
(388, 'Cal State Northridge', 381),
(389, 'Santa Barbara', 381),
(390, 'UC Irvine', 381),
(391, 'Colonial', 5),
(392, 'College of Charleston', 391),
(393, 'Delaware', 391),
(394, 'Drexel', 391),
(395, 'Hofstra', 391),
(396, 'James Madison', 391),
(397, 'UNC-Wilmington', 391),
(398, 'Northeastern', 391),
(399, 'Towson', 391),
(400, 'William & Mary', 391),
(401, 'Conference USA', 5),
(402, 'Charlotte', 401),
(403, 'East Carolina', 401),
(404, 'Florida Atlantic', 401),
(405, 'Florida International', 401),
(406, 'Louisiana Tech', 401),
(407, 'Marshall', 401),
(408, 'Middle Tennessee', 401),
(409, 'North Texas', 401),
(410, 'Old Dominion', 401),
(411, 'Rice', 401),
(412, 'Southern Miss', 401),
(413, 'UTEP', 401),
(414, 'UTSA', 401),
(415, 'Tulane', 401),
(416, 'Tulsa', 401),
(417, 'UAB', 401),
(418, 'Horizon League', 5),
(419, 'Cleveland State', 418),
(420, 'Detroit', 418),
(421, 'Green Bay', 418),
(422, 'Illinois-Chicago', 418),
(423, 'Oakland', 418),
(424, 'Valparaiso', 418),
(425, 'Wisconsin-Milwaukee', 418),
(426, 'Wright State', 418),
(427, 'Youngstown State', 418),
(428, 'Independents', 5),
(429, 'New Jersey Tech', 428),
(430, 'Ivy League', 5),
(431, 'Brown', 430),
(432, 'Columbia', 430),
(433, 'Cornell', 430),
(434, 'Dartmouth', 430),
(435, 'Harvard', 430),
(436, 'Pennsylvania', 430),
(437, 'Princeton', 430),
(438, 'Yale', 430),
(439, 'MAAC', 5),
(440, 'Canisius', 439),
(441, 'Fairfield', 439),
(442, 'Iona', 439),
(443, 'Manhattan', 439),
(444, 'Marist', 439),
(445, 'Monmouth', 439),
(446, 'Niagara', 439),
(447, 'Quinnipiac', 439),
(448, 'Rider', 439),
(449, 'Siena', 439),
(450, 'St. Peter''s', 439),
(451, 'Mid-American', 5),
(452, 'East', 451),
(453, 'Akron', 452),
(454, 'Bowling Green', 452),
(455, 'Buffalo', 452),
(456, 'Kent State', 452),
(457, 'Miami (Ohio)', 452),
(458, 'Ohio', 452),
(459, 'West', 451),
(460, 'Ball State', 459),
(461, 'Central Michigan', 459),
(462, 'Eastern Michigan', 459),
(463, 'Northern Illinois', 459),
(464, 'Toledo', 459),
(465, 'Western Michigan', 459),
(466, 'MEAC', 5),
(467, 'Bethune-Cookman', 466),
(468, 'Coppin State', 466),
(469, 'Delaware State', 466),
(470, 'Florida A&M', 466),
(471, 'Hampton', 466),
(472, 'Howard', 466),
(473, 'Maryland-Eastern Shore', 466),
(474, 'Morgan State', 466),
(475, 'Norfolk State', 466),
(476, 'North Carolina A&T', 466),
(477, 'North Carolina Central', 466),
(478, 'Savannah State', 466),
(479, 'SC State', 466),
(480, 'Missouri Valley', 5),
(481, 'Bradley', 480),
(482, 'Drake', 480),
(483, 'Evansville', 480),
(484, 'Illinois State', 480),
(485, 'Indiana State', 480),
(486, 'Loyola-Chicago', 480),
(487, 'Missouri State', 480),
(488, 'Northern Iowa', 480),
(489, 'Southern Illinois', 480),
(490, 'Wichita State', 480),
(491, 'Mountain West', 5),
(492, 'Air Force', 491),
(493, 'Boise State', 491),
(494, 'Colorado State', 491),
(495, 'Fresno State', 491),
(496, 'Nevada', 491),
(497, 'New Mexico', 491),
(498, 'San Diego State', 491),
(499, 'San Jose State', 491),
(500, 'UNLV', 491),
(501, 'Utah State', 491),
(502, 'Wyoming', 491),
(503, 'Northeast', 5),
(504, 'Bryant University', 503),
(505, 'Central Connecticut State', 503),
(506, 'Fairleigh Dickinson', 503),
(507, 'LIU-Brooklyn', 503),
(508, 'Mount St. Mary''s', 503),
(509, 'Robert Morris', 503),
(510, 'Sacred Heart', 503),
(511, 'St. Francis (NY)', 503),
(512, 'St. Francis (PA)', 503),
(513, 'Wagner', 503),
(514, 'Ohio Valley', 5),
(515, 'East', 514),
(516, 'Belmont', 515),
(517, 'Eastern Kentucky', 515),
(518, 'Jacksonville State', 515),
(519, 'Morehead State', 515),
(520, 'Tennessee State', 515),
(521, 'Tennessee Tech', 515),
(522, 'West', 514),
(523, 'Austin Peay', 522),
(524, 'Eastern Illinois', 522),
(525, 'Murray State', 522),
(526, 'SIU-Edwardsville', 522),
(527, 'Southeast Missouri State', 522),
(528, 'UT Martin', 522),
(529, 'Pac-12', 5),
(530, 'Arizona State', 529),
(531, 'Arizona', 529),
(532, 'California', 529),
(533, 'Colorado', 529),
(534, 'Oregon', 529),
(535, 'Oregon State', 529),
(536, 'USC', 529),
(537, 'Stanford', 529),
(538, 'UCLA', 529),
(539, 'Utah', 529),
(540, 'Washington', 529),
(541, 'Washington State', 529),
(542, 'Patriot League', 5),
(543, 'American', 542),
(544, 'Army', 542),
(545, 'Boston University', 542),
(546, 'Bucknell', 542),
(547, 'Colgate', 542),
(548, 'Holy Cross', 542),
(549, 'Lafayette', 542),
(550, 'Lehigh', 542),
(551, 'Loyola-Maryland', 542),
(552, 'Navy', 542),
(553, 'SEC', 5),
(554, 'Alabama', 553),
(555, 'Arkansas', 553),
(556, 'Auburn', 553),
(557, 'Florida', 553),
(558, 'Georgia', 553),
(559, 'Kentucky', 553),
(560, 'LSU', 553),
(561, 'Mississippi State', 553),
(562, 'Missouri', 553),
(563, 'Ole Miss', 553),
(564, 'South Carolina', 553),
(565, 'Tennessee', 553),
(566, 'Texas A&M', 553),
(567, 'Vanderbilt', 553),
(568, 'Southern', 5),
(569, 'Appalachian State', 568),
(570, 'Chattanooga', 568),
(571, 'Davidson', 568),
(572, 'Elon', 568),
(573, 'Furman', 568),
(574, 'Georgia Southern', 568),
(575, 'NC-Greensboro', 568),
(576, 'Samford', 568),
(577, 'The Citadel', 568),
(578, 'Western Carolina', 568),
(579, 'Wofford', 568),
(580, 'Southland', 5),
(581, 'Abilene Christian', 580),
(582, 'Central Arkansas', 580),
(583, 'Houston Baptist', 580),
(584, 'Incarnate Word', 580),
(585, 'Lamar', 580),
(586, 'McNeese State', 580),
(587, 'New Orleans', 580),
(588, 'Nicholls State', 580),
(589, 'Northwestern State', 580),
(590, 'Oral Roberts', 580),
(591, 'Sam Houston State', 580),
(592, 'Southeastern Louisiana', 580),
(593, 'Stephen F. Austin', 580),
(594, 'Texas A&M-Corpus Christi', 580),
(595, 'Summit League', 5),
(596, 'Denver', 595),
(597, 'IPFW', 595),
(598, 'IUPUI', 595),
(599, 'Nebraska Omaha', 595),
(600, 'North Dakota State', 595),
(601, 'Oral Roberts', 595),
(602, 'South Dakota', 595),
(603, 'South Dakota State', 595),
(604, 'Western Illinois', 595),
(605, 'SWAC', 5),
(606, 'Alabama A&M', 605),
(607, 'Alabama State', 605),
(608, 'Alcorn State', 605),
(609, 'Arkansas-Pine Bluff', 605),
(610, 'Grambling', 605),
(611, 'Jackson State', 605),
(612, 'Mississippi Valley State', 605),
(613, 'Prairie View A&M', 605),
(614, 'Southern', 605),
(615, 'Texas Southern', 605),
(616, 'Sun Belt', 5),
(617, 'Arkansas State', 616),
(618, 'Arkansas-Little Rock', 616),
(619, 'Georgia State', 616),
(620, 'Louisiana-Monroe', 616),
(621, 'South Alabama', 616),
(622, 'Texas State-San Marcos', 616),
(623, 'Texas-Arlington', 616),
(624, 'Troy', 616),
(625, 'UL Lafayette', 616),
(626, 'Western Kentucky', 616),
(627, 'WCC', 5),
(628, 'Brigham Young', 627),
(629, 'Gonzaga', 627),
(630, 'Loyola Marymount', 627),
(631, 'Pacific', 627),
(632, 'Pepperdine', 627),
(633, 'Portland', 627),
(634, 'San Diego', 627),
(635, 'San Francisco', 627),
(636, 'Santa Clara', 627),
(637, 'St. Mary''s', 627),
(638, 'WAC', 5),
(639, 'Cal State Bakersfield', 638),
(640, 'Chicago State', 638),
(641, 'Grand Canyon', 638),
(642, 'Idaho', 638),
(643, 'New Mexico State', 638),
(644, 'Seattle', 638),
(645, 'Texas-Pan American', 638),
(646, 'UMKC', 638),
(647, 'Utah Valley', 638),
(648, 'General', 6),
(649, 'National League', 6),
(650, 'East', 649),
(651, 'Atlanta Braves', 650),
(652, 'Miami Marlins', 650),
(653, 'New York Mets', 650),
(654, 'Philadelphia Phillies', 650),
(655, 'Washington Nationals', 650),
(656, 'Central', 649),
(657, 'Chicago Cubs', 656),
(658, 'Cincinnati Reds', 656),
(659, 'Milwaukee Brewers', 656),
(660, 'Pittsburgh Pirates', 656),
(661, 'St. Louis Cardinals', 656),
(662, 'West', 649),
(663, 'Arizona Diamondbacks', 662),
(664, 'Colorado Rockies', 662),
(665, 'Los Angeles Dodgers', 662),
(666, 'San Diego Padres', 662),
(667, 'San Francisco Giants', 662),
(668, 'American League', 6),
(669, 'East', 668),
(670, 'Baltimore Orioles', 669),
(671, 'Boston Red Sox', 669),
(672, 'New York Yankees', 669),
(673, 'Tampa Bay Rays', 669),
(674, 'Toronto Blue Jays', 669),
(675, 'Central', 668),
(676, 'Chicago White Sox', 675),
(677, 'Cleveland Indians', 675),
(678, 'Detroit Tigers', 675),
(679, 'Kansas City Royals', 675),
(680, 'Minnesota Twins', 675),
(681, 'West', 668),
(682, 'Houston Astros', 681),
(683, 'Los Angeles Angels', 681),
(684, 'Oakland Athletics', 681),
(685, 'Seattle Mariners', 681),
(686, 'Texas Rangers', 681),
(687, 'General', 7),
(688, 'Central Division', 7),
(689, 'Chicago Blackhawks', 688),
(690, 'Colorado Avalanche', 688),
(691, 'Dallas Stars', 688),
(692, 'Minnesota Wild', 688),
(693, 'Nashville Predators', 688),
(694, 'St. Louis Blues', 688),
(695, 'Winnipeg Jets', 688),
(696, 'Atlantic Division', 7),
(697, 'Boston Bruins', 696),
(698, 'Buffalo Sabres', 696),
(699, 'Detroit Red Wings', 696),
(700, 'Florida Panthers', 696),
(701, 'Montreal Canadiens', 696),
(702, 'Ottawa Senators', 696),
(703, 'Tampa Bay Lightning', 696),
(704, 'Toronto Maple Leafs', 696),
(705, 'Pacific Division', 7),
(706, 'Anaheim Ducks', 705),
(707, 'Arizona Coyotes', 705),
(708, 'Calgary Flames', 705),
(709, 'Edmonton Oilers', 705),
(710, 'Los Angeles Kings', 705),
(711, 'San Jose Sharks', 705),
(712, 'Vancouver Canucks', 705),
(713, 'Metropolitan Division', 7),
(714, 'Carolina Hurricanes', 713),
(715, 'Columbus Blue Jackets', 713),
(716, 'New Jersey Devils', 713),
(717, 'New York Islanders', 713),
(718, 'New York Rangers', 713),
(719, 'Philadelphia Flyers', 713),
(720, 'Pittsburgh Penguins', 713),
(721, 'Washington Capitals', 713),
(722, 'General', 8),
(723, 'General', 9),
(724, 'General', 10),
(725, 'NASCAR', 10),
(726, 'Boxing', 10),
(727, 'Golf', 10),
(730, 'Tennis', 10),
(731, 'Extreme Sports', 10),
(733, 'Kobe Bryant', 11),
(734, 'Kevin Durant', 11),
(735, 'LeBron James', 11),
(736, 'Mike Trout', 11),
(737, 'Robinson Cano', 11),
(738, 'Clayton Kershaw', 11),
(739, 'Giancarlo Stanton', 11),
(740, 'Tom Brady', 11),
(741, 'Peyton Manning', 11),
(742, 'Aaron Rodgers', 11),
(743, 'Calvin Johnson', 11),
(744, 'Floyd Mayweather Jr.', 11),
(745, 'Wladimir Klitschko', 11),
(746, 'Ronda Rousey', 11),
(747, 'LeSean McCoy', 11),
(748, 'Roger Federer', 11),
(749, 'Rafael Nadal', 11),
(750, 'Tiger Woods', 11),
(751, 'Jameis Winston', 11),
(752, 'Marcus Mariota', 11),
(753, 'Bryce Petty', 11),
(754, 'Derek Jeter', 11)"   

         )->query();

    //********************** create table command for dynamic_comments  table **********************//


   Yii::app()->db->createCommand(

   	'CREATE TABLE IF NOT EXISTS `dynamic_comments` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `comment_on` varchar(10) NOT NULL,
  `content_id` bigint(20) unsigned NOT NULL,
  `comment_from` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1'

   	)->query();



    //********************** create table command for games table **********************//


    Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `games` (
  `id` bigint(20) NOT NULL,
  `league_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `home` bigint(20) NOT NULL,
  `visiting` bigint(20) NOT NULL,
  `home_spread` float NOT NULL,
  `visiting_spread` float NOT NULL,
  `home_score` float NOT NULL,
  `visiting_score` float NOT NULL,
  `winner` enum('home','visiting','draw','pending') NOT NULL DEFAULT 'pending',
  `set_winner` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `league_id` (`league_id`),
  KEY `home` (`home`),
  KEY `visiting` (`visiting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
    	)->query();

    
    //********************** create table command for game_api_variables  table **********************//


     Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `game_api_variables` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sport_type` varchar(255) NOT NULL,
  `league` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1"
     )->query();
    
    //********************** create table command for leagues  table **********************//
    

    Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `leagues` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sport_type` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL COMMENT 'active- make leage show records on home page under Upcoming Games section',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4"
     )->query();
    
     //********************** create table command for like_dislike  table **********************//   
 
    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `like_dislike` (
  `video_id` varchar(100) NOT NULL,
  `likes` text,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();


    //********************** create table command for like_dislike_battles  table **********************//

    Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `like_dislike_battles` (
  `battle_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `likes` text,
  PRIMARY KEY (`battle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
     )->query();
    
    
     //********************** create table command for like_dislike_battles  table **********************//


    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `like_dislike_comments` (
  `comment_id` bigint(20) unsigned NOT NULL,
  `likes` text,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();
    
    //********************** create table command for marked_inappropriate  table **********************//


    Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `marked_inappropriate` (
  `video_id` varchar(100) NOT NULL DEFAULT '',
  `marked_by` text,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
     )->query();


     //********************** create table command for messaging  table **********************//



    Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `messaging` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from` bigint(20) unsigned DEFAULT NULL,
  `to` bigint(20) unsigned DEFAULT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2"
     )->query();
    
    //********************** create table command for newsletter_emails  table **********************//



    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `newsletter_emails` (
  `email` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();
    
    //********************** create table command for news_cache  table **********************//
    

    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `news_cache` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `query` varchar(255) NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1'
     )->query();
    
    
    //********************** create table command for notifications  table **********************//

    Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from` bigint(20) unsigned DEFAULT NULL,
  `to` bigint(20) unsigned DEFAULT NULL,
  `notification` varchar(255) DEFAULT NULL,
  `extra` text,
  `date` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67"
     )->query();


    //********************** create table command for posts_comments_nm  table **********************//


    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `posts_comments_nm` (
  `postId` int(11) unsigned NOT NULL,
  `commentId` int(11) unsigned NOT NULL,
  `text_battle_id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`commentId`),
  KEY `fk_posts_comments_comments` (`commentId`),
  KEY `fk_posts_comments_posts` (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();


    //********************** create table command for search_cache  table **********************//



    Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `search_cache` (
  `id` char(128) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `value` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();
	
    //********************** create table command for tbl_migration  table **********************//


	Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1'
     )->query();
	
	//********************** create table command for teams  table **********************//



	Yii::app()->db->createCommand(

     	'CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `league_id` bigint(20) NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `league_id` (`league_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164'
     )->query();
	
	//********************** create table command for team_names  table **********************//


	Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `team_names` (
  `team_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `sport` varchar(20) NOT NULL DEFAULT 'NBA',
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"
     )->query();
	

	//********************** create table command for transactions  table **********************//


	Yii::app()->db->createCommand(

     	"CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `credit_purchased` int(20) NOT NULL,
  `status` enum('noStarted','initiated','failed','success') NOT NULL DEFAULT 'noStarted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table for keep records of user transactions for credit purchase' AUTO_INCREMENT=1"
     )->query();

	//********************** create table command for users  table **********************//


    Yii::app()->db->createCommand(

 
"CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `display_picture` varchar(255) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `reg_date` datetime NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `email_verified` enum('0','1') NOT NULL DEFAULT '0',
  `feed_visibility` enum('public','relation','private') NOT NULL DEFAULT 'relation',
  `groups` text NOT NULL,
  `contact_allowance` enum('public','private','relation') NOT NULL DEFAULT 'public',
  `search_allowance` enum('0','1') NOT NULL DEFAULT '1',
  `country` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `fb_id` varchar(50) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `flame_name` varchar(50) NOT NULL,
  `device_id` varchar(100) DEFAULT NULL,
  `fav_cat` text,
  `credits` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3691414566384"

    	)->query();


    //********************** create table command for user_bids  table **********************//


    Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `user_bids` (
  `userid` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `game_date` datetime NOT NULL,
  `id` varchar(50) NOT NULL,
  `bid_on` varchar(20) NOT NULL,
  `won` enum('pending','won','lost') NOT NULL DEFAULT 'pending',
  `winner_declared` datetime DEFAULT NULL,
  `credits` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1"

    	)->query();

    //********************** create table command for videos  table **********************//

    
     Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `duration` bigint(20) unsigned DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `uploading_date` datetime DEFAULT NULL,
  `video_id` varchar(100) NOT NULL,
  `audio_id` varchar(50) DEFAULT NULL,
  `uploaded_by` bigint(20) unsigned NOT NULL,
  `views` bigint(20) unsigned NOT NULL DEFAULT '0',
  `last_watched` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `marked_by` text NOT NULL,
  `type` enum('video','comment') NOT NULL DEFAULT 'video',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66"

    	)->query();

	
     //********************** create table command for video_comments  table **********************//

    
    Yii::app()->db->createCommand(

    	'CREATE TABLE IF NOT EXISTS `video_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_uploaded` datetime DEFAULT NULL,
  `uploaded_by` bigint(20) unsigned DEFAULT NULL,
  `video_id` varchar(50) NOT NULL,
  `audio_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1'

    	)->query();


     //********************** create table command for web_config  table **********************//

    Yii::app()->db->createCommand(

    	"CREATE TABLE IF NOT EXISTS `web_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2"

    	)->query();


/*********** alter tables for post via functionality ************/
 Yii::app()->db->createCommand("ALTER TABLE `battles` ADD `media` ENUM( 'ios', 'android', 'web' ) NOT NULL DEFAULT 'web'")->query();
 Yii::app()->db->createCommand("ALTER TABLE `audios` ADD `media` ENUM( 'ios', 'android', 'web' ) NOT NULL DEFAULT 'web'")->query();
 Yii::app()->db->createCommand("ALTER TABLE `videos` ADD `media` ENUM( 'ios', 'android', 'web' ) NOT NULL DEFAULT 'web'")->query();
 Yii::app()->db->createCommand("ALTER TABLE `comments` ADD `media` ENUM( 'ios', 'android', 'web' ) NOT NULL DEFAULT 'web'")->query();
 Yii::app()->db->createCommand("ALTER TABLE `messaging` ADD `media` ENUM( 'ios', 'android', 'web' ) NOT NULL DEFAULT 'web'")->query();

  }
	public function down()
	{

		$this->dropcolumn("videos","newcolumn","varchar(25)");
		/*echo "m150102_102216_create_user_table does not support migration down.\n";
		return false;*/
	}
}