# Database Change log

## [1 June 2017]

**Updated category table**

```
ALTER table `page_category` add `description` varchar (255) default NULL; 
```


## [31 May 2017]

**Add page table**

```
CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) unsigned NOT NULL,
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `target` varchar(255) NOT NULL DEFAULT '',
  `tag` varchar(255) DEFAULT NULL,
  `page_order` int(11) DEFAULT NULL,
  `page_status` varchar(20) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `page_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `page_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```


**Add category table**

```
CREATE TABLE `page_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```


**Add Image gallery table**

```
CREATE TABLE `img_gallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL DEFAULT '',
  `img_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
