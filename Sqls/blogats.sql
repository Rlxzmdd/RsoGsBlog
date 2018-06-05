-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 05, 2018 at 12:39 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogats`
--

CREATE TABLE `blogats` (
  `id` int(5) NOT NULL,
  `title` tinytext,
  `content` mediumtext,
  `time` tinytext,
  `author` varchar(30) NOT NULL DEFAULT 'Rlxzmdd',
  `tags` varchar(30) NOT NULL DEFAULT '笔记',
  `index` int(2) NOT NULL DEFAULT '1' COMMENT '显示等级'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogats`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogats`
--
ALTER TABLE `blogats`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogats`
--
ALTER TABLE `blogats`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
