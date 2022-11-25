drop database if exists phpscratchtest;

create database phpscratchtest;

use phpscratchtest;

-- if your default storage engine is not INNODB use ENGINE=

create table article(id int primary key auto_increment,article_title varchar(255) not null,article_content text not null) ENGINE = INNODB;

