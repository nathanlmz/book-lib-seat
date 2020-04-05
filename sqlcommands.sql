CREATE TABLE bookrecord (
  bookid int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  sid varchar(11) NOT NULL,
  bookdate date not NULL,
  starttime int NOT NULL,
  endtime int NOT NULL,
  seatid varchar(11) not null,
  area char(2) not null,
  lib varchar(11) not null
);

CREATE TABLE bookrecord (
  bookid int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  sid varchar(11) NOT NULL,
  bookdate date not NULL,
  starttime time NOT NULL,
  endtime time NOT NULL,
  seatid varchar(11) not null,
  area char(2) not null,
  lib varchar(11) not null
);



INSERT INTO `bookrecord`(`sid`, `bookdate`, `starttime`, `endtime`, `seatid`, `area`, `lib`) VALUES ('s1155109544','2020-04-20','13:00:00','18:00:00','A1','A','ulib')

SELECT seatid FROM bookrecord WHERE bookdate='2020-04-20'AND (starttime>='12:00:00' OR endtime <='19:00:00')

SELECT * FROM bookrecord WHERE seatid='A1' AND bookdate='2020-04-20' AND ((starttime<='13:00:00' AND endtime>='16:00:00') OR (starttime<='16:00:00' AND endtime>='16:00:00') OR (starttime>='13:00:00' AND endtime<='16:00:00'));