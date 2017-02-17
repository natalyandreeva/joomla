CREATE TABLE IF NOT EXISTS `#__contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `replied` tinyint(11) NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
