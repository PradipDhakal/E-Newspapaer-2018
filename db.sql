CREATE DATABASE project2pm;

CREATE TABLE tbl_users(
id int AUTO_INCREMENT PRIMARY KEY,
name varchar(100) not null,
username varchar(100) UNIQUE,
email varchar(100) UNIQUE,
password varchar(100) NOT null,
user_type ENUM ('user','admin') DEFAULT 'user',
STATUS int DEFAULT '0',
image varchar(100) not null
);

CREATE TABLE tbl_gallery(
id int AUTO_INCREMENT PRIMARY KEY,
img_name varchar(100) not null,
user_id int,
    FOREIGN KEY(user_id) REFERENCES tbl_users( id) ON DELETE RESTRICT ON UPDATE CASCADE

);

CREATE TABLE tbl_category(
id int AUTO_INCREMENT PRIMARY KEY,
cat_name varchar(100) not null
);

CREATE TABLE tbl_news(
id int AUTO_INCREMENT PRIMARY KEY,
title varchar(200) not null,
image varchar(100) not null,
description text

);

CREATE TABLE tbl_news_category(
id int AUTO_INCREMENT PRIMARY KEY,
news_id int,
cat_id int,
 user_id int,
 FOREIGN KEY(news_id) REFERENCES tbl_news(id) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY(cat_id) REFERENCES tbl_category(id) ON DELETE CASCADE ON UPDATE CASCADE,
     FOREIGN KEY(user_id) REFERENCES tbl_users(id) ON DELETE CASCADE ON UPDATE CASCADE

)

SELECT tbl_news.*,tbl_category.cat_name, tbl_users.username FROM tbl_news
JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id


---- tbl_slider -- dekheii ko part ho yo------------
    CREATE TABLE tbl_slider (
     id	int PRIMARY KEY AUTO_INCREMENT,
        title varchar(200) not null,
        image_name varchar(100) not null,
        description text,
        FOREIGN KEY(user_id) REFERENCES tbl_users( id) ON DELETE RESTRICT ON UPDATE CASCADE
  )

CREATE TABLE tbl_latest_post (
 id	int PRIMARY KEY AUTO_INCREMENT,
     title varchar (100) not null,
    image_name varchar(100) not null,
    description text
)

CREATE TABLE tbl_business (
id int PRIMARY KEY AUTO_INCREMENT,
    title varcha(200) not null,
    image_name  varchar(100) not null,
    description text

)
-- data show --
SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=8



CREATE TABLE tbl_menu_news(
id int AUTO_INCREMENT PRIMARY KEY,
  title varchar(100) not null,
  newstitle varchar(200) not null,
  description text
)



   CREATE TABLE tbl_submenu (
   id	int PRIMARY KEY AUTO_INCREMENT,
   menu_news_id int,
   menu_id int,
   user_id int,
        FOREIGN KEY(menu_news_id) REFERENCES tbl_menu_news(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY(menu_id) REFERENCES tbl_menu(id) ON DELETE CASCADE ON UPDATE CASCADE,
         FOREIGN KEY(user_id) REFERENCES tbl_users(id) ON DELETE CASCADE ON UPDATE CASCADE
  )



SELECT tbl_news.*,GROUP_CONCAT(tbl_category.cat_name SEPARATOR ',')  as category,tbl_users.username FROM tbl_news
JOIN tbl_news_category ON  tbl_news.id = tbl_news_category.news_id
JOIN tbl_category ON  tbl_category.id = tbl_news_category.cat_id
JOIN tbl_users ON  tbl_users.id = tbl_news_category.user_id
GROUP BY tbl_news_category.cat_id




SELECT tbl_users.name,tbl_users.username,tbl_users.user_type,tbl_users.image,tbl_category.cat_name
FROM tbl_users JOIN tbl_category ON tbl_users.id =tbl_category.id
WHERE tbl_users.id=8


------------------- Dashoard backend ko QUERY ------------
SELECT tbl_users.username,GROUP_CONCAT(DISTINCT tbl_category.cat_name  SEPARATOR ',' )as category,tbl_users.user_type,tbl_users.image FROM tbl_news_category
JOIN tbl_users on tbl_users.id=tbl_news_category.user_id
JOIN tbl_category on tbl_category.id=tbl_news_category.cat_id
GROUP BY tbl_news_category.user_id


--VIEW KO NAV KO QUERY ---------------------
SELECT  tbl_submenu.*,tbl_menu_news.title FROM tbl_submenu
JOIN tbl_menu_news ON tbl_menu_news.id = tbl_submenu.menu_news_id


//---- submenu ko query -----//
SELECT tbl_menu_news.*,GROUP_CONCAT(tbl_menu.menu_name SEPARATOR ',')  as menu,tbl_users.username FROM tbl_submenu
JOIN tbl_menu_news ON  tbl_menu_news.id = tbl_submenu.menu_news_id
JOIN tbl_menu ON  tbl_menu.id = tbl_submenu.menu_id
JOIN tbl_users ON tbl_users.id = tbl_submenu.user_id
GROUP BY tbl_submenu.user_id


-- imp query of edit_submenu(not use)--
SELECT tbl_menu.*,GROUP_CONCAT( tbl_menu_news.title SEPARATOR ',')  as menu, GROUP_CONCAT(DISTINCT tbl_users.username SEPARATOR ',') as username FROM tbl_submenu
JOIN tbl_menu_news ON  tbl_menu_news.id = tbl_submenu.menu_news_id
JOIN tbl_menu ON  tbl_menu.id = tbl_submenu.menu_id
JOIN tbl_users ON tbl_users.id = tbl_submenu.user_id
GROUP by tbl_submenu.menu_id

-- news mathi news new query //

SELECT COUNT(tbl_news.title) as total_news,GROUP_CONCAT(DISTINCT tbl_category.cat_name SEPARATOR ',' )as category , tbl_news.id as nw_id, tbl_users.username
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id
WHERE tbl_news_category.user_id=2
GROUP By tbl_news_category.user_id

-- ***** news mathi news new query ***** //


-- show page ko query --
SELECT (tbl_news.title) as total_news ,tbl_news.id as nw_id, tbl_users.username, tbl_category.cat_name
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id
WHERE tbl_news_category.user_id=2

-------- **************************** -----