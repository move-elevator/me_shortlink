#
# Table structure for table 'tx_meshortlink_domain_model_shortlink'
#
CREATE TABLE tx_meshortlink_domain_model_shortlink (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,

  title varchar(255) DEFAULT '' NOT NULL,
  page int(11) DEFAULT '0' NOT NULL,
  url varchar(255) DEFAULT '' NOT NULL,
  params varchar(255) DEFAULT '' NOT NULL,
  is_dummy_record tinyint(4) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  starttime int(11) unsigned DEFAULT '0' NOT NULL,
  endtime int(11) unsigned DEFAULT '0' NOT NULL,

  t3ver_oid INT(11) DEFAULT '0' NOT NULL,
  t3ver_id INT(11) DEFAULT '0' NOT NULL,
  t3ver_wsid INT(11) DEFAULT '0' NOT NULL,
  t3ver_label VARCHAR(30) DEFAULT '' NOT NULL,
  t3ver_state TINYINT(4) DEFAULT '0' NOT NULL,
  t3ver_stage TINYINT(4) DEFAULT '0' NOT NULL,
  t3ver_count INT(11) DEFAULT '0' NOT NULL,
  t3ver_tstamp INT(11) DEFAULT '0' NOT NULL,
  t3_origuid INT(11) DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid),
  KEY parent (pid),
);

#
# Table structure for table 'tx_meshortlink_domain_model_domain'
#
CREATE TABLE tx_meshortlink_domain_model_domain (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,

  name varchar(255) DEFAULT '' NOT NULL,
  is_dummy_record tinyint(4) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
  starttime int(11) unsigned DEFAULT '0' NOT NULL,
  endtime int(11) unsigned DEFAULT '0' NOT NULL,


  t3ver_oid INT(11) DEFAULT '0' NOT NULL,
  t3ver_id INT(11) DEFAULT '0' NOT NULL,
  t3ver_wsid INT(11) DEFAULT '0' NOT NULL,
  t3ver_label VARCHAR(30) DEFAULT '' NOT NULL,
  t3ver_state TINYINT(4) DEFAULT '0' NOT NULL,
  t3ver_stage TINYINT(4) DEFAULT '0' NOT NULL,
  t3ver_count INT(11) DEFAULT '0' NOT NULL,
  t3ver_tstamp INT(11) DEFAULT '0' NOT NULL,
  t3_origuid INT(11) DEFAULT '0' NOT NULL,

  PRIMARY KEY (uid),
  KEY parent (pid)
);
