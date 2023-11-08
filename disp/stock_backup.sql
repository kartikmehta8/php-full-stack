

CREATE TABLE `allocate` (
  `allocate_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(100) DEFAULT NULL,
  `lp_no` varchar(20) DEFAULT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `allocate_qty` int(10) DEFAULT NULL,
  `allocate_qty_in_store` int(10) DEFAULT NULL,
  `allocated_date` date DEFAULT NULL,
  PRIMARY KEY (`allocate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO allocate VALUES("1","2","","","61","10","10","2022-07-05");
INSERT INTO allocate VALUES("2","3","","","61","3","3","2021-07-14");
INSERT INTO allocate VALUES("3","4","","","62","100","100","2021-07-15");
INSERT INTO allocate VALUES("4","7","","","62","3","3","2021-07-15");
INSERT INTO allocate VALUES("5","8","","","62","3","3","2021-07-15");
INSERT INTO allocate VALUES("6","9","","","62","3","3","2021-07-15");
INSERT INTO allocate VALUES("7","10","","","64","1","1","2021-07-15");
INSERT INTO allocate VALUES("8","5","","","63","2","2","2021-07-15");
INSERT INTO allocate VALUES("9","11","","","62","6","6","2021-07-15");
INSERT INTO allocate VALUES("10","6","","","62","1","1","2021-07-15");
INSERT INTO allocate VALUES("11","15","","","61","10","10","2021-07-15");
INSERT INTO allocate VALUES("12","30","","","63","1","1","2023-07-27");



CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `dept_details` varchar(255) NOT NULL,
  `added_at` date DEFAULT NULL,
  PRIMARY KEY (`dept_id`),
  UNIQUE KEY `dept_name` (`dept_name`),
  KEY `dept_name_2` (`dept_name`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("1","DOT ARENERS","12345","1","default stock department","2018-03-27");
INSERT INTO department VALUES("2","DOT ARENERS1","12345","1","default stock department","2018-03-27");
INSERT INTO department VALUES("61","3 COY RR STORE","admin","0","3  COY RR","2022-07-05");
INSERT INTO department VALUES("62","RP STORE","admin","0"," HQ COY","2021-07-15");
INSERT INTO department VALUES("63","IT STORE","admin","0","2 COY","2021-07-15");
INSERT INTO department VALUES("64","NMC STORE","admin","0"," HQ COY","2021-07-15");
INSERT INTO department VALUES("65","efsstore3","admin","0","3 COY","2023-07-17");
INSERT INTO department VALUES("66","TM STORE","admin","0"," 1 COY","2023-07-17");
INSERT INTO department VALUES("67","cqmh","admin","0","HQ COY","2023-07-17");
INSERT INTO department VALUES("68","GRANT STORE","abc123","0"," 2/3 COY","2023-07-18");
INSERT INTO department VALUES("69","RR STORE","abc123","0"," 2/3 COY","2023-07-18");
INSERT INTO department VALUES("70","TECH STORE","abc123","0"," 2/3 COY","2023-07-18");
INSERT INTO department VALUES("71","mt_3","abc123","0","3 COY","2023-07-18");
INSERT INTO department VALUES("76","cqmh_1","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("77","mt_1","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("80","lrw_hq","abc123","0"," HQ COY","2023-07-18");
INSERT INTO department VALUES("81","NFS Store","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("82","OP STORE","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("83","A Store","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("84","LINE STORE","abc123","0"," 1 Coy","2023-07-18");
INSERT INTO department VALUES("85","efsstore2","abc123","0"," 2 Coy","2023-07-18");
INSERT INTO department VALUES("86","mt_2","abc123","0"," 2 Coy","2023-07-18");
INSERT INTO department VALUES("87","cqmh_2","abc123","0"," 2 Coy","2023-07-18");
INSERT INTO department VALUES("88","cqmh_3","abc123","0"," 3 COY","2023-07-18");



CREATE TABLE `dept_issue` (
  `dept_issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(20) NOT NULL,
  `allocate_id` int(20) NOT NULL,
  `dept_qty_issue` int(20) DEFAULT NULL,
  `dept_issue_to` varchar(100) DEFAULT NULL,
  `dept_allocated_date` date DEFAULT NULL,
  `dept_id` int(10) NOT NULL,
  PRIMARY KEY (`dept_issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;




CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(90) DEFAULT NULL,
  `item_cat` varchar(90) DEFAULT NULL,
  `qty` int(8) DEFAULT NULL,
  `cost_per` varchar(20) NOT NULL,
  `item_detail` varchar(100) DEFAULT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(99) DEFAULT NULL,
  `dept_id` varchar(67) DEFAULT '1',
  `qty_issue` int(9) DEFAULT NULL,
  `supplied_at` date DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO item VALUES("4","PLASTIC CHAIR"," ACG","100","585.00","V/40R","CRV/ACG/61","RAJ MOTOR STORE","1","0","2022-03-20");
INSERT INTO item VALUES("5","TP-LINK 4G LTE MODEM"," ACG GRANT","2","5000","V/24","CRV/ACG/58","UNIVERSAL TRADING CO","1","0","2022-03-18");
INSERT INTO item VALUES("6","SHAMIYANA WATER PROOF"," ACG GRANT","1","56200","V/20","CRV/ACG/56","LAXMI DYEING","1","0","2022-03-12");
INSERT INTO item VALUES("7","GOOD QUALITEY WITH LID 1000 ML WATER JUG","ACG","3","760","V/28R","CRV/ACG/60","RAJ MOTOR STORE","1","0","2022-03-03");
INSERT INTO item VALUES("8","BOROSIL 1000 MLBOWL(1 PIECE IN SET)","ACG GRANT","3","960","V/30","ACG/60","RAJ MOTOR STORE","1","0","2022-03-20");
INSERT INTO item VALUES("9","UNBRANDED GLASS TRANSPARENT ROUND BOWL"," ACG GRANT","3","755","V/40","CRV/ACG/60","RAJ MOTOR STORE","1","0","2022-03-20");
INSERT INTO item VALUES("10","UNBRANDED PRINTED VINYL ON SUN BOARD"," ACG GRANT","1","6500","V/25R","CRV/ACG/59","JUNEJA COMPUTERS","1","0","2022-03-18");
INSERT INTO item VALUES("11","UNBRANDED BACKREST BEDCLOTHES RUBBERISED COIR MATTRESS CUSHIONS AND PILLOWS"," ACG","6","4500","V/25","CRV/ACG/57","ERA ENTERPRISES","1","0","2022-03-18");
INSERT INTO item VALUES("13","CANOPY SHAMIYANA"," ACG","1","56000","V/17","CRV/ACG/48","LAXMI DYEING","1","1","2022-02-26");
INSERT INTO item VALUES("14","UNBRANDED REVOLVING CHAIR WITH ARMS","ACG","1","10030","V/222","CRV/ACG/47","REDHU ENTERPRISES","1","1","2022-02-20");
INSERT INTO item VALUES("15","SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED","ACG","30","2550","V/16R","CRV/ACG/46","NATIONAL MUSKETARY STORE","1","20","2022-02-18");
INSERT INTO item VALUES("16","UNBRANDED BELT DRIVE WATER PUMP MOTOR"," ACG","2","5200","V/12R","CRV/ACG/45","ERA ENTERPRISES","1","2","2022-02-16");
INSERT INTO item VALUES("17","OREVA 1200 WATT RADIANT HEATER"," ACG","5","1250","V/09R","CRV/ACG/42","JUNEJA COMPUTERS","1","5","2022-02-08");
INSERT INTO item VALUES("18","UNBRANDED 1200 WATT RADIANT HEATER"," ACG","2","10400","V/06R","CRV/ACG/39","BANSAL TRACTOR & TRADING CO","1","2","2022-01-30");
INSERT INTO item VALUES("19","SIDE TABLE"," ACG","2","9800","212R","CRV/ACG/36","SIDHI VINAYAKA COMPUTERS & TRA","1","2","2021-12-11");
INSERT INTO item VALUES("20","MAIN TABLE"," ACG","1","14400","213R","CRV/ACG/36","SIDHI VINAYAKA COMPUTERS & TRA","1","1","2021-12-11");
INSERT INTO item VALUES("21","ZEBRA BLIND SMALL"," ACG","1","3000","214R","CRV/ACG/36","SIDHI VINAYAKA COMPUTERS & TRA","1","1","2021-12-11");
INSERT INTO item VALUES("22","ZEBRA BLIND LARGE"," ACG","1","5200","215R","CRV/ACG/36","SIDHI VINAYAKA COMPUTERS & TRA","1","1","2021-12-11");
INSERT INTO item VALUES("23","FROSTED FILM"," ACG","1","1500","216R","CRV/ACG/36","SIDHI VINAYAKA COMPUTERS & TRA","1","1","2021-12-11");
INSERT INTO item VALUES("24","KMT KRISHNA MEDITECH FRONT FREEZER"," ACG","1","42500","V/239","CRV/ACG/16","NATIONAL MUSKETARY STORE","1","1","2021-07-22");
INSERT INTO item VALUES("26","keyboard"," it","1","350","v/285","265/cv","INFOSYS","1","1","2021-07-15");
INSERT INTO item VALUES("27","Tenmars digits LCD Digital Light Meter","TT&IE","1","10000","TT&IE/VII/83","CRV/TT&IE/31","INFOSYS","1","1","2021-08-17");
INSERT INTO item VALUES("28","Monitor","dsaf","200","2000","20","12/civ","REDHU ENTERPRISES","1","200","0000-00-00");
INSERT INTO item VALUES("29","Mobile"," ACG","10","800","v/6","fdfsf","INFOSYS","1","10","0000-00-00");
INSERT INTO item VALUES("30","sdsff"," asf","2","23","sda","sdaasd","INFOSYS","1","1","0000-00-00");
INSERT INTO item VALUES("31","cp singh"," swsg","1","1","1","2","INFOSYS","1","1","0000-00-00");
INSERT INTO item VALUES("32","rajes"," 1","1","1","1","1","UNIVERSAL TRADING CO","1","1","0000-00-00");



CREATE TABLE `qrcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qrUsername` varchar(250) NOT NULL,
  `qrContent` varchar(250) NOT NULL,
  `qrImg` varchar(250) NOT NULL,
  `qrlink` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

INSERT INTO qrcodes VALUES("1","MONITOR1","ITEM ID : 1
ITEM NAME : MONITOR
ITEM CATEGORY : COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","MONITOR1.png","localhost/stock/lib/qr/userQr/MONITOR1.png");
INSERT INTO qrcodes VALUES("2","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("3","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("4","MONITOR1","ITEM ID : 1
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","MONITOR1.png","localhost/stock/lib/qr/userQr/MONITOR1.png");
INSERT INTO qrcodes VALUES("5","MONITOR1","ITEM ID : 1
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","MONITOR1.png","localhost/stock/lib/qr/userQr/MONITOR1.png");
INSERT INTO qrcodes VALUES("6","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("7","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("8","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("9","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("10","MONITOR1","ITEM ID : 1
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","MONITOR1.png","localhost/stock/lib/qr/userQr/MONITOR1.png");
INSERT INTO qrcodes VALUES("11","MONITOR1","ITEM ID : 1
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","MONITOR1.png","localhost/stock/lib/qr/userQr/MONITOR1.png");
INSERT INTO qrcodes VALUES("12","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("13","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("14","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("15","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("16","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("17","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("18","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("19","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("20","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("21","SCOOTY3","ITEM ID : 3
ITEM NAME : SCOOTY
ITEM CATEGORY : ELECTRICAL
Cost/Unit :80000
QLP No :RV/1/123445/
CIV No :12345
PURCHASE DATE :2021-07-10
VENDOR :INFOSYS
ITEM IN :QM Store","SCOOTY3.png","localhost/stock/lib/qr/userQr/SCOOTY3.png");
INSERT INTO qrcodes VALUES("22","MONITOR2","ITEM ID : 2
ITEM NAME : MONITOR
ITEM CATEGORY :COMN ITEM
Cost/Unit :2200
QLP No :TECH/333/56
CIV No :L225021
PURCHASE DATE :2022-07-01
VENDOR :INFOSYS
ITEM IN :QM Store","MONITOR2.png","localhost/stock/lib/qr/userQr/MONITOR2.png");
INSERT INTO qrcodes VALUES("23","SCOOTY3","ITEM ID : 3
ITEM NAME : SCOOTY
ITEM CATEGORY : ELECTRICAL
Cost/Unit :80000
QLP No :RV/1/123445/
CIV No :12345
PURCHASE DATE :2021-07-10
VENDOR :INFOSYS
ITEM IN :QM Store","SCOOTY3.png","localhost/stock/lib/qr/userQr/SCOOTY3.png");
INSERT INTO qrcodes VALUES("24","SCOOTY2","ITEM ID : 2
ITEM NAME : SCOOTY
ITEM CATEGORY : ELECTRICAL
Cost/Unit :80000
QLP No :RV/1/123445/
CIV No :12345
PURCHASE DATE :2021-07-10
VENDOR :INFOSYS
ITEM IN :3 COY RR STORE","SCOOTY2.png","localhost/stock/lib/qr/userQr/SCOOTY2.png");
INSERT INTO qrcodes VALUES("25","PLASTIC CHAIR4","ITEM ID : 4
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","PLASTIC CHAIR4.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR4.png");
INSERT INTO qrcodes VALUES("26","TP-LINK 4G LTE MODEM5","ITEM ID : 5
ITEM NAME : TP-LINK 4G LTE MODEM
ITEM CATEGORY : ACG GRANT
Cost/Unit :5000
QLP No :V/24
CIV No :CRV/ACG/58
PURCHASE DATE :2022-03-18
VENDOR :UNIVERSAL TRADING CO
ITEM IN :QM Store","TP-LINK 4G LTE MODEM5.png","localhost/stock/lib/qr/userQr/TP-LINK 4G LTE MODEM5.png");
INSERT INTO qrcodes VALUES("27","SHAMIYANA WATER PROOF6","ITEM ID : 6
ITEM NAME : SHAMIYANA WATER PROOF
ITEM CATEGORY : ACG GRANT
Cost/Unit :56200
QLP No :V/20
CIV No :CRV/ACG/56
PURCHASE DATE :2022-03-12
VENDOR :LAXMI DYEING
ITEM IN :QM Store","SHAMIYANA WATER PROOF6.png","localhost/stock/lib/qr/userQr/SHAMIYANA WATER PROOF6.png");
INSERT INTO qrcodes VALUES("28","GOOD QUALITEY WITH LID 1000 ML WATER JUG7","ITEM ID : 7
ITEM NAME : GOOD QUALITEY WITH LID 1000 ML WATER JUG
ITEM CATEGORY :ACG
Cost/Unit :760
QLP No :V/28R
CIV No :CRV/ACG/60
PURCHASE DATE :2022-03-03
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png","localhost/stock/lib/qr/userQr/GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png");
INSERT INTO qrcodes VALUES("29","GOOD QUALITEY WITH LID 1000 ML WATER JUG7","ITEM ID : 7
ITEM NAME : GOOD QUALITEY WITH LID 1000 ML WATER JUG
ITEM CATEGORY :ACG
Cost/Unit :760
QLP No :V/28R
CIV No :CRV/ACG/60
PURCHASE DATE :2022-03-03
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png","localhost/stock/lib/qr/userQr/GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png");
INSERT INTO qrcodes VALUES("30","GOOD QUALITEY WITH LID 1000 ML WATER JUG7","ITEM ID : 7
ITEM NAME : GOOD QUALITEY WITH LID 1000 ML WATER JUG
ITEM CATEGORY :ACG
Cost/Unit :760
QLP No :V/28R
CIV No :CRV/ACG/60
PURCHASE DATE :2022-03-03
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png","localhost/stock/lib/qr/userQr/GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png");
INSERT INTO qrcodes VALUES("31","GOOD QUALITEY WITH LID 1000 ML WATER JUG7","ITEM ID : 7
ITEM NAME : GOOD QUALITEY WITH LID 1000 ML WATER JUG
ITEM CATEGORY :ACG
Cost/Unit :760
QLP No :V/28R
CIV No :CRV/ACG/60
PURCHASE DATE :2022-03-03
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png","localhost/stock/lib/qr/userQr/GOOD QUALITEY WITH LID 1000 ML WATER JUG7.png");
INSERT INTO qrcodes VALUES("32","BOROSIL 1000 MLBOWL(1 PIECE IN SET)8","ITEM ID : 8
ITEM NAME : BOROSIL 1000 MLBOWL(1 PIECE IN SET)
ITEM CATEGORY :ACG GRANT
Cost/Unit :960
QLP No :V/30
CIV No :ACG/60
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","BOROSIL 1000 MLBOWL(1 PIECE IN SET)8.png","localhost/stock/lib/qr/userQr/BOROSIL 1000 MLBOWL(1 PIECE IN SET)8.png");
INSERT INTO qrcodes VALUES("33","UNBRANDED GLASS TRANSPARENT ROUND BOWL9","ITEM ID : 9
ITEM NAME : UNBRANDED GLASS TRANSPARENT ROUND BOWL
ITEM CATEGORY : ACG GRANT
Cost/Unit :755
QLP No :V/40
CIV No :CRV/ACG/60
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","UNBRANDED GLASS TRANSPARENT ROUND BOWL9.png","localhost/stock/lib/qr/userQr/UNBRANDED GLASS TRANSPARENT ROUND BOWL9.png");
INSERT INTO qrcodes VALUES("34","UNBRANDED PRINTED VINYL ON SUN BOARD10","ITEM ID : 10
ITEM NAME : UNBRANDED PRINTED VINYL ON SUN BOARD
ITEM CATEGORY : ACG GRANT
Cost/Unit :6500
QLP No :V/25R
CIV No :CRV/ACG/59
PURCHASE DATE :2022-03-18
VENDOR :JUNEJA COMPUTERS
ITEM IN :QM Store","UNBRANDED PRINTED VINYL ON SUN BOARD10.png","localhost/stock/lib/qr/userQr/UNBRANDED PRINTED VINYL ON SUN BOARD10.png");
INSERT INTO qrcodes VALUES("35","UNBRANDED BACKREST BEDCLOTHES RUBBERISED COIR MATTRESS CUSHIONS AND PILLOWS11","ITEM ID : 11
ITEM NAME : UNBRANDED BACKREST BEDCLOTHES RUBBERISED COIR MATTRESS CUSHIONS AND PILLOWS
ITEM CATEGORY : ACG
Cost/Unit :4500
QLP No :V/25
CIV No :CRV/ACG/57
PURCHASE DATE :2022-03-18
VENDOR :ERA ENTERPRISES
ITEM IN :QM Store","UNBRANDED BACKREST BEDCLOTHES RUBBERISED COIR MATTRESS CUSHIONS AND PILLOWS11.png","localhost/stock/lib/qr/userQr/UNBRANDED BACKREST BEDCLOTHES RUBBERISED COIR MATTRESS CUSHIONS AND PILLOWS11.png");
INSERT INTO qrcodes VALUES("36","SHAMIYANA WATER PROOF12","ITEM ID : 12
ITEM NAME : SHAMIYANA WATER PROOF
ITEM CATEGORY : ACG GRANT
Cost/Unit :56200
QLP No :V/20
CIV No :CRV/ACG/56
PURCHASE DATE :2022-03-12
VENDOR :LAXMI DYEING
ITEM IN :QM Store","SHAMIYANA WATER PROOF12.png","localhost/stock/lib/qr/userQr/SHAMIYANA WATER PROOF12.png");
INSERT INTO qrcodes VALUES("37","CANOPY SHAMIYANA13","ITEM ID : 13
ITEM NAME : CANOPY SHAMIYANA
ITEM CATEGORY : ACG
Cost/Unit :56000
QLP No :V/17
CIV No :CRV/ACG/48
PURCHASE DATE :2022-02-26
VENDOR :LAXMI DYEING
ITEM IN :QM Store","CANOPY SHAMIYANA13.png","localhost/stock/lib/qr/userQr/CANOPY SHAMIYANA13.png");
INSERT INTO qrcodes VALUES("38","UNBRANDED REVOLVING CHAIR WITH ARMS14","ITEM ID : 14
ITEM NAME : UNBRANDED REVOLVING CHAIR WITH ARMS
ITEM CATEGORY :ACG
Cost/Unit :10030
QLP No :V/222
CIV No :CRV/ACG/47
PURCHASE DATE :2022-02-20
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","UNBRANDED REVOLVING CHAIR WITH ARMS14.png","localhost/stock/lib/qr/userQr/UNBRANDED REVOLVING CHAIR WITH ARMS14.png");
INSERT INTO qrcodes VALUES("39","UNBRANDED REVOLVING CHAIR WITH ARMS14","ITEM ID : 14
ITEM NAME : UNBRANDED REVOLVING CHAIR WITH ARMS
ITEM CATEGORY :ACG
Cost/Unit :10030
QLP No :V/222
CIV No :CRV/ACG/47
PURCHASE DATE :2022-02-20
VENDOR :REDHU ENTERPRISES
ITEM IN :QM Store","UNBRANDED REVOLVING CHAIR WITH ARMS14.png","localhost/stock/lib/qr/userQr/UNBRANDED REVOLVING CHAIR WITH ARMS14.png");
INSERT INTO qrcodes VALUES("40","SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15","ITEM ID : 15
ITEM NAME : SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED
ITEM CATEGORY :ACG
Cost/Unit :2550
QLP No :V/16R
CIV No :CRV/ACG/46
PURCHASE DATE :2022-02-18
VENDOR :NATIONAL MUSKETARY STORE
ITEM IN :QM Store","SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15.png","localhost/stock/lib/qr/userQr/SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15.png");
INSERT INTO qrcodes VALUES("41","UNBRANDED REVOLVING CHAIR WITH ARMS14","ITEM ID : 14
ITEM NAME : UNBRANDED REVOLVING CHAIR WITH ARMS
ITEM CATEGORY :ACG
Cost/Unit :10030
QLP No :V/222
CIV No :CRV/ACG/47
PURCHASE DATE :2022-02-20
VENDOR :REDHU ENTERPRISES
ITEM IN :QM Store","UNBRANDED REVOLVING CHAIR WITH ARMS14.png","localhost/stock/lib/qr/userQr/UNBRANDED REVOLVING CHAIR WITH ARMS14.png");
INSERT INTO qrcodes VALUES("42","UNBRANDED BELT DRIVE WATER PUMP MOTOR16","ITEM ID : 16
ITEM NAME : UNBRANDED BELT DRIVE WATER PUMP MOTOR
ITEM CATEGORY : ACG
Cost/Unit :5200
QLP No :V/12R
CIV No :CRV/ACG/45
PURCHASE DATE :2022-02-16
VENDOR :ERA ENTERPRISES
ITEM IN :QM Store","UNBRANDED BELT DRIVE WATER PUMP MOTOR16.png","localhost/stock/lib/qr/userQr/UNBRANDED BELT DRIVE WATER PUMP MOTOR16.png");
INSERT INTO qrcodes VALUES("43","OREVA 1200 WATT RADIANT HEATER17","ITEM ID : 17
ITEM NAME : OREVA 1200 WATT RADIANT HEATER
ITEM CATEGORY : ACG
Cost/Unit :1250
QLP No :V/09R
CIV No :CRV/ACG/42
PURCHASE DATE :2022-02-08
VENDOR :JUNEJA COMPUTERS
ITEM IN :QM Store","OREVA 1200 WATT RADIANT HEATER17.png","localhost/stock/lib/qr/userQr/OREVA 1200 WATT RADIANT HEATER17.png");
INSERT INTO qrcodes VALUES("44","UNBRANDED 1200 WATT RADIANT HEATER18","ITEM ID : 18
ITEM NAME : UNBRANDED 1200 WATT RADIANT HEATER
ITEM CATEGORY : ACG
Cost/Unit :10400
QLP No :V/06R
CIV No :CRV/ACG/39
PURCHASE DATE :2022-01-30
VENDOR :BANSAL TRACTOR & TRADING CO
ITEM IN :QM Store","UNBRANDED 1200 WATT RADIANT HEATER18.png","localhost/stock/lib/qr/userQr/UNBRANDED 1200 WATT RADIANT HEATER18.png");
INSERT INTO qrcodes VALUES("45","SIDE TABLE19","ITEM ID : 19
ITEM NAME : SIDE TABLE
ITEM CATEGORY : ACG
Cost/Unit :9800
QLP No :212R
CIV No :CRV/ACG/36
PURCHASE DATE :2021-12-11
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","SIDE TABLE19.png","localhost/stock/lib/qr/userQr/SIDE TABLE19.png");
INSERT INTO qrcodes VALUES("46","MAIN TABLE20","ITEM ID : 20
ITEM NAME : MAIN TABLE
ITEM CATEGORY : ACG
Cost/Unit :14400
QLP No :213R
CIV No :CRV/ACG/36
PURCHASE DATE :2021-12-11
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","MAIN TABLE20.png","localhost/stock/lib/qr/userQr/MAIN TABLE20.png");
INSERT INTO qrcodes VALUES("47","ZEBRA BLIND SMALL21","ITEM ID : 21
ITEM NAME : ZEBRA BLIND SMALL
ITEM CATEGORY : ACG
Cost/Unit :3000
QLP No :214R
CIV No :CRV/ACG/36
PURCHASE DATE :2021-12-11
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","ZEBRA BLIND SMALL21.png","localhost/stock/lib/qr/userQr/ZEBRA BLIND SMALL21.png");
INSERT INTO qrcodes VALUES("48","ZEBRA BLIND LARGE22","ITEM ID : 22
ITEM NAME : ZEBRA BLIND LARGE
ITEM CATEGORY : ACG
Cost/Unit :5200
QLP No :215R
CIV No :CRV/ACG/36
PURCHASE DATE :2021-12-11
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","ZEBRA BLIND LARGE22.png","localhost/stock/lib/qr/userQr/ZEBRA BLIND LARGE22.png");
INSERT INTO qrcodes VALUES("49","FROSTED FILM23","ITEM ID : 23
ITEM NAME : FROSTED FILM
ITEM CATEGORY : ACG
Cost/Unit :1500
QLP No :216R
CIV No :CRV/ACG/36
PURCHASE DATE :2021-12-11
VENDOR :SIDHI VINAYAKA COMPUTERS & TRA
ITEM IN :QM Store","FROSTED FILM23.png","localhost/stock/lib/qr/userQr/FROSTED FILM23.png");
INSERT INTO qrcodes VALUES("50","KMT KRISHNA MEDITECH FRONT FREEZER24","ITEM ID : 24
ITEM NAME : KMT KRISHNA MEDITECH FRONT FREEZER
ITEM CATEGORY : ACG
Cost/Unit :42500
QLP No :V/239
CIV No :CRV/ACG/16
PURCHASE DATE :2021-07-22
VENDOR :NATIONAL MUSKETARY STORE
ITEM IN :QM Store","KMT KRISHNA MEDITECH FRONT FREEZER24.png","localhost/stock/lib/qr/userQr/KMT KRISHNA MEDITECH FRONT FREEZER24.png");
INSERT INTO qrcodes VALUES("51","PLASTIC CHAIR3","ITEM ID : 3
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :RP STORE","PLASTIC CHAIR3.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR3.png");
INSERT INTO qrcodes VALUES("52","PLASTIC CHAIR3","ITEM ID : 3
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :RP STORE","PLASTIC CHAIR3.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR3.png");
INSERT INTO qrcodes VALUES("53","PLASTIC CHAIR4","ITEM ID : 4
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","PLASTIC CHAIR4.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR4.png");
INSERT INTO qrcodes VALUES("54","PLASTIC CHAIR4","ITEM ID : 4
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","PLASTIC CHAIR4.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR4.png");
INSERT INTO qrcodes VALUES("55","PLASTIC CHAIR4","ITEM ID : 4
ITEM NAME : PLASTIC CHAIR
ITEM CATEGORY : ACG
Cost/Unit :585.00
QLP No :V/40R
CIV No :CRV/ACG/61
PURCHASE DATE :2022-03-20
VENDOR :RAJ MOTOR STORE
ITEM IN :QM Store","PLASTIC CHAIR4.png","localhost/stock/lib/qr/userQr/PLASTIC CHAIR4.png");
INSERT INTO qrcodes VALUES("56","SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15","ITEM ID : 15
ITEM NAME : SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED
ITEM CATEGORY :ACG
Cost/Unit :2550
QLP No :V/16R
CIV No :CRV/ACG/46
PURCHASE DATE :2022-02-18
VENDOR :NATIONAL MUSKETARY STORE
ITEM IN :QM Store","SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15.png","localhost/stock/lib/qr/userQr/SUPREME PLASTIC CHAIR WITH ARMS WITH CUSHION SEPARATED MODULED15.png");
INSERT INTO qrcodes VALUES("57","Tenmars 3-1/2 digits LCD. Digital Light Meter25","ITEM ID : 25
ITEM NAME : Tenmars 3-1/2 digits LCD. Digital Light Meter
ITEM CATEGORY : TT&IE
Cost/Unit :10000
QLP No :TT&IE/VII/83
CIV No :CRV/TT&IE/31
PURCHASE DATE :2021-08-19
VENDOR :INFOSYS
ITEM IN :QM Store","Tenmars 3-1/2 digits LCD. Digital Light Meter25.png","localhost/stock/lib/qr/userQr/Tenmars 3-1/2 digits LCD. Digital Light Meter25.png");
INSERT INTO qrcodes VALUES("58","Tenmars 3-1/2 digits LCD. Digital Light Meter25","ITEM ID : 25
ITEM NAME : Tenmars 3-1/2 digits LCD. Digital Light Meter
ITEM CATEGORY : TT&IE
Cost/Unit :10000
QLP No :TT&IE/VII/83
CIV No :CRV/TT&IE/31
PURCHASE DATE :2021-08-19
VENDOR :INFOSYS
ITEM IN :QM Store","Tenmars 3-1/2 digits LCD. Digital Light Meter25.png","localhost/stock/lib/qr/userQr/Tenmars 3-1/2 digits LCD. Digital Light Meter25.png");
INSERT INTO qrcodes VALUES("59","keyboard26","ITEM ID : 26
ITEM NAME : keyboard
ITEM CATEGORY : it
Cost/Unit :350
QLP No :v/285
CIV No :265/cv
PURCHASE DATE :2021-07-15
VENDOR :INFOSYS
ITEM IN :QM Store","keyboard26.png","localhost/stock/lib/qr/userQr/keyboard26.png");
INSERT INTO qrcodes VALUES("60","Tenmars 3-1/2 digits LCD. Digital Light Meter27","ITEM ID : 27
ITEM NAME : Tenmars 3-1/2 digits LCD. Digital Light Meter
ITEM CATEGORY : TT&IE
Cost/Unit :10000
QLP No :TT&IE/VII/83
CIV No :CRV/TT&IE/31
PURCHASE DATE :2021-08-17
VENDOR :INFOSYS
ITEM IN :QM Store","Tenmars 3-1/2 digits LCD. Digital Light Meter27.png","localhost/stock/lib/qr/userQr/Tenmars 3-1/2 digits LCD. Digital Light Meter27.png");
INSERT INTO qrcodes VALUES("61","Tenmars 3-1/2 digits LCD Digital Light Meter27","ITEM ID : 27
ITEM NAME : Tenmars 3-1/2 digits LCD Digital Light Meter
ITEM CATEGORY :TT&IE
Cost/Unit :10000
QLP No :TT&IE/VII/83
CIV No :CRV/TT&IE/31
PURCHASE DATE :2021-08-17
VENDOR :INFOSYS
ITEM IN :QM Store","Tenmars 3-1/2 digits LCD Digital Light Meter27.png","localhost/stock/lib/qr/userQr/Tenmars 3-1/2 digits LCD Digital Light Meter27.png");
INSERT INTO qrcodes VALUES("62","Tenmars digits LCD Digital Light Meter27","ITEM ID : 27
ITEM NAME : Tenmars digits LCD Digital Light Meter
ITEM CATEGORY :TT&IE
Cost/Unit :10000
QLP No :TT&IE/VII/83
CIV No :CRV/TT&IE/31
PURCHASE DATE :2021-08-17
VENDOR :INFOSYS
ITEM IN :QM Store","Tenmars digits LCD Digital Light Meter27.png","localhost/stock/lib/qr/userQr/Tenmars digits LCD Digital Light Meter27.png");
INSERT INTO qrcodes VALUES("63","Monitor28","ITEM ID : 28
ITEM NAME : Monitor
ITEM CATEGORY :dsaf
Cost/Unit :2000
QLP No :20
CIV No :12/civ
PURCHASE DATE :0000-00-00
VENDOR :REDHU ENTERPRISES
ITEM IN :QM Store","Monitor28.png","localhost/stock/lib/qr/userQr/Monitor28.png");
INSERT INTO qrcodes VALUES("64","Mobile29","ITEM ID : 29
ITEM NAME : Mobile
ITEM CATEGORY : ACG
Cost/Unit :800
QLP No :v/6
CIV No :fdfsf
PURCHASE DATE :0000-00-00
VENDOR :INFOSYS
ITEM IN :QM Store","Mobile29.png","localhost/stock/lib/qr/userQr/Mobile29.png");
INSERT INTO qrcodes VALUES("65","sdsff12","ITEM ID : 12
ITEM NAME : sdsff
ITEM CATEGORY : asf
Cost/Unit :23
QLP No :sda
CIV No :sdaasd
PURCHASE DATE :0000-00-00
VENDOR :INFOSYS
ITEM IN :IT STORE","sdsff12.png","localhost/stock/lib/qr/userQr/sdsff12.png");



CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_details` varchar(255) NOT NULL,
  `added_at` date NOT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `supplier_name` (`supplier_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("1","INFOSYS","SOFTWARE SOLUTIONS","2022-07-05");
INSERT INTO supplier VALUES("2","RAJ MOTOR STORE"," 205 AUTO MARKET HISAR","2021-07-15");
INSERT INTO supplier VALUES("3","JUNEJA COMPUTERS"," TCP-1 HISAR CANTT","2021-07-15");
INSERT INTO supplier VALUES("4","UNIVERSAL TRADING CO"," GH4-346 MEERA APARTMENT","2021-07-15");
INSERT INTO supplier VALUES("5","ERA ENTERPRISES"," NEAR KANPUR ARMY STORE","2021-07-15");
INSERT INTO supplier VALUES("6","LAXMI DYEING"," 22 KHATRI NAGAR,JAIPUR","2021-07-15");
INSERT INTO supplier VALUES("7","REDHU ENTERPRISES"," K BLOCK K-89 NEW MODEL TOWN HISAR","2021-07-15");
INSERT INTO supplier VALUES("8","NATIONAL MUSKETARY STORE"," 1ST FLOOR BOARD MARKET HISAR","2021-07-15");
INSERT INTO supplier VALUES("9","BANSAL TRACTOR & TRADING CO","382,AUTO MARKET,HISAR","2021-07-15");
INSERT INTO supplier VALUES("10","SIDHI VINAYAKA COMPUTERS & TRA","204 AUTO MARKET, HISAR","2021-07-15");
