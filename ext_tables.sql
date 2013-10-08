#
# Table structure for table 'tx_meshortlink_domain_model_shortlink'
#
CREATE TABLE tx_meshortlink_domain_model_shortlink (
  uid             INT(11)                         NOT NULL AUTO_INCREMENT,
  pid             INT(11) DEFAULT '0'             NOT NULL,
  title           VARCHAR(255) DEFAULT ''         NOT NULL,
  page            INT(11) DEFAULT '0'             NOT NULL,
  url             VARCHAR(255) DEFAULT ''         NOT NULL,
  params          VARCHAR(255) DEFAULT ''         NOT NULL,
  is_dummy_record TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  tstamp          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id       INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted         TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime       INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime         INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid),

);

#
# Table structure for table 'tx_meshortlink_domain_model_domain'
#
CREATE TABLE tx_meshortlink_domain_model_domain (

  uid             INT(11)                         NOT NULL AUTO_INCREMENT,
  pid             INT(11) DEFAULT '0'             NOT NULL,
  name            VARCHAR(255) DEFAULT ''         NOT NULL,
  is_dummy_record TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  tstamp          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id       INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted         TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime       INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime         INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid)
);