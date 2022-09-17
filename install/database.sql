-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2022 at 09:59 PM
-- Server version: 5.7.38
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `at_admin_user`
--

CREATE TABLE `at_admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `at_admin_user`
--

INSERT INTO `at_admin_user` (`id`, `username`, `email`, `password`, `image`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '8469406072022064808.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `at_artist`
--

CREATE TABLE `at_artist` (
  `id` int(11) NOT NULL,
  `at_artist_name` varchar(255) NOT NULL,
  `at_artist_image` varchar(255) NOT NULL,
  `at_artist_link` varchar(255) NOT NULL,
  `at_artist_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 = Enable, 0 = Disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `at_category`
--

CREATE TABLE `at_category` (
  `cid` int(11) NOT NULL,
  `at_category_name` varchar(255) NOT NULL,
  `at_category_image` varchar(255) NOT NULL,
  `at_category_link` varchar(255) NOT NULL,
  `at_category_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 = Enable, 0 = Disable',
  `at_category_visible` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `at_songs`
--

CREATE TABLE `at_songs` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `at_song_title` varchar(100) NOT NULL,
  `at_upload_from` varchar(255) NOT NULL,
  `at_song_url` text,
  `mp3_server_url` text,
  `at_listen_url` text,
  `at_song_link` text NOT NULL,
  `at_song_thumbnail` varchar(255) NOT NULL,
  `at_song_duration` varchar(255) DEFAULT NULL,
  `at_song_size` varchar(255) DEFAULT NULL,
  `at_song_artist` text NOT NULL,
  `at_song_spotify_link` text,
  `at_song_itunes_link` text,
  `at_song_youtube_link` text,
  `at_song_music` varchar(255) DEFAULT NULL,
  `at_song_lyrics` varchar(255) DEFAULT NULL,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `total_download` int(11) NOT NULL DEFAULT '0',
  `at_today_download` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `at_users`
--

CREATE TABLE `at_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` text,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `at_web_settings`
--

CREATE TABLE `at_web_settings` (
  `id` int(2) NOT NULL,
  `at_site_name` text NOT NULL,
  `at_site_sub_name` text NOT NULL,
  `at_site_url` text NOT NULL,
  `at_site_description` text NOT NULL,
  `at_site_keywords` text NOT NULL,
  `at_site_logo` text NOT NULL,
  `at_song_tag_img` text NOT NULL,
  `at_site_favicon` text NOT NULL,
  `at_site_copyright` text NOT NULL,
  `at_header_code` longtext NOT NULL,
  `at_footer_code` longtext NOT NULL,
  `at_primary_color` varchar(250) NOT NULL,
  `at_about_content` longtext NOT NULL,
  `at_about_status` varchar(10) NOT NULL DEFAULT 'true',
  `at_terms_content` longtext NOT NULL,
  `at_terms_status` varchar(10) NOT NULL DEFAULT 'true',
  `at_privacy_content` longtext NOT NULL,
  `at_privacy_status` varchar(10) NOT NULL DEFAULT 'true',
  `at_contact_email` varchar(255) NOT NULL,
  `at_contact_email_no` varchar(255) NOT NULL,
  `at_contact_number` varchar(50) NOT NULL,
  `at_contact_text` text NOT NULL,
  `at_facebook` text NOT NULL,
  `at_youtube` text NOT NULL,
  `at_twitter` text NOT NULL,
  `at_instagram` text NOT NULL,
  `at_dc_alert_status` tinyint(4) NOT NULL DEFAULT '0',
  `at_index_ad` text NOT NULL,
  `at_header_ad` text NOT NULL,
  `at_footer_ad` text NOT NULL,
  `at_d_page_ad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `at_web_settings`
--

INSERT INTO `at_web_settings` (`id`, `at_site_name`, `at_site_sub_name`, `at_site_url`, `at_site_description`, `at_site_keywords`, `at_site_logo`, `at_song_tag_img`, `at_site_favicon`, `at_site_copyright`, `at_header_code`, `at_footer_code`, `at_primary_color`, `at_about_content`, `at_about_status`, `at_terms_content`, `at_terms_status`, `at_privacy_content`, `at_privacy_status`, `at_contact_email`, `at_contact_email_no`, `at_contact_number`, `at_contact_text`, `at_facebook`, `at_youtube`, `at_twitter`, `at_instagram`, `at_dc_alert_status`, `at_index_ad`, `at_header_ad`, `at_footer_ad`, `at_d_page_ad`) VALUES
(1, 'Audiotape', 'Music download platform', 'https://pixelsoft.digital', 'Lorem ipsum dolor sit, amet consectetur adipisicing, elit. Inventore, mollitia sequi voluptatum, hic aliquid sed odit? Reprehenderit dolorem corrupti eum dolor fugit accusamus itaque unde, neque optio,', 'music, songs, audiotape, php music, download songs', '', '5041506072022070258.png', '1615405072022012819.png', 'Copyright &copy; 2022 AudioTape - Music Web Application, All rights reserved.', '', '', '#c21919', '<h1><strong>About Us</strong></h1>\r\n\r\n<p>Welcome to Pixel Soft, your number one source for all things web applications. We&#39;re dedicated to providing you with the best of web applications, with a focus on dependability.</p>\r\n\r\n<p>We&#39;re working to turn our passion for web applications into a booming online store. We hope you enjoy our products as much as we enjoy offering them to you.</p>\r\n\r\n<p>Sincerely,</p>\r\n\r\n<p>PixelSoft</p>\r\n', 'true', '<h1><strong>Terms and Conditions</strong></h1>\r\n\r\n<p>Welcome to Pixel Soft!</p>\r\n\r\n<p>These terms and conditions outline the rules and regulations for the use of Pixel Soft&#39;s Website, located at www.pixelsoft.digital.</p>\r\n\r\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use Pixel Soft if you do not agree to take all of the terms and conditions stated on this page.</p>\r\n\r\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: &quot;Client&quot;, &quot;You&quot; and &quot;Your&quot; refers to you, the person log on this website and compliant to the Company&rsquo;s terms and conditions. &quot;The Company&quot;, &quot;Ourselves&quot;, &quot;We&quot;, &quot;Our&quot; and &quot;Us&quot;, refers to our Company. &quot;Party&quot;, &quot;Parties&quot;, or &quot;Us&quot;, refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client&rsquo;s needs in respect of provision of the Company&rsquo;s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>We employ the use of cookies. By accessing Pixel Soft, you agreed to use cookies in agreement with the Pixel Soft&#39;s Privacy Policy.</p>\r\n\r\n<p>Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>\r\n\r\n<p><strong>License</strong></p>\r\n\r\n<p>Unless otherwise stated, Pixel Soft and/or its licensors own the intellectual property rights for all material on Pixel Soft. All intellectual property rights are reserved. You may access this from Pixel Soft for your own personal use subjected to restrictions set in these terms and conditions.</p>\r\n\r\n<p>You must not:&nbsp; &nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>Republish material from Pixel Soft</li>\r\n	<br />\r\n	<li>Sell, rent or sub-license material from Pixel Soft</li>\r\n	<br />\r\n	<li>Reproduce, duplicate or copy material from Pixel Soft</li>\r\n	<br />\r\n	<li>Redistribute content from Pixel Soft</li>\r\n	<br />\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Pixel Soft does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Pixel Soft,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Pixel Soft shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>\r\n\r\n<p>Pixel Soft reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>\r\n\r\n<p>You warrant and represent that:&nbsp; &nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>\r\n	<br />\r\n	<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>\r\n	<br />\r\n	<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>\r\n	<br />\r\n	<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>\r\n	<br />\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<p>You hereby grant Pixel Soft a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>\r\n\r\n<h3><strong>Hyperlinking to our Content</strong></h3>\r\n\r\n<p>The following organizations may link to our Website without prior written approval:</p>\r\n\r\n<ul><br />\r\n	<li>Government agencies;</li>\r\n	<br />\r\n	<li>Search engines;</li>\r\n	<br />\r\n	<li>News organizations;</li>\r\n	<br />\r\n	<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>\r\n	<br />\r\n	<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>\r\n	<br />\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party&rsquo;s site.</p>\r\n\r\n<p>We may consider and approve other link requests from the following types of organizations:&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>commonly-known consumer and/or business information sources;&nbsp; &nbsp;</li>\r\n	<br />\r\n	<li>dot.com community sites;</li>\r\n	<br />\r\n	<li>associations or other groups representing charities;</li>\r\n	<br />\r\n	<li>online directory distributors;&nbsp;&nbsp;</li>\r\n	<br />\r\n	<li>internet portals;&nbsp;&nbsp;</li>\r\n	<br />\r\n	<li>accounting, law and consulting firms; and&nbsp;&nbsp;</li>\r\n	<br />\r\n	<li>educational institutions and trade associations.</li>\r\n</ul>\r\n\r\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Pixel Soft; and (d) the link is in the context of general resource information.</p>\r\n\r\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.</p>\r\n\r\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Pixel Soft. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>\r\n\r\n<p>Approved organizations may hyperlink to our Website as follows:</p>\r\n\r\n<ul><br />\r\n	<li>By use of our corporate name; or&nbsp;</li>\r\n	<br />\r\n	<li>By use of the uniform resource locator being linked to; or</li>\r\n	<br />\r\n	<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.</li>\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>No use of Pixel Soft&#39;s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>iFrames</strong></h3>\r\n\r\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>\r\n\r\n<h3><strong>Content Liability</strong></h3>\r\n\r\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>\r\n\r\n<h3><strong>Your Privacy</strong></h3>\r\n\r\n<p>Please read Privacy Policy</p>\r\n\r\n<h3><strong>Reservation of Rights</strong></h3>\r\n\r\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>\r\n\r\n<h3><strong>Removal of links from our website</strong></h3>\r\n\r\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>\r\n\r\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>\r\n\r\n<h3><strong>Disclaimer</strong></h3>\r\n\r\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>\r\n\r\n<ul><br />\r\n	<li>limit or exclude our or your liability for death or personal injury;</li>\r\n	<br />\r\n	<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>\r\n	<br />\r\n	<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>\r\n	<br />\r\n	<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>\r\n\r\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>\r\n', 'true', '<h1><strong>Privacy Policy for Pixel Soft</strong></h1>\r\n\r\n<p><strong>At Pixel Soft, accessible from www.pixelsoft.digital, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Pixel Soft and how we use it.</strong></p>\r\n\r\n<p><strong>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Consent</strong></h2>\r\n\r\n<p><strong>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</strong></p>\r\n\r\n<h2><strong>Information we collect</strong></h2>\r\n\r\n<p><strong>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</strong></p>\r\n\r\n<p><strong>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</strong></p>\r\n\r\n<p><strong>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</strong></p>\r\n\r\n<h2><strong>How we use your information</strong></h2>\r\n\r\n<p><strong>We use the information we collect in various ways, including to:</strong></p>\r\n\r\n<ul><br />\r\n	<li><strong>Provide, operate, and maintain our website</strong></li>\r\n	<br />\r\n	<li><strong>Improve, personalize, and expand our website</strong></li>\r\n	<br />\r\n	<li><strong>Understand and analyze how you use our website</strong></li>\r\n	<br />\r\n	<li><strong>Develop new products, services, features, and functionality</strong></li>\r\n	<br />\r\n	<li><strong>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</strong></li>\r\n	<br />\r\n	<li><strong>Send you emails</strong></li>\r\n	<br />\r\n	<li><strong>Find and prevent fraud</strong></li>\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<h2><strong>Log Files</strong></h2>\r\n\r\n<p><strong>Pixel Soft follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services&#39; analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users&#39; movement on the website, and gathering demographic information.</strong></p>\r\n\r\n<h2><strong>Google DoubleClick DART Cookie</strong></h2>\r\n\r\n<p><strong>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL &ndash; <a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></strong></p>\r\n\r\n<h2><strong>Our Advertising Partners</strong></h2>\r\n\r\n<p><strong>Some of advertisers on our site may use cookies and web beacons. Our advertising partners are listed below. Each of our advertising partners has their own Privacy Policy for their policies on user data. For easier access, we hyperlinked to their Privacy Policies below.&nbsp; &nbsp; </strong></p>\r\n\r\n<ul>\r\n	<li><strong><strong>Google&nbsp;</strong></strong><strong><strong><a href=\"https://policies.google.com/technologies/ads\">https://policies.google.com/technologies/ads</a></strong></strong></li>\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<h2><strong>Advertising Partners Privacy Policies</strong></h2>\r\n\r\n<p><strong>You may consult this list to find the Privacy Policy for each of the advertising partners of Pixel Soft.</strong></p>\r\n\r\n<p><strong>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Pixel Soft, which are sent directly to users&#39; browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</strong></p>\r\n\r\n<p><strong>Note that Pixel Soft has no access to or control over these cookies that are used by third-party advertisers.</strong></p>\r\n\r\n<h2><strong>Third Party Privacy Policies</strong></h2>\r\n\r\n<p><strong>Pixel Soft&#39;s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </strong></p>\r\n\r\n<p><strong>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers&#39; respective websites.</strong></p>\r\n\r\n<h2><strong>CCPA Privacy Rights (Do Not Sell My Personal Information)</strong></h2>\r\n\r\n<p><strong>Under the CCPA, among other rights, California consumers have the right to:</strong></p>\r\n\r\n<p><strong>Request that a business that collects a consumer&#39;s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</strong></p>\r\n\r\n<p><strong>Request that a business delete any personal data about the consumer that a business has collected.</strong></p>\r\n\r\n<p><strong>Request that a business that sells a consumer&#39;s personal data, not sell the consumer&#39;s personal data.</strong></p>\r\n\r\n<p><strong>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</strong></p>\r\n\r\n<h2><strong>GDPR Data Protection Rights</strong></h2>\r\n\r\n<p><strong>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</strong></p>\r\n\r\n<p><strong>The right to access &ndash; You have the right to request copies of your personal data. We may charge you a small fee for this service.</strong></p>\r\n\r\n<p><strong>The right to rectification &ndash; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</strong></p>\r\n\r\n<p><strong>The right to erasure &ndash; You have the right to request that we erase your personal data, under certain conditions.</strong></p>\r\n\r\n<p><strong>The right to restrict processing &ndash; You have the right to request that we restrict the processing of your personal data, under certain conditions.</strong></p>\r\n\r\n<p><strong>The right to object to processing &ndash; You have the right to object to our processing of your personal data, under certain conditions.</strong></p>\r\n\r\n<p><strong>The right to data portability &ndash; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</strong></p>\r\n\r\n<p><strong>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</strong></p>\r\n\r\n<h2><strong>Children&#39;s Information</strong></h2>\r\n\r\n<p><strong>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</strong></p>\r\n\r\n<p><strong>Pixel Soft does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	&nbsp;\r\n</ul>\r\n', 'true', 'hello@pixelsoft.digital', 'noreply@pixelsoft.digital', '0712345678', 'Please contact us if you would like to notify us of any removals or regarding our site.', 'https://www.facebook.com/pixelsoftdigital', 'https://www.youtube.com', 'https://www.twitter.com', 'https://www.instagram.com', 1, '&lt;iframe data-aa=\'2043524\' src=\'//acceptable.a-ads.com/2043524\' style=\'border:0px; padding:0; width:100%; height:100%; overflow:hidden; background-color: transparent;\'&gt;&lt;/iframe&gt;', '&lt;iframe data-aa=\'2043524\' src=\'//acceptable.a-ads.com/2043524\' style=\'border:0px; padding:0; width:100%; height:100%; overflow:hidden; background-color: transparent;\'&gt;&lt;/iframe&gt;', '&lt;iframe data-aa=\'2043524\' src=\'//acceptable.a-ads.com/2043524\' style=\'border:0px; padding:0; width:100%; height:100%; overflow:hidden; background-color: transparent;\'&gt;&lt;/iframe&gt;', '&lt;iframe data-aa=\'2043543\' src=\'//acceptable.a-ads.com/2043543\' style=\'border:0px; padding:0; width:100%; height:100%; overflow:hidden; background-color: transparent;\'&gt;&lt;/iframe&gt;');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `at_admin_user`
--
ALTER TABLE `at_admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `at_artist`
--
ALTER TABLE `at_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `at_category`
--
ALTER TABLE `at_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `at_songs`
--
ALTER TABLE `at_songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `at_users`
--
ALTER TABLE `at_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `at_web_settings`
--
ALTER TABLE `at_web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `at_admin_user`
--
ALTER TABLE `at_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `at_artist`
--
ALTER TABLE `at_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `at_category`
--
ALTER TABLE `at_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `at_songs`
--
ALTER TABLE `at_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `at_users`
--
ALTER TABLE `at_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `at_web_settings`
--
ALTER TABLE `at_web_settings`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
